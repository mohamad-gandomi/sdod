<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue admin scripts
function magiz_enqueue_public_custom_scripts() {
    wp_enqueue_style( 'magiz-user-dashboard', MAGIZ_DASH_POST_URL . 'public/assets/css/magiz-user-dashboard.css', array(), '1.0', 'all' );
}
add_action('wp_enqueue_scripts', 'magiz_enqueue_public_custom_scripts');