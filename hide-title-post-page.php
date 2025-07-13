<?php
/**
 * Plugin Name: Hide Title Post Page
 * Description: Allows authors to hide the title tag on single pages and posts via the edit post screen.
 * Version: 1.2
 * Author: Mirza Rizvi Amin
 * Text Domain: hide-title-post-page
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'HTPP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HTPP_URL', plugin_dir_url( __FILE__ ) );

require_once HTPP_PATH . 'includes/class-hide-title-plugin.php';

/**
 * Load plugin translation files.
 *
 * @return void
 */
function htpp_load_textdomain() {
    load_plugin_textdomain( 'hide-title-post-page', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'htpp_load_textdomain' );

/**
 * Bootstrap the Hide Title Post Page plugin.
 *
 * Creates an instance of the main plugin class and executes it after all
 * other plugins have loaded.
 *
 * @return void
 */
function htpp_run_plugin() {
    $plugin = new Hide_Title_Plugin();
    $plugin->run();
}
add_action( 'plugins_loaded', 'htpp_run_plugin', 20 );
