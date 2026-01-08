<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="caratteristiche-generali" class="_main__section">
	<div class="wp-block-columns border-t border-black py-12">
		<div class="wp-block-column col-span-12">
			<h3 class="mb-12">Caratteristiche generali</h3>
			<?php echo canva_get_template('tabs', ['post_id' => $post_id, 'tab_items' => ['descrizione-generale' => 'Descrizione generale', 'highlights' => 'Highlights', 'descrizione-tecnica' => 'Descrizione tecnica', 'descrizione-funzionamento' => 'Funzionamento', 'galleria-immagini' => 'Galleria Immagini', 'immagini-tecniche' => 'Immagini tecniche']]); ?>
		</div>
	</div>

</div>
