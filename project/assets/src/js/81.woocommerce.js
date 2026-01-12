/**
 * funzione per popolare con dati il carrello per la modale
 */
 function wooc_cart_ajax(new_modal = true, modal_position, template_name) {
	// let ajaxUrl = WPURLS.ajaxurl;
	// console.log(ajaxUrl);

	$.ajax({
		url: WPURLS.ajaxurl + '?action=canva_wooc_cart_ajax',

		beforeSend: function (response) {
			if (!new_modal) {

				// set _overlay-modal off
				element_is_off('._overlay-modal');

				// deactivate state ._is-on far all menu items
				element_is_off('.menu>li.menu-item-icon');

				setTimeout(() => {
					// empty before appending the new content
					$('._overlay-modal ._modal-content-append').empty();

					// empty before appending the new content
					$('._modal-cart-ajax').empty();

					// empty before appending the new content
					$('._modal-post-opener-ajax').empty();

					// remove modal type css classes
					// $('._overlay-modal').removeClass('_modal-contact _modal-search _modal-opener _modal-wooc-cart _modal-post-opener-left _modal-post-opener ' + template_name);
					$('._overlay-modal').removeClass().addClass('_overlay-modal');

					// add current modal type css class
					$('._overlay-modal').addClass('_modal-wooc-cart ' + template_name);

					// show cart content it
					$('._overlay-modal ._modal-cart-ajax').removeClass('hidden');

				}, 300);

			} else {

				// set body overflow off
				body_overflow_off();

				// set _overlay-modal off
				element_is_off('._overlay-modal');

				// empty before appending the new content
				$('._overlay-modal ._modal-content-append').empty();

				// empty before appending the new content
				$('._modal-cart-ajax').empty();

				// empty before appending the new content
				$('._modal-post-opener-ajax').empty();

				// modal position setup
				if (modal_position === 'below-the-top') {
					// set z-index overlays
					$('._overlay-modal').addClass('below-the-top');
					$('._overlay-loader').addClass('below-the-top');
					$('._overlay-filter').addClass('below-the-top');
				}

				// open overlay loader
				open_modal('._overlay-loader', 'ani-fade-in', 150);
				// open overlay filter
				open_modal('._overlay-filter', 'ani-fade-in', 150);

				// remove modal type css classes
				// $('._overlay-modal').removeClass('_modal-contact _modal-search _modal-opener _modal-wooc-cart _modal-post-opener ' + template_name);
				$('._overlay-modal').removeClass().addClass('_overlay-modal');

				// add current modal type css class
				$('._overlay-modal').addClass('_modal-wooc-cart ' + template_name);

				$('._overlay-modal').removeClass('hidden');

				// show cart content it
				$('._overlay-modal ._modal-cart-ajax').removeClass('hidden');
			}
		},

		complete: function (response) {

			// open overlay loader
			close_modal('._overlay-loader', 'ani-fade-out', 150);

			// empty before appending the new content
			element_is_on('._overlay-modal');

			// show cart content it
			// $('._overlay-modal ._modal-post-opener-ajax').removeClass('hidden');

			setTimeout(() => {
				// b-lazy reload
				let bLazy = new Blazy();
				bLazy.revalidate();

				// CF7 reload
				document.querySelectorAll(".wpcf7 > form").forEach((
					function (e) {
						return wpcf7.init(e);
					}
				));
			}, 300);
		},
	})
		.done(function (content) {
			$('._modal-cart-ajax').append(content);
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			// Azioni da eseguire in caso di errore chiamata. Definire con MT output html e css
			console.log('errore cart not loading');
		});
}


/**
 * Funzione per popolare con dati l'apertura di un post in modale
 *
 * @author Toni Guga
 * @param {*} id
 * @param {*} template_name
 */
