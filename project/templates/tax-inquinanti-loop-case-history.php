<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// prodotti x famiglia
$args_mf = [
	'post_type' => 'case-history',
	'facetwp' => false,
	'posts_per_page' => 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'inquinante',
			'field'    => 'term_id',
			'terms'    => $term_id,
		),
	),
];

$query_ch = new WP_Query($args_mf);
?>

<?php if ($query_ch->have_posts()) : ?>
	<div id="case-history" class="<?php echo esc_attr($css_classes); ?> _main__section">
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-12">
				<h3>Case history</h3>

				<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">
					<?php
					while ($query_ch->have_posts()) {
						$query_ch->the_post();

						echo canva_get_template('card-case-history', ['post_id' => get_the_ID()]);
					}
					wp_reset_postdata($query_ch);
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
