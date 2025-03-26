<?php

/*** Custom Post Types ***/

/** Testimonial **/

add_action('init', 'create_general_options_test');

function create_general_options_test() {


    $label_affiliates = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add Testimonial',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'all_items' => 'All Testimonials',
        'view_item' => 'View Testimonials',
        'search_items' => 'Search Testimonials',
        'not_found' => 'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Testimonials'
    );

    $Testimonials_args = array(
        'labels' => $label_affiliates,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => ''),
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        //'menu_icon' => 'dashicons',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
    );

    register_post_type('Testimonial', $Testimonials_args);
}


/** Services **/

add_action('init', 'create_general_options_services');

function create_general_options_services() {


    $label_activity = array(
        'name' => 'Services',
        'singular_name' => 'service',
        'add_new' => 'Add service',
        'add_new_item' => 'Add New service',
        'edit_item' => 'Edit service',
        'new_item' => 'New service',
        'all_items' => 'All service',
        'view_item' => 'View service',
        'search_items' => 'Search service',
        'not_found' => 'No service found',
        'not_found_in_trash' => 'No service found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Services'
    );

    $services_args = array(
        'labels' => $label_activity,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => ''),
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        //'menu_icon' => 'dashicons',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
    );

    register_post_type('services', $services_args);
}

/** FAQ **/

add_action('init', 'create_general_options_faq');

function create_general_options_faq() {


    $label_affiliates = array(
        'name' => 'Faq',
        'singular_name' => 'Faq',
        'add_new' => 'Add Faq',
        'add_new_item' => 'Add New Faq',
        'edit_item' => 'Edit Faq',
        'new_item' => 'New Faq',
        'all_items' => 'All Faqs',
        'view_item' => 'View Faqs',
        'search_items' => 'Search Faqs',
        'not_found' => 'No Faqs found',
        'not_found_in_trash' => 'No Faqs found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'FAQ'
    );

    $faq_args = array(
        'labels' => $label_affiliates,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => ''),
        'has_archive' => false,
        'hierarchical' => true,
        'menu_position' => null,
        //'menu_icon' => 'dashicons',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
    );

    register_post_type('Faq', $faq_args);
}

?>
