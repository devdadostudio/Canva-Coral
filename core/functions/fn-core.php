<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

//Canva Theme folders paths

// Ajax Stuff
define('CANVA_ADMIN_AJAX_URI', admin_url('admin-ajax.php'));

// Core Costants
define('CANVA_CORE', get_template_directory() . '/core/');
define('CANVA_CORE_URI', get_template_directory_uri() . '/core/');
define('CANVA_CORE_TEMPLATES', get_template_directory() . '/core/templates/');
define('CANVA_CORE_CSS', get_template_directory() . '/core/assets/css/');
define('CANVA_CORE_CSS_URI', get_template_directory_uri() . '/core/assets/css/');
define('CANVA_CORE_JS', get_template_directory() . '/core/assets/js/');
define('CANVA_CORE_JS_URI', get_template_directory_uri() . '/core/assets/js/');
define('CANVA_CORE_IMG', get_template_directory() . '/core/assets/img/');
define('CANVA_CORE_IMG_URI', get_template_directory_uri() . '/core/assets/img/');
define('CANVA_CORE_BLOCKS', get_template_directory() . '/core/blocks/');
define('CANVA_CORE_BLOCKS_URI', get_template_directory_uri() . '/core/blocks/');


// Project Costants
define('CANVA_PROJECT', get_template_directory() . '/project/');
define('CANVA_PROJECT_URI', get_template_directory_uri() . '/project/');
define('CANVA_PROJECT_TEMPLATES', get_template_directory() . '/project/templates/');
define('CANVA_PROJECT_CSS', get_template_directory() . '/project/assets/css/');
define('CANVA_PROJECT_CSS_URI', get_template_directory_uri() . '/project/assets/css/');
define('CANVA_PROJECT_JS', get_template_directory() . '/project/assets/js/');
define('CANVA_PROJECT_JS_URI', get_template_directory_uri() . '/project/assets/js/');
define('CANVA_PROJECT_IMG', get_template_directory() . '/project/assets/img/');
define('CANVA_PROJECT_IMG_URI', get_template_directory_uri() . '/project/assets/img/');
define('CANVA_PROJECT_BLOCKS', get_template_directory() . '/project/blocks/');
define('CANVA_PROJECT_BLOCKS_URI', get_template_directory_uri() . '/project/blocks/');


// define('CANVA_ACF_VERSION','5.12.2');
// define('CANVA_ACF_VERSION', '6.0.2');
define('CANVA_ACF_VERSION', '6.1.6');

// Define path and URL to the ACF plugin.
define('MY_ACF_PATH', get_template_directory() . '/core/acf-' . CANVA_ACF_VERSION . '/');
define('MY_ACF_URL', get_template_directory_uri() . '/core/acf-' . CANVA_ACF_VERSION . '/');

// Include the ACF plugin.
include_once MY_ACF_PATH . 'acf.php';

// Customize the url setting to fix incorrect asset URLs.
function canva_acf_settings_url($url)
{
  return MY_ACF_URL;
}
add_filter('acf/settings/url', 'canva_acf_settings_url');

// (Optional) Hide the ACF admin menu item.
function canva_acf_settings_show_admin($show_admin)
{
  return true;
}
add_filter('acf/settings/show_admin', 'canva_acf_settings_show_admin');


/**
 * Set Security Header
 *
 * @return void
 */

function canva_set_security_headers($headers)
{
  $headers['X-XSS-Protection'] = '1; mode=block';
  $headers['Strict-Transport-Security'] = 'max-age=63072000; includeSubDomains; preload';
  $headers['X-Content-Type-Options'] = 'nosniff';
  $headers['X-Frame-Options'] = 'SAMEORIGIN';
  $headers['Access-Control-Allow-Origin'] = '*';

  return $headers;
}
add_filter('wp_headers', 'canva_set_security_headers');



/**
 * Returns the right template path
 *
 * @param [type] $slug
 * @param array $args
 * @return void
 */
