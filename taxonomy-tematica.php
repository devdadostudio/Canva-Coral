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

			<div class="_hero _hero-tematica _layer-wrap mb-6">

				<div class="_layer-visual absolute">
					<?php
					echo canva_get_img([
						'img_id' => canva_get_term_featured_img_id($term),
						'img_type' => 'bg', // img, bg, url
						'thumb_size' => '1920-free',
						'wrapper_class' => '_layer-bg bg-cover bg-center',
					]);
					?>
					<div class="_layer-filter" style="background-color: <?php echo canva_get_term_color($term); ?>; mix-blend-mode: normal;"></div>
				</div>

				<div class="_layer-content relative w-full flex items-center justify-center p-6">
					<div class="w-full p-6 isdark max-w-screen-lg" style="background: rgba(0,0,0,.75);">
						<div class="wp-block-columns mb-0">
							<div class="wp-block-column col-span-12 lg:col-span-6">
								<h1 class="font-extra uppercase mb-0"><?php echo canva_get_term_name($term); ?></h1>
							</div>
							<?php if (canva_get_term_subtitle($term)) : ?>
								<div class="wp-block-column col-span-12 lg:col-span-6">
									<span class="_subtitle fs-h5"><?php echo canva_get_term_subtitle($term); ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

</div>


<div class="_main__section _gt-shelf _shelf-books">

	<div class="wp-block-columns">

		<!-- Colonna 1 tutti i filtri -->
		<div class="_col-1 wp-block-column" style="padding-bottom: 6rem;">

			<div class="sticky-wrap">
				<h3 class="_title">
					<?php echo canva_get_term_name($term_id); ?>
				</h3>
				<?php echo canva_get_term_description($term); ?>


				<div class="_other hidden lg:block">
					<span class="h6 mt-24 mb-4 block">Altre tematiche</span>
					<?php
					$other_terms = get_terms(
						array(
							'taxonomy' => sanitize_text_field($taxonomy),
							'hide_empty' => true,
							'exclude' => $term_id,
						)
					);
					// var_dump($term_children_ids);
					?>
					<ul class="menu-v">
						<?php
						foreach ($other_terms as $other_term) {
							echo '<li class="">
							<a href="' . get_term_link($other_term, $taxonomy) . '">' . canva_get_term_name($other_term->term_id) . '</a>
							</li>';
						}
						?>
					</ul>
				</div>

			</div>

		</div>


		<!-- Colonna 2 Tutte le card -->
		<div class="_col-2 wp-block-column">

			<?php
			if (have_posts()) :
			?>

				<div class="_archive-news pb-16">

					<div class="_archive-news-wrap grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

						<?php
						while (have_posts()) {
							the_post();
							echo canva_get_template('card-scuola', ['post_id' => get_the_ID(), 'term_color' => canva_get_term_color($term)]);
						}
						?>

					</div>

				</div>


			<?php else : ?>

				<div class="flex flex-wrap items-center justify-center">
					<span class="h2 my-32">Non ci sono articoli disponibili qui.</span>
				</div>

			<?php endif; ?>
		</div>

	</div>

</div>

<div class="_main__section">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12 pb-24">
			<div class="_other lg:hidden">
				<span class="h6 mt-24 mb-4 block">Altre tematiche</span>
				<?php
				$other_terms = get_terms(
					array(
						'taxonomy' => sanitize_text_field($taxonomy),
						'hide_empty' => true,
						'exclude' => $term_id,
					)
				);
				// var_dump($term_children_ids);
				?>
				<ul class="menu-v">
					<?php
					foreach ($other_terms as $other_term) {
						echo '<li class="">
						<a href="' . get_term_link($other_term, $taxonomy) . '">' . canva_get_term_name($other_term->term_id) . '</a>
						</li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
