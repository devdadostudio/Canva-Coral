<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$terms = get_the_terms(get_the_ID(), 'product_tag');

$terms_arr = [];
foreach($terms as $term){
	$terms_arr[] = $term->term_id;
}

$ids = get_posts(array(
	'post_type' => 'product',
	'posts_per_page' => 12,
	'post_status' => 'publish',
	'fields' => 'ids',
	'post__not_in' => [get_the_ID()],
	'tax_query' => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'product_tag',
			'field'    => 'term_id',
			'terms'    => $terms_arr,
			// 'operator' => 'AND'
		),
	)
));

// var_dump($ids);

?>
<?php if ($ids) : ?>
	<section class="up-sells products py-8 _main__section">

		<div class="wp-block-columns">

			<?php
			// $heading = apply_filters('woocommerce_product_upsells_products_heading', __('Related products', 'woocommerce'));
			$heading = 'Sullo stesso argomento';

			if ($heading) :
			?>

			<div class="wp-block-column col-span-12">
				<h3 class="mb-8 fw-400"><?php echo esc_html($heading); ?></h3>
			</div>

			<?php endif; ?>

			<?php
			//woocommerce_product_loop_start();
			?>

			<div class="_related-box wp-block-column col-span-12 grid grid-cols-1 md:grid-cols-4 gap-6">

				<?php foreach ($ids as $id) : ?>
					<?php echo canva_get_template('card-product', ['post_id' => $id]); ?>
				<?php endforeach; ?>
			</div>

			<?php
			//woocommerce_product_loop_end();
			?>

		</div>

	</section>

<?php endif; ?>