function modal_post_ajax(id, template_name, modal_position) {

	$.ajax({
		url: WPURLS.ajaxurl + '?action=canva_modal_post_opener&id=' + id + '&template=' + template_name,

		beforeSend: function (response) {
			// set body overflow off
			body_overflow_off();

			// set _overlay-modal off
			element_is_off('._overlay-modal');

			// empty before appending the new content
			$('._overlay-modal ._modal-content-append').empty();

			// empty before appending the new content
			$('._modal-cart-ajax').empty();

			// empty before appending the new content
			$('._modal-post-opener-ajax').empty();

			// modal position setup
			if (modal_position === 'below-the-top') {
				// set z-index overlays
				$('._overlay-modal').addClass('below-the-top');
				$('._overlay-loader').addClass('below-the-top');
				$('._overlay-filter').addClass('below-the-top');
			}

			// open overlay loader
			open_modal('._overlay-loader', 'ani-fade-in', 150);
			// open overlay filter
			open_modal('._overlay-filter', 'ani-fade-in', 150);


			// remove modal type css classes
			$('._overlay-modal').removeClass().addClass('_overlay-modal');

			// add current modal type css class
			$('._overlay-modal').addClass('_modal-post-opener ' + template_name);

			$('._overlay-modal').removeClass('hidden');

			// show cart content it
			$('._overlay-modal ._modal-post-opener-ajax').removeClass('hidden');
		},

		complete: function (response) {
			// open overlay loader
			close_modal('._overlay-loader', 'ani-fade-out', 150);

			// empty before appending the new content
			element_is_on('._overlay-modal');

			// deactivate state ._is-on far all menu items
			// element_is_off('.menu>li.menu-item-icon');

			// show cart content it
			// $('._overlay-modal ._modal-post-opener-ajax').removeClass('hidden');

			setTimeout(() => {
				// b-lazy reload
				let bLazy = new Blazy();
				bLazy.revalidate();

				// CF7 reload
				document.querySelectorAll(".wpcf7 > form").forEach((
					function (e) {
						return wpcf7.init(e);
					}
				));
			}, 300);
		},
	})
		.done(function (content) {
			$('._modal-post-opener-ajax').append(content);
		})
		.fail(function (jqXHR, textStatus, errorThrown) {
			// Azioni da eseguire in caso di errore chiamata. Definire con MT output html e css
			console.log('error not loading');
		});
}

