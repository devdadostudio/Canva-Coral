<?php

/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 6.1.0
 */

defined('ABSPATH') || exit;

global $product;

$attribute_keys = array_keys($attributes);

do_action('woocommerce_before_add_to_cart_form');

// controlla se libro è uscito o no
// $today = strtotime(date('Ymd'));

$today = canva_get_current_time('Ymd');
$data_pubblicazione = strtotime(get_field('data_pubblicazione', $product->get_id()));

// echo strtotime($data_pubblicazione);
// echo $today . ' - ' . $data_pubblicazione;

if ($today < $data_pubblicazione) {
	$selling_type = 'Preordina';
} else {
	$selling_type = 'Acquista';
}
?>

<div class="_add-to-cart-buttons flex flex-wrap justify-between">

	<?php
	$product_variations = $product->get_available_variations();
	$variations = $product_variations;

	foreach ($variations as $variation) :

		$stock = $variation['is_in_stock'];
		$attribute_formato = $variation['attributes']['attribute_pa_tipo-libro'];
		$variation_id = $variation['variation_id'];
		$variation_sku = str_replace('-', '', $variation['sku']);
		$variation_price = $variation['display_price'];

		if ($stock == 1) {
			$stock_content =  ' - In stock';
		} else {
			$stock_content =  ' - Out of stock';
		}

	?>
		<form class="variations_form cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint($product->get_id()); ?>" data-product_variations="<?php echo $variations_attr; ?>">

			<?php do_action('woocommerce_before_variations_form'); ?>

			<?php if ($stock >= 1) { ?>

				<?php if ($attribute_formato == 'libro') { ?>

					<div class="_libro flex flex-col">

						<span class="_label mb-2">
							<?php echo $selling_type . ' ' . $attribute_formato; ?>
						</span>

						<button type="submit" class="single_add_to_cart_button ajax_add_to_cart button hollow w-48" type="submit" data-product_id="<?php echo $variation_id; ?>" data-price="<?php echo esc_attr($variation_price); ?>">
							<div class="_add-to-cart-icon _icon-wrap">
								<figure class="_shopping-cart-icon absolute w-16">
									<?php echo canva_get_svg_icon('icons/book', 'w-4 mr-2 _shopping-cart-icon absolute'); ?>
								</figure>

								<figure class="_check-icon absolute w-16 opacity-0">
									<?php echo canva_get_svg_icon('fontawesome/regular/check', '_check-icon absolute opacity-0'); ?>
								</figure>
							</div>
							<div class="_add-to-cart-message relative">
								<span class="_add-to-cart-text block">
									<?php
									//echo $attribute_formato;
									echo wc_price($variation_price);
									?>
								</span>
								<span class="_added-to-cart-text block hidden">
									Aggiunto
								</span>
							</div>
						</button>
						<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>">
						<input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
						<input type="hidden" name="variation_id" class="variation_id" value="<?php echo $variation_id; ?>">
					</div>

				<?php } else { ?>

					<div class="_ebook flex flex-col">
						<span class="_label mb-2">
							<?php echo $selling_type . ' ' . $attribute_formato; ?>
						</span>
						<button type="submit" class="single_add_to_cart_button ajax_add_to_cart button hollow w-48" type="submit" data-productid="<?php echo $variation_id; ?>" data-price="<?php echo esc_attr($variation_price); ?>">
							<div class="_add-to-cart-icon _icon-wrap">
								<figure class="_shopping-cart-icon absolute w-16">
									<?php echo canva_get_svg_icon('icons/book', 'w-4 mr-2 _shopping-cart-icon absolute'); ?>
								</figure>

								<figure class="_check-icon absolute w-16 opacity-0">
									<?php echo canva_get_svg_icon('fontawesome/regular/check', '_check-icon absolute opacity-0'); ?>
								</figure>
							</div>
							<div class="_add-to-cart-message relative">
								<span class="_add-to-cart-text block">
									<?php
									//echo $attribute_formato;
									echo wc_price($variation_price);
									?>
								</span>
								<span class="_added-to-cart-text block hidden">
									Aggiunto
								</span>
							</div>
						</button>
						<input type="hidden" name="add-to-cart" value="<?php echo $product->get_id(); ?>">
						<input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
						<input type="hidden" name="variation_id" class="variation_id" value="<?php echo $variation_id; ?>">
					</div>

				<?php } ?>


				<?php do_action('woocommerce_after_add_to_cart_button'); ?>

				<?php do_action('woocommerce_after_variations_form'); ?>
		</form>

	<?php } else { ?>

		<div style="_out-of-stock">
			<strong><?php echo ucfirst($attribute_formato); ?></strong>
			<?php _e('<span class="block">Non disponibile</span>', 'studio42-wooc'); ?>
		</div>

	<?php } ?>

<?php endforeach; ?>

</div>

<?php
do_action('woocommerce_after_add_to_cart_form');
