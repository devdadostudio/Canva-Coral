<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (is_admin() && !defined('DOING_AJAX')) {

	if (!$is_preview) {
		/* rendering in inserter preview  */
		echo '<img src="' . CANVA_PROJECT_BLOCKS_URI . '/previews/' . wp_basename($block['name']) . '.jpg" class="block-preview" style="width:100%; height:auto;">';
	}

?>

	<div class="canva-wp-block canva-flex">

		<div class="info canva-width-24 canva-p-4">

			<span class="title canva-block canva-mb-2 canva-fs-xxsmall canva-font-system canva-lh-10" style="">
				<?php _e('Hero Product', 'canva-backend'); ?>
			</span>

			<figure class="canva-width-12 canva-m-0">

				<!-- Icona -->
				<?php echo apply_filters('promo_block_slider_preview_blocks_icon', canva_get_svg_icon('canva-icons/canva-icon-posts-selector-preview', null)); ?>
				<!-- Fine Icona -->

			</figure>

		</div>

		<div class="_content canva-flex-1 canva-p-4">

			<?php
			if (get_field('product_id')[0]) {
			?>
				<h3>
					<?php echo get_the_title(get_field('product_id')[0]); ?>
				</h3>
				<?php
				echo canva_get_img([
					'img_id' => get_field('product_id')[0],
					'img_type' => 'img', // img, bg, url
					'thumb_size' => '640-free',
					'wrapper_class' => 'canva-width-24 canva-p-0 canva-m-0 canva-mr-4',
					'img_class' => '',
					'blazy' => 'off'
				]);
				?>
			<?php } else { ?>
				<span class="canva-block canva-mb-2 canva-fs-h4 canva-font-theme canva-fw-700 canva-lh-11">
					Imposta il blocco
				</span>
			<?php } ?>
		</div>

	</div>

<?php } else { ?>

<?php
	// Create id attribute allowing for custom "anchor" value.
	$id = $block['id'];
	if (!empty($block['anchor'])) {
		$id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$className = '';
	if (!empty($block['className'])) {
		$className .= ' ' . $block['className'];
	}

	$template_name = 'block-hero-product';
	if(get_field('template_name')){
		$template_name = esc_attr(get_field('template_name'));
	}

	echo canva_get_template(sanitize_text_field($template_name), ['product_id' => get_field('product_id')[0], 'color' => get_field('color'), 'is_dark' => get_field('is_dark'), 'css_classes' => $className]);
}
