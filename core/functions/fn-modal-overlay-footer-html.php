<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// non modificare mai le seguenti classi perchè servono per far funzionare l'interattività sviluppata con jquery
// _modal-link (serve a jquery per aprire e chiudere la modale dopo il click)
// _modal-content-append (serve a jquery per inserire il contenuto della modale)

//esempio del codice html per aprire la modale contiene anche il contenuto

/**
 * <!-- Pulsante o Link per aprire la Modale -->
 * <button class="_modal-open cursor-pointer" data-modal-content="promo-modal-content"><strong><a>Apri modale.</a></strong></button>
 * <!-- Pulsante o Link per aprire la Modale -->
 *
 * <!-- Contenuto della Modale -->
 * <div class="promo-modal-content hidden">
 * Contenuto html da mostrare nella modale
 * </div>
 * <!-- Contenuto della Modale -->
 *
 * Spiegazione!!!
 *
 * Per funzionare il valore del data attribute data-modal-content="" deve essere identico alla classe
 * del div nascosto con la classe hide. E possibile insere più modali nella stessa pagina cambiando per
 * ogni modale il valore e la classe spiegata prima.
 *
 * @function js modal_link_open(); in 40.modals.esc_js($text:string )
 *
 * !!!! ATTENZIONE !!!!
 *
 * Non modificare mai le seguenti classi:
 *
 * _overlay-modal
 * 	_layer-modal-close
 * 	_modal-close
 * 	_modal-dialog-container
 * 		_modal-post-opener-ajax
 * 		_ajax-modal
 * 		_overlay-loader
 * 		_overlay-filter
 * 		hidden
 *
 * perchè servono al JS per le manipolazioni legate alle modali overlay
 */
?>

<div class="_overlay-modal hidden">

	<div class="_layer-modal-close _modal-close"></div>

	<div class="_modal-dialog-container">

		<a class="_x-button _modal-close absolute top-2 right-2" aria-label="<?php _e('close modal','canva-frontend'); ?>"></a>

		<div class="_modal-content-append">
			<?php /* jQuery appends here the modal content */ ?>
		</div>

		<?php
		// stampa codice html del carrello ajax per la modale overlay - template fn-modal-wooc-cart-ajax-footer-html.php
		do_action('modal_wooc_cart_ajax');
		?>

		<?php
		// div per ajax di modal post opener
		?>
		<div class="_modal-post-opener-ajax _ajax-modal hidden"></div>

		<?php
		// stampa codice html per il form CF7 per la modale overlay - template fn-modal-search-footer-html.php
		do_action('modal_contact_data');

		// stampa codice html per il form di ricerca per la modale overlay - template fn-modal-contact-footer-html.php
		do_action('modal_search_data');
		?>

		<?php
		// div per messaggio invio modulo CF7
		?>

		<div class="_modal-content-msg w-full hidden flex">
			<?php _e('Grazie il tuo messaggio è stato inviato.', 'canva-frontend'); ?>
		</div>

	</div>

	</div>

</div>

<div class="_overlay-loader hidden"></div>

<div class="_overlay-filter hidden"> </div>
