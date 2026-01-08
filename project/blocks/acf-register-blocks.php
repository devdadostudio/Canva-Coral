<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * funzione di callback che automatizza l'inclusione
 * del template che renderizza l'output del blocco
 *
 * Non modificare
 *
 * @param [type] $block
 * @return void
 */
function project_be_block_callback($block)
{
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
	$slug = str_replace('_', '-', $slug);

	// Set preview flag to true when rendering for the block editor.
	$is_preview = false;
	if ( is_admin() && acf_is_block_editor() ) {
		$is_preview = true;
	}

	// include a template part from within the folder
	if (file_exists(CANVA_PROJECT_BLOCKS . $slug . '.php')) {
		include(CANVA_PROJECT_BLOCKS . $slug . '.php');
	} elseif (file_exists(CANVA_CORE_BLOCKS . $slug . '.php')) {
		include(CANVA_CORE_BLOCKS . $slug . '.php');
	}
}



/**
 * Aggiunge la categoria  studio42 per i blocchi
 *
 * Modificare il titolo => 'title' con il nome del progetto
 *
 * @param array $categories Array of block categories.
 * @return array
 */

function  project_block_categories($categories)
{
	$category_slugs = wp_list_pluck($categories, 'slug');
	return in_array('project_block_category', $category_slugs, true) ? $categories : array_merge(
		$categories,
		array(
			array(
				'slug'  => 'project_block_category', //non modificare
				'title' => __('Coral Custom Blocks'), //modificare con mone progetto
				'icon'  => null,
			),
		)
	);
}
add_filter('block_categories_all', 'project_block_categories');


/**
 * funzione per registare i nuovi blocchi custom del progetto
 *
 * Modificare ogni volta che vuoi aggiungere un blocco nuovo
 * devi copiare tutto il blocco della funzione acf_register_block(***);
 * sotto per registrare il nuovo blocco
 *
 * Nella cartella studio42/blockeditor del tema figlio dovrai creare
 * un microtemplate con il nome dello slug => 'name' che hai dato al blocco
 *
 * esempio sotto post-header.php
 *
 * @return void
 */
function project_be_acf_init()
{
	// check function exists
	if (function_exists('acf_register_block_type')) {

		// acf_register_block([
		// 	'name' 				=> 'crl-term-highlights', //modificare slug del blocco
		// 	'title' 			=> __('Term Higlights', 'canva-backend'), //modificare titolo del blocco
		// 	'description' 		=> __('Term Higlights', 'canva-backend'), //modificare azione del blocco
		// 	'render_callback' 	=> 'canva_be_block_callback', //non modificare
		// 	'category' 			=> 'project_block_categories', //non modificare
		// 	'icon' 				=> 'align-pull-right',
		// 	'keywords' 			=> ['Term Higlights'],
		// 	'supports'			=> array('align' => false, 'multiple' => true, 'anchor' => true),
		// ]);
	}
}
add_action('acf/init', 'project_be_acf_init');


/**
 *
 * funzione per generare whitelist dei blocchi da utilizzare di per il progetto
 *
 * @url https://rudrastyh.com/gutenberg/remove-default-blocks.html
 *
 */
function project_allowed_blocks($allowed_blocks)
{

	$new_blocks =  [

		// 'acf/crl-term-highlights',

	];

	return array_merge($new_blocks, $allowed_blocks);
}
add_filter('canva_block_list', 'project_allowed_blocks', 10, 1);
