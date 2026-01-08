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
				<div class="wp-block-column col-span-12">

					<div class="facetwp-template grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">
						<?php
						while (have_posts()) {
							the_post();

							echo canva_get_template('card-macro-famiglia', ['post_id' => get_the_ID()]);
						}
						wp_reset_postdata();
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
