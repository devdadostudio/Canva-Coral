<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Carrello
 * Modifica taglio e classi immagine prodotto
 *
 * @param [type] $product_get_image
 * @param [type] $cart_item
 * @param [type] $cart_item_key
 * @return void
 */

function filter_woocommerce_cart_item_thumbnail($product_get_image, $cart_item, $cart_item_key)
{
	$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
	return $_product->get_image('160-free', array('class' => 'w-24'));
};
add_filter('woocommerce_cart_item_thumbnail', 'filter_woocommerce_cart_item_thumbnail', 10, 3);



/**
 * Modifica il numero di prodotti per pagina
 *
 * @param [type] $q
 * @return void
 */
function woocommerce_product_query($q)
{
	if ($q->is_main_query() && ($q->get('wc_query') === 'product_query')) {
		$q->set('posts_per_page', 12);

		if (is_facetwp_activated()) {
			$q->set('facetwp', 1);
		}
	}
}
add_action('woocommerce_product_query', 'woocommerce_product_query');



/**
 * Output a list of variation attributes for use in the cart forms.
 *
 * @param array $args Arguments.
 * @since 2.4.0
 */
function wc_dropdown_variation_attribute_options($args = array())
{
	$args = wp_parse_args(
		apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args),
		array(
			'options'          => false,
			'attribute'        => false,
			'product'          => false,
			'selected'         => false,
			'name'             => '',
			'id'               => '',
			'class'            => '',
			'show_option_none' => __('Choose an option', 'woocommerce'),
		)
	);

	// Get selected value.
	if (false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
		$selected_key = 'attribute_' . sanitize_title($args['attribute']);
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
	$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
	$class                 = $args['class'];
	$show_option_none      = (bool) $args['show_option_none'];
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

	if (empty($options) && !empty($product) && !empty($attribute)) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[$attribute];
	}

	$html  = '<select id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
	$html .= '<option value="">' . esc_html($show_option_none_text) . '</option>';

	if (!empty($options)) {
		if ($product && taxonomy_exists($attribute)) {
			// Get terms if this is a taxonomy - ordered. We need the names too.
			$terms = wc_get_product_terms(
				$product->get_id(),
				$attribute,
				array(
					'fields' => 'all',
				)
			);

			foreach ($terms as $term) {
				if (in_array($term->slug, $options, true)) {
					if ($attribute === 'pa_combinazioni') {
						$color = '<div class="_color-combination mr-4 mb-4 rounded-full overflow-hidden border-2 border-gray-300 transition-colors hover:border-black w-9">
							<div class="border-3 border-white h-8 w-8 rounded-full" style="background: linear-gradient(90deg, ' . get_field('term_color', $term) . ' 50%, ' . get_field('term_color_secondary', $term) . ' 50%);"></div>
						</div>';
					}
					$html .= '<option data-color-primary="' . get_field('term_color', $term) . '" data-color-secondary="' . get_field('term_color_secondary', $term) . '" value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name, $term, $attribute, $product)) . ' ' . $color . '</option>';
				}
			}
		} else {
			foreach ($options as $option) {
				// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
				$selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
				$html    .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option, null, $attribute, $product)) . '</option>';
			}
		}
	}

	$html .= '</select>';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args);
}


/**
 * Funzione usata per ajax per stampare la gallery per versioni desktop
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return void
 */
