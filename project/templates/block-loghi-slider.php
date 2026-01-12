<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<?php if (get_field('external_url', $post_id)) { ?>
	<a href="<?php echo get_field('external_url', $post_id); ?>" target="_blank" rel="nofollow noopener">
<?php } ?>

	<?php
	echo canva_get_img([
		'img_id' => $post_id,
		'img_type' => 'img', // img, bg, url
		'thumb_size' => '320-11',
		'wrapper_class' => '_swiper-thumb-wrap relative px-6',
		'img_class' => 'max-w-24 mx-auto',
		'blazy' => 'on',
		'srcset' => 'on',
	]);
	?>

<?php if (get_field('external_url', $post_id)) { ?>
	</a>
<?php } ?>
