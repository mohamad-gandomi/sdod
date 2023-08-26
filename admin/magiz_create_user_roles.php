<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add new user roles
function magiz_custom_add_roles() {
    add_role('mechanic_engineer', __('Mechanic Engineer', 'magiz-dash-post'), array(
        'read' => true,
    ));

    add_role('electronic_engineer', __('Electronic Engineer', 'magiz-dash-post'), array(
        'read' => true,
    ));
}
add_action('init', 'magiz_custom_add_roles');

// Hide admin bar for specific user roles
function magiz_custom_hide_admin_bar() {
    $current_user = wp_get_current_user();
    if ( in_array('mechanic_engineer', $current_user->roles) || in_array('electronic_engineer', $current_user->roles) ) {
        show_admin_bar(false);
    }
}
add_action('plugins_loaded', 'magiz_custom_hide_admin_bar');

// Redirect users from dashboard
function magiz_custom_redirect_from_dashboard() {
    $current_user = wp_get_current_user();
    if ( in_array('mechanic_engineer', $current_user->roles) || in_array('electronic_engineer', $current_user->roles) ) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('admin_init', 'magiz_custom_redirect_from_dashboard');