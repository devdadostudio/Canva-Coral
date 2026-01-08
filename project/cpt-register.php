<?php
defined('ABSPATH') || exit;

// add_action('after_switch_theme', function(){
// 	unregister_post_type('macrofamiglia');
// 	unregister_post_type('famiglia');
// });

function cptui_register_my_cpts()
{

  /**
   * Post Type: Macro Famiglie.
   */

  $labels = [
    "name" => esc_html__("Macro Famiglie", "canva"),
    "singular_name" => esc_html__("Macro Famiglia", "canva"),
  ];

  $args = [
    "label" => esc_html__("Macro Famiglie", "canva"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "linee-prodotti", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-admin-multisite",
    "supports" => ["title", "thumbnail", "revisions"],
    "show_in_graphql" => false,
  ];

  register_post_type("macrofamiglia", $args);

  /**
   * Post Type: Famiglie.
   */

  $labels = [
    "name" => esc_html__("Famiglie", "canva"),
    "singular_name" => esc_html__("Famiglia", "canva"),
  ];

  $args = [
    "label" => esc_html__("Famiglie", "canva"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "grupppo-prodotti", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-networking",
    "supports" => ["title", "thumbnail", "revisions"],
    "show_in_graphql" => false,
  ];

  register_post_type("famiglia", $args);

  /**
   * Post Type: Prodotti.
   */

  $labels = [
    "name" => esc_html__("Prodotti", "canva"),
    "singular_name" => esc_html__("Prodotto", "canva"),
  ];

  $args = [
    "label" => esc_html__("Prodotti", "canva"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "prodotto", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-products",
    "supports" => ["title", "thumbnail"],
    "show_in_graphql" => false,
  ];

  register_post_type("prodotto", $args);

  /**
   * Post Type: Case History.
   */

  $labels = [
    "name" => esc_html__("Case History", "canva"),
    "singular_name" => esc_html__("Case history", "canva"),
  ];

  $args = [
    "label" => esc_html__("Case History", "canva"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "case-history", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-calendar-alt",
    "supports" => ["title", "editor", "thumbnail", "revisions"],
    "show_in_graphql" => false,
  ];

  register_post_type("case-history", $args);

  /**
   * Post Type: Sedi.
   */

  $labels = [
    "name" => esc_html__("Sedi", "canva"),
    "singular_name" => esc_html__("Sede", "canva"),
  ];

  $args = [
    "label" => esc_html__("Sedi", "canva"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => ["slug" => "sedi", "with_front" => true],
    "query_var" => true,
    "menu_icon" => "dashicons-admin-multisite",
    "supports" => ["title", "editor", "thumbnail", "revisions"],
    "taxonomies" => ["tipologia_sede", "localita_sede"],
    "show_in_graphql" => false,
  ];

  register_post_type("sedi", $args);
}

add_action('init', 'cptui_register_my_cpts');



function cptui_register_my_taxes()
{

  /**
   * Taxonomy: Categorie Prodotto.
   */

  $labels = [
    "name" => esc_html__("Categorie Prodotti", "canva"),
    "singular_name" => esc_html__("Categoria Prodotto", "canva"),
  ];


  $args = [
    "label" => esc_html__("Categorie Prodotti", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'categoria', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "categoria",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => true,
    "show_in_graphql" => false,
  ];
  register_taxonomy("categoria", ["macrofamiglia", "famiglia"], $args);

  /**
   * Taxonomy: Macro Famiglie.
   */

  $labels = [
    "name" => esc_html__("Macro Famiglie", "canva"),
    "singular_name" => esc_html__("Macro Famiglia", "canva"),
  ];


  $args = [
    "label" => esc_html__("Macro Famiglie", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'macrofamiglia', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "macrofamiglia",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("macrofamiglia", ["famiglia", "prodotto"], $args);

  /**
   * Taxonomy: Famiglie.
   */

  $labels = [
    "name" => esc_html__("Famiglie", "canva"),
    "singular_name" => esc_html__("Famiglia", "canva"),
  ];


  $args = [
    "label" => esc_html__("Famiglie", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'famiglia', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "famiglia",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("famiglia", ["prodotto", "case-history"], $args);

  /**
   * Taxonomy: Inquinanti.
   */

  $labels = [
    "name" => esc_html__("Inquinanti", "canva"),
    "singular_name" => esc_html__("Inquinante", "canva"),
  ];


  $args = [
    "label" => esc_html__("Inquinanti", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'inquinante', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "inquinante",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("inquinante", ["macrofamiglia", "case-history"], $args);

  /**
   * Taxonomy: Applicazioni.
   */

  $labels = [
    "name" => esc_html__("Applicazioni", "canva"),
    "singular_name" => esc_html__("Applicazione", "canva"),
  ];


  $args = [
    "label" => esc_html__("Applicazioni", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "query_var" => true,
    "rewrite" => ['slug' => 'applicazione', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "applicazione",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("applicazione", ["macrofamiglia", "case-history"], $args);


  /**
   * Taxonomy: Categorie Common Block.
   */

  $labels = [
    "name" => esc_html__("Categorie Common Block", "canva"),
    "singular_name" => esc_html__("Categoria Common Block", "canva"),
  ];


  $args = [
    "label" => esc_html__("Categorie Common Block", "canva"),
    "labels" => $labels,
    "public" => false,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "query_var" => true,
    "rewrite" => ['slug' => 'cb_cat', 'with_front' => true,],
    "show_admin_column" => false,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "cb_cat",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("cb_cat", ["common-blocks"], $args);

  /**
   * Taxonomy: Tipologie Case History.
   */

  $labels = [
    "name" => esc_html__("Tipologie Case History", "canva"),
    "singular_name" => esc_html__("Tipologia Case History", "canva"),
  ];


  $args = [
    "label" => esc_html__("Tipologie Case History", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "query_var" => true,
    "rewrite" => ['slug' => 'categoria_ch', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "categoria_ch",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => true,
    "show_in_graphql" => false,
  ];
  register_taxonomy("categoria_ch", ["case-history"], $args);

  /**
   * Taxonomy: Tipologie Sedi.
   */

  $labels = [
    "name" => esc_html__("Tipologie Sedi", "canva"),
    "singular_name" => esc_html__("Tipologia Sede", "canva"),
  ];


  $args = [
    "label" => esc_html__("Tipologie Sedi", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "query_var" => true,
    "rewrite" => ['slug' => 'tipologia_sede', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "tipologia_sede",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("tipologia_sede", ["sedi"], $args);

  /**
   * Taxonomy: Località Sedi.
   */

  $labels = [
    "name" => esc_html__("Località Sedi", "canva"),
    "singular_name" => esc_html__("Località Sede", "canva"),
  ];


  $args = [
    "label" => esc_html__("Località Sedi", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "query_var" => true,
    "rewrite" => ['slug' => 'localita_sede', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "localita_sede",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("localita_sede", ["sedi"], $args);

  /**
   * Taxonomy: Tipologia News.
   */

  $labels = [
    "name" => esc_html__("Tipologia News", "canva"),
    "singular_name" => esc_html__("Tipologia News", "canva"),
  ];


  $args = [
    "label" => esc_html__("Tipologia News", "canva"),
    "labels" => $labels,
    "public" => true,
    "publicly_queryable" => true,
    "hierarchical" => true,
    "show_ui" => true,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "query_var" => true,
    "rewrite" => ['slug' => 'tipologia_news', 'with_front' => true,],
    "show_admin_column" => true,
    "show_in_rest" => true,
    "show_tagcloud" => false,
    "rest_base" => "tipologia_news",
    "rest_controller_class" => "WP_REST_Terms_Controller",
    "rest_namespace" => "wp/v2",
    "show_in_quick_edit" => true,
    "sort" => false,
    "show_in_graphql" => false,
  ];
  register_taxonomy("tipologia_news", ["post"], $args);

}
add_action('init', 'cptui_register_my_taxes');
