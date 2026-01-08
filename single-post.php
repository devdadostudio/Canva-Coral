<?php
get_header();

if (!$post_id) {
	$post_id = get_the_ID();
}

?>

<div class="_main__section">
	<div class="_post-news-hero wp-block-columns md:gap-8 items-center pb-8 border-b border-black">
		<div class="_news-meta wp-block-column col-span-12 md:col-span-6">
			<h1 class="_title"><?php the_title(); ?></h1>
			<div class="inline-flex">
				<?php echo canva_get_category(get_the_ID(), 'category', $class = '_tag', $parent = 'no', $term_link = 'yes',  $facet_url = ''); ?>
				<span class="_tag _tag-date">
					<?php echo strtolower(get_the_date('j F Y', $post_id)); ?>
				</span>
			</div>
		</div>
		<div class="_img wp-block-column col-span-12 md:col-span-6">
			<?php
			echo canva_get_img([
				'img_id' => get_the_ID(),
				'img_type' => 'img', // img, bg, url
				'thumb_size' => '960-free',
				'wrapper_class' => '_news-image ratio-3-2 relative',
				'img_class' => 'absolute w-full h-full object-cover object-center',
				'img_style' => '',
			]);
			?>
		</div>
	</div>


	<div class="_post-news-content wp-block-columns py-8">
		<div class="wp-block-column col-span-12 md:col-span-6">
			<?php
			  the_content();
			?>
		</div>
	</div>
</div>

<?php

get_footer();

