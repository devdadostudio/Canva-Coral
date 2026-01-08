<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

if (get_post_type($post_id) == 'famiglia') {
	$post_type = 'famiglia';
} else {
	$post_type = 'macro_famiglia';
}

// prodotti x famiglia o macrofamiglia
$args = [
	'post_type' => 'prodotto',
	'facetwp' => true,
	'posts_per_page'  =>  -1,
	'orderby'   => 'meta_value_num',
	'meta_key'  => 'id_progressivo',
	'order'  => 'ASC',
	'meta_query' =>  array(
		array(
			'key'   =>  $post_type,
			'value' =>  $post_id,
		)
	),
];
$prodotti = get_posts($args);


$dimensioni = dimensioni_prodotto();

// boolean array (init false), same keys as $dimensioni
$dimensioni_reali = array_fill_keys(array_keys($dimensioni), false);

foreach ($prodotti as $prodotto) {
	foreach ($dimensioni_reali as $key => $dimensione) {
		// se la dimensione corrente non è ancora stata trovata
		// nei precedenti prodotti e se è presente nel prodotto
		// corrente
		if (!$dimensione && get_field($key, $prodotto) && get_field($key, $prodotto) != "-") {
			$dimensioni_reali[$key] = !$dimensione;
		}
	}
}

?>
<table class="_table-modelli _dimensioni mx-auto">
	<thead>
		<tr>
			<th class="_th-modello">Modello</th>
			<?php foreach ($dimensioni as $key => $dimensione) : ?>
				<?php if ($dimensioni_reali[$key]) : ?>
					<th class="_th-caratteristica">
						<?php echo $dimensione; ?>
					</th>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($prodotti as $prodotto) : ?>
			<tr class="cursor-pointer" onclick="window.location.href='<?php echo esc_url(get_permalink($prodotto)); ?>'">
				<td class="_modello">
					<a class="_no-translate" href="<?php echo esc_url(get_permalink($prodotto)); ?>">
						<?php echo get_the_title($prodotto); ?>
					</a>
				</td>
				<?php foreach ($dimensioni as $key => $dimensione) : ?>
					<?php if ($dimensioni_reali[$key]) : ?>
						<td class="text-center">
							<?php
							if (get_field($key, $prodotto) && get_field($key, $prodotto) != "-") :
								echo get_field($key, $prodotto);
							else :
								echo ' - ';
							endif;
							?>
						</td>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>

		<?php echo facetwp_display('facet', 'load_more'); ?>
	</tbody>
</table>
