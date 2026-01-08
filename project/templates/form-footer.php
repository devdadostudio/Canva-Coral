<?php
if (!$post_id) {
	$post_id = get_the_ID();
}
?>

<div id="cta-footer" class="_main__section bg-gray-100">
	<div class="wp-block-columns">
		<div class="wp-block-column col-span-12">
			<div class="text-center mb-8">
				<h3>Hai bisogno di aiuto?</h3>
				<p>Vuoi sapere quale prodotto è il piu indicato al tuo settore industriale ma non sai quale scegliere? Contattaci.</p>
			</div>
			<div class="max-w-screen-md mx-auto">
				<?php echo do_shortcode('[contact-form-7 id="3252" title="Form Contattaci"]'); ?>
			</div>
		</div>
	</div>
</div>
