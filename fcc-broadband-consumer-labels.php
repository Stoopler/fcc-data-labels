<?php
/**
 * Plugin Name: FCC Broadband Consumer Labels
 * Description: A plugin to create and manage FCC Broadband Consumer Labels with comprehensive data entry forms, company configurations, and shortcode generation for easy display in posts.
 * Version: 1.1.4
 * Author: Tyler Weinrich
 * License: GPLv2 or later
 * Text Domain: fcc-bcl
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Define plugin version - this is the single source of truth
define('FCC_BCL_VERSION', '1.1.4');

// Other constant definitions remain the same
define('FCC_BCL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FCC_BCL_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once FCC_BCL_PLUGIN_DIR . 'includes/class-fcc-bcl-activator.php';
require_once FCC_BCL_PLUGIN_DIR . 'includes/class-fcc-bcl-deactivator.php';
require_once FCC_BCL_PLUGIN_DIR . 'includes/class-fcc-bcl.php';

// Register activation and deactivation hooks
register_activation_hook(__FILE__, array('FCC_BCL_Activator', 'activate'));
register_deactivation_hook(__FILE__, array('FCC_BCL_Deactivator', 'deactivate'));

// Add upgrade check
add_action('plugins_loaded', array('FCC_BCL_Activator', 'check_version'));

/**
 * Begins execution of the plugin.
 *
 * @since 1.0.0
 */
function run_fcc_bcl() {
    $plugin = new FCC_BCL();
    $plugin->run();
}
run_fcc_bcl();