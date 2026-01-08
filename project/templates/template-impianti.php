<?php
$args_ch = [
	'post_type' => 'case-history',
	'facetwp' => true,
	'posts_per_page' => 9,
	'post__not_in' => $ch_ids,
	'tax_query' => array(
		array(
			'taxonomy' => 'categoria_ch',
			'field'    => 'slug',
			'terms'    => 'coral',
			'operator' => 'NOT IN',
		),
	),
];

$query_ch = new WP_Query($args_ch);
if ($query_ch->have_posts()) :
?>

	<div id="case-history" class="<?php echo esc_attr($css_classes); ?> _main__section">
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-12">
				<div class="_ch-filtri flex flex-wrap mb-8">
					<div class="mr-4">
						<?php echo facetwp_display('facet', 'applicazioni_fselect'); ?>
					</div>
					<div class="mr-4">
						<?php echo facetwp_display('facet', 'inquinanti_fselect'); ?>
					</div>
					<div class="mr-4">
						<?php echo facetwp_display('facet', 'categorie_fselect'); ?>
					</div>
				</div>

				<div class="facetwp-template grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">
					<?php
					while ($query_ch->have_posts()) {
						$query_ch->the_post();

						echo canva_get_template('card-case-history', ['post_id' => get_the_ID()]);
					}
					wp_reset_postdata($query_ch);
					?>
				</div>

				<div class="mt-8">
					<?php echo facetwp_display('facet', 'load_more'); ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>