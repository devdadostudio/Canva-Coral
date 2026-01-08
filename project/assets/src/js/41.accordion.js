(function ($) {

	var allPanels = $('._accordion');
	var allNotActivePanels = $('._accordion:not(._active)');

	$(allNotActivePanels).each(function () {
		$(this).find('._accordion-content').slideUp();
	});

	$(allPanels).click(function () {

		$this = $(this);

		if ($this.hasClass('_active')) {
			if ($this.hasClass('_free-mode')) {
				// do nothing
				$this.removeClass('_active').find('._accordion-content').slideUp();
			}
		} else {
			if ($this.hasClass('_free-mode')) {
				// do nothing
				$this.addClass('_active').find('._accordion-content').slideDown();
			} else {
				allPanels.removeClass('_active').find('._accordion-content').slideUp();
				$this.addClass('_active').find('._accordion-content').slideDown();
			}
		}

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

		}, 600);

		return false;

	});

})(jQuery);
