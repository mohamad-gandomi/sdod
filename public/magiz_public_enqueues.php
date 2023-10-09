<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue admin scripts
function magiz_enqueue_public_custom_scripts() {
    wp_enqueue_style( 'magiz-user-dashboard', MAGIZ_DASH_POST_URL . 'public/assets/css/magiz-user-dashboard.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'jalalidatepicker', MAGIZ_DASH_POST_URL . 'public/assets/css/jalalidatepicker.min.css', array(), '0.9.1', 'all' );
    wp_enqueue_style( 'magiz-wells-table', MAGIZ_DASH_POST_URL . 'public/assets/css/magiz-wells-table.css', array(), '1.0.0', 'all' );


    wp_enqueue_script( 'magiz-user-dashboard', MAGIZ_DASH_POST_URL . 'public/assets/js/magiz-user-dashboard.js', array('jalalidatepicker'), '1.0.0', true );
    wp_enqueue_script( 'jalalidatepicker', MAGIZ_DASH_POST_URL . 'public/assets/js/jalalidatepicker.min.js', array(), '0.9.1', true );
    wp_enqueue_script( 'magiz-wells-table', MAGIZ_DASH_POST_URL . 'public/assets/js/magiz-wells-table.js', array(), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'magiz_enqueue_public_custom_scripts');