<?php
get_header();

if (!$post_id) {
	$post_id = get_the_ID();
}

?>

<div class="_main__section">
	<div class="_case-history-post wp-block-columns md:gap-8">
		<div class="_case-history-meta wp-block-column col-span-12 md:col-span-10">
			<p class="_title fs-h2"><?php the_title(); ?></p>
		</div>
		<div class="wp-block-column col-span-12 flex flex-wrap">
			<?php echo canva_get_category($post_id, 'applicazione', $class = '_tag _tag-date', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
			<?php echo canva_get_category($post_id, 'inquinante', $class = '_tag _tag-date', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>

		</div>

		<div class="_img wp-block-column col-span-12 md:col-span-10">
			<?php
			echo canva_get_img([
				'img_id' => get_the_ID(),
				'img_type' => 'img', // img, bg, url
				'thumb_size' => '640-free',
				'wrapper_class' => '_case-history-image ratio-16-9 relative',
				'img_class' => 'absolute w-full h-full object-cover object-center',
				'img_style' => '',
			]);
			?>
		</div>
	</div>


	<div class="_info-post wp-block-columns py-8">
		<div class="wp-block-column col-span-12 md:col-span-6">
				<?php the_content(); ?>
		</div>
	</div>
</div>

<?php if (get_field('gallery', $post_id)) : ?>
	<div class="_main__section gallery pb-24">
		<?php
		$atts = [
			'img_ids' => get_field('gallery', $post_id),
			'template_name' => 'gallery-slider',
			'swiper_hero_class' => '',
			'swiper_container_class' => '',
			'slides_per_view_xsmall' => 1,
			'slides_per_view_small' => 1,
			'slides_per_view_medium' => 1,
			'slides_per_view_large' => 1,
			'slides_per_view_xlarge' => 1,
			'prev_next' => 'true',
			'pagination' => 'true',
			'autoplay' => 'false',
			'loop' => 'true',
			'centered_slides_bounds' => 'false',
			'centered_slides' => 'false',
			'center_insufficient_slides' => 'false',
			'slides_offset_before' => 0,
			'slides_offset_after' => 0,
			'free_mode' => 'false'
		];

		canva_gallery_slider($atts);
		?>
	</div>
<?php endif; ?>

<?php canva_render_blocks(5552); ?>

<?php

get_footer();
