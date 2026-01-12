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

<div class="_main-info-section _main__section _gt-single-2col">
	<div class="wp-block-columns">
		<div class="_main-photo-gallery _col-1 wp-block-column">
			<div class="sticky-wrap">
				<?php
				echo canva_get_img([
					'img_id' => get_the_ID(),
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '960-free',
					'wrapper_class' => '_scuola-image ratio-4-3 relative',
					'img_class' => 'absolute w-full h-full object-cover object-center',
					'img_style' => '',
				]);
				?>

				<div class="_scuola-info-cta bg-gray-200 p-8 mt-4 isdark" style="background-color: <?php echo esc_attr($term_color); ?>">
					<h5>Vuoi proporre questo progetto nella tua scuola?</h5>
					<p>Contattaci per consigli e informazioni dettagliate su <strong><?php echo get_the_title(); ?></strong>.</p>
					<a class="_modal-open button hollow" data-modal-content="_modal-cf7-scuole" data-modal-type="_modal-opener" data-modal-position="above-the-top" data-animation-in="modal-dialog-in" data-animation-out="modal-dialog-out">
						Contattaci
					</a>
					<div class="_modal-cf7-scuole hidden">
						<?php echo do_shortcode('[contact-form-7 id="32045" title="Modulo SCUOLE_new"]'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="_main-info _col-2 wp-block-column">

			<div class="_post-meta flex flex-wrap justify-between mb-8">
				<div class="_post-category">
					<span class="font-extra uppercase" style="color: <?php echo esc_attr($term_color); ?>;">Percorsi | <?php echo canva_get_category(get_the_ID(), 'tematica', $class = 'inline-block mr-2', $parent = 'no', $term_link = 'yes',  $facet_url = ''); ?></span>
				</div>
			</div>

			<h1 class="_title font-extra uppercase" style="color: <?php echo esc_attr($term_color); ?>;">
				<?php the_title(); ?>
			</h1>

			<div class="mt-12 py-12 border-t border-gray-200">
				<?php the_content(); ?>
			</div>

			<div class="border-t border-b border-gray-200 p-4">
				<div class="wp-block-columns mb-0">
					<div class="wp-block-column col-span-12 flex flex-wrap justify-between">
						<h4 class="fw-400 mb-0">Condividi</h4>

						<?php
						echo canva_get_share_this_post([
							'post_id' => '',
							'facebook' => 'on',
							'twitter' => 'on',
							'linkedin' => 'on',
							'pinterest' => 'on',
							'whatsapp' => 'on',
							'telegram' => 'on',
							'copy_url' => 'on',
							'icon_classes' => 'w-4 mr-2',
							'container_classes' => 'flex flex-wrap gap-4',
							'template_name' => 'fn-share-this-post'
						]);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

get_footer();
