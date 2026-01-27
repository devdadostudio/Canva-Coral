<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!$post_id) {
  $post_id = get_the_ID();
}
$term_id = get_queried_object_id();
$wp_query = new WP_Query(array(
  'post_type' => array('famiglia', 'macrofamiglia'),
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'catalogo',
      'field' => 'term_id',
      'terms' => $term_id,
    ),
  )
));
?>

<div id="prodotti" class="<?php echo esc_attr($css_classes); ?> _main__section">
  <div id="filtri-prodotti" class="wp-block-columns">
    <div class="wp-block-column col-span-12">
      <div class="wp-block-columns md:gap-8">
        <div class="wp-block-column col-span-12 md:col-span-12 xxl:col-span-12">

          <div class="facetwp-template grid grid-cols-1 md:grid-cols-2 xxl:grid-cols-3 gap-y-8 gap-x-4 mb-4">
            <?php
            while ($wp_query->have_posts()) {
              $wp_query->the_post();
              if (get_post_type() == 'macrofamiglia' || get_post_type() == 'famiglia') {
                echo canva_get_template('card-macro-famiglia-catalogo', ['post_id' => get_the_ID()]);
              }
            }
            // wp_reset_postdata();
            ?>
          </div>
          <div class=" mt-8">
            <?php echo facetwp_display('facet', 'load_more');
            ?>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>