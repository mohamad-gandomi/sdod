<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Create custom Well post type
function magiz_custom_well_post_type() {
    $labels = array(
        'name' => __('Wells', 'magiz-dash-post'),
        'singular_name' => __('Well', 'magiz-dash-post'),
        'menu_name' => __('Wells', 'magiz-dash-post'),
        'all_items' => __('All Wells', 'magiz-dash-post'),
        'add_new' => __('Add New', 'magiz-dash-post'),
        'add_new_item' => __('Add New Well', 'magiz-dash-post'),
        'edit_item' => __('Edit Well', 'magiz-dash-post'),
        'new_item' => __('New Well', 'magiz-dash-post'),
        'view_item' => __('View Well', 'magiz-dash-post'),
        'search_items' => __('Search Wells', 'magiz-dash-post'),
        'not_found' => __('No wells found', 'magiz-dash-post'),
        'not_found_in_trash' => __('No wells found in trash', 'magiz-dash-post'),
    );

    $args = array(
        'label' => __('Well', 'magiz-dash-post'),
        'labels' => $labels,
        'description' => __('A custom post type for wells.', 'magiz-dash-post'),
        'public' => true,
        'menu_icon' => 'dashicons-marker',
        'supports' => array('title'),
        'rewrite' => array('slug' => 'well'),
        'has_archive' => true,
    );

    register_post_type('well', $args);
}
add_action('init', 'magiz_custom_well_post_type', 0);


// Register Custom Taxonomies
function magiz_custom_well_taxonomies() {
    // Add new category taxonomy
    $category_labels = array(
        'name' => __('Well Categories', 'magiz-dash-post'),
        'singular_name' => __('Well Category', 'magiz-dash-post'),
        'search_items' => __('Search Categories', 'magiz-dash-post'),
        'all_items' => __('All Categories', 'magiz-dash-post'),
        'edit_item' => __('Edit Category', 'magiz-dash-post'),
        'update_item' => __('Update Category', 'magiz-dash-post'),
        'add_new_item' => __('Add New Category', 'magiz-dash-post'),
        'new_item_name' => __('New Category Name', 'magiz-dash-post'),
        'menu_name' => __('Categories', 'magiz-dash-post'),
    );
    $category_args = array(
        'hierarchical' => true,
        'labels' => $category_labels,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'well-category'),
    );
    register_taxonomy('well-category', 'well', $category_args);

    // Add new tag taxonomy
    $tag_labels = array(
        'name' => __('Well Tags', 'magiz-dash-post'),
        'singular_name' => __('Well Tag', 'magiz-dash-post'),
        'search_items' => __('Search Tags', 'magiz-dash-post'),
        'all_items' => __('All Tags', 'magiz-dash-post'),
        'edit_item' => __('Edit Tag', 'magiz-dash-post'),
        'update_item' => __('Update Tag', 'magiz-dash-post'),
        'add_new_item' => __('Add New Tag', 'magiz-dash-post'),
        'new_item_name' => __('New Tag Name', 'magiz-dash-post'),
        'menu_name' => __('Tags', 'magiz-dash-post'),
    );
    $tag_args = array(
        'hierarchical' => false,
        'labels' => $tag_labels,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'well-tag'),
    );
    register_taxonomy('well-tag', 'well', $tag_args);

    // Add new location taxonomy
    $location_labels = array(
        'name' => __('Locations', 'magiz-dash-post'),
        'singular_name' => __('Location', 'magiz-dash-post'),
        'search_items' => __('Search Locations', 'magiz-dash-post'),
        'all_items' => __('All Locations', 'magiz-dash-post'),
        'edit_item' => __('Edit Location', 'magiz-dash-post'),
        'update_item' => __('Update Location', 'magiz-dash-post'),
        'add_new_item' => __('Add New Location', 'magiz-dash-post'),
        'new_item_name' => __('New Location Name', 'magiz-dash-post'),
        'menu_name' => __('Locations', 'magiz-dash-post'),
    );
    $location_args = array(
        'hierarchical' => true,
        'labels' => $location_labels,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'well-location'),
    );
    register_taxonomy('well-location', 'well', $location_args);
}
add_action('init', 'magiz_custom_well_taxonomies', 0);
