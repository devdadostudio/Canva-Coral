<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="prodotti" class="<?php echo esc_attr($css_classes); ?> _main__section">
	<div id="filtri-prodotti" class="wp-block-columns">
		<div class="wp-block-column col-span-12">

			<div class="wp-block-columns md:gap-8">

				<div class="wp-block-column col-span-12 md:col-span-12 xxl:col-span-12">

					<p class="h4 h-12 mb-2 line-clamp-2">Prodotti per <span class="lowercase"><?php echo canva_get_term_name($term_id); ?></span></p>

					<div class="mb-8 pt-8 flex flex-wrap justify-end items-center">
						<?php //echo facetwp_display('facet', 'results_count'); ?>
						<?php echo facetwp_display('facet', 'sort_by'); ?>
					</div>

					<div class="facetwp-template grid grid-cols-1 md:grid-cols-2 xxl:grid-cols-3 gap-y-8 gap-x-4 mb-4">
						<?php
						while (have_posts()) {
							the_post();

							if(get_post_type() == 'macrofamiglia'){
								echo canva_get_template('card-macro-famiglia', ['post_id' => get_the_ID()]);
							}
						}
						// wp_reset_postdata();
						?>
					</div>

					<div class=" mt-8">
						<?php echo facetwp_display('facet', 'load_more');
						?>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>
