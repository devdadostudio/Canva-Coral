<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header();

$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$term_slug = $queried_object->slug;

$ancestors = get_ancestors($term_id, $taxonomy);
$ancestors = array_reverse($ancestors);

$term_top_parent = get_term($ancestors[0], $taxonomy);
// $term_top_parent_name = $term_top_parent->name;

$term_parent = get_term($ancestors[1], $taxonomy);
// $term_parent_name = $term_parent->name;

$term = get_term($term_id, $taxonomy);
// $childs = get_term_children($term_parent->term_id, $taxonomy);

//MT page-header inclusion
echo canva_get_template('page-header-categoria', ['css_classes' => '_page-header-categoria', 'nav_magellan' => ['Panoramica', 'Prodotti', 'Vantaggi', 'Approfondimenti']]);

//MT Hero inclusion
echo canva_get_template('hero-categoria', ['term' => $term, 'css_classes' => '_hero-categoria']);

// MT Loop: se esistono sottocategorie del termine corrente, mostra quelle; altrimenti fallback alle macrofamiglie
$children = get_terms([
	'taxonomy'   => $taxonomy,   // 'product_cat'
	'parent'     => $term_id,
	'hide_empty' => false,
	'orderby'    => 'menu_order',
	'order'      => 'ASC',
]);

if (!is_wp_error($children) && !empty($children)) {
	echo canva_get_template(
		'tax-categoria-loop-sottocategorie',
		[
			'children'    => $children,
			'css_classes' => '_loop-sottocategorie',
		]
	);
} else {
	echo canva_get_template(
		'tax-categoria-loop-macro-famiglie',
		[
			'term_id'     => $term_id,
			'css_classes' => '_loop-macro-famiglie-applicazione',
		]
	);
}



$term_posts = get_field('common_block_selector', $term);
if ($term_posts) {
	foreach ($term_posts as $term_post) {
		canva_render_blocks($term_post);
	}
}

// MT Form Footer
echo canva_get_template('form-footer', ['post_id' => $post_id]);

get_footer();
