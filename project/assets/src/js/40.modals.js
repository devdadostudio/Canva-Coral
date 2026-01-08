/**
 * tooltip
 */
(function ($) {
	$(document).on('click', '.tooltip', function () {
		$('.tooltiptext').toggleClass('visibility');
	});
})(jQuery);


//Helper Functions

/**
 * Funzione per la apertura delle modali
 * @author Toni Guga
 * @param {*} selector
 * @param {*} add_animation_in
 * @param {*} delay_clean_animation_in
 */
function open_modal(selector, add_animation_in, delay_clean_animation_in = 300) {
	$(selector).removeClass('hidden').addClass('_is-on ' + add_animation_in);

	setTimeout(function () {
		$(selector + '._is-on').removeClass(add_animation_in);
	}, delay_clean_animation_in);
}

/**
 * Funzione per la chiusura delle modali
 * @author Toni Guga
 * @param {*} selector
 * @param {*} add_animation_out
 * @param {*} delay_hidden
 */
function close_modal(selector, add_animation_out, delay_hidden = 300) {
	$(selector).addClass(add_animation_out);

	setTimeout(function () {
		$(selector).addClass('hidden');
		$(selector).removeClass(add_animation_out);
		$(selector).removeClass('_is-on');
	}, delay_hidden);
}

/**
 * Funzione per la chiusura delle modali
 * @author Toni Guga
 * @param {*} selector
 * @param {*} add_animation_out
 * @param {*} delay_hidden
 */
function close_all_modals(delay = 450) {

	element_is_off('._modal-open');
	element_is_off('._overlay-modal');
	element_is_off('._overlay-offc');

	setTimeout(() => {

		// remove modal type & position css classes
		$('._overlay-modal').removeClass().addClass('_overlay-modal');
		$('._overlay-loader').removeClass('below-the-top');
		$('._overlay-filter').removeClass('below-the-top');
		$('._overlay-offc').removeClass('below-the-top');

		// hide visible ajax modal
		$('._overlay-modal:not(hidden)').addClass('hidden');
		$('._ajax-modal:not(hidden)').addClass('hidden');
		$('._overlay-offc:not(hidden)').addClass('hidden');

		// empty before appending the new content
		$('._overlay-modal ._modal-content-append').empty();

		// empty before appending the new content
		$('._modal-cart-ajax').empty();

		// empty before appending the new content
		$('._modal-post-opener-ajax').empty();

		// set body overflow on
		body_overflow_on();

		// deactivate state ._is-on far all menu items
		element_is_off('.menu>li.menu-item-icon');
		element_is_off('._overlay-loader');
		element_is_off('._overlay-filter');

		$('._overlay-loader:not(hidden)').addClass('hidden');
		$('._overlay-filter:not(hidden)').addClass('hidden');
	}, delay);

}



/**
 * Overlay Modal Opener
 *
 * Struttura link per il modal opener (modale statica senza ajax):
 *
 * <a class="_modal-open"
 * data-modal-content="_nome_classe_contenitore_modale " // Obbligatorio
 * data-modal-type="_modal-opener" // Obbligatorio
 * data-modal-position="above-the-top" // Facoltativo default below-the-top
 * href="url pagina"></a>
 *
 * Posizione modale:
 *
 * data-modal-position="above-the-top" apre modale in sovra impressione a tutto il sito
 * data-modal-position="_below-the-top" apre modale sotto il menu
 *
 *
 * Struttura link per il modal post opener (modale dinamica con ajax):
 *
 * <a class="_modal-open"
 * data-modal-content="_modal-post-opener-ajax" // Obbligatorio
 * data-post-id="4594" // Obbligatorio
 * data-template-name="modal-post-opener" // Facoltativo serve se cambia il template php
 * data-modal-type="_modal-post-opener" // Obbligatorio
 * data-modal-position="above-the-top" // Facoltativo default below-the-top
 * href="url pagina"></a>
 *
 * Posizione modale:
 *
 * data-modal-position="above-the-top" apre modale in sovra impressione a tutto il sito
 * data-modal-position="_below-the-top" apre modale sotto il menu
 * @template
 */
