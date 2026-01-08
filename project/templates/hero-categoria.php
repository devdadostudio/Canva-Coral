<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// if (!$post_id) {
// 	$post_id = get_the_ID();
// }
?>
<div class="_hero-applicazione _main__section">
	<div class="wp-block-columns gap-0">
		<div class="wp-block-column is-vertically-aligned-top col-span-12 md:col-span-6">
			<div class=" md:mt-8">
				<h1 class="fs-huge"><?php echo canva_get_term_subtitle($term) ?></h1>
				<?php
				if (canva_get_term_featured_img_id($term)) {
					echo canva_get_img([
						'img_id' => canva_get_term_featured_img_id($term),
						'img_type' => 'img', // img, bg, url
						'thumb_size' => '960-free',
						'wrapper_class' => 'relative overflow-hidden',
						'img_class' => 'w-full object-cover object-center',
						'img_style' => '',
					]);
				} else {
					echo canva_get_img([
						'img_id' => canva_get_no_image_id(),
						'img_type' => 'img', // img, bg, url
						'thumb_size' => '960-free',
						'wrapper_class' => 'relative overflow-hidden',
						'img_class' => ' w-full object-cover object-center',
						'img_style' => '',
					]);
				}
				?>
			</div>
		</div>

		<div class="wp-block-column is-vertically-aligned-top col-span-12 md:col-span-6 bg-secondary isdark p-6 md:p-16">
			<?php echo canva_get_term_description($term); ?>
		</div>
	</div>
</div>