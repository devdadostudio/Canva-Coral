<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<a href="<?php echo get_permalink($post_id) ?>">
	<div class="_card-news-lg grid grid-cols-12 group bg-primary">

		<div class="_img col-span-12 md:col-span-6 bg-white">
			<?php
			if (has_post_thumbnail($post_id)) {
				echo canva_get_img([
					'img_id' => $post_id,
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'ratio-4-3 relative',
					'img_class' => 'absolute w-full h-full object-cover object-center',
					'img_style' => '',
				]);
			} else {
				echo canva_get_img([
					'img_id' => canva_get_no_image_id(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'ratio-4-3 relative',
					'img_class' => 'absolute w-full h-full object-cover object-center',
					'img_style' => '',
				]);
			}
			?>
		</div>

		<div class="_info col-span-12 md:col-span-6 p-8 lg:p-12 xxl:p-16 flex flex-col isdark justify-between">

			<div class="_top inline-flex mb-8">
				<?php echo canva_get_category($post_id, 'category', $class = '_tag text-white', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
				<span class="_tag _tag-date text-white">
					<?php echo strtolower(get_the_date('j F Y', get_the_ID())); ?>
				</span>
			</div>

			<div class="_middle">
				<h2 class="fs-h3 mb-0">
					<?php echo get_the_title($post_id); ?>
				</h2>
				<p class="mt-12">
					<?php
					echo canva_get_trimmed_content(get_post($post_id)->post_content, $trim_words = 20, $strip_blocks = true, $strip_shortcode = true); ?>
				</p>
			</div>

			<div class="_bottom mt-8">
				<span class="v-r fs-xs inline-block">Scopri</span>
			</div>
		</div>

	</div>
</a>
