<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function magiz_display_users_shortcode($atts) {
    ob_start();

    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $current_user_role = $current_user->roles[0] ?? '';

    // Define the number of users to display per page
    $users_per_page = 20; // Change this to your desired number

    // Get the current page number
    $current_page = get_query_var('paged') ? get_query_var('paged') : 1;

    // Query users with the 'mechanic_engineer' and 'electronic_engineer' role with pagination
    $users_query = new WP_User_Query(array(
        'role__in'   => array('mechanic_engineer', 'electronic_engineer'),
        'number'     => $users_per_page,
        'paged'      => $current_page,
        'exclude'      => array($current_user_id),
    ));

    // Get the total number of users found
    $total_users = $users_query->get_total();

    // Loop through the users and display them
    if (!empty($users_query->results)) {
        foreach ($users_query->results as $user) {

            $user_id = $user->ID;
            $user_name = esc_html($user->display_name);
            $user_email = esc_html($user->user_email);
            $mechanic_team_score = get_user_meta($user_id, 'mechanic_team_score', true) ?: [];
            $electronic_team_score = get_user_meta($user_id, 'electronic_team_score', true) ?: [];
            $days_of_work = get_the_author_meta('days_of_work', $user_id) ?: '';
            $distance_traveled = get_the_author_meta('distance_traveled', $user_id) ?: '';


            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['score_' . $user_id])) {
                    $new_score = intval($_POST['score_' . $user_id]);

                    if (in_array($current_user_role, array('mechanic_engineer'))) {
                        $mechanic_team_score[$current_user_id] = $new_score;
                        if ($new_score == 0) unset($mechanic_team_score[$current_user_id]);
                        update_user_meta($user_id, 'mechanic_team_score', $mechanic_team_score);
                    }

                    if (in_array($current_user_role, array('electronic_engineer'))) {
                        $electronic_team_score[$current_user_id] = $new_score;
                        if ($new_score == 0) unset($electronic_team_score[$current_user_id]);
                        update_user_meta($user_id, 'electronic_team_score', $electronic_team_score);
                    }
                    
                }
            }

            // Calculate average scores
            $average_electronic_score = $electronic_team_score ? array_sum($electronic_team_score) / count($electronic_team_score) : '';
            $average_mechanic_score = $mechanic_team_score ? array_sum($mechanic_team_score) / count($mechanic_team_score) : '';

            // Calculate current user selected score value
            if (in_array($current_user_role, array('mechanic_engineer'))) {
                $selected_score_value = $mechanic_team_score[$current_user_id] ?? 0 ;
            }
            if (in_array($current_user_role, array('electronic_engineer'))) {
                $selected_score_value = $electronic_team_score[$current_user_id] ?? 0 ;
            }
    
             // Render user information and score form
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
                </div>
                <?php if( ! current_user_can( 'administrator' ) ): ?>
                <form method="post" class="score-form" id="score-form_<?php echo $user_id; ?>">
                    <label for="score_<?php echo $user_id; ?>"><?php _e('Your score: ') ?></label>
                    <select id="score_<?php echo $user_id; ?>" name="score_<?php echo $user_id; ?>">
                        <option value=""><?php _e('You did not score') ?></option>
                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <option value="<?php echo $i; ?>" <?php selected($i, $selected_score_value); ?>><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                </form>
                <?php endif; ?>
            </div>

            <script>
                document.getElementById('score_<?php echo $user_id; ?>').addEventListener('change', function() {
                    document.getElementById('score-form_<?php echo $user_id; ?>').submit();
                });
            </script>

            <?php
        }
    }

    // Output pagination links
    if ($total_users > $users_per_page) {
        echo '<div class="pagination">';
        echo paginate_links(array(
            'base'      => get_pagenum_link(1) . '%_%',
            'format'    => 'page/%#%',
            'current'   => $current_page,
            'total'     => ceil($total_users / $users_per_page),
            'prev_text' => 'صفحه قبل',
            'next_text' => 'صفحه بعد',
        ));
        echo '</div>';
    }

    return ob_get_clean();
}
add_shortcode('magiz_display_users', 'magiz_display_users_shortcode');