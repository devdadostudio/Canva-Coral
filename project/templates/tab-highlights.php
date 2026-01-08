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

<?php
	echo canva_get_template('clip-highlights', ['post_id' => $post_id]);
?>
