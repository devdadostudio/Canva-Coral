<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// prodotti x famiglia
$prodotti = [$post_id];

$gruppi_aspiranti = gruppi_aspiranti();

// boolean array (init false), same keys as $gruppi_aspiranti
$gruppi_aspiranti_reali = array_fill_keys(array_keys($gruppi_aspiranti), false);

foreach ($prodotti as $prodotto) {
	foreach ($gruppi_aspiranti_reali as $key => $gruppo_aspirante) {
		// se la gruppo_aspirante corrente non è ancora stata trovata
		// nei precedenti prodotti e se è presente nel prodotto
		// corrente
		if (!$gruppo_aspirante && get_field($key, $prodotto) && get_field($key, $prodotto) != "-") {
			$gruppi_aspiranti_reali[$key] = !$gruppo_aspirante;
		}
	}
}

?>

<div class="_page-header _main__section py-4">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12 overflow-x-auto">
			<h3 class="h5 fw-700 line-l">Caratteristiche tecniche principali</h3>

			<table class="_table-prodotto _gruppi_aspiranti">
				<thead>
					<tr>
						<?php foreach ($gruppi_aspiranti as $key => $gruppo_aspirante) : ?>
							<?php if ($gruppi_aspiranti_reali[$key]) : ?>
								<th class="bg-gray-50 fs-xxs">
									<?php echo $gruppo_aspirante; ?>
								</th>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($prodotti as $prodotto) : ?>
						<tr>
							<?php foreach ($gruppi_aspiranti as $key => $gruppo_aspirante) : ?>
								<?php if ($gruppi_aspiranti_reali[$key]) : ?>
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
