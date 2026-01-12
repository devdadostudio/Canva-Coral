<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>
<a href="<?php echo get_permalink($post_id); ?>">
	<div class="_card _card-famiglia h-full border border-gray-200 group flex md:flex-col">
		<div class="_card-figure w-1/3 md:w-full">
			<?php
			if (has_post_thumbnail($post_id)) {
				echo canva_get_img([
					'img_id' => $post_id,
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'relative ratio-1-1 md:ratio-3-2 overflow-hidden',
					'img_class' => 'absolute w-full h-full p-4 object-contain object-center transform-gpu btn-transition group-hover:scale-105',
					'img_style' => '',
				]);
			} elseif (get_field('macro_famiglia', $post_id)) {
				echo canva_get_img([
					'img_id' => get_field('macro_famiglia', $post_id),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'relative ratio-1-1 md:ratio-3-2 overflow-hidden',
					'img_class' => 'absolute w-full h-full p-4 object-contain object-center transform-gpu btn-transition group-hover:scale-105',
					'img_style' => '',
				]);
			} else {
				echo canva_get_img([
					'img_id' => canva_get_no_image_id(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'relative ratio-1-1 md:ratio-3-2 overflow-hidden',
					'img_class' => 'absolute w-full h-full p-4 object-contain object-center transform-gpu btn-transition group-hover:scale-105',
					'img_style' => '',
				]);
			}
			?>
		</div>
		<div class="_card-info flex-1 p-4 xl:p-8 xl:pt-0">
			<h3 class="_title h5 fw-700 mb-4 break-all">
				<span class="_no-translate"><?php echo get_the_title($post_id); ?></span>
				<span class="_subtitle"><?php echo get_field('subtitle', $post_id); ?></span>
			</h3>
			<p class="fs-xs line-clamp-2 mb-4">
				<?php echo canva_get_trimmed_content(get_field('descrizione_principale', $post_id), $trim_words = 20, $strip_blocks = false, $strip_shortcode = true); ?>
			</p>
			<span class="v-r block fs-xs md:inline-block">Scopri</span>
		</div>
	</div>
</a>
