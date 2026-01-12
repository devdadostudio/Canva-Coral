<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<a href="<?php echo get_permalink($post_id) ?>">
	<div class="_card _card-case-history group">

		<div class="_figure bg-gray-100 h-64">
			<?php
			if (has_post_thumbnail($post_id)) {
				echo canva_get_img([
					'img_id' => $post_id,
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => '_card-figure relative h-64 w-full overflow-hidden',
					'img_class' => 'absolute w-full h-full object-cover object-center transform-gpu btn-transition group-hover:scale-105 duration-xslow',
					'img_style' => '',
				]);
			} ?>
		</div>

		<div class="_info py-4">

			<div class="_tags-wrap inline-flex mb-4">
				<?php echo canva_get_category($post_id, 'applicazione', $class = '_tag', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
				<?php echo canva_get_category($post_id, 'inquinante', $class = '_tag', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
			</div>

			<h3 class="h4 h-12 mb-6 line-clamp-2">
				<?php echo get_the_title($post_id); ?>
			</h3>

			<span class="v-r inline-block fs-xs">Scopri</span>

		</div>

	</div>
</a>
