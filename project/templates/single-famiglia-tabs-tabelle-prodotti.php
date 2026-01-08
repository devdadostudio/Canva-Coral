<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

?>
<div id="prodotti" class="_main__section py-12">

	<div class="_tabs max-w-screen-xxl mx-auto">

		<div class="_tabs-nav flex justify-center mb-8">
			<ul class="menu-h _tabs-tabelle-prodotti flex-wrap">
				<?php
				$i = 0;
				foreach ($tab_items as $key => $tab_item) :
					$i++;
					$current = '';
					if ($i == 1) {
						$current = '_current';
					}
				?>
					<li class="_tab _tab-btn <?php echo esc_attr($current); ?> <?php echo esc_attr($key); ?>">
						<span class="fs-xs mb-0"><?php echo $tab_item ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="_tabs-content wp-block-column col-span-12 overflow-x-auto">

			<?php
			$i = 0;
			foreach ($tab_items as $key => $tab_item) :
				$i++;
				$current = 'force-hidden';
				if ($i == 1) {
					$current = '_current';
				}
			?>
				<div class="_tab-content <?php echo esc_attr($current); ?> <?php echo esc_attr($key); ?>">
					<?php echo canva_get_template('single-famiglia-tab-tabella-' . esc_attr($key), ['post_id' => $post_id]); ?>
				</div>
			<?php endforeach; ?>

		</div>

	</div>

</div>
