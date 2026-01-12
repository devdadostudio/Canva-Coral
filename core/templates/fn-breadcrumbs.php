<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<?php if (function_exists('yoast_breadcrumb') && !empty(get_option('wpseo_titles')['breadcrumbs-enable'])) : ?>
	<?php
	// if (is_home() || is_front_page() || is_category() || is_archive())  :
	?>
	<?php if (is_home() || is_front_page()) : ?>

	<?php else : ?>
		<div class="_breadcrumbs fixed w-full _main__section py-2 fs-xxs bg-white z-20">
			<div class="wp-block-columns">
				<div class="wp-block-column col-span-12">
					<?php echo yoast_breadcrumb(); ?>
				</div>
			</div>
		</div>
		<div class="_after-breadcrumbs a-transition"></div>
	<?php endif; ?>

<?php endif; ?>
