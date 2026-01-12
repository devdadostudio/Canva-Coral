<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<?php if (get_field('descrizione_principale', get_field('macro_famiglia', $post_id))) : ?>
	<?php echo get_field('descrizione_principale', get_field('macro_famiglia', $post_id)); ?>
<?php endif; ?>
