<?php
/*
 * Template Name: Pagina Catalogo
 * Template Post Type: page
 */

get_header();
?>
<section class="title-container _main__section md:pb-6 md:pt-8 py-4">
  <div class="wp-block-columns w-full">
    <h1 class="title-section mb-0 md:lh-13 lh-10"><?php the_title(); ?></h1>
  </div>
</section>
<section class="catalogo-parent-cats-container _main__section canva-block-posts-selector">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full wp-block-columns">
    <?php
    $args = array(
      'taxonomy' => 'catalogo',
      'orderby' => 'term_id',
      'order' => 'ASC',
      'hide_empty' => false,
      'parent' => 0
    );

    $parent_cats = get_terms($args);

    if (!empty($parent_cats) && !is_wp_error($parent_cats)) {
      $parent_cats_c = count($parent_cats);
      for ($i = 0; $i < $parent_cats_c; $i++) {
        $cat_name = $parent_cats[$i]->name;
        $thumbnail_id = canva_get_term_featured_img_id($parent_cats[$i])
          ?>
        <div class="catalogo-parent-container">
          <div class="catalogo-title-img-container items-center pl-6 grid grid-cols-2 gap-1">
            <h2 class="catalogo-parent-title mb-0">
              <?php echo $cat_name; ?>
            </h2>
            <div>
              <figure class="figure-60 figure-cat-thumbnail overflow-hidden">
                <?php
                echo wp_get_attachment_image($thumbnail_id, "full", false, ['class' => 'object-cover h-full w-full', 'title' => $cat_name, 'alt' => $cat_name]);
                ?>
              </figure>
            </div>
          </div>
          <div class="md:p-4 p-5 grid grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $child_args = array(
              'taxonomy' => 'catalogo',
              'orderby' => 'term_id',
              'order' => 'DESC',
              'hide_empty' => false,
              'parent' => $parent_cats[$i]->term_id
            );

            $child_cats = get_terms($child_args);

            if (!empty($child_cats) && !is_wp_error($child_cats)) {
              $child_cats_c = count($child_cats);
              for ($j = 0; $j < $child_cats_c; $j++) {
                $child_cat_name = $child_cats[$j]->name;
                $child_cat_link = get_term_link($child_cats[$j]->term_id, 'catalogo');
                $child_cat_thumbnail_id = canva_get_term_featured_img_id($child_cats[$j]);
                $child_cat_thumbnail_url = "https://placehold.co/280x210";
                ?>
                <div class="catalogo-child-container">
                  <a href="<?php echo esc_url($child_cat_link); ?>"
                    class="catalogo-child-link flex flex-col justify-between h-full gap-2">
                    <?php echo esc_html($child_cat_name); ?>
                    <figure class="figure-100 figure-img-h-100">
                      <?php
                      if (!$child_cat_thumbnail_id) {
                        ?>
                        <img title="<?php echo $child_cat_name; ?>" src="<?php echo esc_url($child_cat_thumbnail_url); ?>"
                          alt="<?php echo esc_attr($child_cat_name); ?>" />
                        <?php
                      } else {
                        echo wp_get_attachment_image($child_cat_thumbnail_id, "catalog-child", false, ['title' => $child_cat_name, 'alt' => $child_cat_name]);
                      }
                      ?>
                    </figure>
                  </a>
                </div>
                <?php
              }
            }
            ?>
          </div>
        </div>
        <?php
      }
    }
    ?>
  </div>
</section>
<?php
echo canva_get_template('form-footer', ['post_id' => $post_id]);
get_footer();