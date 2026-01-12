<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div class="<?php echo esc_attr($css_classes); ?> _page-header fixed w-full z-20">
	<div class="_title _main__section">
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-12">
				<h1 class="<?php echo esc_attr($no_translate); ?> title fw-400 btn-transition">
					<?php
					if($term_name){
						echo $term_name;
					}else{
						echo get_the_title($post_id);
					}
					?>
				</h1>
			</div>
		</div>
	</div>
	<div class="_nav-local _main__section py-4 bg-gray-100 overflow-x-auto">
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-12">
				<?php if (isset($nav_magellan)) : ?>
					<ul class="_menu-local menu-h gap-8 fs-sm mb-0">
						<?php
						$i = 0;
						foreach ($nav_magellan as $item) :
							$i++;
							$current = '';
							if ($i == 1) {
								$current = '_current';
							}
						?>
							<li class="flex-shrink-0 <?php echo sanitize_title($item) ?>">
								<a class="<?php echo esc_attr($current); ?>" href="#<?php echo sanitize_title($item) ?>">
									<?php echo $item ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="_after-page-header"></div>
