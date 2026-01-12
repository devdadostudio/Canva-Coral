<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

// Init
if (!is_user_logged_in()) {
	add_action('template_redirect', 'canva_maintenance_mode', 10); //for all
}

if (!get_field('show_admin_bar', 'options')) {
	add_filter('show_admin_bar', '__return_false');
} else {
	if (!current_user_can('edit_posts')) {
		add_filter('show_admin_bar', '__return_false');
	}
}

add_action('wp_head', 'canva_favicon', 20);

// Header
if (get_field('iubenda', 'options') || get_field('cookiebot', 'options')) {
	add_action('wp_head', 'gdpr_cookie_consent_bar', 99);
}

add_action('wp_head', 'canva_header_scripts', PHP_INT_MAX);
add_action('wp_head', 'canva_dynamic_css_vars_header', PHP_INT_MAX);
add_action('wp_head', 'canva_css_inline', PHP_INT_MAX);

if (get_field('google_analytics_id', 'options')) {
	add_action('wp_head', 'canva_google_analytics_header', PHP_INT_MAX);
}

// print facebook app id if defined in theme options
if (get_field('facebook_app_id', 'options')) {
	add_action('wp_head', function () {
		echo '<meta property="fb:app_id" content="' . esc_attr(get_field('facebook_app_id', 'option')) . '" />';
	}, PHP_INT_MAX);
}

if (get_field('facebook_pixel_id', 'options')) {
	add_action('wp_head', 'canva_facebook_pixel_header', PHP_INT_MAX);
}

// Stampa array js CF7 da usare pe la messaggistica delle modali in ajax
add_action('wp_head', 'canva_cf7_forms_ids_js_array', PHP_INT_MAX);

// Body

add_action('canva_body_start', 'canva_body_scripts', 10);
// Site Menu
add_action('canva_body_start', 'canva_menu_builder', 30);
// Site notices
add_action('desktop_navigation_before', 'canva_notices_posts_before_navigation', 20);
add_action('mobile_navigation_before', 'canva_notices_posts_before_navigation', 20);
add_action('desktop_navigation_after', 'canva_notices_posts_after_navigation', 40);
add_action('mobile_navigation_after', 'canva_notices_posts_after_navigation', 40);

// Main
add_action('canva_container_start', 'canva_get_breadcrumbs', 10);


// Footer
add_action('canva_footer_start', 'canva_footer_opt', 10);

// After Footer
// add_action('canva_body_end', 'canva_scroll_to_top_html', 20);

add_action('canva_body_end', 'canva_photoswipe_html', 90);
add_action('canva_body_end', 'canva_privacy_infobar', 91);
add_action('canva_body_end', 'canva_overlay_footer', 92);
add_action('canva_body_end', 'canva_footer_scripts', 99);

// Analytics Ecommerce Tracking
if (get_field('google_analytics_id', 'options') && is_woocommerce_activated()) {
	add_action('canva_body_end', 'canva_google_analytics_footer', PHP_INT_MAX);
}

//Stampa eventi js per tracciare invio moduli cf7
if (get_field('google_analytics_id', 'options')) {
	add_action('canva_body_end', 'canva_cf7_event_tracker', PHP_INT_MAX);
}
