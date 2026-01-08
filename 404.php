<?php
get_header();

if (get_field('page_404_cb', 'options')) {
	canva_render_blocks(get_field('page_404_cb', 'options'));
} else {

?>

	<div class="_main__section ">
		<div class="wp-block-columns">
			<div class="wp-block-column col-span-12 md:col-span-8">
				<div class="text-center">
					<h1>Pagina non trovata</h1>
					<p>404</p>
				</div>
			</div>
		</div>

	<?php
}

get_footer();
