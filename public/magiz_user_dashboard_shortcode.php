<?php

function magiz_current_user_info_shortcode() {
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        ?>
        <div class="user-cart">
            <div class="user-cart__image">
                <img src="<?php echo get_the_author_meta('profile_image', $current_user->ID) ? get_the_author_meta('profile_image', $current_user->ID) : MAGIZ_DASH_POST_URL . 'admin/assets/images/default-profile-image.jpg' ?>" alt="User Image">
            </div>
            <div class="user-cart__info">
                <div class="user-cart__name"><?php echo esc_html($current_user->display_name) ?></div>
                <div class="user-cart__email"><?php echo esc_html($current_user->user_email) ?></div>
                <div class="user-cart__days-work"><?php echo get_the_author_meta('days_of_work', $current_user->ID); ?><?php _e(' days of work', 'magiz-dash-post'); ?></div>
                <div class="user-cart__distance-travel"><?php echo get_the_author_meta('distance_traveled', $current_user->ID); ?><?php _e(' km traveled', 'magiz-dash-post'); ?></div>
                <div class="user-cart__team-scores">
                <div class="user-cart__team-score user-cart__team-score--a"><?php _e('Team A Score: ', 'magiz-dash-post'); ?><?php echo get_the_author_meta('team_a_score', $current_user->ID); ?></div>
                <div class="user-cart__team-score user-cart__team-score--b"><?php _e('Team B Score: ', 'magiz-dash-post'); ?><?php echo get_the_author_meta('team_b_score', $current_user->ID); ?></div>
                </div>
            </div>
        </div>
        <?php
    } else {
        return __('You must be logged in to view this content.', 'magiz-dash-post');
    }
}
add_shortcode('current_user_info', 'magiz_current_user_info_shortcode');