function canva_get_template($template_name, $args = [])
{
  if (is_admin() && !defined('DOING_AJAX')) {
    return;
  }

  $template_name = esc_attr($template_name);

  if (file_exists(CANVA_PROJECT_TEMPLATES . $template_name . '.php')) {
    $template = CANVA_PROJECT_TEMPLATES . $template_name . '.php';
  } else {
    $template = CANVA_CORE_TEMPLATES . $template_name . '.php';
  }

  if (!$template) {
    return false;
  }

  if ($args) {
    extract($args);
  }

  include $template;
}


/**
 * used to print social icons from theme options
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @param array $atts
 * @return void
 */
function canva_get_template_shortcode($atts = [])
{
  extract(shortcode_atts([
    'template_name' => 'render-block',
  ], $atts));

  return canva_get_template($template_name);
}
add_shortcode('canva_get_template', 'canva_get_template_shortcode');

/*
 *
 * is_there_any_post($post_type = 'post')
 * controlla se ci sono post pubblicati in un post type
 *
 */

function is_there_any_post($post_type = 'post', $taxonomy = 'category', $term_id = '')
{
  $args = [
    'posts_per_page' => -1,
    'post_type' => $post,
    'tax_query' => [
      [
        'taxonomy' => $taxonomy,
        'field' => 'term_id',
        'terms' => $term_id,
      ],
    ],
  ];

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    return true;
  }

  return false;
  wp_reset_query();
}

/*
 *
 * is_acf_activated()
 * controlla se ACF è attivo o no
 *
 */

function is_acf_activated()
{
  return class_exists('acf') ? true : false;
}

/*
 *
 * is_woocommerce_activated()
 * controlla se woocommerce è attivo o no
 *
 */

function is_woocommerce_activated()
{
  return class_exists('woocommerce') ? true : false;
}

function is_woocommerce_membership_activated()
{
  return class_exists('wc_memberships') ? true : false;
}

function is_woocommerce_subscription_activated()
{
  return class_exists('wc_subscriptions') ? true : false;
}

function is_weglot_activated()
{
  return class_exists('Context_Weglot') ? true : false;
}
/**
 * check if WPML is active
 *
 * @return boolean
 */
function is_wpml_activated()
{
  return function_exists('icl_object_id') ? true : false;
}

/**
 * get current navigation language WPML.
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return string
 */
function get_current_lang()
{
  if (is_wpml_activated()) {
    if (defined('ICL_LANGUAGE_CODE')) {
      return $current_lang = ICL_LANGUAGE_CODE;
    }
  } else {
    return 'it';
  }
}

/**
 * get browser lang.
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return string
 */
function get_browser_lang()
{
  if (function_exists("locale_accept_from_http")) {
    if (!$locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      return null;
    }
  }

  return $locale ? substr($locale, 0, 2) : "it";
}


/**
 * check if facetwp plugin is activated
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return boolean
 */
function is_facetwp_activated()
{
  return class_exists('FacetWP') ? true : false;
}


/**
 * check if maintenance mode is on
 *
 * @author Toni Guga <toni@schiavoneguga.com>
 * @return boolean
 */
function is_maintenance_mode_activated()
{
  $maintenance_mode = get_field('maintenance_mode', 'options');

  if ($maintenance_mode['maintenance_mode_option']) {
    return true;
  } else {
    return false;
  }
}


/**
 * Undocumented function
 *
 * @param integer $user_id
 * @return void
 */
function get_user_role($user_id = 0)
{
  $user = ($user_id) ? get_userdata($user_id) : wp_get_current_user();

  return current($user->roles);
}

function is_user_role($role = 'administrator')
{
  $current_user = wp_get_current_user();

  if (is_user_logged_in() && get_user_role($current_user->ID) == $role) {
    return true;
  } else {
    return false;
  }
}

/**
 * check if url is external or not
 *
 * @param [type] $url
 * @return boolean
 */
