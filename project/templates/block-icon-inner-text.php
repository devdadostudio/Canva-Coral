<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="<?php echo esc_attr($id); ?>" class="_canva-block-icon-inner-text flex flex-wrap gap-4 items-center <?php echo esc_attr($css_classes); ?>">

	<div class="_icon <?php echo esc_attr($icon_classes); ?>">
		<?php
		echo canva_get_img([
			'img_id' => get_field('icon'),
			'img_type' => 'img', // img, bg, url
			'thumb_size' => '320-11',
			'wrapper_class' => $parent_classes,
			'img_class' => $child_classes,
			'bg_content' => '',
			'caption' => 'off',
			'blazy' => 'on',
			'srcset' => 'off',
			'data_attr' => '',
			'width' => '',
			'height' => '',
		]);
		?>
	</div>

	<div class="_content flex-1">
		<InnerBlocks />
	</div>

</div>
