<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

if (!$post_id) {
	$post_id = get_the_ID();
}

$original_lang = weglot_get_original_language();
$destination_langs = weglot_get_destination_languages();
$current_lang = weglot_get_current_language();
$current_full_url = weglot_get_current_full_url();
$browser_lang = get_browser_lang();

$site_langs = [$original_lang];

foreach ($destination_langs as $dl) {
	$site_langs[] = $dl['language_to'];
}
?>

<?php if ($current_lang != $browser_lang) : ?>

	<div id="lang_switcher" class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 text-center py-2 border-gray-400" style="border-bottom: solid 1px;">

		<?php if (in_array($browser_lang, $site_langs)) : ?>

			<div class="_text <?php echo $browser_lang; ?>" data-wg-notranslate="">

				<?php if ($browser_lang == 'it') : ?>
					<p class="mb-0 fs-xs"><strong>Parli Italiano?</strong> Clicca su continua per passare alla versione <strong>italiana</strong> del sito.</p>
				<?php elseif ($browser_lang == 'en') : ?>
					<p class="mb-0 fs-xs"><strong>Do you speak English?</strong> Click on continue to go to the <strong>English</strong> version of the site.</p>
				<?php elseif ($browser_lang == 'de') : ?>
					<p class="mb-0 fs-xs"><strong>Sprichst du Deutsch?</strong> Klicken Sie auf Weiter, um zur <strong>deutschen</strong> Version der Seite zu wechseln.</p>
				<?php elseif ($browser_lang == 'fr') : ?>
					<p class="mb-0 fs-xs"><strong>Tu parles français?</strong> Cliquez sur continuer pour accéder à la version <strong>française</strong> du site.</p>
				<?php elseif ($browser_lang == 'es') : ?>
					<p class="mb-0 fs-xs"><strong>¿Tú hablas español?</strong> Haga clic en continuar para cambiar a la versión en <strong>español</strong> del sitio.</p>
				<?php endif; ?>

			</div>

			<div class="_text" data-wg-notranslate="">
				<?php if ($browser_lang === 'it') : ?>
					<a class="button fs-xs px-4 py-1" data-wg-notranslate="" href="https://www.coral.eu/">
						Continua
					</a>
				<?php elseif ($browser_lang == 'en') : ?>
					<a class="button fs-xs px-4 py-1" data-wg-notranslate="" href="https://www.coral.eu/<?php echo $browser_lang; ?>/">
						Continue
					</a>
				<?php elseif ($browser_lang == 'de') : ?>
					<a class="button fs-xs px-4 py-1" data-wg-notranslate="" href="https://www.coral.eu/<?php echo $browser_lang; ?>/">
						Fortsetzen
					</a>
				<?php elseif ($browser_lang == 'fr') : ?>
					<a class="button fs-xs px-4 py-1" data-wg-notranslate="" href="https://www.coral.eu/<?php echo $browser_lang; ?>/">
						Continuez
					</a>
				<?php elseif ($browser_lang == 'es') : ?>
					<a class="button fs-xs px-4 py-1" data-wg-notranslate="" href="https://www.coral.eu/<?php echo $browser_lang; ?>/">
						Continuar
					</a>
				<?php endif; ?>
			</div>

		<?php else : ?>



		<?php endif; ?>

	</div>

<?php endif; ?>
