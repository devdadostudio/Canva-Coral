<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

$layer_content_output = '
	<div class="grid grid-cols-1 md:grid-cols-2 gap-8 h-full">
		<div class="col-span-1 md:mb-24">
			<h3 class="h1 line-clamp-3">' . get_the_title($post_id) . '</h3>
		</div>
		<div class="col-span-1 flex flex-col items-start justify-end">
			<p class="line-clamp-3">' . canva_get_trimmed_content(get_the_content($post_id), $trim_words = 24, $strip_blocks = false, $strip_shortcode = true) . '</p>

			<a href="' . get_permalink($post_id) . '" class="v-r">Scopri</a>
		</div>
	</div>
';

canva_the_layer([
	'layer_type' => '_hero _slide-case-history isdark', // _hero, _card, _photobutton
	'layer_id' => '',
	'layer_class' => '',

	'img_id' => get_post_thumbnail_id($post_id),
	'img_small_id' => '',
	'thumb_size' => '1920-free',
	'thumb_small_size' => '640-free',
	'video_url' => '',

	'layer_visual_class' => 'absolute',

	'layer_bg' => 'on',
	'layer_bg_class' => '',

	'layer_picture' => 'off',
	'layer_picture_class' => '',

	'layer_filter' => 'on',
	'layer_filter_class' => '',

	'layer_graphics' => 'on',
	'layer_graphics_class' => '',

	'layer_date' => 'off',
	'layer_date_class' => '',

	'layer_status' => 'on',
	'layer_status_class' => '',

	'layer_info' => 'off',
	'layer_info_class' => '',

	'layer_content' => 'on',
	'layer_content_class' => 'relative w-full p-8 sm:p-12 lg:p-16',
	'layer_content_output' => $layer_content_output,
]);
