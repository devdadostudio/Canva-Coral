<?php

/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

if ($upsells) : ?>

	<section class="up-sells products py-8 _main__section border-t border-gray-200">

		<div class="wp-block-columns">

			<?php
			// $heading = apply_filters('woocommerce_product_upsells_products_heading', __('Related products', 'woocommerce'));
			$heading = 'Altri volumi che ti possono interessare';

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

				<?php foreach ($upsells as $upsell) : ?>

					<?php
					$post_object = get_post($upsell->get_id());

					setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part('content', 'product');
					?>

				<?php endforeach; ?>
			</div>

			<?php
			//woocommerce_product_loop_end();
			?>

		</div>

	</section>

<?php
endif;

wp_reset_postdata();

// echo get_the_ID();
?>

<?php $posts = get_field('libri_correlati'); ?>
<?php if ($posts) : ?>
	<section class="up-sells products py-8 _main__section border-t border-gray-200">

		<div class="wp-block-columns">

			<?php
			// $heading = apply_filters('woocommerce_product_upsells_products_heading', __('Related products', 'woocommerce'));
			$heading = 'Altri volumi che ti possono interessare';

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

				<?php foreach ($posts as $post) : ?>
					<?php echo canva_get_template('card-product', ['post_id' => $post]); ?>
				<?php endforeach; ?>
			</div>

			<?php
			//woocommerce_product_loop_end();
			?>

		</div>

	</section>

<?php endif; ?>
