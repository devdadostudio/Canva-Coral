<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

if (get_post_type() == 'prodotto') {
	$post_id = get_field('famiglia', $post_id);
}
?>

<div class="flex flec-wrap gap-4">

	<?php if (get_field('descrizione_funzionamento_img', $post_id)) : ?>
		<div class="descrizione_funzionamento_img flex-1">

			<?php
			echo canva_get_img([
				'img_id' => get_field('descrizione_funzionamento_img', $post_id),
				'img_type' => 'img', // img, bg, url
				'thumb_size' => '640-free',
				'wrapper_class' => 'relative ratio-1-1 md:ratio-4-3 px-8 overflow-hidden photoswipe-item gallery-item gallery-item' . $post_id,
				'img_class' => 'absolute w-full h-full object-contain object-center',
				'img_style' => '',
			]);
			?>
		</div>
	<?php endif; ?>

	<?php if (get_field('descrizione_funzionamento', $post_id)) : ?>
		<div class="descrizione_funzionamento flex-1">
			<?php echo get_field('descrizione_funzionamento', $post_id); ?>
		</div>
	<?php endif; ?>

</div>
