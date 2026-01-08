<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div class="_tabs wp-block-columns gap-0">
	<div class="_tabs-nav wp-block-column col-span-12 md:col-span-4 bg-accent p-4 sm:p-8 lg:p-16">
		<ul class="ul-type-a menu-v">
			<?php
			$i = 0;
			foreach ($tab_items as $key => $tab_item) :
				$i++;
				$current = '';
				if ($i == 1) {
					$current = '_current';
				}
			?>
				<li class="_tab <?php echo esc_attr($current); ?> p-4 <?php echo esc_attr($key); ?>"><?php echo $tab_item ?></li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="_tabs-content wp-block-column col-span-12 md:col-span-8 bg-gray-100  p-4 sm:p-8 lg:p-16">
		<?php
		$i = 0;
		foreach ($tab_items as $key => $tab_item) :
			$i++;
			$current = 'hidden';
			if ($i == 1) {
				$current = '_current';
			}
		?>
			<div class="_tab-content <?php echo esc_attr($current); ?> <?php echo esc_attr($key); ?>">
				<?php echo canva_get_template('tab-' . esc_attr($key), ['post_id' => $post_id]); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
