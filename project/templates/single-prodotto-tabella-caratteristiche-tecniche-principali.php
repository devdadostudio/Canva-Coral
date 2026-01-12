<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// prodotti x famiglia
$prodotti = [$post_id];

$caratteristiche_principali = caratteristiche_principali();

// boolean array (init false), same keys as $caratteristiche_principali
$caratteristiche_principali_reali = array_fill_keys(array_keys($caratteristiche_principali), false);

foreach ($prodotti as $prodotto) {
	foreach ($caratteristiche_principali_reali as $key => $caratteristica_principale) {
		// se la caratteristica_principale corrente non è ancora stata trovata
		// nei precedenti prodotti e se è presente nel prodotto
		// corrente
		if (!$caratteristica_principale && get_field($key, $prodotto) && get_field($key, $prodotto) != "-") {
			$caratteristiche_principali_reali[$key] = !$caratteristica_principale;
		}
	}
}

?>
<div class="_page-header _main__section py-4">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12 overflow-x-auto">
			<h3 class="h5 fw-700 line-l">Caratteristiche prodotto</h3>

			<table class="_table-prodotto _caratteristiche_principali">
				<thead>
					<tr>
						<?php foreach ($caratteristiche_principali as $key => $caratteristica_principale) : ?>
							<?php if ($caratteristiche_principali_reali[$key]) : ?>
								<th class="bg-gray-50 fs-xxs">
									<?php echo $caratteristica_principale; ?>
								</th>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($prodotti as $prodotto) : ?>
						<tr>
							<?php foreach ($caratteristiche_principali as $key => $caratteristica_principale) : ?>
								<?php if ($caratteristiche_principali_reali[$key]) : ?>
									<td class="text-center bg-gray-200">
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
		</div>
	</div>
</div>
