<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<?php if (get_field('highlights', $post_id)) : ?>
	<ul class="wp-block-list">
		<?php
		$highlights = explode(';', get_field('highlights', $post_id));
		foreach ($highlights as $highlight) : ?>
			<li><?php echo $highlight; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
