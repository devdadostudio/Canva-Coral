<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Apre in modale il modulo CF7 impostato nei theme settings
 *
 * !!!! ATTENZIONE !!!!
 *
 * Non modificare mai le seguenti classi:
 *
 * _modal-contact-data
 * hidden
 *
 * perchè servono al JS per le manipolazioni legate alle modali overlay
 */
?>


<div class="_modal-contact-data hidden">

	<div class="text-center">

		<span class="block h3 mb-8">
			<?php _e('Contact us', 'canva-frontend'); ?>
		</span>

		<?php echo do_shortcode(get_field('modal_contact_form', 'options')); ?>

	</div>

</div>
