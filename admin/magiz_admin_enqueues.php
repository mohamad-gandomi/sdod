<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue admin scripts
function magiz_enqueue_admin_custom_scripts() {
    if (is_admin()) {

        wp_enqueue_style( 'magiz-admin-dash-post', MAGIZ_DASH_POST_URL . 'admin/assets/css/magiz-admin-dash-post.css', array(), '1.0');
        wp_enqueue_style( 'jalalidatepicker', MAGIZ_DASH_POST_URL . 'admin/assets/css/jalalidatepicker.min.css', array(), '0.9.1', 'all' );

        wp_enqueue_media();
        wp_enqueue_script('magiz_user_custom_fields', MAGIZ_DASH_POST_URL . 'admin/assets/js/magiz-user-custom-fields.js', array('jquery', 'jalalidatepicker'), null, true);
        wp_enqueue_script( 'jalalidatepicker', MAGIZ_DASH_POST_URL . 'admin/assets/js/jalalidatepicker.min.js', array(), '0.9.1', true );

    }
}
add_action('admin_enqueue_scripts', 'magiz_enqueue_admin_custom_scripts');