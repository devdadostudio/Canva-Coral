<?php
defined('ABSPATH') || exit;


add_filter('facetwp_query_args', function ($query_args, $class) {

	$macro_famiglia_id = url_to_postid($class->http_params['uri']);

	if ('famiglie' === $class->ajax_params['template']) {
		$query_args['post_type'] = 'famiglia';
		// $query_args['orderby'] = 'meta_value';
		$query_args['meta_key'] = 'macro_famiglia';
		// $query_args['meta_value'] = '"' . intval($macro_famiglia_id) . '"';
		$query_args['meta_value'] = intval($macro_famiglia_id);
	}


	return $query_args;
}, 10, 2);



function project_facetwp_results($output, $class)
{
	// echo get_the_ID();
	$GLOBALS['wp_query'] = $class->query;

	if ('macro_famiglie' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {
			echo '<div class="grid grid-cols-1 md:grid-cols-4 gap-y-8 gap-x-4 mb-4">';

			while (have_posts()) {
				the_post();

				canva_get_template('card-macro-famiglia', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}

	if ('famiglie' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {
			echo '<div class="grid grid-cols-1 md:grid-cols-2 xxl:grid-cols-3 gap-y-8 gap-x-4 mb-4">';

			while (have_posts()) {
				the_post();

				canva_get_template('card-famiglia', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}

	if ('case_history_coral' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {
			echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">';

			// echo facetwp_display('facet', 'applicazioni_fselect');
			// echo facetwp_display('facet', 'inquinanti_fselect');

			while (have_posts()) {
				the_post();

				canva_get_template('card-case-history', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}
	if ('case_history_engineering' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {
			echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">';

			// echo facetwp_display('facet', 'applicazioni_fselect');
			// echo facetwp_display('facet', 'inquinanti_fselect');

			while (have_posts()) {
				the_post();

				canva_get_template('card-case-history', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}

	if ('news_coral' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {
			echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">';

			while (have_posts()) {
				the_post();

				canva_get_template('card-news', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}

	if ('news_engineering' === $class->ajax_params['template']) {

		ob_start();

		if (have_posts()) {

			echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-x-4 mb-4">';

			while (have_posts()) {
				the_post();

				canva_get_template('card-news', ['post_id' => get_the_ID()]);
			}

			echo '</div>';

			wp_reset_postdata();
			wp_reset_query();
		}

		$output = ob_get_clean();
	}

	if ('regular_search' === $class->ajax_params['template']) {

		ob_start();

		$keyword = $class->http_params['get']["_regular_search"];

		// Macro Famiglie
		$macrofamiglie_args = array(
			'post_type' => 'macrofamiglia',
			'posts_per_page' => -1,
			'facetwp' => true,
			's' => $keyword,
		);

		$macrofamiglie = new WP_Query($macrofamiglie_args);

		if ($macrofamiglie->have_posts()) {
			echo '<h3 id="macro-famiglie" class="mt-8">Macro famiglie</h3>';
			echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">';

			while ($macrofamiglie->have_posts()) {
				$macrofamiglie->the_post();

				canva_get_template('card-macro-famiglia', ['post_id' => get_the_ID()]);
			}
			echo '</div>';

			wp_reset_postdata($macrofamiglie);
		}

		// Famiglie
		$famiglie_args = array(
			'post_type' => 'famiglia',
			'posts_per_page' => -1,
			'facetwp' => true,
			's' => $keyword,
		);

		$famiglie = new WP_Query($famiglie_args);

		if ($famiglie->have_posts()) {
			echo '<hr class="mt-16"/>';
			echo '<h3 id="famiglie" class="mt-8">Famiglie</h3>';
			echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">';

			while ($famiglie->have_posts()) {
				$famiglie->the_post();

				canva_get_template('card-famiglia', ['post_id' => get_the_ID()]);
			}
			echo '</div>';

			wp_reset_postdata($famiglie);
		}

		// Case history
		$ch_args = array(
			'post_type' => 'case-history',
			'posts_per_page' => -1,
			'facetwp' => true,
			's' => $keyword,
		);

		$ch = new WP_Query($ch_args);

		if ($ch->have_posts()) {
			echo '<hr class="mt-16"/>';
			echo '<h3 id="case-history" class="mt-8">Case history</h3>';
			echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">';

			while ($ch->have_posts()) {
				$ch->the_post();

				canva_get_template('card-case-history', ['post_id' => get_the_ID()]);
			}
			echo '</div>';

			wp_reset_postdata($ch);
		}

		// News
		$news_args = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'facetwp' => true,
			's' => $keyword,
		);

		$news = new WP_Query($news_args);

		if ($news->have_posts()) {
			echo '<hr class="mt-16"/>';
			echo '<h3 id="news" class="mt-8">News</h3>';
			echo '<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 mb-4">';

			while ($news->have_posts()) {
				$news->the_post();

				canva_get_template('card-news', ['post_id' => get_the_ID()]);
			}
			echo '</div>';

			wp_reset_postdata($news);
		}

		$output = ob_get_clean();
	}

	return $output;
}
add_filter('facetwp_template_html', 'project_facetwp_results', 10, 2);
// add_filter('facetwp_facet_dropdown_show_counts', '__return_false'); //nasconde il conteggio dei post

/**
 * modify expand & collapse facets
 */
add_filter('facetwp_assets', function ($assets) {
	FWP()->display->json['expand'] = '<span class="block bg-icon icon-v-d expand w-4 h-4"></span>';
	FWP()->display->json['collapse'] = '<span class="block bg-icon icon-v-u collapse w-4 h-4"></span>';
	return $assets;
});


/**
 * Image as checkboxes buttons in FacetWp "categorie_blog"
 *
 * @param [type] $output
 * @param [type] $params
 * @return $output
 */
add_filter('facetwp_facet_html', function ($output, $params) {

	if ('product_categories' == $params['facet']['name'] || 'news_categories' == $params['facet']['name']) {

		$output = '';
		$values = (array) $params['values'];
		$selected_values = (array) $params['selected_values'];

		if (!empty($values)) {

			if ('product_categories' == $params['facet']['name']) {
				$output .= '<span class="h6 mt-8 mb-4 hide md:block">' . __('Collane', 'canva-addeditore') . '</span>';
			}
		}

		foreach ($values as $result) {
			$border_last = '';
			if (!next($values)) {
				$border_last = 'border-b';
			}

			// dump_to_error_log($params);

			// $term = get_term_by('slug', $result['facet_value'], 'product_cat');

			// $term_img_id = get_term_meta($term->term_id, 'thumbnail_id', true);

			// $term_img_url = canva_get_img([
			// 	'img_id'   =>  $term_img_id,
			// 	'img_type' => 'url',
			// 	'thumb_size' =>  '160-11',
			// ]);

			// $term_img = canva_get_img([
			// 	'img_id'   =>  $term_img_id,
			// 	'img_type' => 'img',
			// 	'thumb_size' =>  '160-11',
			// 	'img_class' =>  'w-10 mix-blend-multiply transition transform-gpu group-hover:scale-110',
			// 	'wrapper_class' =>  'overflow-hidden',
			// 	'blazy' => 'off'
			// ]);

			$clean_val = esc_attr($result['facet_value']);
			$selected = in_array($result['facet_value'], $selected_values) ? ' checked' : '';
			$selected .= (0 == $result['counter'] && '' == $selected) ? ' disabled' : '';

			$output .= '<div class="_facetwp-radio-filter facetwp-radio relative flex flex-wrap gap-2 mb-0 border-t border-gray-200 group ' . $border_last . ' ' . $selected . '" data-value="' . esc_attr($result['facet_value']) . '">';
			// if ($term_img_id) {
			// 	$output .= '<div class="_img-wrap py-2">' . $term_img . '</div>';
			// }
			$output .= '<div class="_text-wrap py-2 flex-1 flex items-center gap-1"><span class="fs-xs fw-700">' . ucwords($result['facet_display_value']) . '</span> <span class="fs-xs">(' . $result['counter'] . ')</span></div>';
			$output .= '</div>';
		}
	} elseif ('reset' == $params['facet']['name']) {
		$output = '<div class="facetwp-facet facetwp-facet-reset facetwp-type-reset md:text-right" data-name="reset" data-type="reset"><a class="facetwp-reset button hollow p-1 fs-xs" href="javascript:;">Reset filtri</a></div>';
	}


	$output .= '</div>';
	return $output;
}, 10, 2);


function custom_weglot_add_regex_checkers($regex_checkers)
{
	$regex_checkers[] = new \Weglot\Parser\Check\Regex\RegexChecker(
        '#window\.FWP_JSON\s*=\s*(\{.*?\});#s',
        'JSON',
        1
    );
    return $regex_checkers;
}
add_filter('weglot_get_regex_checkers', 'custom_weglot_add_regex_checkers');

add_filter('facetwp_ajax_load_query_vars', function ($query_vars) {
    if (defined('WEGLOT_CURRENT_LANGUAGE') && WEGLOT_CURRENT_LANGUAGE !== 'it') {
        $query_vars['lang'] = WEGLOT_CURRENT_LANGUAGE;
    }
    return $query_vars;
});


function custom_weglot_fumi_translation($html)
{

	if (have_rows('string_translate', 'option')) {
		while (have_rows('string_translate', 'option')) {
			the_row();

			$it = get_sub_field('italiano');
			$en = get_sub_field('inglese');
			$fr = get_sub_field('francese');
			$de = get_sub_field('tedesco');
			$es = get_sub_field('spagnolo');

			switch (weglot_get_current_language()) {
				case 'en':
					$html = str_replace($it, $en, $html);
					break;
				case 'fr':
					$html = str_replace($it, $fr, $html);
					break;
				case 'de':
					$html = str_replace($it, $de, $html);
					break;
				case 'es':
					$html = str_replace($it, $es, $html);
					break;
			}
		}
	}

	return $html;
}
add_filter('weglot_html_treat_page', 'custom_weglot_fumi_translation');



 function custom_weglot_words_translate($words) {
// {
	// $post_cats = get_terms(array(
	// 	'taxonomy' => 'category',
	// 	'hide_empty' => false,
	// ));

	// foreach($post_cats as $term){
	// 	$words[] = $term->name;
	// }

	// $categoria = get_terms(array(
	// 	'taxonomy' => 'categoria',
	// 	'hide_empty' => false,
	// ));

	// foreach($categoria as $term){
	// 	$words[] = $term->name;
	// }

	// $inquinante = get_terms(array(
	// 	'taxonomy' => 'inquinante',
	// 	'hide_empty' => false,
	// ));

	// foreach($inquinante as $term){
	// 	$words[] = $term->name;
	// }

	// $applicazione = get_terms(array(
	// 	'taxonomy' => 'applicazione',
	// 	'hide_empty' => false,
	// ));

	// foreach($applicazione as $term){
	// 	$words[] = $term->name;
	// }

	$words[] = 'Risultati';

	return $words;

 }
 add_filter('weglot_words_translate', 'custom_weglot_words_translate');
