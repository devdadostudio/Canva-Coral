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
// $term_parent_name = $term_parent->name;

$term = get_term($term_id, $taxonomy);
$term_parent = get_term($term->parent, $taxonomy);
// $childs = get_term_children($term_parent->term_id, $taxonomy);
?>
<section class="title-taxonomy-catalogo _main__section pb-4 border-bottom mb-6">
  <div class="wp-block-columns">
    <div class="col-span-12">
      <h1 class="mb-0">
        <?php
        echo $term->name . " " . __("per") . " " . $term_parent->name;
        ?>
      </h1>
    </div>
  </div>
</section>
<?php
// MT Loop Catalogo
echo canva_get_template('tax-catalogo-loop', ['term_id' => $term_id, 'css_classes' => '_loop-catalogo']);


$term_posts = get_field('common_block_selector', $term);
if ($term_posts) {
  foreach ($term_posts as $term_post) {
    canva_render_blocks($term_post);
  }
}
echo canva_get_template('form-footer', ['post_id' => $post_id]);
get_footer();
