<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="prodotti" class="_main__section pt-0">

	<div id="filtri-prodotti" class="wp-block-columns">

		<div class="wp-block-column col-span-12 md:col-span-4 xxl:col-span-3 sm:hide md:block">

			<div class="_facet-box bg-primary isdark p-4">

				<div class="">
					<h4>Categorie</h4>

					<div class="mt-8 mb-4">
						<?php echo do_shortcode('[facetwp facet="load_more"]'); ?>
					</div>

					<?php echo do_shortcode('[facetwp facet="categorie_prodotti"]'); ?>
				</div>

			</div>

		</div>


		<div class="wp-block-column col-span-12 md:col-span-8 xxl:col-span-9">

			<div class="mb-8 pt-8 flex flex-wrap justify-between items-center hidden">
				<?php
				//echo do_shortcode('[facetwp facet="results_count"]');
				?>
				<?php
				//echo do_shortcode('[facetwp facet="sort_by"]');
				?>
			</div>

			<div class="">
				<a href="javascript:;" class="button facetwp-flyout-open md:hide mb-4">Filtra i prodotti</a>

				<?php echo do_shortcode('[facetwp template="famiglie"]'); ?>
			</div>

		</div>

	</div>

</div>
