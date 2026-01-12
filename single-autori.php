<?php
get_header();

$terms = get_the_terms(get_the_ID(), 'tematica');

$term_ids = [];
foreach ($terms as $term) {
	$term_ids[] = $term->term_id;
}

$term = get_term_by('term_id', $term_ids[0], 'tematica');

if (isset($_GET['term_color']) && ('' != trim($_GET['term_color']))) {
	$term_color = '#' . $_GET['term_color'];
} else {
	$term_color = canva_get_term_color($term);
}

?>
<div class="_main__section _gt-page-2col">
	<div class="wp-block-columns">
		<div class="wp-block-column _col-1">
			<div class="sticky-wrap">
				<?php
				echo canva_get_img([
					'img_id' => get_the_ID(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => '',
					'img_class' => 'm-0 image-caption block',
					'img_style' => '',
				]);
				?>
				<p class="mt-2 mb-0"><?php the_title(); ?></p>

			</div>
		</div>
		<div class="wp-block-column _col-2">
			<div class="_post-meta flex flex-wrap justify-between mb-8">
				<div class="_post-category" style="color: <?php echo esc_attr($term_color); ?>;">
					<?php echo canva_get_category(get_the_ID(), 'autore-categoria', $class = '_bullet inline-flex fs-xxs', $parent = 'no', $term_link = 'no',  $facet_url = ''); ?>
				</div>
			</div>
			<h1 class="_title"><?php the_title(); ?></h1>
			<div class="mt-8 pt-8 border-t border-gray-200">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</div>

<?php

get_footer();
