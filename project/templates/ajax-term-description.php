<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<div class="py-16">
	<?php if(!empty($term_id)) : ?>
		<h2 class="fw-400">
			<?php echo canva_get_term_name($term_id); ?>
		</h2>
		<div class="flex flex-col items-start gap-4">
			<a href="<?php echo esc_url(get_term_link($term_id)); ?>" class="button fs-xs">Scopri <?php echo strtolower(canva_get_term_name($term_id)); ?></a>
			<a href="#cta-footer" class="button hollow fs-xs">Richiedi informazioni</a>
		</div>
	<?php else : ?>
		<h2 class="fw-400">
			Esplora i prodotti Coral
		</h2>
		<div class="flex flex-col items-start gap-4">
			<a href="#cta-footer" class="button hollow fs-xs">Richiedi informazioni</a>
		</div>
	<?php endif; ?>
</div>
