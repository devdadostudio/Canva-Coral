<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Apre in modale la ricerca del sito
 *
 * !!!! ATTENZIONE !!!!
 *
 * Non modificare mai le seguenti classi:
 *
 * _modal-search-data
 * hidden
 *
 * perchè servono al JS per le manipolazioni legate alle modali overlay
 */
?>

<div class="_modal-search-data hidden">

	<div class="text-center">

		<span class="block h3 mb-8">
			Cerca nel sito
		</span>

		<form role="search" method="get" class="flex flex-wrap group" action="<?php echo esc_url(home_url('/search/')); ?>">
			<input type="search" class="search-input group-hover:shadow-md" placeholder="Cerca qualcosa qui" value="<?php echo get_search_query(); ?>" name="_regular_search" title="cerca" autofocus>
			<button class="search-button button group-hover:shadow-md" type="submit" value="Cerca">Cerca</button>
		</form>

	</div>

</div>
