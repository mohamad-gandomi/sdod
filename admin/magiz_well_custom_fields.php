<?php

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add the custom well informations fields metabox
function magiz_well_informations_meta_box() {
    add_meta_box(
        'well_informations_metabox',
        __('Well Informations', 'magiz-dash-post'),
        'render_well_informations_metabox',
        'well',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'magiz_well_informations_meta_box');

// Render the well informations fields
function render_well_informations_metabox($post) {

    // Define an array of field names, labels, and input types
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

    // Loop through the fields and display inputs with values from post meta
    foreach ($fields as $field_name => $field_info) {
        $label = $field_info['label'];
        $input_type = $field_info['type'];
        $field_value = get_post_meta($post->ID, $field_name, true);
        ?>
        <div class="magiz-custom-input">
            <label for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($label); ?></label>
            <input type="<?php echo esc_attr($input_type); ?>" id="<?php echo esc_attr($field_name); ?>" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr($field_value); ?>">
        </div>
        <?php
    }
    
}

// Save well fields
function magiz_save_well_field_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Array of custom field names
    $custom_fields = array(
        'client',
        'field-loc',
        'rig-no',
        'well-no',
        'hole-size',
        'declination-conv',
        'total-grid-calc',
        'dip-hl',
        'last-casing-shoe',
        'project-depth',
        'start-date-time',
        'start-depth',
        'end-depth',
        'target-inc-azi'
    );

    // Loop through the custom fields and save their values
    foreach ($custom_fields as $field_name) {
        if (isset($_POST[$field_name])) {
            update_post_meta($post_id, $field_name, sanitize_text_field($_POST[$field_name]));
        }
    }
}
add_action('save_post', 'magiz_save_well_field_data');
