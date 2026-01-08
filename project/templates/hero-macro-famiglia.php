<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="panoramica" class="_main__section _hero-macro-famiglia py-16">
	<div class="wp-block-columns md:gap-12">
		<div class="_macro-famiglia-figure wp-block-column col-span-12 md:col-span-6">
			<?php
			if (has_post_thumbnail($post_id)) {
				echo canva_get_img([
					'img_id' => $post_id,
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => 'relative ratio-4-3 overflow-hidden photoswipe-item gallery-item gallery-item' . $post_id,
					'img_class' => 'absolute w-full h-full object-contain object-center',
					'img_style' => '',
				]);
			} else {
				echo canva_get_img([
					'img_id' => canva_get_no_image_id(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => 'relative ratio-4-3 overflow-hidden',
					'img_class' => 'absolute w-full h-full  object-contain object-center',
					'img_style' => '',
				]);
			}
			?>
		</div>
		<div class="_macro-famiglia-info wp-block-column col-span-12 md:col-span-6">

			<p class="lead">
				<?php echo get_field('descrizione_principale', $post_id); ?>
			</p>

			<div class="mt-12 flex gap-4 flex-col items-start">
				<a class="button" href="#prodotti">Scopri i prodotti</a>
				<a class="button hollow" href="#cta-footer">Richiedi informazioni</a>
			</div>
		</div>
	</div>
</div>
