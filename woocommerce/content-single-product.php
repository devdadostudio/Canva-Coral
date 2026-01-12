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


$sku_book = '';
$sku_ebook = '';
$variations = $product->get_available_variations();
foreach ($variations as $variation) {
	$attribute_formato = $variation['attributes']['attribute_pa_tipo-libro'];
	$variation_sku = str_replace('-', '', $variation['sku']);

	if ($attribute_formato == 'libro') {
		$sku_book = $variation_sku;
	} else {
		$sku_ebook = $variation_sku;
	}
}


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

	<div class="_product-sheet-wrap wp-block-columns gap-0 mb-0">

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

				<div class="_collane _bullet fs-xs inline-block mb-8">
							<?php echo canva_get_category($product->get_id(), 'product_cat', $class = 'uppercase', $parent = 'no', $term_link = 'yes',  $facet_url = ''); ?>
						</div>

						<?php
						$authors = get_field('libro_autore');

						if ($authors) :
							$author_names = [];
							foreach ($authors as $author) {
								$author_names[] = canva_get_modal(
									[
										'post_id' => $author->ID,
										'css_classes' => '_autore',
										'template_name' => 'add-modale-autore',
										'modal_type' => '_modal-post-opener-right',
										'overlay_position' => 'below-the-top',
										'animation_in' => 'modal-in-from-r',
										'animation_out' => 'modal-out-to-r',
										'title' => get_field('nome', $author->ID) . ' ' . get_field('cognome', $author->ID),
										'title_css_classes' => '',
									]
								);
							}
						?>

							<div class="_autori uppercase fs-h5 fw-700 mb-1">
								<?php
								// var_dump($author_names);
								echo implode(', ', $author_names);
								?>
							</div>

						<?php endif; ?>


				<div class="_product-titles">

					<h1 class="_product-title max-w-48ch"><?php echo get_field('titolo'); ?></h1>

					<?php if (get_field('sottotitolo')) : ?>
						<h2 class="_product-subtitle h5 mt-6 fw-300">
							<?php echo get_field('sottotitolo'); ?>
						</h2>
					<?php endif; ?>
				</div>

				<div class="_collaboratori flex flex-wrap mt-2">

					<?php if (get_field('libro_traduttore')) : ?>
						<div class="_traduzione-wrapper mr-2">
							<span class="_traduzione-label fw-700">
								Traduzione:
							</span>
							<span class="_traduzione">
								<?php if (get_field('libro_traduttore_link')) : ?>
									<a href="<?php echo get_field('libro_traduttore_link'); ?>" target="_blank" rel="nofollow noopener">
									<?php endif; ?>

									<?php echo get_field('libro_traduttore'); ?>

									<?php if (get_field('libro_traduttore_link')) : ?>
									</a>
								<?php endif; ?>
							</span>
						</div>
					<?php endif; ?>

					<?php if (get_field('prefazione_di')) : ?>
						<div class="_prefazione-wrapper mr-2">
							<span class="_prefazione-label fw-700">
								Prefazione:
							</span>
							<span class="_prefazione">
								<?php if (get_field('prefazione_di_link')) : ?>
									<a href="<?php echo get_field('prefazione_di_link'); ?>" target="_blank" rel="nofollow noopener">
									<?php endif; ?>

									<?php echo get_field('prefazione_di'); ?>

									<?php if (get_field('prefazione_di_link')) : ?>
									</a>
								<?php endif; ?>
							</span>
						</div>
					<?php endif; ?>

					<?php if (get_field('postfazione_di')) : ?>
						<div class="_postfazione-wrapper mr-2">
							<span class="_postfazione-label fw-700">
								Postfazione:
							</span>
							<span class="_postfazione">
								<?php if (get_field('postfazione_di_link')) : ?>
									<a href="<?php echo get_field('postfazione_di_link'); ?>" target="_blank" rel="nofollow noopener">
									<?php endif; ?>

									<?php echo get_field('postfazione_di'); ?>

									<?php if (get_field('postfazione_di_link')) : ?>
									</a>
								<?php endif; ?>
							</span>
						</div>
					<?php endif; ?>

					<?php if (get_field('libro_illustrazione')) : ?>
						<div class="_illustrazione-wrapper mr-2">
							<span class="_illustrazione-label fw-700">
								Illustrazioni:
							</span>
							<span class="_illustrazione">
								<?php if (get_field('libro_illustrazione_link')) : ?>
									<a href="<?php echo get_field('libro_illustrazione_link'); ?>" target="_blank" rel="nofollow noopener">
									<?php endif; ?>

									<?php echo get_field('libro_illustrazione'); ?>

									<?php if (get_field('libro_illustrazione_link')) : ?>
									</a>
								<?php endif; ?>
							</span>
						</div>
					<?php endif; ?>

				</div>

			</div>
			<!-- Fascia titolo e dati main valida fino a md END -->



			<div class="_product-attributes-wrap sticky-wrap pt-0 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">

				<div class="_col-1">
					<div class="_product-gallery">
						<?php echo simple_product_silder_gallery($product->get_id()); ?>
					</div>
				</div>

				<div class="_col-2">
					<div class="_product-sell mt-8">
						<?php echo woocommerce_template_single_add_to_cart(); ?>
					</div>
					<div class="_product-attributes mt-8">
						<?php if (get_field('libro_numero_pagine')) : ?>
							<div class="_pagine grid grid-cols-2 py-2 border-t border-gray-200">
								<span class="_label fs-xs fw-700">Pagine:</span>
								<span class="_value fs-xs"><?php echo get_field('libro_numero_pagine'); ?></span>
							</div>
						<?php endif; ?>
						<?php if (get_field('libro_formato_cm')) : ?>
							<div class="_formato grid grid-cols-2 py-2 border-t border-gray-200">
								<span class="_label fs-xs fw-700">Formato:</span>
								<span class="_value fs-xs"><?php echo get_field('libro_formato_cm'); ?> cm</span>
							</div>
						<?php endif; ?>
						<?php if (get_field('data_pubblicazione')) : ?>
							<div class="_data-pubblicazione grid grid-cols-2 py-2 border-t border-gray-200">
								<span class="_label fs-xs fw-700">Data di uscita:</span>
								<span class="_value fs-xs"><?php echo date_i18n("j F Y", strtotime(get_field('data_pubblicazione'))); ?></span>
							</div>
						<?php endif; ?>
						<div class="_isbn grid grid-cols-2 py-2 border-t border-b border-gray-200">
							<span class="_label fs-xs fw-700">ISBN:</span>
							<span class="_value fs-xs"><?php echo $sku_book; ?></span>
						</div>
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

						<?php
						$authors = get_field('libro_autore');

						if ($authors) :
							$author_names = [];
							foreach ($authors as $author) {
								$author_names[] = canva_get_modal(
									[
										'post_id' => $author->ID,
										'css_classes' => '_autore',
										'template_name' => 'modal-autore',
										'modal_type' => '_modal-post-opener-right',
										'overlay_position' => 'below-the-top',
										'animation_in' => 'modal-in-from-r',
										'animation_out' => 'modal-out-to-r',
										'title' => get_field('nome', $author->ID) . ' ' . get_field('cognome', $author->ID),
										'title_css_classes' => '',
									]
								);
							}
						?>

							<div class="_autori uppercase fs-h5 fw-700 mb-1">
								<?php
								// var_dump($author_names);
								echo implode(', ', $author_names);
								?>
							</div>

						<?php endif; ?>



						<div class="_product-titles">
							<h1 class="_product-title max-w-48ch mb-0"><?php echo get_field('titolo'); ?></h1>

							<?php if (get_field('sottotitolo')) : ?>
								<h2 class="_product-subtitle h3 mt-6 fw-400">
									<?php echo get_field('sottotitolo'); ?>
								</h2>
							<?php endif; ?>
						</div>



						<div class="_collaboratori flex flex-wrap mt-2 pb-12 border-b">

							<?php if (get_field('libro_traduttore')) : ?>
								<div class="_traduzione-wrapper mr-2">
									<span class="_traduzione-label fw-700">
										Traduzione:
									</span>
									<span class="_traduzione">
										<?php if (get_field('libro_traduttore_link')) : ?>
											<a href="<?php echo get_field('libro_traduttore_link'); ?>" target="_blank" rel="nofollow noopener">
											<?php endif; ?>

											<?php echo get_field('libro_traduttore'); ?>

											<?php if (get_field('libro_traduttore_link')) : ?>
											</a>
										<?php endif; ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if (get_field('prefazione_di')) : ?>
								<div class="_prefazione-wrapper mr-2">
									<span class="_prefazione-label fw-700">
										Prefazione:
									</span>
									<span class="_prefazione">
										<?php if (get_field('prefazione_di_link')) : ?>
											<a href="<?php echo get_field('prefazione_di_link'); ?>" target="_blank" rel="nofollow noopener">
											<?php endif; ?>

											<?php echo get_field('prefazione_di'); ?>

											<?php if (get_field('prefazione_di_link')) : ?>
											</a>
										<?php endif; ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if (get_field('postfazione_di')) : ?>
								<div class="_postfazione-wrapper mr-2">
									<span class="_postfazione-label fw-700">
										Postfazione:
									</span>
									<span class="_postfazione">
										<?php if (get_field('postfazione_di_link')) : ?>
											<a href="<?php echo get_field('postfazione_di_link'); ?>" target="_blank" rel="nofollow noopener">
											<?php endif; ?>

											<?php echo get_field('postfazione_di'); ?>

											<?php if (get_field('postfazione_di_link')) : ?>
											</a>
										<?php endif; ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if (get_field('libro_illustrazione')) : ?>
								<div class="_illustrazione-wrapper mr-2">
									<span class="_illustrazione-label fw-700">
										Illustrazioni:
									</span>
									<span class="_illustrazione">
										<?php if (get_field('libro_illustrazione_link')) : ?>
											<a href="<?php echo get_field('libro_illustrazione_link'); ?>" target="_blank" rel="nofollow noopener">
											<?php endif; ?>

											<?php echo get_field('libro_illustrazione'); ?>

											<?php if (get_field('libro_illustrazione_link')) : ?>
											</a>
										<?php endif; ?>
									</span>
								</div>
							<?php endif; ?>

						</div>

					</div>
					<!-- file title-wrap -->

				</div>

				<div class="_info-content-section-2">

					<?php if (have_rows('libro_strilli')) : ?>

						<div class="_strilli-stampa grid grid-cols-2 gap-4 mt-8 border-b">

							<?php while (have_rows('libro_strilli')) : the_row(); ?>
								<div class="_strillo-stampa">
									<p><?php the_sub_field('strillo_stampa'); ?></p>
									<p>
										<?php if (get_sub_field('autore')) : ?>
											<span class="_autore-strillo fw-700"><?php the_sub_field('autore'); ?></span>
										<?php endif; ?>

										<?php if (get_sub_field('testata')) : ?>
											- <span class="_testata-strillo"><?php the_sub_field('testata'); ?></span>
										<?php endif; ?>
									</p>
								</div>
							<?php endwhile; ?>

						</div>

					<?php endif; ?>




					<div class="_product-description mt-8">

						<div class="_descrizione">
							<?php the_content(); ?>

							<?php if (get_field('estratto')) : ?>
								<p><a class="button" href="<?php echo esc_url(get_field('estratto')); ?>" target="_blank">Leggi un estratto</a></p>
							<?php endif; ?>
						</div>


						<?php if (get_field('libro_citazione')) : ?>
							<div class="_citazione grid grid-cols-12 gap-4 mt-16 bg-gray-100 p-6 items-center rounded-r">
								<div class="_citazione-icon col-span-2">
									<figure class="_book-icon hidden md:block">
										<?php echo canva_get_svg_icon('icons/book', 'w-16'); ?>
									</figure>
								</div>

								<div class="_citazione-text col-span-12 md:col-span-9">
									<p><?php echo get_field('libro_citazione'); ?></p>

									<?php if (get_field('libro_autore_citazione')) : ?>
										<div class="_citazione-autore">
											<span><?php echo get_field('libro_autore_citazione'); ?></span>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

					</div>
					<!-- fine _product-description -->



					<div class="_product-accordion mt-16">

						<?php if (have_rows('rassegna_stampa')) : ?>

							<div class="_rassegna-stampa _accordion border-t border-gray-200">
								<div class="_accordion-titlecursor-pointer  flex items-center group transition-colors hover:bg-gray-100">
									<div class="flex-1 py-4">
										<h3 class="mb-0 ml-4 h5 fw-300">Rassegna stampa</h3>
									</div>
									<div class="_accordion-icon flex items-center justify-end w-24 transform-gpu transition-transform group-hover:scale-110">
										<div class="_icon flex items-center justify-center w-12 h-12 transform-gpu transition-transform">
											<?php echo canva_get_svg_icon('fontawesome/regular/angle-down', 'w-3'); ?>
										</div>
									</div>
								</div>

								<div class="_accordion-content border border-gray-200 p-4">
									<ul class="ul-dot fs-h4 mb-2">
										<?php while (have_rows('rassegna_stampa')) : the_row(); ?>
											<li class="flex items-center w-full justify-between border-b border-gray-200 mt-2 pb-2">
												<span class="_rassegna-stampa-titolo"><?php the_sub_field('titolo'); ?></span>
												<?php if (get_sub_field('pdf')) : ?>
													<a class="_rassegna-stampa-pdf" href="<?php the_sub_field('pdf'); ?>" target="_blank">
														<figure class="_pdf-icon">
															<?php echo canva_get_svg_icon('icons/pdf', 'w-4'); ?>
														</figure>
													</a>
												<?php else : ?>
													<a class="_rassegna-stampa-link" href="<?php the_sub_field('link'); ?>" target="_blank">
														<figure class="_link-icon">
															<?php echo canva_get_svg_icon('icons/url', 'w-4'); ?>
														</figure>
													</a>
												<?php endif; ?>
											</li>
										<?php endwhile; ?>
									</ul>
								</div>
							</div>

						<?php endif; ?>

						<?php if (have_rows('immagini')) : ?>

							<div class="_immagini _accordion border-t border-gray-200">
								<div class="_accordion-title cursor-pointer flex items-center group transition-colors hover:bg-gray-100">
									<div class="flex-1 py-4">
										<h3 class="mb-0 ml-4 h5 fw-300">Galleria immagini</h3>
									</div>
									<div class="_accordion-icon flex items-center justify-end w-24 transform-gpu transition-transform group-hover:scale-110">
										<div class="_icon flex items-center justify-center w-12 h-12 transform-gpu transition-transform">
											<?php echo canva_get_svg_icon('fontawesome/regular/angle-down', 'w-3'); ?>
										</div>
									</div>
								</div>

								<div class="_accordion-content border border-gray-200 p-4">
									<div class="photoswipe-gallery-container grid grid-cols-2 md:grid-cols-4 gap-4">
										<?php while (have_rows('immagini')) : the_row(); ?>
											<?php
											echo canva_get_img([
												'img_id'   =>  get_sub_field('immagine'),
												'img_type' => 'img', // img, bg, url
												'thumb_size' =>  '640-free',
												'wrapper_class' => 'photoswipe-item relative ratio-1-1 group gallery-item gallery-item-' . get_row_index(),
												'img_class' => 'absolute object-cover transform-gpu w-full w-3/4',
												'blazy' => 'on',
											]);
											?>
										<?php endwhile; ?>
									</div>
								</div>
							</div>

						<?php endif; ?>

						<?php if (have_rows('video')) : ?>

							<div class="_video _accordion border-t border-gray-200">
								<div class="_accordion-title cursor-pointer flex items-center group transition-colors hover:bg-gray-100">
									<div class="flex-1 py-4">
										<h3 class="mb-0 ml-4 h5 fw-300">Galleria video</h3>
									</div>
									<div class="_accordion-icon flex items-center justify-end w-24 transform-gpu transition-transform group-hover:scale-110">
										<div class="_icon flex items-center justify-center w-12 h-12 transform-gpu transition-transform">
											<?php echo canva_get_svg_icon('fontawesome/regular/angle-down', 'w-3'); ?>
										</div>
									</div>
								</div>

								<div class="_accordion-content border border-gray-200 p-4">
									<div class="photoswipe-gallery-container grid grid-cols-2 md:grid-cols-4 gap-4">
										<?php while (have_rows('video')) : the_row(); ?>
											<?php
											echo canva_get_youtube_thumb($youtube_url = get_sub_field('youtube'), $gallery_item = get_row_index(), $template_name = 'fn-youtube-thumb-photoswipe');
											?>
										<?php endwhile; ?>
									</div>
								</div>
							</div>

						<?php endif; ?>

					</div>
					<!-- fine _product-accordion -->


					<div class="text-center mt-4">
						<a class="_slide-down button hollow fs-xxs" style="display:none;" href="javascript:;">
							<?php _e('Show more', 'canva-abac'); ?>
						</a>
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
