<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>
<?php if ($taxonomy_slug) : ?>

	<?php
	$args = [
		'taxonomy' => sanitize_text_field($taxonomy_slug),
		'hide_empty' => true,
	];

	if ($orderby && $orderby != 'rand') {
		$args[] = ['orderby' => $orderby];
	}

	if ($exclude) {
		$args[] = ['exclude' => $exclude];
	}

	dump_to_error_log($args);

	$terms = get_terms($args);

	if ($orderby == 'rand') {
		shuffle($terms);
	}

	?>

	<ul class="menu-v <?php echo esc_attr($css_classes); ?>">
		<?php foreach ($terms as $term) : ?>
			<li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo $term->name; ?></a></li>
		<?php endforeach; ?>
	</ul>

<?php endif; ?>
