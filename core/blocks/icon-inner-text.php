<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

//if (is_admin() && !defined('DOING_AJAX')) {
if (is_admin()) {

?>
	<div class="canva-wp-block" style="border: 1px dashed #aaaaaa;">

		<div class="_info canva-flex align-middle">
			<figure class="canva-width-8 canva-m-0 canva-bg-grey-lightest canva-p-0">
				<!-- ICONA -->
				<?php echo apply_filters('icon_text_blocks_icon', canva_get_svg_icon('canva-icons/canva-icon-icon-text', null)); ?>
				<!-- Fine Icona -->
			</figure>
			<div class="canva-flex-1 canva-p-4 canva-bg-grey-lightest">
				<span class="title canva-block canva-mb-2 canva-fs-xxsmall canva-font-system canva-lh-12" style=""><?php _e('Icon Inner Text', 'canva-backend'); ?></span>
				<!-- <span>Contiene: Sopratitolo, Titolo, Sottotitolo</span> -->
				<span class="canva-block canva-mt-0 canva-mb-2 canva-fs-small canva-font-theme canva-lh-11"><?php echo esc_html('Icon & Text with inner blocks', 'canva-backend'); ?></span>
			</div>
		</div>

		<div class="_content canva-p-4 canva-bg-white canva-flex">

			<div class="_icon">
				<?php
				if (get_field('icon')) {

					echo canva_get_img([
						'img_id' => get_field('icon'),
						'img_type' => 'img', // img, bg, url
						'thumb_size' => '320-11',
						'wrapper_class' => 'canva-width-12 canva-p-0 canva-m-0 canva-mr-4 canva-bg-grey-lighter',
						'img_class' => '',
						'bg_content' => '',
						'caption' => 'off',
						'blazy' => 'off',
						'srcset' => 'off',
						'data_attr' => '',
						'width' => '',
						'height' => '',
					]);
				} else {
					echo canva_get_svg_icon('fontawesome/regular/image', 'canva-width-12 canva-p-0 canva-m-0 canva-mr-4');
				}
				?>
			</div>

			<div class="_text-inner-blocks canva-flex-1">
				<InnerBlocks />
			</div>
		</div>

	</div>

<?php } else { ?>

<?php
	// Create id attribute allowing for custom "anchor" value.
	$id = $block['id'];
	if (!empty($block['anchor'])) {
		$id = $block['anchor'];
	}

	// dump_to_error_log($block);

	// Create class attribute allowing for custom "className" and "align" values.
	$className = '';
	if (!empty($block['className'])) {
		$className .= ' ' . $block['className'];
	}

	$icon_size = get_field('icon_size');

	switch ($icon_size) {
		case 'micro':
			$icon_classes = 'w-8';

			break;

		case 'mini':
			$icon_classes = 'w-12';

			break;

		case 'normal':
			$icon_classes = 'w-20';

			break;

		case 'medium':
			$icon_classes = 'w-24';

			break;

		case 'large':
			$icon_classes = 'w-32';

			break;

		case 'xlarge':
			$icon_classes = 'w-48';

			break;
	}

	$parent_classes = '';
	$child_classes = '';

	if (get_field('css_classes')) {
		if (false !== strpos(get_field('css_classes'), '|')) {
			$css_classes = explode('|', get_field('css_classes'));
		} else {
			$css_classes = get_field('css_classes');
		}

		if (is_array($css_classes)) {
			$parent_classes = $css_classes[0];
			$child_classes = $css_classes[1];
		}
	}

	$template_name = 'block-icon-inner-text';
	if (get_field('template_name')) {
		$template_name = esc_attr(get_field('template_name'));
	}

	echo canva_get_template(sanitize_text_field($template_name), ['css_classes' => $className, 'icon_classes' => $icon_classes, 'parent_classes' => $parent_classes, 'child_classes' => $child_classes]);
}
