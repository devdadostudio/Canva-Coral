<?php
$response = (geoip_detect2_get_info_from_current_ip());
$country_name = $response->country->names["it"];

$query = new WP_Query(array(
	'post_type' => 'sedi',
	'post_status' => 'publish',
	'meta_query' => array(
		array(
			'key' => 'nazione',
			'value' => array($country_name),
			'compare' => 'IN'
		)
	)
));

$posts = $query->posts;
if (empty($posts)) {
	$query = new WP_Query(array(
		'post_type' => 'sedi',
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'nazione',
				'value' => array("Italia"),
				'compare' => 'IN'
			)
		)
	));
	$posts = $query->posts;

	$country_name = "Italia";
}
?>
<div class="wp-block-columns border-t border-black pt-6">

	<div class="wp-block-column col-span-12 lg:col-span-4">
		<p><strong>Coral Engineering srl</strong></p>
		<p><strong>Progettazione</strong></p>
	</div>

	<div class="wp-block-column col-span-12 lg:col-span-8">
		<?php foreach ($posts as $post) : ?>
			<div class="wp-block-columns mt-4 pb-4 border-b border-gray-200">
				<ul class="wp-block-column menu-v col-span-12 md:col-span-7">

					<li class="fw-700">
						<?php echo get_the_title($post->ID)?>
					</li>

					<li class="">
						<?php if ( get_field('indirizzo_completo', $post->ID) ) : ?>
							<?php echo get_field('indirizzo_completo',  $post->ID); ?>
						<?php endif; ?>
					</li>

				</ul>
				<ul class="wp-block-column menu-v col-span-12 md:col-span-5">
					<li>
						<?php echo get_field("citta", $post->ID); ?>

						<?php if (get_field('provincia', $post->ID)) : ?>
							(<?php echo get_field('provincia', $post->ID); ?>)
						<?php endif; ?>
					</li>
					<li>
						<?php if (get_field('telefono', $post->ID)) : ?>
							<a href="tel:<?php echo get_field('telefono', $post->ID); ?>">
								<?php echo get_field('telefono', $post->ID); ?>
							</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
</div>
