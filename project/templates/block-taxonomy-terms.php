<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}


?>
<?php if ($taxonomy_slug) : ?>

	<?php
	$args = [
		'taxonomy' => sanitize_text_field($taxonomy_slug),
		'hide_empty' => true,
	];

	if ($orderby && $orderby != 'rand') {
		$args[] = ['orderby' => $orderby];
	}

	if ($order && $orderby != 'rand') {
		$args[] = ['order' => $order];
	}

	if ($exclude) {
		$args[] = ['exclude' => $exclude];
	}

	$terms = get_terms($args);

	if ($orderby == 'rand') {
		shuffle($terms);
	}

	// var_dump($args);

	?>

	<!-- Questo è il div che contiene tutte le card, di solito lo si imposta come grid... gap... dentro le classi css che si danno al blocco nel be wp -->
	<div class="<?php echo esc_attr($css_classes); ?>">

		<?php
		foreach ($terms as $term) :

			$term_color = canva_get_term_color($term);
			$term_image = canva_get_term_featured_img_id($term);
		?>

			<a href="<?php echo esc_url(get_term_link($term)); ?>">
				<div class="_card group">
					<div class="_card-img _layer-wrap ratio ratio-4-5 md:ratio-4-3 relative">

						<div class="_layer-visual absolute">
							<div class="_layer-filter"></div>
							<div class="_layer-picture">
								<?php
								echo canva_get_img([
									'img_id' => $term_image,
									'img_type' => 'img', // img, bg, url
									'thumb_size' => '640-11',
									'wrapper_class' => '',
									'img_class' => 'w-full h-full object-cover object-center transform-gpu btn-transition group-hover:scale-105 duration-xslow', 'image-caption' => 'block',
								]);
								?>
							</div>
						</div>

						<div class="_layer-content absolute flex w-full h-full items-end justify-center p-4 md:p-8">
							<div class="_title w-full isdark text-left">
								<h3 class="fs-h6 md:fs-h4 mb-0 font-extra"><?php echo $term->name; ?></h3>
							</div>
						</div>
					</div>
				</div>
			</a>

		<?php endforeach; ?>
	</div>


<?php endif; ?>
