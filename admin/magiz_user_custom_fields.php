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
        <tr>
            <th><label for="user_reported_location"><?php _e('User Reported Location', 'magiz-dash-post'); ?></label></th>
            <td>
                <?php echo esc_attr(get_the_author_meta('user_reported_location', $user->ID)); ?>
            </td>
        </tr>
        <tr>
            <th><label for="user_current_location"><?php _e('User Current Location', 'magiz-dash-post'); ?></label></th>
            <td>
            <select name="user_current_location" id="user_current_location">
            <?php
                // Get the terms from the "well-location" custom taxonomy
                $terms = get_terms(array(
                    'taxonomy' => 'well-location',
                    'hide_empty' => false, // Show even if there are no posts assigned
                ));

                // Define the value that you want to be selected
                $selected_value = get_the_author_meta('user_current_location', $user->ID); // Replace 'desired_value' with the value you want to select

                // Loop through the terms and display them as options
                foreach ($terms as $term) {
                    // Get the term's ID
                    $term_id = $term->term_id;

                    // Get the custom field "distance_to_tehran" value for each term
                    $distance_to_tehran = get_term_meta($term_id, 'distance_to_tehran', true);

                    // Check if this option should be selected
                    $selected = ($distance_to_tehran === $selected_value) ? 'selected' : '';

                    // Output each term as an option
                    echo '<option value="' . esc_attr($distance_to_tehran) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                }
            ?>
            </select>
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

    // Save uploaded profile image
    if (isset($_POST['user_current_location'])) {
        // Get the current user's stored current_location
        $current_user_location = get_user_meta($user_id, 'user_current_location', true);

        // Check if the new location is different from the current one
        if ($_POST['user_current_location'] != $current_user_location) {
            // Location has changed, update both location and distance traveled
            update_user_meta($user_id, 'user_current_location', $_POST['user_current_location']);
            
            $current_distance_traveled = isset($_POST['distance_traveled']) ? $_POST['distance_traveled'] : 0;
            $new_distance_traveled = $current_distance_traveled + ($_POST['user_current_location'] * 2);
            update_user_meta($user_id, 'distance_traveled', $new_distance_traveled);
        }
    }

}
add_action('personal_options_update', 'magiz_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'magiz_save_custom_user_profile_fields');
