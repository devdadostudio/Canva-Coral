<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div class="_clip-sede-wrap py-8" style="border-top: 1px solid var(--body-color);">

	<h3 class="fs-h5 fw-700">
		<?php echo get_the_title($post_id); ?>
		<?php
		echo
		" (" . (get_field("citta", $post_id) ? get_field("citta", $post_id) : "") .
			(get_field("provincia", $post_id) ? ", " . get_field("provincia", $post_id) : "") . ")"; ?>
	</h3>

	<?php if (get_field('indirizzo_completo', $post_id)) : ?>
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-2 hide md:block">
				<p class="fs-sm">Posizione</p>
			</div>
			<div class="wp-block-column col-span-8">
				<p class="fs-sm">
					<?php echo get_field('indirizzo_completo', $post_id) . (get_field("citta", $post_id) ? ", " . get_field("citta", $post_id) : "") . (get_field("provincia", $post_id) ? ", " . get_field("provincia", $post_id) : ""); ?>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if (get_field('telefono', $post_id)) : ?>
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-2 hide md:block">
				<p class="fs-sm">Telefono</p>
			</div>
			<div class="wp-block-column col-span-8">
				<p class="fs-sm">
					<?php echo get_field('telefono', $post_id); ?>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php if (get_field('email', $post_id)) : ?>
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-2 hide md:block">
				<p>Email</p>
			</div>
			<div class="wp-block-column col-span-8">
				<p><?php echo get_field('email', $post_id); ?></p>
			</div>
		</div>
	<?php endif; ?>

	<?php if (get_field('sito_web', $post_id)) : ?>
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-2 hide md:block">
				<p>Sito web</p>
			</div>
			<div class="wp-block-column col-span-8">
				<p><?php echo get_field('sito_web', $post_id); ?></p>
			</div>
		</div>
	<?php endif; ?>

</div>
