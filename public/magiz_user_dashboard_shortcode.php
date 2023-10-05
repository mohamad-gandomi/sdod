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
                    <label for="user_reported_location"><?php _e('Report your location:', 'magiz-dash-post'); ?></label>
                    <select name="user_reported_location" id="user_reported_location">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
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