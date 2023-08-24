<?php

function magiz_current_user_info_shortcode() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        
        $avatar = get_avatar($current_user->ID, 96); // Change the size as needed
        
        $user_info = '<div class="current-user-info">';
        $user_info .= '<div class="avatar">' . $avatar . '</div>';
        $user_info .= '<div class="display-name">' . esc_html($current_user->display_name) . '</div>';
        $user_info .= '<div class="user-email">' . esc_html($current_user->user_email) . '</div>';
        // Add more user info fields as needed
        
        $user_info .= '</div>';
        
        return $user_info;
    } else {
        return 'You must be logged in to view this content.';
    }
}
add_shortcode('current_user_info', 'magiz_current_user_info_shortcode');