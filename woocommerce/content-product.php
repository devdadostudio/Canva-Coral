<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// echo $product->get_id();

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}


$today = canva_get_current_time('Ymd');
$data_pubblicazione = strtotime(get_field('data_pubblicazione', $product->get_id()));

?>

<a href="<?php echo get_permalink($product->get_id()); ?>">

	<div <?php wc_product_class('_card _card-product h-full relative border border-gray-200 group', $product); ?>>

		<div class="_card-img-container ratio-1-1 bg-gray-100 relative">

			<?php
			if (has_post_thumbnail($product->get_id())) :
			?>

				<div class="_card-img-wrap absolute">
					<?php
					echo canva_get_img([
						'img_id' => $product->get_id(),
						'img_type' => 'img', // img, bg, url
						'thumb_size' => '640-free',
						'img_class' => '_card-book-img w-full h-full object-contain object-center transform-gpu transition-all group-hover:scale-110 group-hover:-rotate-1',
						'wrapper_class' => '_figure-container relative w-full h-full flex items-center justify-center',
						'blazy' => 'on',
					]);
					?>
				</div>

			<?php endif; ?>

		</div>

		<div class="_card-status absolute -top-3 -left-3 flex flex-col gap-2">
			<?php if ($today < $data_pubblicazione) : ?>
				<div class="_new-flag w-14 h-14 flex justify-center items-center p-4 rounded-full rounded-br-none bg-white border-2 border-black text-center">
					<span class="fw-700 fs-xxs lh-12 uppercase inline-block"><?php _e('In arrivo', 'canva-add'); ?></span>
				</div>
			<?php endif; ?>
		</div>

		<div class="_card-info p-4 pt-6 relative">
			<div class="_bullet inline-flex fs-xs absolute top-0 left-0 transform-gpu -translate-y-1/2">
				<?php echo canva_get_category($product->get_id(), 'product_cat', $class = '', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
			</div>
			<div class="_card-info-wrap">
				<div class="_info">
					<div class="_product-title-wrap h-16">

						<?php
						$authors = get_field('libro_autore', $product->get_id());

						if ($authors) :
							$author_names = [];
							foreach ($authors as $author) {
								// dump_to_error_log($author->ID);
								$author_names[] = get_field('nome', $author->ID) . ' ' . get_field('cognome', $author->ID);
							}
						?>

							<div class="_toptitle block mb-2 fs-xs">
								<?php
								echo implode(', ', $author_names);
								?>
							</div>

						<?php endif; ?>

						<h3 class="_product-title mb-0">
							<span class="_title fs-h5 line-clamp-2"><?php echo get_field('titolo', $product->get_id()); ?></span>
						</h3>
					</div>

					<div class="_price-box flex flex-wrap gap-6 gap-y-2 mt-6">

						<?php
						// woocommerce_template_loop_price();
						$variations = $product->get_available_variations();

						foreach ($variations as $variation) :
							$attribute_formato = $variation['attributes']['attribute_pa_tipo-libro'];
							// dump_to_error_log($variation);
						?>

							<?php if ($attribute_formato == 'libro') : ?>
								<div class="_price-book-wrap inline-flex items-center gap-1">
									<div class="_icon-book w-4 h-4 bg-icon icon-book-sm"></div>
									<div class="flex-1 fs-sm fw-700 lh-10"><?php echo $variation['price_html']; ?></div>
								</div>
							<?php else : ?>
								<div class="_price-ebook-wrap inline-flex items-center gap-1">
									<div class="_icon-ebook w-4 h-4 bg-icon icon-ebook-sm"></div>
									<div class="flex-1 fs-sm fw-700 lh-10"><?php echo $variation['price_html']; ?></div>
								</div>
							<?php endif; ?>

						<?php endforeach; ?>

					</div>

					<?php
					/**
					 * Hook: woocommerce_after_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					// do_action('woocommerce_after_shop_loop_item_title');
					?>
				</div>
			</div>
		</div>

	</div>
</a>
