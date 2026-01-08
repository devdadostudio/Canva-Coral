<?php
$ip = geoip_detect2_get_client_ip();
$response = (geoip_detect2_get_info_from_current_ip($ip));
$country_name = $response->country->names["it"];
$country_name = $country_name=="Regno Unito"?"UK":$country_name;
echo "<span style='display:none'>".$ip."-_-".$country_name."</span>";
if($country_name) :
	// Get Italy headquarter
	$query = new WP_Query(array(
		'post_type' => 'sedi',
		'post_status' => 'publish',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'nazione',
				'value' => array("Italia"),
				'compare' => 'IN',
			),
			array(
				'key' => 'citta',
				'value' => array("Volpiano"),
				'compare' => 'IN',
			)
		)
	));
	$posts = $query->posts;
	$current_post = $posts[0];
	// Get foreign headquarters
	if($country_name !== "Italia" && !empty($current_post)) :
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
		$current_post = $posts[0];
		if(!empty($current_post)) :
		?>
			<h5 class="fw-700">Contact</h5>
			<ul class="menu-v wp-block-list">
				<li class="lh-10">
					<?php
						echo (get_field("indirizzo_completo", $current_post->ID) ? get_field("indirizzo_completo", $current_post->ID) : "") .
							(get_field("citta", $current_post->ID) ? ", ".get_field("citta", $current_post->ID) : "") .
							(get_field("provincia", $current_post->ID) ? ", ".get_field("provincia", $current_post->ID) : "") .
							(get_field("nazione", $current_post->ID) ? ", ".get_field("nazione", $current_post->ID) : "");
					?>
				</li>
				<li>
					<a href="tel:<?php echo get_field("telefono", $current_post->ID); ?>">
						<?php echo get_field("telefono", $current_post->ID); ?>
					</a>
				</li>
			</ul>
		<?php
		endif;
    endif;
endif;

?>
					
