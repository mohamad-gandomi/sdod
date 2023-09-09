<?php

/*
 * Plugin Name:       Magiz Dash Post
 * Plugin URI:        https://magiztech.com/plugins/magiz-dash-post/
 * Description:       Create a user front dashboard panel and create or updare posts
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mohamad Gandomi
 * Author URI:        https://magiztech.com/mohamad-gandomi
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       magiz-dash-post
 * Domain Path:       /languages
 */

// Security check to prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants for file paths
define('MAGIZ_DASH_POST_DIR', plugin_dir_path(__FILE__));
define('MAGIZ_DASH_POST_URL', plugin_dir_url(__FILE__));

// Localization
function magiz_dash_post_load_textdomain() {
    load_plugin_textdomain('magiz-dash-post', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'magiz_dash_post_load_textdomain');

// Include public files
require_once(MAGIZ_DASH_POST_DIR . 'public/magiz_public_enqueues.php');
require_once(MAGIZ_DASH_POST_DIR . 'public/magiz_user_dashboard_shortcode.php');
require_once(MAGIZ_DASH_POST_DIR . 'public/magiz_users_score_shortcode.php');
require_once(MAGIZ_DASH_POST_DIR . 'public/magiz_new_job_shortcode.php');

// Include admin files
require_once(MAGIZ_DASH_POST_DIR . 'admin/magiz_admin_enqueues.php');
require_once(MAGIZ_DASH_POST_DIR . 'admin/magiz_user_custom_fields.php');
require_once(MAGIZ_DASH_POST_DIR . 'admin/magiz_create_user_roles.php');
require_once(MAGIZ_DASH_POST_DIR . 'admin/magiz_well_post_type.php');
require_once(MAGIZ_DASH_POST_DIR . 'admin/magiz_well_custom_fields.php');
