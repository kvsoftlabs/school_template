<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

/* * *Walker Menu** */

class navclass_walker_nav_menu extends Walker_Nav_Menu {
// Remove <ul> for sub-menus
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= ''; // No sub-menu <ul> tag
	}

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Check if item is active
        $active_class = ($item->current || $item->current_item_ancestor) ? ' active' : '';

        // Check if item has children (dropdown)
        $is_dropdown = in_array('menu-item-has-children', $item->classes) ? ' dropdown-toggle' : '';

        // Link attributes
        $attributes = !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
        $attributes .= ' class="nav-item nav-link' . $is_dropdown . $active_class . '"';

        // Build the output
        $output .= '<a' . $attributes . '>' . esc_html($item->title) . '</a>';
    }
}

add_theme_support( 'post-thumbnails' );

function tg_include_custom_post_types_in_search_results( $query ) {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post') );
	}
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );

function create_slider_post_type() {
	$labels = array(
		'name'               => 'Sliders',
		'singular_name'      => 'Slider',
		'menu_name'          => 'Sliders',
		'name_admin_bar'     => 'Slider',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Slider',
		'new_item'           => 'New Slider',
		'edit_item'          => 'Edit Slider',
		'view_item'          => 'View Slider',
		'all_items'          => 'All Sliders',
		'search_items'       => 'Search Sliders',
		'not_found'          => 'No sliders found.',
		'not_found_in_trash' => 'No sliders found in Trash.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-images-alt2', // Slider icon in admin
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'        => false,
		'rewrite'            => array( 'slug' => 'slider' ),
	);

	register_post_type( 'slider', $args );
}
add_action( 'init', 'create_slider_post_type' );

function register_facilities_post_type() {
    $labels = array(
        'name'          => 'Facilities',
        'singular_name' => 'Facility',
        'add_new'       => 'Add New Facility',
        'add_new_item'  => 'Add New Facility',
        'edit_item'     => 'Edit Facility',
        'new_item'      => 'New Facility',
        'view_item'     => 'View Facility',
        'all_items'     => 'All Facilities',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => false,
        'menu_icon'     => 'dashicons-building',
        'supports'      => array('title', 'editor', 'thumbnail', 'custom-fields'),
    );

    register_post_type('facility', $args);
}
add_action('init', 'register_facilities_post_type');

// Add Site Settings Page to Admin Menu
function add_site_settings_menu() {
    add_menu_page(
        'Site Settings',        // Page title
        'Site Settings',        // Menu title
        'manage_options',       // Capability
        'site-settings',        // Menu slug
        'site_settings_page',   // Callback function
        'dashicons-admin-generic', // Icon
        20                      // Position
    );
}
add_action('admin_menu', 'add_site_settings_menu');

if (file_exists(get_template_directory() . '/includes/admin-settings.php')) {
    require_once get_template_directory() . '/includes/admin-settings.php';
    error_log('admin-settings.php loaded successfully.');
} else {
    error_log('admin-settings.php NOT FOUND.');
}