function is_url_local($url)
{
  if (empty($url)) {
    return false;
  }

  $urlParsed = parse_url($url);
  $host = $urlParsed['host'];

  if (empty($host)) {
    // maybe we have a relative link like: /wp-content/uploads/image.jpg
    // add absolute path to begin and check if file exists
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    $maybefile = $doc_root . $url;
    // Check if file exists
    $fileexists = file_exists($maybefile);
    if ($fileexists) {
      // maybe you want to convert to full url?
      return true;
    }
  }

  // strip www. if exists
  $host = str_replace('www.', '', $host);
  $thishost = $_SERVER['HTTP_HOST'];

  // strip www. if exists
  $thishost = str_replace('www.', '', $thishost);
  if ($host == $thishost) {
    return true;
  }

  return false;
}


/**
 * returns the client ip address
 *
 * @return void
 */
function get_client_ip()
{
  $ipaddress = '';

  if (getenv('HTTP_CLIENT_IP')) {
    $ipaddress = getenv('HTTP_CLIENT_IP');
  } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('HTTP_X_FORWARDED')) {
    $ipaddress = getenv('HTTP_X_FORWARDED');
  } elseif (getenv('HTTP_FORWARDED_FOR')) {
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  } elseif (getenv('HTTP_FORWARDED')) {
    $ipaddress = getenv('HTTP_FORWARDED');
  } elseif (getenv('REMOTE_ADDR')) {
    $ipaddress = getenv('REMOTE_ADDR');
  } else {
    $ipaddress = 'UNKNOWN';
  }

  return $ipaddress;
}

/**
 * FUNZIONI WPML PER IL LANG SWITCHER
 */

function wpml_get_original_lang()
{
  if (has_filter('wpml_default_language')) {
    $original_lang = apply_filters('wpml_default_language', function ($default_lang) {
      return $default_lang;
    });
  } else {
    $original_lang = null;
  }

  return $original_lang;
}

function wpml_get_destination_langs()
{
  if (has_filter('wpml_active_languages')) {
    $destination_langs = apply_filters('wpml_active_languages', function ($active_langs) {
      return $active_langs;
    });
  } else {
    $destination_langs = null;
  }

  return $destination_langs;
}

function wpml_get_current_lang()
{
  $current_lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : null;
  return $current_lang;
}

function wpml_get_destination_url()
{
  $destination_url = null;
  $destination_langs = wpml_get_destination_langs();
  if ($destination_langs) {
    $lang = get_browser_lang();
    if ($lang && array_key_exists($lang, $destination_langs) && array_key_exists('url', $destination_langs[$lang])) {
      $destination_url = $destination_langs[$lang]['url'];
    }
  } else {
    return $destination_url;
  }
  return $destination_url;
}

/**
 * FUNZIONI WEGLOT PER IL LANG SWITCHER
 */

function weglot_get_original_lang()
{
  if (function_exists('weglot_get_original_language')) {
    $original_lang = weglot_get_original_language();
  } else {
    $original_lang = null;
  }
  return $original_lang;
}

function weglot_get_destination_langs()
{
  if (function_exists('weglot_get_destination_languages')) {
    $destination_langs = weglot_get_destination_languages();
  } else {
    $destination_langs = null;
  }
  return $destination_langs;
}

function weglot_get_current_lang()
{
  if (function_exists('weglot_get_current_language')) {
    $current_lang = weglot_get_current_language();
  } else {
    $current_lang = null;
  }
  return $current_lang;
}

function weglot_get_destination_url()
{
  if (function_exists('weglot_get_service')) {
    $language_services = weglot_get_service('Language_Service_Weglot');
    $request_url_services = weglot_get_service('Request_Url_Service_Weglot');

    global $wp;
    $url = home_url($wp->request);

    $wg_url = $request_url_services->create_url_object($url);
    $language = $language_services->get_language_from_internal(get_browser_lang());
    $destination_url = $wg_url->getForLanguage($language);
  } else {
    $destination_url = null;
  }

  return $destination_url;
}