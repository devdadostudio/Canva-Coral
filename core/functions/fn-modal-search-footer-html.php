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
			<?php _e('Search in the website', 'canva-frontend'); ?>
		</span>

		<form role="search" method="get" class="flex flex-wrap group" action="<?php echo esc_url(home_url('/search/')); ?>">

			<input type="search" class="search-input group-hover:shadow-md" placeholder="<?php _e('Search something here...', 'canva-frontend'); ?>" value="<?php echo get_search_query(); ?>" name="_regular_search" title="<?php echo _e('Search', 'canva-frontend'); ?>" autofocus>

			<button class="search-button button group-hover:shadow-md" type="submit" value="<?php echo _e('Search', 'canva-frontend'); ?>"><?php echo _e('Search', 'canva-frontend'); ?></button>

		</form>

	</div>

</div>
