<?php
/**
 * Plugin Name:       Disabled Source, Disabled Right Click and Content Protection
 * Plugin URI:        https://wordpress.org/plugins/disabled-source-disabled-right-click-and-content-protection/
 * Description:       Disabled Source(Ctrl+U), Disabled Right click, Disable F12 functional key, and Disable save the page(Ctrl+S) and Content Protection of your WordPress Website.
 * Version:           1.7.2
 * Requires at least: 4.7
 * Tested up to: 6.9
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
define( 'JH_VERSION', '1.7.2' );

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
  if (class_exists('CTBLOCK_PRO_INIT')) {
    if ( file_exists( CTBLOCK_PRO_PATH . 'includes/admin/options/global.php' ) ) {
      require_once CTBLOCK_PRO_PATH . 'includes/admin/options/global.php';
    }
  }else{
    if ( file_exists( JH_PATH . 'includes/admin/options/global.php' ) ) {
      require_once JH_PATH . 'includes/admin/options/global.php';
    }
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

if ( ! function_exists( 'dsdrcacp_fs' ) && !is_plugin_active( 'disabled-source-disabled-right-click-and-content-protection-pro/ctblock-pro.php' ) ) {
  // Create a helper function for easy SDK access.
  function dsdrcacp_fs() {
      global $dsdrcacp_fs;

      if ( ! isset( $dsdrcacp_fs ) ) {
        if ( !defined( 'WP_FS__PRODUCT_26484_MULTISITE' ) ) {
          define( 'WP_FS__PRODUCT_26484_MULTISITE', true );
        }
        require_once dirname( __FILE__ ) . '/includes/vendor/start.php';
        $dsdrcacp_fs = fs_dynamic_init( array(
            'id'               => '26484',
            'slug'             => 'disabled-source-disabled-right-click-and-content-protection',
            'premium_slug'     => 'disabled-source-disabled-right-click-and-content-protection-pro',
            'type'             => 'plugin',
            'public_key'       => 'pk_8940fc0c5b451b9903dcd9855e5c4',
            'is_premium'       => false,
            'premium_suffix'   => 'Starter',
            'has_addons'       => false,
            'has_paid_plans'   => true,
            'is_org_compliant' => true,
            'menu'             => array(
                'slug'    => 'disabled-source-disabled-right-click-and-content-protection',
                'support' => false,
            ),
            'is_live'          => true,
        ) );
      }

      return $dsdrcacp_fs;
  }

  // Init Freemius.
  dsdrcacp_fs();
  // Signal that SDK was initiated.
  do_action( 'dsdrcacp_fs_loaded' );
}