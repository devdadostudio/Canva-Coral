<?php

/**
 * The template for displaying the footer.
 *
 * @since Canva 1.0.0
 */
?>

<?php do_action('canva_container_end'); ?>

</main><!-- end container -->

<footer>

	<?php do_action('canva_footer_start'); ?>

	<?php do_action('canva_footer_end'); ?>

</footer>

<?php do_action('canva_body_end'); ?>

<?php wp_footer(); ?>

<!-- utile per calcolare la largezza di una colonna di un grid row -->
<div class="_main-section py-0">
	<div class="wp-block-columns">
		<div class="_grid-1fr wp-block-column col-span-1"></div>
	</div>
</div>

</body>

</html>
