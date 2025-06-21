<?php
/**
 * Plugin Name:       Disabled Source, Disabled Right Click and Content Protection
 * Plugin URI:        https://wordpress.org/plugins/disabled-source-disabled-right-click-and-content-protection/
 * Description:       Disabled Source(Ctrl+U), Disabled Right click, Disable F12 functional key, and Disable save the page(Ctrl+S) and Content Protection of your WordPress Website.
 * Version:           1.6.0
 * Requires at least: 4.7
 * Tested up to: 6.8
 * Requires PHP:      5.3
 * Text Domain: disabled-source-disabled-right-click-and-content-protection
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Author:            jahidcse
 * Author URI:        https://profiles.wordpress.org/jahidcse/
 */


// don't load directly
defined( 'ABSPATH' ) || exit;

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

//URL

define( 'JH_URL', plugin_dir_url( __FILE__ ) );
define( 'JH_PATH', plugin_dir_path( __FILE__ ) );

// Init Hook
add_action( 'init', 'jh_disabled_init_global_plugin' );

/**
 * Codestar Framework Integrate
*/

if ( file_exists( JH_PATH . 'includes/admin/framework/codestar-framework.php' ) ) {
  require_once JH_PATH . 'includes/admin/framework/codestar-framework.php';
}

/**
* Global Option Page
*/
function jh_disabled_init_global_plugin() {
  if ( file_exists( JH_PATH . 'includes/admin/options/global.php' ) ) {
    require_once JH_PATH . 'includes/admin/options/global.php';
  }
}


/**
 * Functions include
*/

if ( file_exists( JH_PATH . 'includes/functions/functions.php' ) ) {
    require_once JH_PATH . 'includes/functions/functions.php';
}

/**
 * Admin Notice include
*/

if ( file_exists( JH_PATH . 'includes/functions/notice.php' ) ) {
    require_once JH_PATH . 'includes/functions/notice.php';
}

/**
 * Plugin Settings page
*/

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),'disablde_source_deshboard_settings');

function disablde_source_deshboard_settings( $links ) {
  $link = sprintf( "<a href='%s' style='color:#2271b1;'>%s</a>", admin_url( 'admin.php?page=disabled-source-disabled-right-click-and-content-protection'), __( 'Settings', 'disabled-source-disabled-right-click-and-content-protection' ) );
  array_push( $links, $link );

  return $links;
}