(function ($) {

	/**
	 * Wooc Modal Cart - Open
	 * mostra carrello aggiornato dopo la rimozione del prodotto
	 */
	$(document).ready(function () {

		let removeItem = searchUrlParams('removed_item');
		// console.log(removeItem);

		if (removeItem) {
			show_modal_cart_ajax();
		}

	});


	/**
	 * Wooc Modal Cart - Close
	 * chiude carrello in modale
	 */
	// $(document).on('click', '._close-wooc-modal-cart, ._overlay', function (event) {
	// 	event.preventDefault();

	// 	close_modal('._wooc-modal-cart._modal-wrap', 'slide-out-to-r', 300);

	// 	setTimeout(function () {
	// 		close_modal('._overlay-filter._is-on', 'ani-fade-out', 300);
	// 	}, 150);

	// 	setTimeout(() => {
	// 		$('._modal-wooc-cart-container').empty();
	// 	}, 350);

	// });


	/**
	 * Wooc Modal Cart
	 * Ajax delete product in the cart
	 */
	$(document).on('click', '._cart-item a.remove', function (event) {
		event.preventDefault();

		let ajaxUrl = WPURLS.ajaxurl;

		$(this).parentsUntil('._cart-item').parent().fadeOut(150);

		setTimeout(() => {
			$(this).parentsUntil('._cart-item').parent().remove();
		}, 150);

		setTimeout(() => {
			$.ajax(ajaxUrl + '?action=canva_wooc_ajax_update_modal_cart_fragment')
				.done(function (content) {
					// $('._product-gallery-content').fadeOut();
					// $('._loading').fadeIn();

					$('._cart-sub-totals').animate({ opacity: 0 }, 150);
					setTimeout(() => {
						$('._cart-sub-totals').empty();
						$('._cart-sub-totals').append(content);
						$('._cart-sub-totals').animate({ opacity: 1 }, 150);
					}, 150);
				})
				.fail(function (jqXHR, textStatus, errorThrown) {
					// Azioni da eseguire in caso di errore chiamata. Definire con MT output html e css
					console.log('errore cart not loading');
				});
		}, 300);

	});



	/**
	* AJAX Add To Cart
	* code from Ajax add to cart per WooCommerce Plugin
	* https://it.wordpress.org/plugins/woo-ajax-add-to-cart/
	*/

	$.fn.serializeArrayAll = function () {
		var rCRLF = /\r?\n/g;
		return this.map(function () {
			return this.elements ? jQuery.makeArray(this.elements) : this;
		}).map(function (i, elem) {
			var val = jQuery(this).val();
			if (val == null) {
				return val == null
				//next 2 lines of code look if it is a checkbox and set the value to blank
				//if it is unchecked
			} else if (this.type == "checkbox" && this.checked === false) {
				return { name: this.name, value: this.checked ? this.value : '' }
				//next lines are kept from default jQuery implementation and
				//default to all checkboxes = on
			} else {
				return jQuery.isArray(val) ?
					jQuery.map(val, function (val, i) {
						return { name: elem.name, value: val.replace(rCRLF, "\r\n") };
					}) :
					{ name: elem.name, value: val.replace(rCRLF, "\r\n") };
			}
		}).get();
	};


	$(document).on('click', '.single_add_to_cart_button:not(.disabled)', function (e) {
		e.preventDefault();

		var $thisbutton = $(this),
			$form = $thisbutton.closest('form.cart'),
			//quantity = $form.find('input[name=quantity]').val() || 1,
			//product_id = $form.find('input[name=variation_id]').val() || $thisbutton.val(),
			data = $form.find('input:not([name="product_id"]), select, button, textarea').serializeArrayAll() || 0;
		// console.log($form);

		$.each(data, function (i, item) {
			if (item.name == 'add-to-cart') {
				item.name = 'product_id';
				item.value = $form.find('input[name=variation_id]').val() || $thisbutton.val();
			}
		});

		$(document.body).trigger('adding_to_cart', [$thisbutton, data]);

		$.ajax({
			type: 'POST',
			url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
			data: data,
			beforeSend: function (response) {
				$thisbutton.removeClass('added').addClass('loading');
			},
			complete: function (response) {
				$thisbutton.addClass('added').removeClass('loading');
			},
			success: function (response) {
				if (response.error && response.product_url) {
					window.location = response.product_url;
					return;
				}

				$(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
				// $('.added_to_cart').addClass('block text-center button mt-2 md:mt-0 md:ml-2');
				$('.added_to_cart').addClass('block text-center mt-2');

				// animazione scambio icona
				$thisbutton.find('._shopping-cart-icon').animate({ opacity: 0 }, 150);
				$thisbutton.find('._add-to-cart-text').fadeOut();

				setTimeout(() => {
					$thisbutton.find('._check-icon').animate({ opacity: 1 }, 150);
					$thisbutton.find('._added-to-cart-text').fadeIn();
				}, 300);

				setTimeout(() => {
					$thisbutton.find('._check-icon').animate({ opacity: 0 }, 150);
					$thisbutton.find('._added-to-cart-text').fadeOut();
				}, 1200);

				setTimeout(() => {
					$thisbutton.find('._shopping-cart-icon').animate({ opacity: 1 }, 150);
					$thisbutton.find('._add-to-cart-text').fadeIn();
				}, 1600);

				// animazione rimozione scritta visualizza il carrello
				setTimeout(() => {
					$('.added_to_cart').fadeOut();
				}, 8000);

				setTimeout(() => {
					$('.added_to_cart').remove();
				}, 8150);
			},
		});

		return false;

	});

})(jQuery);
