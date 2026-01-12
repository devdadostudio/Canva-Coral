<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
// do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

// echo get_page_template_slug(get_the_ID());


?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('_main__section mb-0', $product); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	// do_action('woocommerce_before_single_product_summary');
	?>

	<?php if (get_field('allenatore')) : ?>
		<div class="flex justify-center p-8">
			<div class="flex flex-col md:flex-row p-4 gap-4 items-center">
				<?php
				echo canva_get_img([
					'img_id' => get_post_thumbnail_id(get_field('allenatore')),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-11',
					'wrapper_class' => 'w-32 h-32 relative overflow-hidden rounded-full rounded-br-none',
					'img_class' => 'absolute object-cover object-center w-full h-full',
					'image-caption' => 'block',
				]);
				?>
				<div class="_card-info flex-1">
					<div class="_bullet uppercase fs-xs inline-block mb-4"><?php echo get_field('data_partenza'); ?></div>
					<div>
						<h3 class="_title h1"><?php the_title(); ?></h3>
						<span class="fs-h5 fw-400 mb-0"><?php echo get_field('subtitle'); ?></span>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>



	<div class="_product-sheet-wrap wp-block-columns gap-0 mb-0 border-t border-gray-200">

		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		// do_action( 'woocommerce_single_product_summary' );
		?>

		<div class="_product-img-attr-col wp-block-column col-span-12 lg:col-span-4 xl:col-span-3 lg:p-6 lg:pl-0 lg:border-r border-gray-200">


			<!-- Fascia titolo e dati main valida fino a md -->
			<div class="_title-wrap lg:hidden py-12">

				<div class="_product-titles">
					<h1 class="_product-title max-w-48ch"><?php the_title(); ?></h1>
				</div>

			</div>
			<!-- Fascia titolo e dati main valida fino a md END -->



			<div class="_product-attributes-wrap sticky top-24 pt-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">

				<div class="_pezzo-1">
					<div class="_product-gallery">
						<?php echo simple_product_silder_gallery($product->get_id()); ?>
					</div>
				</div>

				<div class="_pezzo-2">
					<div class="_product-sell mt-8">
						<?php echo woocommerce_template_single_add_to_cart(); ?>
					</div>
				</div>

			</div>

		</div>



		<div class="_product-info-col wp-block-column col-span-12 lg:col-span-8 xl:col-span-9 py-12 lg:p-6">

			<div class="_info-content">

				<div class="_info-content-section-1">

					<div class="_title-wrap mb-4 hidden md:block">

						<div class="_collane _bullet fs-xs inline-block mb-8">
							<?php echo canva_get_category($product->get_id(), 'product_cat', $class = 'uppercase', $parent = 'no', $term_link = 'yes',  $facet_url = ''); ?>
						</div>


						<div class="_product-titles">
							<h1 class="_product-title max-w-48ch"><?php the_title(); ?></h1>
						</div>

					</div>
					<!-- file title-wrap -->

				</div>

				<div class="_info-content-section-2">

					<div class="_product-description mt-8">

						<div class="_descrizione">
							<?php the_content(); ?>
						</div>

						<?php if (get_field('location_info')) : ?>
							<div class="_citazione grid grid-cols-12 gap-4 mt-12 bg-gray-100 p-6 items-center rounded-r-xl">
								<div class="_citazione-icon col-span-2">
									<figure class="_book-icon hidden md:block">
										<?php echo canva_get_svg_icon('icons/book', 'w-16'); ?>
									</figure>
								</div>

								<div class="_citazione-text col-span-12 md:col-span-9">
									<span><?php echo get_field('location_info'); ?></span>
								</div>
							</div>
						<?php endif; ?>

					</div>
					<!-- fine _product-description -->

					<div class="_product-programma mt-8 border border-gray-200">

						<h3 class="py-4 pl-8 mb-0">Programma</h3>

						<?php if (have_rows('programma')) : ?>

							<?php
							while (have_rows('programma')) : the_row();
								$data = strtotime(get_sub_field('data'));
							?>

								<hr>
								<div class="_programma flex flex-wrap items-center p-8 mb-0">
									<div class="_data pr-16">
										<span class="_giorno block h1 mb-0">
											<?php echo date_i18n("d", $data); ?>
										</span>
										<span class="_mese-anno block h4 fw-700 mb-0">
											<?php echo date_i18n("F Y", $data); ?>
										</span>
										<span class="_ora block h5 fw-400">
											Ore <?php echo date_i18n("H:i", $data); ?>
										</span>
									</div>
									<div class="_descrizione">
										<h5><?php the_sub_field('titolo'); ?></h5>
										<?php the_sub_field('descrizione'); ?>
									</div>
								</div>
							<?php endwhile; ?>

						<?php endif; ?>

					</div>

					<div class="mt-8 border-t border-gray-200 py-4 px-8 mb-0">
						<div class="wp-block-columns mb-0">
							<div class="wp-block-column col-span-12 flex flex-wrap justify-between">
								<h4 class="fw-400 mb-0">Condividi</h4>

								<?php
								echo canva_get_share_this_post([
									'post_id' => '',
									'facebook' => 'on',
									'twitter' => 'on',
									'linkedin' => 'on',
									'pinterest' => 'on',
									'whatsapp' => 'on',
									'telegram' => 'on',
									'copy_url' => 'on',
									'icon_classes' => 'w-4 mr-2',
									'container_classes' => 'flex flex-wrap gap-4',
									'template_name' => 'fn-share-this-post'
								]);
								?>
							</div>
						</div>
					</div>

				</div>
				<!-- fine _info-content-section-2 -->

			</div>
			<!-- fine _info-content -->
		</div>
		<!-- fine _main-info -->

	</div>
	<!-- fine _main-info-section -->

</div>
<!-- fine _main__section -->

<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action('woocommerce_after_single_product_summary');
?>
</div>


<?php do_action('woocommerce_after_single_product'); ?>
