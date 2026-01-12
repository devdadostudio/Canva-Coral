<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

// Elenco Variabili per promemoria
//
// $args = [
//     'id' => $id,
//     'class_name' => $class_name,
//     'isdark' => $isdark,
//     'isdark' => $isdark,
//     'action_link' => $action_link,
//     'target_link' => $target_link,
//     'href' => $href,
//     'modal' => $modal,
//     'modal_class' => $modal_class,
//     'modal_data_contet' => $modal_data_contet,
//     'track_title' => $track_title,
//     'link_wrap' => $link_wrap,
//     'button' => $button,
//     'button_title' => $button_title,
//     'bg_image' => $bg_image,
//     'bg_image_small' => $bg_image_small,
//     'video_bg_file_url' => $video_bg_file_url,
//     'icon' => $icon,
//     'photobutton_toptitle' => $photobutton_toptitle,
//     'photobutton_title' => $photobutton_title,
//     'photobutton_subtitle' => $photobutton_subtitle,
//     'photobutton_text' => $photobutton_text,
//     'modal_content' => $modal_content,
//     'wysiwyg' => $wysiwyg,
//     'post_content' => $post_content,
// ];

?>

<div id="<?php echo esc_attr($id); ?>" class="wp-block-photobutton">

	<?php
	// Il _pb-fixed-ratio dà al photobutton un ratio di deafult definito nella variabile --phbtn-ratio, ma si può poi sovrascrivere da template o da backend wp con ratio-X-Y md:ratio-X-Y
	?>
	<div class="_block-pb-d _photobutton _layer-wrap<?php echo esc_attr($class_name); ?> <?php echo esc_attr($isdark); ?>">

		<!-- Layer content -->
		<div class="_layer-content isdark">

			<?php
			// Il content-wrap è fatto in flex per permettere di allineare i contenuti in fondo quando necessario, senza dover passare al position absolute
			?>

			<div class="_content-wrap grid grid-cols-1 md:grid-cols-2 gap-8">
				<div>
					<div class="grid grid-cols-12 items-center">
						<div class="col-span-4">
							<?php if ($photobutton_toptitle) : ?>
								<h3 class="_pb-toptitle line-l fs-h1"><?php echo $photobutton_toptitle; ?></h3>
							<?php endif; ?>
						</div>
						<div class="col-span-8">
							<?php if ($photobutton_title) : ?>
								<h3 class="_pb-title h4"><?php echo $photobutton_title; ?></h3>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div>
					<?php if ($photobutton_subtitle) : ?>
						<span class="_pb-subtitle h5"><?php echo $photobutton_subtitle; ?></span>
					<?php endif; ?>
					<?php if ($photobutton_text) : ?>
						<span class="_pb-text"><?php echo $photobutton_text; ?></span>
					<?php endif; ?>
					<a class="v-r" <?php echo $href . ' ' . $target_link; ?> <?php echo canva_get_ga_event_tracker($eventCategory = 'Action-Link', $eventAction = 'Photobutton', $eventLabel = $event_label);  ?> <?php echo $modal_data_contet; ?>><?php echo esc_html($button_title); ?></a>
				</div>
			</div>
		</div>

	</div>
</div>
