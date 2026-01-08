<?php
if (!$post_id) {
	$post_id = get_the_ID();
}

$post_title = get_the_title($post_id);

// Recupera il primo termine della tassonomia personalizzata 'categoria'
$terms = get_the_terms($post_id, 'categoria');
$categoria = (!empty($terms) && !is_wp_error($terms)) ? $terms[0]->name : 'prodotti';
?>

<div id="cta-footer" class="_main__section bg-gray-200 py-16">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12">
			<div class="text-center mb-8">
				<h3>Hai bisogno di informazioni su <?php echo esc_html($post_title); ?>?</h3>
				<p>Scrivici per sapere quali <?php echo esc_html(strtolower($categoria)); ?> della linea <?php echo esc_html($famiglia); ?> si adattano meglio alle tue esigenze.</p>
			</div>
			<div class="max-w-screen-md mx-auto">
				<?php echo do_shortcode('[contact-form-7 id="2560" title="Form Prodotto"]'); ?>
			</div>
		</div>
	</div>
</div>
