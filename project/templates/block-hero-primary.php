<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// Lista variabili in ingresso
// $args = [
// 'id' => $id,
// 'css_classes' => $className,
// 'bg_image' => $bg_image,
// 'bg_image_small' => $bg_image_small,
// 'video_bg_file_url' => $video_bg_file_url,
// 'layer_picture' => $layer_picture,
// 'action_link' => $action_link,
// 'action_link_2' => $action_link_2,
// 'toptitle' => $toptitle,
// 'title' => $title,
// 'toptitle' => $toptitle,
// 'toptitle' => $toptitle,
// 'content' => $content,
// 'cta' => $cta,
// 'cta_2' => $cta_2,
// 'form' => $form,
// ];

$layer_content_output = '';

if ($toptitle || $title || $subtitle || $content || $cta || $cta_2 || $form) {

	$layer_content_output .= '<div class="_layer-content-wrap text-center group-ani-txt-in duration-xxslow">';

		if ($toptitle) {
			$layer_content_output .= '<span class="block h3 fw-300">' . $toptitle . '</span>';
		}

		if ($title) {
			$layer_content_output .= '<h1 class="_title fs-huge" style="--group-child-dly:0s;">' . $title . '</h1>';
		}

		if ($subtitle) {
			$layer_content_output .= '<span class="block mt-2 h4" style="--group-child-dly:0.1s;">' . $subtitle . '</span>';
		}

		if ($content) {
			$layer_content_output .= '<div class="_hero-primary-content mt-8" style="--group-child-dly:0.2s;">' . $content . '</div>';
		}

		if ($form) {
			$layer_content_output .= '<div class="_hero-form-box pt-4" style="--group-child-dly:0.3s;">' . do_shortcode($form) . '</div>';
		} else {
			$layer_content_output .= '<div class="_hero-button-box pt-4 inline-flex flex-wrap justify-center gap-8 isdark" style="--group-child-dly:0.3s;">' . $cta . ' ' . $cta_2 . '</div>';
		}

	$layer_content_output .= '</div>';
}


$layer_filter = 'on';
$layer_content = 'on';
if (!$layer_content_output) {
	$layer_filter = 'off';
	$layer_content = 'off';
}


canva_the_layer([
	'layer_type' => '_hero', // _hero, _card, _photobutton
	'layer_id' => esc_attr($id),
	'layer_class' => '' . esc_attr($css_classes),

	'img_id' => $bg_image,
	'img_small_id' => $bg_image_small,
	'thumb_size' => '1920-free',
	'thumb_small_size' => '640-free',
	'video_url' => $video_bg_file_url,

	'layer_visual_class' => 'absolute',

	'layer_bg' => 'on',
	'layer_bg_class' => '',

	'layer_picture' => $layer_picture,
	'layer_picture_class' => '',

	'layer_filter' => 'on',
	'layer_filter' => $layer_filter,
	'layer_filter_class' => '',

	'layer_graphics' => 'on',
	'layer_graphics_class' => '',
	'layer_graphics_html' => '<div class="absolute w-16 h-16 bg-icon icon-arrow-lg-d-primary bottom-8 left-1/2 -ml-8 ani-wave-y"></div>',

	'layer_date' => 'off',
	'layer_date_class' => '',

	'layer_status' => 'off',
	'layer_status_class' => '',

	'layer_info' => 'off',
	'layer_info_class' => '',

	'layer_content' => $layer_content,
	'layer_content_class' => 'relative w-full _main__section py-24 max-w-screen-lg mx-auto flex items-center justify-center isdark',
	'layer_content_output' => $layer_content_output,
]);
