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
          <div class="facetwp-template grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-4 mb-4">
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
<script>
  function equalizeSpanHeights() {
    // Controlla se la larghezza della finestra è sopra 639px
    if (window.innerWidth <= 639) {
      // Se siamo sotto 639px, resetta le altezze
      const container = document.querySelector('#filtri-prodotti');
      if (container) {
        const spans = container.querySelectorAll('._title');
        spans.forEach(span => {
          span.style.height = 'auto';
        });
      }
      return;
    }

    // Trova il div principale
    const container = document.querySelector('#filtri-prodotti');

    if (!container) return;

    // Trova tutti gli span con classe cat-title
    const spans = container.querySelectorAll('._title');

    if (spans.length === 0) return;

    // Reset delle altezze per ricalcolare correttamente
    spans.forEach(span => {
      span.style.height = 'auto';
    });

    // Trova l'altezza massima
    let maxHeight = 0;
    spans.forEach(span => {
      const height = span.offsetHeight;
      if (height > maxHeight) {
        maxHeight = height;
      }
    });

    // Applica l'altezza massima a tutti gli span
    spans.forEach(span => {
      span.style.height = maxHeight + 'px';
    });
  }

  // Esegui al caricamento della pagina
  window.addEventListener('load', equalizeSpanHeights);

  // Esegui al resize della finestra
  window.addEventListener('resize', equalizeSpanHeights);
</script>