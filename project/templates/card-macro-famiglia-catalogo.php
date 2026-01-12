<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!$post_id) {
  $post_id = get_the_ID();
}
?>
<a href="<?php echo get_permalink($post_id); ?>">
  <div
    class="_card _card-macro-famiglia _card-macro-famiglia-catalogo border border-gray-200 group flex flex-row-reverse md:flex-col p-4 md:py-10 md:px-5 md:gap-0 gap-4">
    <div class="_card-info flex-1">
      <h3 class="_title _no-translate fw-700 md:mb-4 mb-6 break-all">
        <?php echo get_the_title($post_id); ?>
      </h3>
      <p class="line-clamp-3 _description md:mb-0 mb-6 md:fs-p fs-xs">
        <?php echo canva_get_trimmed_content(get_field('descrizione_principale', $post_id), $trim_words = 20, $strip_blocks = false, $strip_shortcode = true); ?>
      </p>
      <span class="v-r v-r-xs block md:hide mt-2 mb-0 fw-400">Scopri</span>
    </div>
    <div class="_card-figure w-1/3 md:w-full md:py-10">
      <?php
      if (has_post_thumbnail($post_id)) {
        echo canva_get_img([
          'img_id' => $post_id,
          'img_type' => 'img', // img, bg, url
          'thumb_size' => '640-free',
          'wrapper_class' => 'relative ratio-1-1 md:ratio-3-2 overflow-hidden',
          'img_class' => 'absolute w-full h-full object-contain object-center transform-gpu a-transition group-hover:scale-105',
          'img_style' => '',
        ]);
      } else {
        echo canva_get_img([
          'img_id' => canva_get_no_image_id(),
          'img_type' => 'img', // img, bg, url
          'thumb_size' => '640-free',
          'wrapper_class' => 'relative ratio-1-1 md:ratio-3-2 overflow-hidden',
          'img_class' => 'absolute w-full h-full object-contain object-center transform-gpu a-transition group-hover:scale-105',
          'img_style' => '',
        ]);
      }
      ?>
    </div>
    <div class="_card-info flex-1 md:inline-block hidden">
      <span class="v-r mt-2 h4 mb-0 fw-400">Scopri la famiglia</span>
    </div>
  </div>
</a>