function abac_simple_product_gallery()
{
	if (isset($_GET['post_id']) && ('' != trim($_GET['post_id']))) {
		$post_id = esc_attr($_GET['post_id']);
	} elseif (isset($_POST['post_id']) && '' != trim($_POST['post_id'])) {
		$post_id = esc_attr($_POST['post_id']);
	} elseif (isset($_REQUEST['post_id']) && '' != trim($_REQUEST['post_id'])) {
		$post_id = esc_attr($_REQUEST['post_id']);
	}

	$gallery = explode(',', get_post_meta($post_id, '_product_image_gallery', true));
	if ($gallery) :
?>

		<div class="_gallery-variation grid grid-cols-1 lg:grid-cols-2 gap-1">

			<?php
			$i = 1;
			foreach ($gallery as $img) {
				echo canva_get_img([
					'img_id' => $img,
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					// 'img_class' => '',
					// 'wrapper_class' => 'photoswipe-item gallery-item gallery-item-' . $i++,
					'wrapper_class' => 'photoswipe-item relative ratio-1-1 group gallery-item gallery-item-' . $i++,
					'img_class' => 'absolute object-cover transform-gpu transition-all duration-slow group-hover:scale-105',
					'blazy' => 'off',
					'sercset' => 'on',
				]);
			}
			?>

		</div>

	<?php else : ?>

		<div class="_product-photo">
			<?php
			echo canva_get_img([
				'img_id'   =>  $post_id,
				'img_type' => 'img', // img, bg, url
				'thumb_size' =>  '960-free',
				'wrapper_class' => 'photoswipe-item relative ratio-4-5 group gallery-item gallery-item' . $post_id,
				'img_class' => 'absolute object-cover transform-gpu w-3/4',
				'blazy' => 'off',
			]);
			?>
		</div>

	<?php endif; ?>

	<?php
	wp_die();
}
add_action('wp_ajax_abac_simple_product_gallery', 'abac_simple_product_gallery');
add_action('wp_ajax_nopriv_abac_simple_product_gallery', 'abac_simple_product_gallery');



/**
 * stampa i post scelti con il post object di ACF con impostazione formato di ritorno ID e genera uno slider con swiper.
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param $attributes array
 */
function canva_simple_slider_by_ids($attributes = [])
{
	extract(shortcode_atts([
		'post_ids' => array(),
		'template_name' => 'render-blocks',
		'swiper_hero_class' => '',
		'swiper_container_class' => '',
		'prev_next' => 'true',
		'pagination' => 'true',
	], $attributes));

	// wp_send_json(wp_json_encode($attributes));

	if ($post_ids) {

		$element_id = esc_attr(wp_generate_password(16, false, false));
	?>
		<!-- ///////// Slider Posts ///////// -->
		<div id="<?php echo $element_id; ?>" class="<?php echo esc_attr($swiper_hero_class); ?>">

			<div class="swiper-container <?php echo $element_id; ?> <?php echo esc_attr($swiper_container_class); ?>">

				<div class="swiper-wrapper">

					<?php
					$i = 1;
					foreach ($post_ids as $post_id) {
						$item = $i++;
						// echo '<div class="swiper-slide">';
						canva_get_template(sanitize_text_field($template_name), ['post_id' => $post_id, 'item' => $item]);
						// echo '</div>';
					} ?>
				</div>

				<?php if ('true' === $pagination) { ?>
					<div class="swiper-pagination"></div>
				<?php } ?>

				<?php if ('true' === $prev_next) { ?>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				<?php } ?>

			</div>


		</div>
	<?php
	}
}

/**
 * stampa i post scelti con il post object di ACF con impostazione formato di ritorno ID e genera uno slider con swiper.
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param $attributes array
 */
function canva_simple_slider_thumbs_by_ids($attributes = [])
{
	extract(shortcode_atts([
		'post_ids' => array(),
		'template_name' => 'render-blocks',
		'swiper_hero_class' => '',
		'swiper_container_class' => '',
		'prev_next' => 'true',
		'pagination' => 'true',
	], $attributes));

	// wp_send_json(wp_json_encode($attributes));

	if ($post_ids) {
	?>
		<!-- ///////// Slider Posts ///////// -->
		<div class="<?php echo esc_attr($swiper_hero_class); ?>">

			<div class="swiper-container <?php echo esc_attr($swiper_container_class); ?>">

				<div class="swiper-wrapper">
					<?php
					$i = 1;
					foreach ($post_ids as $post_id) {
						$item = $i++;
						echo '<div class="swiper-slide">';
						canva_get_template(sanitize_text_field($template_name), ['post_id' => $post_id]);
						echo '</div>';
					} ?>
				</div>

			</div>


		</div>
	<?php
	}
}

/**
 * Funzione usata per ajax per stampare la gallery per versioni mobile
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return void
 */
