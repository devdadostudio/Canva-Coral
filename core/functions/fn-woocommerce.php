<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/* * *********************************************************************** */
/* Remove Action For Hooks TUTTI ******************************************* */
/* * *********************************************************************** */

//Risolve BUG Prezzi Prodotto Variabile
//mostra i prezzi dei prodotti variabili quando esiste anche solo una variazione
//https://github.com/woocommerce/woocommerce/issues/11827
add_filter('woocommerce_show_variation_price', '__return_true');

//Disattiva i 3 css di default di woocommerce
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

//Mostra 40 prodotti per pagina product per page
// add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 40); // da errore su abac boooo !!!

// Gallery Support
//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' );
//add_theme_support( 'wc-product-gallery-slider' );

//Disattiva galleria e lightbox
remove_theme_support('wc-product-gallery-zoom');
remove_theme_support('wc-product-gallery-lightbox');
remove_theme_support('wc-product-gallery-slider');

//Disattiva breadcrumb
// remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Add WooCommerce support for wrappers per
// http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
// remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
// remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


// ARCHIVI: Rimuove "ordina prodotti per" dalle liste prodotti
// remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
// ARCHIVI: Rimuove il titolo dalle liste prodotti
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
// ARCHIVI: Rimuove il rating dalle liste prodotti
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
// ARCHIVI: Rimuove il prezzo dalle liste prodotti
// remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);


// SINGOLA: Rimuove il sconti
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
// SINGOLA: Rimuove immagine del prodotto
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

// SINGOLA: Rimuove il Titolo dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
// SINGOLA: Rimuove il Rating dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
// SINGOLA: Rimuove il Prezzo dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
// SINGOLA: Rimuove il Riassunto dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// SINGOLA: Rimuove il Aggiungi al Carrello dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
// SINGOLA: Rimuove il Meta Info dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
// SINGOLA: Rimuove il Social Sharing dalla scheda singola
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);


// SINGOLA: Rimuove i TAB informativi standard WOOC dalla scheda singola
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
// SINGOLA: Rimuove i UPSELL dalla scheda singola
//remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
// SINGOLA: Rimuove i RELATED PRODUCTS dalla scheda singola
// remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);



//remove cross sell from cart
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
//serve per sganciare il metpdo di pagamento modificat hardcoded sul template
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

//remove coupon
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
// add_action('woocommerce_review_order_before_payment', 'woocommerce_checkout_coupon_form');

//remove accordion for term & conditions
//https://gist.github.com/rynaldos/4993f8515580601856d51fccf974f8de
// remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );
// remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );


// Add WooCommerce support for wrappers per http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
// !!! Verify if this feature is still in use
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
// add_action('woocommerce_before_main_content', 'canva_before_content', 10);
// add_action('woocommerce_after_main_content', 'canva_after_content', 10);



function filter_woocommerce_get_item_data($item_data, $cart_item)
{
	return $item_data;
}
add_filter('woocommerce_get_item_data', 'filter_woocommerce_get_item_data', 10, 2);


/**
 * Aggiorna la quantità nel menu via AJAX.
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param [type] $fragments
 */

