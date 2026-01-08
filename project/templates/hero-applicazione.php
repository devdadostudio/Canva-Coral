<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// if (!$post_id) {
// 	$post_id = get_the_ID();
// }
?>
<div id="panoramica" class="<?php echo esc_attr($css_classes); ?> _main__section pt-0">
	<div class="wp-block-columns gap-0">
		<div class="wp-block-column col-span-12 md:col-span-6">
			<div class="_secondary-title py-12 pr-8">
				<h1 class="fw-400 mb-0"><?php echo canva_get_term_subtitle($term) ?></h1>
			</div>
			<?php
			if (canva_get_term_featured_img_id($term)) {
				echo canva_get_img([
					'img_id' => canva_get_term_featured_img_id($term),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => 'relative overflow-hidden',
					'img_class' => 'w-full object-cover object-center',
					'img_style' => 'height:360px',
				]);
			} else {
				echo canva_get_img([
					'img_id' => canva_get_no_image_id(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => 'relative overflow-hidden',
					'img_class' => ' w-full object-cover object-center',
					'img_style' => 'height:360px',
				]);
			}
			?>
		</div>

		<div class="wp-block-column is-vertically-aligned-top col-span-12 md:col-span-6 bg-secondary isdark p-6 md:p-16">
			<?php echo canva_get_term_description($term); ?>

			<div class="mt-12 flex gap-4 flex-col items-start">
				<a class="button" href="#approfondisci">Approfondisci</a>
			</div>
		</div>
	</div>
</div>
