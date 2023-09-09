<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function magiz_new_job_shortcode($atts) {
    ob_start();

    $fields = array(
        'client' => array('label' => __('client', 'magiz-dash-post'), 'type' => 'text'),
        'field-loc' => array('label' => __('field/loc', 'magiz-dash-post'), 'type' => 'text'),
        'rig-no' => array('label' => __('rig no', 'magiz-dash-post'), 'type' => 'text'),
        'well-no' => array('label' => __('well no', 'magiz-dash-post'), 'type' => 'text'),
        'hole-size' => array('label' => __('hole size', 'magiz-dash-post'), 'type' => 'text'),
        'declination-conv' => array('label' => __('declination/conv.', 'magiz-dash-post'), 'type' => 'text'),
        'total-grid-calc' => array('label' => __('total grid calc.', 'magiz-dash-post'), 'type' => 'text'),
        'dip-hl' => array('label' => __('dip/hl', 'magiz-dash-post'), 'type' => 'text'),
        'last-casing-shoe' => array('label' => __('last casing & shoe', 'magiz-dash-post'), 'type' => 'text'),
        'project-depth' => array('label' => __('project depth', 'magiz-dash-post'), 'type' => 'text'),
        'start-date-time' => array('label' => __('start date/time', 'magiz-dash-post'), 'type' => 'text'),
        'start-depth' => array('label' => __('start depth', 'magiz-dash-post'), 'type' => 'text'),
        'end-depth' => array('label' => __('end depth', 'magiz-dash-post'), 'type' => 'text'),
        'target-inc-azi' => array('label' => __('target inc/azi', 'magiz-dash-post'), 'type' => 'text')
    );

    // Check if the user is logged in
    if (is_user_logged_in()) {
        // Display the form here
        ?>
        <form id="magiz-create-well-post" method="post">
            <?php
            foreach ($fields as $field_name => $field_info) {
                $label = $field_info['label'];
                $input_type = $field_info['type'];
                ?>
                <div class="magiz-custom-input">
                    <label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($label); ?></label>
                    <input type="<?php echo esc_attr($input_type); ?>" id="<?php echo esc_attr($field_name); ?>" name="<?php echo esc_attr($field_name); ?>" value="">
                </div>
                <?php
            }
            ?>
            <input type="submit" value="<?php _e('Send', 'magiz-dash-post') ?>" />
        </form>

        <?php
        // Process form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['well-no'])) {
            $post_title = sanitize_text_field($_POST['well-no']);
        
            // Create the custom post
            $post_args = array(
                'post_title' => $post_title,
                'post_type' => 'well',
                'post_status' => 'publish',
            );
        
            $post_id = wp_insert_post($post_args);
        
            // Save the additional fields
            foreach ($fields as $field_name => $field_info) {
                if (isset($_POST[$field_name])) {
                    $field_value = sanitize_text_field($_POST[$field_name]);
                    update_post_meta($post_id, $field_name, $field_value);
                }
            }
        }
    } else {
        _e('Please log in to create the custom post.','magiz-dash-post');
    }

    return ob_get_clean();
}
add_shortcode('magiz-new-job', 'magiz_new_job_shortcode');