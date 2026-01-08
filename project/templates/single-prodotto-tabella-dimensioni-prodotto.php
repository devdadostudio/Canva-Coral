<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// prodotti x famiglia
$prodotti = [$post_id];

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

<div class="_page-header _main__section py-4">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12 overflow-x-auto">
			<h3 class="h5 fw-700 line-l line-short">Dimensione prodotto</h3>

			<table class="_table-prodotto _dimensioni">
				<thead>
					<tr>
						<?php foreach ($dimensioni as $key => $dimensione) : ?>
							<?php if ($dimensioni_reali[$key]) : ?>
								<th class="bg-gray-50 fs-xxs">
									<?php echo $dimensione; ?>
								</th>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($prodotti as $prodotto) : ?>
						<tr>
							<?php foreach ($dimensioni as $key => $dimensione) : ?>
								<?php if ($dimensioni_reali[$key]) : ?>
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

				</tbody>
			</table>
		</div>
	</div>
</div>
