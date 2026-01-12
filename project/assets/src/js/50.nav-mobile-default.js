/**
 *
 * canva_off_canvas_menu js
 * apre chiude il menu on canvas del sito
 * from f-site-menu.php
 *
 */


(function ($) {
	//Helper Functions in 01.utilities.js

	/************************************************
	Apri menu off-canvas (desktop o mobile)
	************************************************/

	// in apertura, prima entra overlay, poi dopo 300ms entra menu off-canvas
	$(document).on('click', '.menu-item-icon-hamburger:not(._is-on)', function (event) {

		event.preventDefault();

		// vars
		let modal_position = $(this).data('modal-position');

		// reset all modals
		close_all_modals(0);

		setTimeout(function () {

			// set body overflow off
			body_overflow_off();

			// modal position setup
			if (modal_position === 'below-the-top') {
				// set z-index overlays
				$('._overlay-loader').addClass('below-the-top');
				$('._overlay-filter').addClass('below-the-top');
				$('._overlay-offc').addClass('below-the-top');
			}

			// open overlay loader
			// open_modal('._overlay-loader', 'ani-fade-in', 150);
			// open overlay filter
			open_modal('._overlay-filter', 'ani-fade-in', 150);

			// empty before appending the new content
			$('._overlay-modal ._modal-content-append').empty();

			// empty before appending the new content
			$('._ajax-modal').empty();

			// empty before appending the new content
			$('._modal-post-opener-ajax').empty();

			// hide visible ajax modal
			$('._ajax-modal:not(hidden)').addClass('hidden');

			if (get_vw() > 959) {
				open_modal('._nav-offc-dsk', 'none', 300);
			} else {
				open_modal('._nav-offc-mob', 'none', 300);
			}

			// activate state ._is-on for this
			element_is_on('.menu-item-icon-hamburger');

		}, 450);

	});


	/************************************************
	Chiudi menu off-canvas (desktop o mobile)
	da hamburger
	************************************************/

	// in chiusura, prima esce off-canvas, poi dopo 150ms esce overlay
	$(document).on('click', '.menu-item-icon-hamburger._is-on', function (event) {
		event.preventDefault();
		close_all_modals();
	});


	/************************************************
	Chiudi menu off-canvas (desktop o mobile)
	da off-canvas-overlay - VEDI 40 modals.js riga 52
	************************************************/

	// Chiude off-canvas nel resize della window
	$(window).on('resize', function () {
		if (get_vw() > 959) {
			if ($('.menu-item-icon-hamburger._is-on')[0]) {
				close_all_modals()
			}
		} else {
			if ($('.menu-item-icon-hamburger._is-on')[0]) {
				close_all_modals();
			}
		}
	});

	/**
	 * Gestione submenu On Canvas
	 */

	// Hover Enter 1 Livello
	$(document).on('mouseenter', '._nav-dsk ul:not(.dropdown) > li.menu-item-has-children', function () {
		if ($(this).children('.dropdown')) {
			$(this).children('.dropdown').addClass('ani-fade-in').removeClass('hidden').parent().addClass('_is-on');

			setTimeout(() => {
				$(this).children('.dropdown').removeClass('ani-fade-in');
			}, 300);
		}
	});


	// Hover Leave 1 Livello
	$(document).on('mouseleave', '._nav-dsk ul:not(".dropdown") > li.menu-item-has-children._is-on', function () {
		if ($(this).children('.dropdown')) {
			$(this).find('.dropdown').addClass('ani-fade-out').parent().removeClass('_is-on');

			setTimeout(() => {
				$(this).find('.dropdown').removeClass('ani-fade-out').addClass('hidden');
			}, 300);
		}
	});


	// Click 2 Livello Apertura
	$(document).on('click', '._nav-dsk ul.dropdown > li.menu-item-has-children:not(._is-on)', function (event) {
		event.preventDefault();

		// Chiude eventuali submenu già aperti
		if ($(this).parent().find('._is-on')) {
			$(this).parent().find('._is-on').removeClass('_is-on').children('.dropdown').addClass('hidden');
		}

		// Apre submenu richiesto
		if ($(this).children('.dropdown')) {
			$(this).addClass('_is-on');
			$(this).children('.dropdown').addClass('ani-fade-in').removeClass('hidden');

			setTimeout(() => {
				$(this).parent().children('.dropdown').removeClass('ani-fade-in');
			}, 300);
		}
	});


	// Click 2 Livello Chiusura
	$(document).on('click', '._nav-dsk ul.dropdown > li.menu-item-has-children._is-on > a', function (event) {
		event.preventDefault();

		if ($(this).parent().children('.dropdown')) {
			$(this).parent().children('.dropdown').addClass('ani-fade-out').parent().toggleClass('_is-on');

			setTimeout(() => {
				$(this).parent().removeClass('_is-on').children('.dropdown').addClass('hidden').removeClass('ani-fade-in').removeClass('ani-fade-out');
			}, 300);
		}
	});


	/**
	 * Gestione sottomenu Off Canvas
	 */
	$(document).on('click', '._menu-offc-mob li.menu-item-has-children > a, ._menu-offc-dsk li.menu-item-has-children > a', function (event) {
		event.preventDefault();

		if ($(this).parent().find('.dropdown')) {
			$(this).parent().children('.dropdown').slideToggle().parent().toggleClass('open');
			$(this).parent().children('.dropdown').children('.menu-item-has-children.open').children('.dropdown').slideToggle().parent().toggleClass('open');
		} else {
			$(this).parent().children('.dropdown').slideToggle().parent().toggleClass('open');
		}

	});


})(jQuery);
