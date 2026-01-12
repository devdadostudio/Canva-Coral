<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="caratteristiche-generali" class="_main__section py-12">
	<?php echo canva_get_template('tabs', ['post_id' => $post_id, 'tab_items' => ['highlights' => 'Highlights', 'descrizione-tecnica' => 'Descrizione tecnica', 'descrizione-funzionamento' => 'Funzionamento', 'galleria-immagini' => 'Gallery']]); ?>
</div>
