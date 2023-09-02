<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add custom fields for profile image upload, days of work, distance, and team scores in user edit screen
function magiz_custom_user_profile_fields($user) {
    ?>
    <h3><?php _e('Profile Image', 'magiz-dash-post'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="profile_image"><?php _e('Profile Image', 'magiz-dash-post'); ?></label></th>
            <td>

                <?php $profile_image_url = get_the_author_meta('profile_image', $user->ID); ?>
                <?php $default_profile_image_url = MAGIZ_DASH_POST_URL . 'admin/assets/images/default-profile-image.jpg'; ?>

                <input type="button" id="upload_profile_image_button" class="button" value="Upload Image">
                <button id="remove_profile_image_button" class="button" style="display: <?php echo $profile_image_url ? 'inline-block' : 'none'; ?>"><span style="margin-top:4px;" class="dashicons dashicons-trash"></span></button>
                <input type="hidden" id="profile_image" name="profile_image" value="<?php echo esc_attr(get_the_author_meta('profile_image', $user->ID)); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="profile_image_preview"><?php _e('Profile Image Preview', 'magiz-dash-post'); ?></label></th>
            <td>
                <div id="profile_image_preview">
                    <img src="<?php echo esc_url($profile_image_url ? $profile_image_url : $default_profile_image_url ); ?>" alt="Profile Image" style="max-width: 150px;">
                </div>
            </td>
        </tr>
    </table>

    <h3><?php _e('Additional Information', 'magiz-dash-post'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="days_of_work"><?php _e('Days of Work', 'magiz-dash-post'); ?></label></th>
            <td>
                <input type="number" name="days_of_work" id="days_of_work" value="<?php echo esc_attr(get_the_author_meta('days_of_work', $user->ID)); ?>" min="0">
            </td>
        </tr>
        <tr>
            <th><label for="distance_traveled"><?php _e('Distance Traveled', 'magiz-dash-post'); ?></label></th>
            <td>
                <input type="number" name="distance_traveled" id="distance_traveled" value="<?php echo esc_attr(get_the_author_meta('distance_traveled', $user->ID)); ?>" step="0.01" min="0">
            </td>
        </tr>
        <tr>
            <th>
                <label for="electronic_team_score"><?php _e('Electronic Team Score', 'magiz-dash-post'); ?></label>
            </th>
            <td>
                <?php $electronic_team_score = get_the_author_meta('electronic_team_score', $user->ID) ? array_sum(get_the_author_meta('electronic_team_score', $user->ID)) / count(get_the_author_meta('electronic_team_score', $user->ID)) : '' ; ?>
                <?php echo $electronic_team_score; ?>
            </td>
        </tr>
        <tr>
            <th><label for="mechanic_team_score"><?php _e('Mechanic Team Score', 'magiz-dash-post'); ?></label></th>
            <td>
                <?php $mechanic_team_score = get_the_author_meta('mechanic_team_score', $user->ID) ? array_sum(get_the_author_meta('mechanic_team_score', $user->ID)) / count(get_the_author_meta('mechanic_team_score', $user->ID)) : '' ; ?>
                <?php echo $mechanic_team_score; ?>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'magiz_custom_user_profile_fields');
add_action('edit_user_profile', 'magiz_custom_user_profile_fields');

// Save additional custom fields
function magiz_save_custom_user_profile_fields($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Save days of work
    if (isset($_POST['days_of_work'])) {
        update_user_meta($user_id, 'days_of_work', sanitize_text_field($_POST['days_of_work']));
    }

    // Save distance traveled
    if (isset($_POST['distance_traveled'])) {
        update_user_meta($user_id, 'distance_traveled', sanitize_text_field($_POST['distance_traveled']));
    }

    // Save Team A score
    if (isset($_POST['electronic_team_score'])) {
        update_user_meta($user_id, 'electronic_team_score', sanitize_text_field($_POST['electronic_team_score']));
    }

    // Save Team B score
    if (isset($_POST['mechanic_team_score'])) {
        update_user_meta($user_id, 'mechanic_team_score', sanitize_text_field($_POST['mechanic_team_score']));
    }

    // Save uploaded profile image
    if (isset($_POST['profile_image'])) {
        update_user_meta($user_id, 'profile_image', $_POST['profile_image']);
    }
}
add_action('personal_options_update', 'magiz_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'magiz_save_custom_user_profile_fields');