(function ($) {

	// apre modale quando viene cliccato il pulsante o il link con la classe modal-open
	$(document).on('click', '._modal-open:not(._is-on)', function (event) {

		event.preventDefault();

		// vars
		let id = $(this).attr('data-post-id');
		let template_name = $(this).attr('data-template-name');
		let modal_content_class = $(this).data('modal-content');
		let modal_type = $(this).data('modal-type');
		let modal_position = $(this).data('modal-position');

		// console.log(modal_type);

		// set a default template name
		if (!template_name) {
			template_name = 'modal-post-opener';
		}

		// set a default modal type class
		if (!modal_type) {
			modal_type = '_modal-opener';
		}

		if ($('._overlay-modal').hasClass('_is-on')) {

			// set _overlay-modal off
			element_is_off('._overlay-modal');

			if (modal_content_class === '_modal-cart-ajax') {

				// Modal Woocommerce Cart
				wooc_cart_ajax(false, modal_position, template_name);

			} else if (modal_content_class === '_modal-post-opener-ajax') {

				// Modal Post Opener
				modal_post_ajax(id, template_name, modal_position, template_name);

				// console.log('_modal-post-opener-ajax_is_on');

			} else {
				// Clone modal content
				let modal_content = $('.' + modal_content_class).clone();

				setTimeout(() => {
					// empty before appending the new content
					$('._overlay-modal ._modal-content-append').empty();

					// empty before appending the new content
					$('._ajax-modal').empty();

					// empty before appending the new content
					$('._modal-post-opener-ajax').empty();

					// hide visible ajax modal
					$('._ajax-modal:not(hidden)').addClass('hidden');

					// paste new content and show it
					$('._overlay-modal ._modal-content-append').append(modal_content);
					$('._overlay-modal ._modal-content-append .' + template_name).removeClass('hidden');

					// remove modal type css classes
					$('._overlay-modal').removeClass().addClass('_overlay-modal');

					// add current modal type css class
					$('._overlay-modal').addClass(modal_type + ' ' + template_name);
				}, 300);

				setTimeout(() => {
					// empty before appending the new content
					element_is_on('._overlay-modal');

					// deactivate state ._is-on far all menu items
					element_is_off('.menu>li.menu-item-icon');
				}, 600);

			}

		} else {

			if (modal_content_class === '_modal-cart-ajax') {

				// Modal Woocommerce Cart
				wooc_cart_ajax(true, modal_position, template_name);

			} else if (modal_content_class === '_modal-post-opener-ajax') {

				// Modal Post Opener
				modal_post_ajax(id, template_name, modal_position);
				// console.log('_modal-post-opener-ajax_not_is_on');

			} else {
				// set body overflow off
				body_overflow_off();

				// modal close set is on
				element_is_on('._modal-close');

				// open overlay loader
				open_modal('._overlay-loader', 'ani-fade-in', 150);
				// open overlay filter
				open_modal('._overlay-filter', 'ani-fade-in', 150);

				// remove modal type css classes
				$('._overlay-modal').removeClass().addClass('_overlay-modal');

				// add current modal type css class
				$('._overlay-modal').addClass(modal_type);
				// show the overlay modal
				$('._overlay-modal').removeClass('hidden');

				setTimeout(() => {
					// set _overlay-modal to _is-on
					element_is_on('._overlay-modal');

					// empty before appending the new content
					$('._overlay-modal ._modal-content-append').empty();

					// empty before appending the new content
					$('._modal-cart-ajax').empty();

					// empty before appending the new content
					$('._modal-post-opener-ajax').empty();
				}, 300);

				// modal position setup
				if (modal_position === 'below-the-top') {
					// set z-index overlays
					$('._overlay-modal').addClass('below-the-top');
					$('._overlay-loader').addClass('below-the-top');
					$('._overlay-filter').addClass('below-the-top');
				}

				// Modal Everythink Else
				let modal_content = $('.' + modal_content_class).clone();
				setTimeout(() => {
					// empty before appending the new content
					$('._overlay-modal ._modal-content-append').empty();

					// empty before appending the new content
					$('._modal-cart-ajax').empty();

					// empty before appending the new content
					$('._modal-post-opener-ajax').empty();

					$('._overlay-modal ._modal-content-append').append(modal_content);
					$('._overlay-modal ._modal-content-append .' + template_name).removeClass('hidden');
				}, 300);

			}

		}

		setTimeout(() => {
			// activate state ._is-on for this
			$(this).addClass("_is-on");

			// b-lazy reload
			let bLazy = new Blazy();
			bLazy.revalidate();

			// CF7 reload
			document.querySelectorAll(".wpcf7 > form").forEach((
				function (e) {
					return wpcf7.init(e);
				}
			));
		}, 900);

		setTimeout(function () {
			document.addEventListener('wpcf7mailsent', function (event) {
				// Prende id dei moduli cf7 e controlla se sono stati inviati
				$.each(canvaCf7Ids, function (index, value) {
					if (value == event.detail.contactFormId) {
						// alert("Messaggio inviato!");
						$('._overlay-modal ._modal-content-append').addClass("ani-fade-out");

						setTimeout(function () {
							$('._overlay-modal ._modal-content-append').addClass("hidden");
						}, 600);
						setTimeout(function () {
							$('._overlay-modal ._modal-content-msg').fadeToggle('slow');
						}, 1200);

						setTimeout(function () {
							$('._overlay-modal ._modal-content-msg').fadeToggle('slow');
						}, 2400);

						setTimeout(function () {
							modalClose(jQuery);
						}, 2800);
					}
				});

			}, false);
		}, 1200);

		// remove duplicated cf7 ajax-loader in modals
		$("._overlay-modal").find(".ajax-loader:not(:first)").remove();

	});


	// Chiusura modal, prima esce prima il _overlay-modal, poi dopo 150ms esce overlay
	$(document).on('click', '._modal-open._is-on', function (event) {
		event.preventDefault();
	});

	//chiude le modali quando clicchi la X
	$(document).on('click', '._modal-close', function (event) {
		event.preventDefault();
		close_all_modals();
	});

	// Chiusura ._overlay-filter._is-on
	$(document).on('click', '._overlay-filter._is-on', function (event) {
		event.preventDefault();
		close_all_modals();
	});

	//chiude le modali con il tasto ESC
	$(document).on('keyup', 'body', function (event) {
		if (event.which === 27) {
			close_all_modals();
		}
	});

})(jQuery);
