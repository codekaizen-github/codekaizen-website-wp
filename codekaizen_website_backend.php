<?php

/**
 * @link https://github.com/codekaizen-github/codekaizen-website-backend-wp/blob/main/README.md
 * @since
 * @package CodeKaizen_Website_Backend
 *
 * @wordpress-plugin
 * Plugin Name: CodeKzien Website Backend
 * Plugin URI: https://github.com/codekaizen-github/codekaizen-website-backend-wp
 * Version: 0.1.0
 * Description: A plugin used by the CodeKaizen app.
 * Author: Missie Dawes
 * Author URI: https://github.com/missiedawes
 */

// Define plugin path
define('CK_PLUGIN_PATH', __FILE__);

function ck_debug_log()
{
    if (func_num_args() > 0) {
        $args = func_get_args();
        $results = [];
        $results = array_map(function ($arg) {
            return (print_r($arg, true));
        }, $args);
        $date = date('Y-m-d H:i:s');
        error_log($date . ' | ' . implode(' | ', $results) . "\n", 3, dirname(__FILE__) . '/debug.log');
    }
}

// Core functions
require_once('includes/core/ck_c_cors_override.php');
require_once('includes/core/ck_admin_config.php');

// Custom post types
require_once('includes/custom-post-types/ck_cpt_recipe.php');

// Database
require_once('includes/database/ck_db_ingredients.php');
require_once('includes/database/ck_db_measurements.php');
require_once('includes/database/ck_db_amounts.php');

// Custom fields
require_once('includes/custom-fields/ck_cf_ingredients.php');
require_once('includes/custom-fields/ck_cf_measurements.php');
require_once('includes/custom-fields/ck_cf_amounts.php');

// Styles
function ck_admin_styles()
{
    $plugin_uri = plugins_url('/', __FILE__);
    $src = $plugin_uri . 'assets/css/style.css';
    wp_enqueue_style('ck-admin-styles', $src);
}
add_action('admin_enqueue_scripts', 'ck_admin_styles');
