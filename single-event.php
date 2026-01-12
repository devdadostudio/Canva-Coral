<?php
get_header();
?>

<div class="flex flex-col px-16 py-8">
	<?php echo canva_get_template('card-event-lg', get_the_ID()); ?>
</div>

<?php
get_footer();
