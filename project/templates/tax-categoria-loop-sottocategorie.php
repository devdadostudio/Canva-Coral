<?php
if (!defined('ABSPATH')) { exit; }

$children    = $children ?? [];
$css_classes = $css_classes ?? '';

if (empty($children) || !is_array($children)) { return; }
?>
<div id="prodotti" class="<?php echo esc_attr($css_classes); ?> _main__section">
	<div id="filtri-prodotti" class="wp-block-columns">
		<div class="wp-block-column col-span-12">
			<div class="wp-block-columns md:gap-8">
				<div class="wp-block-column col-span-12">

					<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">
						<?php
						foreach ($children as $child) {
							echo canva_get_template('card-sottocategoria', ['term' => $child]);
						}
						?>
					</div>

					<?php
					// Nota: qui evito il load more di FacetWP perché stiamo mostrando termini, non post.
					// Se vuoi un "fake" load more lato JS, si può aggiungere in un secondo momento.
					?>
				</div>
			</div>
		</div>
	</div>
</div>
