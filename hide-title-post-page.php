<?php
/**
 * Plugin Name: Hide Title Post Page
 * Description: Allows authors to hide the title tag on single pages and posts via the edit post screen.
 * Version: 1.1
 * Author: Mirza Rizvi Amin
 * Text Domain: hide-title-post-page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'HTPP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HTPP_URL', plugin_dir_url( __FILE__ ) );

require_once HTPP_PATH . 'includes/class-hide-title-plugin.php';

function htpp_run_plugin() {
    $plugin = new Hide_Title_Plugin();
    $plugin->run();
}
add_action( 'plugins_loaded', 'htpp_run_plugin' );
