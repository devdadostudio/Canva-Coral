<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (empty($post_id)) {
	$post_id = get_the_ID();
}

// Aggiungiamo il rel di sicurezza e SEO
$rel_attr = ' rel="noopener noreferrer nofollow"';
?>

<a href="<?php echo esc_url(get_permalink($post_id)); ?>"<?php echo $rel_attr; ?>>
	<div class="_card _card-news group">

		<div class="_figure bg-gray-100">
			<?php
			if (has_post_thumbnail($post_id)) {
				echo canva_get_img([
					'img_id'         => $post_id,
					'img_type'       => 'img', // img, bg, url
					'thumb_size'     => '640-free',
					'wrapper_class'  => '_card-figure relative ratio-3-2 w-full overflow-hidden',
					'img_class'      => 'absolute w-full h-full object-cover object-center transform-gpu btn-transition group-hover:scale-105 duration-xslow',
					'img_style'      => '',
				]);
			} else {
				echo canva_get_img([
					'img_id'         => canva_get_no_image_id(),
					'img_type'       => 'img', // img, bg, url
					'thumb_size'     => '640-free',
					'wrapper_class'  => '_card-figure relative ratio-3-2 w-full overflow-hidden',
					'img_class'      => 'absolute w-full h-full object-cover object-center transform-gpu btn-transition group-hover:scale-105 duration-xslow',
					'img_style'      => '',
				]);
			}
			?>
		</div>

		<div class="_info py-4">
			<p class="h4 h-12 mb-2 line-clamp-2"><?php echo esc_html(get_the_title($post_id)); ?></p>
		</div>

	</div>
</a>
