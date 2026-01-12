<?php
/*
* Template Name: Testing Code
* Template Post Type: page
*/

get_header();

$posts_arg = [
	'post_type' => 'macrofamiglia',
	'facetwp' => true,
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'inquinante',
			'field'    => 'slug',
			'terms'    => 'fumi',
		),
	)
];

$query = new WP_Query($posts_arg);
// var_dump($query);
?>

<?php if ($query->have_posts()) : ?>

	<ol>
		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
		<?php endwhile; ?>
	</ol>
	<?php
	wp_reset_postdata();
	?>
<?php endif; ?>

<?php
get_footer();
