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

?>

<div class="_main__section">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12">
			<h1>Archivio <span class="text-primary"><?php echo canva_get_term_name($term_id) ?></span></h1>
		</div>
	</div>
</div>

<div class="_main__section">

	<div class="_ch-filtri flex flex-wrap mb-8">
		<div class="mr-4">
			<?php echo facetwp_display('facet', 'categorie_news_fselect'); ?>
		</div>
		<div class="">
			<?php echo facetwp_display('facet', 'tipologie_news_fselect'); ?>
		</div>
	</div>

	<?php
	if (have_posts()) :
	?>
		<div class="_archive-news grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">

			<?php
			while (have_posts()) {
				the_post();
				echo canva_get_template('card-news', ['post_id' => get_the_ID()]);
			}
			?>

			<div class="flex flex-wrap items-center justify-center">
				<?php echo facetwp_display('facet', 'load_more'); ?>
			</div>

		</div>



	<?php else : ?>

		<div class="flex flex-wrap items-center justify-center">
			Non ci sono articoli disponibili qui.
		</div>

	<?php endif; ?>


</div>

<?php
get_footer();
