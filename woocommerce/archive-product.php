<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$term_slug = $queried_object->slug;

$ancestors = get_ancestors($term_id, $taxonomy);
$ancestors = array_reverse($ancestors);

$term_top_parent = get_term($ancestors[0], $taxonomy);
// $term_top_parent_name = $term_top_parent->name;

$term_parent = get_term($ancestors[1], $taxonomy);
// $term_parent_name = $term_parent->name;

$term = get_term($term_id, $taxonomy);
// $childs = get_term_children($term_parent->term_id, $taxonomy);

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>


<div class="_main__section pt-4 md:pt-8">

	<div class="grid grid-cols-12 gap-4">

		<div class="_filters-column wp-block-column col-span-12 md:col-span-4 lg:col-span-3 sm:hide md:block">

			<div class="_filters-wrap sticky top-24 p-4 bg-gray-100">

				<?php if ($term_slug === 'tutte') : ?>

					<h3 class="fw-300"><?php _e('Libri', 'canva-addeditore'); ?></h3>

					<?php echo facetwp_display('facet', 'product_categories'); ?>

					<span class="h6 mt-8 mb-4 hide md:block"><?php _e('Argomenti', 'canva-addeditore'); ?></span>
					<?php echo facetwp_display('facet', 'product_tags'); ?>

					<div class="py-8">
						<?php echo facetwp_display('facet', 'reset'); ?>
					</div>

				<?php else : ?>

					<h3 class="fw-300"><?php echo canva_get_term_name($term_id); ?></h3>
					<?php if (canva_get_term_description($term_id)) : ?>
						<p>
							<?php echo canva_get_term_description($term_id); ?>
						</p>
					<?php else : ?>
						<span class="h6 mt-8 mb-4 hide md:block">Altre collane</span>
						<?php
						$term_children_ids = get_term_children(TERM_LIBRI_ID, $taxonomy);
						// var_dump($term_children_ids);
						?>
						<ul>
							<?php
							foreach ($term_children_ids as $child) {
								echo '<li class="h5 pb-2 border-b-2 border-gray-200"><a href="' . get_term_link($child, $taxonomy) . '">' . canva_get_term_name($child) . '</a></li>';
							}
							?>
						</ul>
					<?php endif; ?>

				<?php endif; ?>
			</div>

		</div>

		<div class="wp-block-column col-span-12 md:col-span-8 lg:col-span-9">

			<header class="woocommerce-products-header"> </header>

			<?php
			if (woocommerce_product_loop()) {
			?>

				<div class="_category-filter-section">

					<div class="_category-filters flex flex-wrap items-end justify-between">

						<div class="_category-filters-left flex items-center">
							<!-- <div class="_filter-label flex-1">
								<span class="block fs-xs lh-10"><?php _e('Mostra filtri', 'canva-addeditore'); ?></span>
							</div>
							<div class="_filter_icon ml-4 cursor-pointer w-8 h-8 bg-gray-200 flex items-center justify-center"></div> -->
						</div>

						<div class="_category-filters-right flex flex-wrap justify-between items-center w-full">

							<div class="_product-status-filter sm:hide md:flex gap-2 items-center">

								<!-- <span class="fs-xs inline-block pr-2"><?php _e('Filter by', 'canva-addeditore'); ?></span> -->

								<?php echo facetwp_display('facet', 'deals'); ?>

								<?php echo facetwp_display('facet', 'new_products'); ?>
							</div>

							<a href="javascript:;" class="button facetwp-flyout-open md:hide"><?php _e('Filters', 'canva-addeditore'); ?></a>

							<div class="_category-products-order sm:hide md:block">
								<?php
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked woocommerce_output_all_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								// do_action('woocommerce_before_shop_loop');

								echo facetwp_display('facet', 'sort_by');

								woocommerce_product_loop_start();
								?>
							</div>
						</div>

					</div>

				</div>

				<div class="_archive-products pb-16">

					<div class="_archive-products-wrap mx-auto grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

						<?php
						if (wc_get_loop_prop('total')) {
							while (have_posts()) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 */

								do_action('woocommerce_shop_loop');

								wc_get_template_part('content', 'product');
							}
						}
						?>

					</div>

				</div>

				<div class="flex flex-wrap items-center justify-center">
					<?php
					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					// do_action('woocommerce_after_shop_loop');
					echo facetwp_display('facet', 'load_more');
					?>
				</div>
			<?php

			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			}

			?>
		</div>

	</div>

</div>





<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
// do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');

get_footer('shop');
