<?php

function magiz_current_user_info_shortcode() {
    if (is_user_logged_in()) {

        $user = wp_get_current_user();
        $user_id = $user->ID;
        $user_name = esc_html($user->display_name);
        $user_email = esc_html($user->user_email);
        $mechanic_team_score = get_user_meta($user_id, 'mechanic_team_score', true) ?: [];
        $electronic_team_score = get_user_meta($user_id, 'electronic_team_score', true) ?: [];
        $days_of_work = get_the_author_meta('days_of_work', $user_id) ?: '';
        $distance_traveled = get_the_author_meta('distance_traveled', $user_id) ?: '';
        $average_electronic_score = $electronic_team_score ? array_sum($electronic_team_score) / count($electronic_team_score) : '';
        $average_mechanic_score = $mechanic_team_score ? array_sum($mechanic_team_score) / count($mechanic_team_score) : '';

        // Check if the form is submitted
        if (isset($_POST['submit'])) {
            // Get the selected location value from the form
            $selected_location = sanitize_text_field($_POST['user_reported_location']);

            // Get the current user's ID
            $user_id = get_current_user_id();

            // Update the user meta with the selected location value
            update_user_meta($user_id, 'user_reported_location', $selected_location);
        }
        
        ?>
        <div class="user-cart">
            <div class="user-cart__image">
                <img src="<?php echo get_the_author_meta('profile_image', $user_id) ?: MAGIZ_DASH_POST_URL . 'admin/assets/images/default-profile-image.jpg' ?>" alt="User Image">
            </div>
            <div class="user-cart__info">
                <div class="user-cart__name"><?php echo $user_name; ?></div>
                <div class="user-cart__email"><?php echo $user_email; ?></div>
                <div class="user-cart__days-work">
                    <?php echo $days_of_work; ?>
                    <?php _e(' days of work', 'magiz-dash-post'); ?>
                </div>
                <div class="user-cart__distance-travel">
                    <?php echo $distance_traveled; ?>
                    <?php _e(' km traveled', 'magiz-dash-post'); ?>
                </div>
                <div class="user-cart__team-scores">
                    <div class="user-cart__team-score user-cart__team-score--a">
                        <?php _e('Electronic Team Score: ', 'magiz-dash-post'); ?>
                        <?php echo $average_electronic_score; ?>
                    </div>
                    <div class="user-cart__team-score user-cart__team-score--b">
                        <?php _e('Mechanic Team Score: ', 'magiz-dash-post'); ?>
                        <?php echo $average_mechanic_score; ?>
                    </div>
                </div>

                <!-- Form to report user location -->
                <form method="post" action="">
                <div class="magiz-custom-input">
                    <label for="user_reported_location"><?php _e('Report your location:', 'magiz-dash-post'); ?></label>
                    <select name="user_reported_location" id="user_reported_location">
                        <?php
                        // Get the terms from the "well-location" custom taxonomy
                        $terms = get_terms(array(
                            'taxonomy' => 'well-location',
                            'hide_empty' => false, // Show even if there are no posts assigned
                        ));

                        $selected_value = get_the_author_meta('user_reported_location', $user_id);

                        // Loop through the terms and display them as options
                        foreach ($terms as $term) {

                            $selected = ($term->name === $selected_value) ? 'selected' : '';

                            // Output each term as an option
                            echo '<option value="' . esc_html($term->name) . '" ' . $selected . '>' . esc_html($term->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                    <input type="submit" name="submit" value="<?php _e('Send', 'magiz-dash-post'); ?>">
                </form>

            </div>
        </div>
        <?php
    } else {
        return __('You must be logged in to view this content.', 'magiz-dash-post');
    }
}
add_shortcode('current_user_info', 'magiz_current_user_info_shortcode');