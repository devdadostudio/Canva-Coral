<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div class="_share-tools <?php echo esc_attr($container_classes); ?>">

	<?php if ('on' == $facebook) { ?>
		<a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post_id)); ?>" rel="nofollow noopener" target="_blank" class="_share-facebook inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/facebook', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' == $twitter) { ?>
		<a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink($post_id)); ?>" rel="nofollow noopener" target="_blank" class="_share-twitter inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/twitter', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' == $linkedin) { ?>
		<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink($post_id)); ?>" rel="nofollow noopener" target="_blank" class="_share-linkedin inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/linkedin', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' == $pinterest) { ?>
		<a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post_id)); ?>" rel="nofollow noopener" target="_blank" class="_share-pinterest inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/pinterest', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' === $whatsapp) { ?>
		<a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_permalink(get_the_ID($post_id))); ?>" rel="nofollow" target="_blank" class="_share-whatsapp inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/whatsapp', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' === $telegram) { ?>
		<a href="https://telegram.me/share/url?url=<?php echo urlencode(get_permalink(get_the_ID($post_id))); ?>" rel="nofollow" target="_blank" class="_share-telegram inline-block">
			<?php echo canva_get_svg_icon('fontawesome/brands/telegram', $icon_classes); ?>
		</a>
	<?php } ?>

	<?php if ('on' == $copy_url) { ?>
		<input id="copythis" style="height:0; width:0; overflow:hidden; position:absolute;padding: 0;margin: 0;left: 0;right: 0;border: 0;" type="text" value="<?php echo get_permalink($post_id); ?>">
		<a class="_copy-url inline-block cursor-pointer" onclick="copyThis()" title="<?php echo esc_html_e('Copia link', 'canva-frontend'); ?>">
			<?php echo canva_get_svg_icon('fontawesome/regular/copy', $icon_classes); ?>
		</a>

		<script>
			function copyThis() {
				var copyText = document.getElementById("copythis");
				copyText.select();
				document.execCommand("copy");
				alert("<?php echo esc_html_e('Link copiato', 'canva'); ?>");
			}
		</script>
	<?php } ?>

</div>