if (!function_exists('canva_wooc_ajax_update_menu_cart_fragment')) {

	function canva_wooc_ajax_update_menu_cart_fragment($fragments)
	{
		global $woocommerce;

		ob_start();

		echo '<span class="_cart-items" > ' . WC()->cart->get_cart_contents_count() . '</span>';

		$fragments['.menu-item-icon-cart ._cart-items'] = ob_get_clean();

		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'canva_wooc_ajax_update_menu_cart_fragment');


/**
 * fix per i coupon con restrizione per email
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param [type] $result
 * @param [type] $coupon
 * @return void
 */
function wc_check_coupon_is_valid($result, $coupon)
{
	$user = wp_get_current_user();
	$restricted_emails = $coupon->get_email_restrictions();

	if (count($restricted_emails) > 0) {
		if (in_array($user->user_email, $restricted_emails)) {
			return $result;
		} else {
			return false;
		}
	} else {
		return $result;
	}
}
add_filter('woocommerce_coupon_is_valid', 'wc_check_coupon_is_valid', 10, 2);


/**
 * funzione anonima per gestire l'ordinamento nell'archivio prodotti
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param [type] $options
 * @return void
 */

add_filter('woocommerce_catalog_orderby', function ($options) {

	unset($options['popularity']);
	//unset( $options[ 'menu_order' ] );
	unset($options['rating']);
	//unset( $options[ 'date' ] );
	//unset( $options[ 'price' ] );
	//unset( $options[ 'price-desc' ] );

	return $options;
});




function canva_wooc_ajax_update_modal_cart_fragment()
{
	$cart = WC()->cart;

	// ob_start();

	$fragments = '(' . $cart->get_cart_contents_count() . ' pz - sub.tot. ' . $cart->get_total() . ')';

	echo $fragments;

	// ob_get_clean();

	wp_die();
}
add_action('wp_ajax_canva_wooc_ajax_update_modal_cart_fragment', 'canva_wooc_ajax_update_modal_cart_fragment');
add_action('wp_ajax_nopriv_canva_wooc_ajax_update_modal_cart_fragment', 'canva_wooc_ajax_update_modal_cart_fragment');



/**
 * trova ID variazione in base agli attributi
 *
 * @param [type] $product_id
 * @param array $attributes
 * @return void
 * @example https://stackoverflow.com/questions/53958871/woocommerce-get-product-variation-id-from-matching-attributes
 */
function get_product_variation_id_by_attributes($product_id, $attributes = [])
{
	return (new \WC_Product_Data_Store_CPT())->find_matching_product_variation(
		new \WC_Product($product_id),
		$attributes
	);
}



/**
 * Crea la modale del carrello
 *
 * @return void
 */
function canva_wooc_cart_ajax()
{
	$cart = WC()->cart;

	if (!$cart->is_empty()) {

?>
		<div class="_modal-cart-top p-4 shadow">
			<div class="_cart-modal-title flex items-center gap-4">
				<div class="_cart-icon">
					<?php echo canva_get_svg_icon('fontawesome/regular/shopping-cart', 'fill-current w-6'); ?>
				</div>
				<div class="_cart-text">
					<span class="block h3 fs-h2 mb-1">
						<?php _e('Your Cart', 'woocommerce'); ?>
					</span>
					<span class="_cart-sub-totals block fs-sm fw-300">
						<?php echo  $cart->get_cart_contents_count(); ?> <?php _e('pezzi - Sub Totale', 'canva-woocommerce'); ?> <?php echo $cart->get_total() ?>
					</span>
				</div>
			</div>
		</div>

		<div class="_modal-cart-items flex-1 overflow-y-auto">
			<?php

			foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
				$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
				// $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
				$product_id = $cart_item['product_id'];
				$product = $cart_item['data'];
				$delete_item = apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'woocommerce_cart_item_remove_link',
					sprintf(
						'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">' . __('Delete', 'woocommerce') . '</a>',
						esc_url(wc_get_cart_remove_url($cart_item_key)),
						esc_attr__('Delete', 'woocommerce'),
						esc_attr($product_id),
						esc_attr($cart_item_key),
						esc_attr($_product->get_sku())
					),
					$cart_item_key
				);

			?>
				<div class="_cart-item flex gap-4 px-4 py-6 border-b border-gray-200">

					<div class="_product-img">
						<a href="<?php echo $product->get_permalink($cart_item); ?>">
							<?php
							// $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('160-free',array('class' => 'w-24')), $cart_item, $cart_item_key);
							if (!$product_permalink) {
								// echo $thumbnail; // PHPCS: XSS ok.
								echo $_product->get_image('160-free', array('class' => 'w-20'));
							} else {
								echo canva_get_img([
									'img_id'   =>  $cart_item['product_id'],
									'img_type' => 'img', // img, bg, url
									'thumb_size' =>  '320-11',
									'img_class' =>  '',
									'wrapper_class' =>  '',
									'blazy' => 'off',
								]);
							}
							?>
						</a>
					</div>

					<div class="_product-data flex-1 pr-8">
						<a href="<?php echo $product->get_permalink($cart_item); ?>">
							<span class="_title block fs-xs uppercase fw-400 mb-1"><?php echo get_the_title($product_id); ?></span>
						</a>
						<span class="_price block fw-700 mb-4"><?php echo $cart->get_product_subtotal($product, $cart_item['quantity']); ?></span>
						<span class="_quantity flex items-center gap-8 fs-xxs lh-10">
							<span class="_quantity text-gray-400 inline-flex gap-2 items-center mr-8"><?php _e('Quantity', 'woocommerce'); ?>
								<span class="fw-700 text-black w-10 h-6 flex items-center justify-center rounded-full border border-black"><?php echo $cart_item['quantity']; ?></span>
							</span>
							<span class="_delete-item block"><?php echo $delete_item; ?></span>
						</span>
					</div>
					<div class="_product-item-delete self-end hide">
						<?php echo $delete_item; ?>
					</div>

				</div>


		<?php
			}
		} else { ?>
		<div class="_modal-cart-top p-4 shadow">
			<div class="_cart-modal-title flex items-center gap-4">
				<div class="_cart-icon">
					<?php echo canva_get_svg_icon('fontawesome/regular/shopping-cart', 'fill-current w-6'); ?>
				</div>
				<div class="_cart-text">
					<span class="block h3 fs-h2 mb-1">
						<?php _e('Your cart', 'woocommerce'); ?>
					</span>
					<span class="_cart-sub-totals block fs-sm fw-300">
						<?php echo  $cart->get_cart_contents_count(); ?> <?php _e('pezzi - Sub Totale', 'canva-woocommerce'); ?> <?php echo $cart->get_total() ?>
					</span>
				</div>
			</div>
		</div>
		<div class="_modal-cart-items flex-1 overflow-y-auto p-8">

			<?php _e('Your cart is currently empty', 'woocommerce'); ?>

		</div>
		<?php
		}
		?>
		</div>

		<div class="_modal-cart-bottom p-4 text-center">
			<a class="button hollow w-64 mb-4" href="<?php echo wc_get_cart_url(); ?>"><?php _e('Gestisci carrello', 'woocommerce'); ?></a>
			<a class="button w-64 mb-0" href="<?php echo wc_get_checkout_url(); ?>"><?php _e('Paga ordine', 'woocommerce'); ?></a>
		</div>
	<?php

	wp_die();
}
add_action('wp_ajax_canva_wooc_cart_ajax', 'canva_wooc_cart_ajax');
add_action('wp_ajax_nopriv_canva_wooc_cart_ajax', 'canva_wooc_cart_ajax');
