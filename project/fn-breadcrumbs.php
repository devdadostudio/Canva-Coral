<?php

/**
 * Funzione per personalizzare il breadcrumbs di Yoast
 *
 * @param [type] $links
 * @return void
 */
function canva_custom_breadcrumbs($links)
{
	global $post;
	$post_id = $post->ID;

	// var_dump($links);

	if (is_singular('post')) {
		$wpml_permalink = get_permalink(get_page_by_path('news-coral'));

		$breadcrumbs = [
			'url' => $wpml_permalink,
			'text' => __('News', 'canva-coral'),
		];

		array_unshift($links, $breadcrumbs);
		// array_splice($links, 2, 2, $breadcrumbs);
	}

	if (is_singular('macrofamiglia')) {
		$prodotti_permalink = get_permalink(get_page_by_path('prodotti'));

		$breadcrumbs = [
			'url' => $prodotti_permalink,
			'text' => __('Prodotti', 'canva-coral'),
		];

		array_unshift($links, $breadcrumbs);
		// array_splice($links, 2, 2, $breadcrumbs);
	}

	if (is_singular('famiglia')) {
		$prodotti_permalink = get_permalink(get_page_by_path('prodotti'));
		$macrofamiglia_permalink = get_permalink(get_field('macro_famiglia', $post_id));
		$macrofamiglia_title = ucfirst(strtolower(get_the_title(get_field('macro_famiglia', $post_id))));

		$breadcrumbs_parent = [
			'url' => $prodotti_permalink,
			'text' => 'Prodotti'
		];
		$breadcrumbs = [
			'url' => $macrofamiglia_permalink,
			'text' => $macrofamiglia_title
		];

		array_unshift($links, $breadcrumbs_parent, $breadcrumbs);
		// array_splice($links, 2, 2, $breadcrumbs);
	}

	if (is_singular('prodotto')) {
		$prodotti_permalink = get_permalink(get_page_by_path('prodotti'));
		$macrofamiglia_permalink = get_permalink(get_field('macro_famiglia', $post_id));
		$macrofamiglia_title = ucfirst(strtolower(get_the_title(get_field('macro_famiglia', $post_id))));
		$famiglia_permalink = get_permalink(get_field('famiglia', $post_id));
		$famiglia_title = ucfirst(strtolower(get_the_title(get_field('famiglia', $post_id))));

		$breadcrumbs_grandparent = [
			'url' => $prodotti_permalink,
			'text' => 'Prodotti'
		];
		$breadcrumbs_parent = [
			'url' => $macrofamiglia_permalink,
			'text' => $macrofamiglia_title
		];
		$breadcrumbs = [
			'url' => $famiglia_permalink,
			'text' => $famiglia_title
		];

		array_unshift($links, $breadcrumbs_grandparent, $breadcrumbs_parent, $breadcrumbs);
		// array_splice($links, 2, 2, $breadcrumbs);
	}

	$home_page = [
		'url' => home_url(),
		'text' => 'Home',
	];

	array_unshift($links, $home_page);

	return $links;
}
add_filter('wpseo_breadcrumb_links', 'canva_custom_breadcrumbs');



function ss_breadcrumb_single_link($link_output, $link)
{
	$element = '';
	$element = esc_attr(apply_filters('wpseo_breadcrumb_single_link_wrapper', $element));
	$link_output =  $element;

	if (isset($link['url'])) {
		$link_output .= '<a rel="nofollow" href="' .

		esc_url($link['url']) . '" class="_no-translate">' .

		esc_html($link['text']) . '</a>';
	}

	return $link_output;
}
// add_filter('wpseo_breadcrumb_single_link', 'ss_breadcrumb_single_link', 10, 2);