function simple_product_silder_gallery($post_id)
{

	$thumbnail_id = get_post_thumbnail_id($thumbnail_id);

	// if (has_post_thumbnail($post_id)) {
	// 	$file = wp_basename(wp_get_attachment_image_src($thumbnail_id, '640-free')[0]);

	// 	if (false !== strpos($file, 'box1') || false !== strpos($file, 'Box1') || false !== strpos($file, 'hshshsji') || false !== strpos($file, '3dd08')) {
	// 		$thumbnail_id = 3967;
	// 	} else {
	// 		$thumbnail_id = get_post_thumbnail_id($post_id);
	// 	}
	// } else {

	// 	$thumbnail_id = 3967;
	// }

	if (get_post_meta($post_id, '_product_image_gallery', true)) {
		$gallery = explode(',', rtrim(get_post_meta($post_id, '_product_image_gallery', true), ','));
	}

	if (!empty($gallery)) :

		array_unshift($gallery, $thumbnail_id);

		canva_simple_slider_by_ids([
			'post_ids' => $gallery,
			'template_name' => 'swiper-product-gallery',
			'swiper_hero_class' => '_swiper-gallery',
			'swiper_container_class' => '',
			'prev_next' => 'true',
			'pagination' => 'true',
		]);

		if (count($gallery) > 1) {
			canva_simple_slider_thumbs_by_ids([
				'post_ids' => $gallery,
				'template_name' => 'swiper-product-gallery-thumb',
				'swiper_hero_class' => '_swiper-gallery-thumb',
				'swiper_container_class' => 'gallery-thumbs grid gap-4 grid-cols-' . count($gallery),
				'prev_next' => 'true',
				'pagination' => 'true',
			]);
		}
	?>

	<?php else : ?>

		<div class="_product-photo">
			<?php
			echo canva_get_img([
				'img_id'   =>  $thumbnail_id,
				'img_type' => 'img', // img, bg, url
				'thumb_size' =>  '960-free',
				'wrapper_class' => 'photoswipe-item relative ratio-1-1 group gallery-item gallery-item' . $post_id,
				'img_class' => 'absolute object-cover transform-gpu w-full',
				'blazy' => 'off',
			]);

			?>
		</div>

	<?php endif; ?>

<?php
}



/**
 * Stampa i data attribute per combinazione colore e taglia
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param [type] $classes
 * @return void
 */
function canva_body_data($classes)
{

	$output = '';

	if (is_single()) {
		global $post;
		$output = 'data-post-id="' . $post->ID . '"';

		if (get_post_type($post) == 'product') {
			$product = wc_get_product($post->ID);

			if ($product->is_type('variable')) {
				$default_attributes = $product->get_default_attributes();

				foreach ($default_attributes as $key => $default_attribute) {
					$output .= 'data-' . $key . '="' . $default_attribute . '"';
				}
			}
		}
	}

	if (is_tax()) {
		$queried_object = get_queried_object();
		$taxonomy = $queried_object->taxonomy;
		// $term_id = $queried_object->term_id;
		$term_slug = $queried_object->slug;

		$output .= 'data-tax="' . $taxonomy . '" data-term="' . $term_slug . '"';
	}

	echo $output;
}
add_action('canva_body_data', 'canva_body_data');





/*
* Automatically adding the product to the cart.
*/

function aaptc_add_product_to_cart($item_key, $product_id)
{
	if (!is_admin()) {

		$free_product_id = 39563;  // Product Id of the free product which will get added to cart
		$found = false;

		//check if product already in cart
		if (sizeof(WC()->cart->get_cart()) >= 2) {

			$libri = [];
			foreach (WC()->cart->get_cart() as $cart_item_key => $values) {

				$_product = $values['data'];
				$quantity = $values['quantity'];

				// dump_to_error_log($_product->attributes['pa_tipo-libro']);

				if ($_product->get_id() == $free_product_id) {
					$found = true;
				}

				if ($_product->attributes['pa_tipo-libro'] != 'ebook') {
					$libri[] = $_product->get_id();
				}
			}

			// if product not found, add it
			if (!$found && count($libri) >= 2) {
			// if (!$found && (count($libri) >= 2 || $items >= 2)) {
				WC()->cart->add_to_cart($free_product_id);
			}
		}
	}
}
add_action('woocommerce_add_to_cart', 'aaptc_add_product_to_cart', 10, 2);
