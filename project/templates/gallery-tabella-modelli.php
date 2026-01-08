<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
$tabella_modelli_galleria = get_field('tabella_modelli_galleria', $post_id);

// var_dump($tabella_modelli_galleria);
?>

<div id="<?php echo esc_attr($anchor_name); ?>" class="_main__section py-0">
	<div class="wp-block-columns py-12 border-t border-black">
		<div class="wp-block-column col-span-12">
			<h3 class="mb-16">Tabella modelli</h3>
			<?php if ($tabella_modelli_galleria) : ?>
				<div class="tabella_modelli_galleria flex flex-wrap gap-4">

					<?php
					foreach (get_field('tabella_modelli_galleria', $post_id) as $img) {
						echo canva_get_img([
							'img_id'   =>  $img,
							'img_type' => 'img', // img, bg, url
							'thumb_size' =>  '960-free',
							'wrapper_class' => 'photoswipe-item gallery-item gallery-item' . $post_id,
							'img_class' => 'w-32 md:w-64',
							'blazy' => 'on',
						]);
					}
					?>

				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
