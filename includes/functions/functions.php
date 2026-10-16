<?php 
// don't load directly
defined( 'ABSPATH' ) || exit;

/**
 * Admin assets Enqueue
*/

add_action('admin_enqueue_scripts', 'disabled_source_admin_page_script');
function disabled_source_admin_page_script(){
	wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/admin/assets/css/admin.css', false, JH_VERSION);
	wp_enqueue_script( 'disabled-source-admin-js', JH_URL.'includes/admin/assets/js/admin.js', array('jquery'), JH_VERSION, true );
}


/**
 * Front End assets Enqueue
*/

add_action('wp_enqueue_scripts', 'disabled_source_front_page_script', 100);
function disabled_source_front_page_script(){

	$jhdoption = get_option( 'jh_disabled_option' );
	if (!is_user_logged_in() ){
		if( apply_filters( 'jh_disable_pages_permission', $pages_permission = '') && apply_filters( 'jh_disable_post_type_permission', $post_type_permission = '') ){

			if( !empty($jhdoption['disabled-content-select']) && $jhdoption['disabled-content-select']=="1" ){
				wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/assets/css/style.css', false, JH_VERSION);
			}
			if( !empty($jhdoption['disabled-notification-status']) && $jhdoption['disabled-notification-status']=="1" ){
				wp_enqueue_script( 'notify-js', JH_URL.'includes/assets/js/notify.min.js', array('jquery'), '1.1.3', true );
			}

			wp_enqueue_script( 'disabled-source-and-content-protection-js', JH_URL.'includes/assets/js/protection.js', array('jquery'), JH_VERSION, true );
			$jh_disabled_options_data_pass = array(
				'disabled_click' => !empty( $jhdoption['disabled-right-click'] ) ? $jhdoption['disabled-right-click'] : '',
				'disabled_ct_u' => !empty( $jhdoption['disabled-ct-u'] ) ? $jhdoption['disabled-ct-u'] : '',
				'disabled_f12' => !empty( $jhdoption['disabled-f12'] ) ? $jhdoption['disabled-f12'] : '',
				'disabled_ctst_i' => !empty( $jhdoption['disabled-ct-st-i'] ) ? $jhdoption['disabled-ct-st-i'] : '',
				'disabled_ctst_j' => !empty( $jhdoption['disabled-ct-st-j'] ) ? $jhdoption['disabled-ct-st-j'] : '',
				'disabled_ctst_c' => !empty( $jhdoption['disabled-ct-st-c'] ) ? $jhdoption['disabled-ct-st-c'] : '',
				'disabled_ct_s' => !empty( $jhdoption['disabled-ct-s'] ) ? $jhdoption['disabled-ct-s'] : '',
				'disabled_dragging_img' => !empty( $jhdoption['disabled-img-drag'] ) ? $jhdoption['disabled-img-drag'] : '',
				'disabled_notifi_status' => !empty( $jhdoption['disabled-notification-status'] ) ? $jhdoption['disabled-notification-status'] : '',
				'disabled_notifi_text' => !empty( $jhdoption['disabled-notify-text'] ) ? $jhdoption['disabled-notify-text'] : '',
				'disabled_notifi_position' => !empty( $jhdoption['disabled-notification-position'] ) ? $jhdoption['disabled-notification-position'] : 'right center',
				'disabled_ct_p' => !empty( $jhdoption['disabled-ct-p'] ) ? $jhdoption['disabled-ct-p'] : ''
			);
			wp_localize_script( 'disabled-source-and-content-protection-js', 'jh_disabled_options_data', $jh_disabled_options_data_pass );
		}
	}else{
		if( apply_filters( 'jh_disable_roles_permission', $roles_permission = '')){
			if( apply_filters( 'jh_disable_pages_permission', $pages_permission = '') && apply_filters( 'jh_disable_post_type_permission', $post_type_permission = '') ){
				
				if( !empty($jhdoption['disabled-content-select']) && $jhdoption['disabled-content-select']=="1" ){
					wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/assets/css/style.css', false, JH_VERSION);
				}
				if( !empty($jhdoption['disabled-notification-status']) && $jhdoption['disabled-notification-status']=="1" ){
					wp_enqueue_script( 'notify-js', JH_URL.'includes/assets/js/notify.min.js', array('jquery'), '1.1.3', true );
				}
				
				wp_enqueue_script( 'disabled-source-and-content-protection-js', JH_URL.'includes/assets/js/protection.js', array('jquery'), JH_VERSION, true );
				$jh_disabled_options_data_pass = array(
					'disabled_click' => !empty( $jhdoption['disabled-right-click'] ) ? $jhdoption['disabled-right-click'] : '',
					'disabled_ct_u' => !empty( $jhdoption['disabled-ct-u'] ) ? $jhdoption['disabled-ct-u'] : '',
					'disabled_f12' => !empty( $jhdoption['disabled-f12'] ) ? $jhdoption['disabled-f12'] : '',
					'disabled_ctst_i' => !empty( $jhdoption['disabled-ct-st-i'] ) ? $jhdoption['disabled-ct-st-i'] : '',
					'disabled_ctst_j' => !empty( $jhdoption['disabled-ct-st-j'] ) ? $jhdoption['disabled-ct-st-j'] : '',
					'disabled_ctst_c' => !empty( $jhdoption['disabled-ct-st-c'] ) ? $jhdoption['disabled-ct-st-c'] : '',
					'disabled_ct_s' => !empty( $jhdoption['disabled-ct-s'] ) ? $jhdoption['disabled-ct-s'] : '',
					'disabled_dragging_img' => !empty( $jhdoption['disabled-img-drag'] ) ? $jhdoption['disabled-img-drag'] : '',
					'disabled_notifi_status' => !empty( $jhdoption['disabled-notification-status'] ) ? $jhdoption['disabled-notification-status'] : '',
					'disabled_notifi_text' => !empty( $jhdoption['disabled-notify-text'] ) ? $jhdoption['disabled-notify-text'] : '',
					'disabled_notifi_position' => !empty( $jhdoption['disabled-notification-position'] ) ? $jhdoption['disabled-notification-position'] : 'right center',
					'disabled_ct_p' => !empty( $jhdoption['disabled-ct-p'] ) ? $jhdoption['disabled-ct-p'] : ''
				);
				wp_localize_script( 'disabled-source-and-content-protection-js', 'jh_disabled_options_data', $jh_disabled_options_data_pass );
			}
		}
	}
}


/**
 * Front End Comments Control
*/

$jh_disabled_options = get_option( 'jh_disabled_option' );

if( !empty($jh_disabled_options['disabled-comments']) && $jh_disabled_options['disabled-comments']=="1" ){

	add_action('admin_init', function () {

	    // Remove comments metabox from dashboard
	    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	    // Disable support for comments and trackbacks in post types
	    foreach (get_post_types() as $post_type) {
	        if (post_type_supports($post_type, 'comments')) {
	            remove_post_type_support($post_type, 'comments');
	            remove_post_type_support($post_type, 'trackbacks');
	        }
	    }
	});

	// Close comments on the front-end
	add_filter('comments_open', '__return_false', 20, 2);
	add_filter('pings_open', '__return_false', 20, 2);

	// Hide existing comments
	add_filter('comments_array', '__return_empty_array', 10, 2);

}

function jh_getvisitor_IP() {
	$ip = '';
	if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip_list = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
		$ip = trim( $ip_list[0] );
	} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return sanitize_text_field( $ip );
}


/**
 * Get the country code for the current admin user (cached via transient).
 * Returns a 2-letter ISO country code string, or empty string on failure.
 */
function jh_get_admin_country_code() {
	if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
		return '';
	}

	$admin_id  = get_current_user_id();
	$cache_key = 'jh_admin_country_code_' . ( $admin_id ? $admin_id : 'main' );
	$cached    = get_transient( $cache_key );
	if ( false !== $cached ) {
		return $cached;
	}

	// Check Cloudflare or server GeoIP headers first
	$header_keys = array( 'HTTP_CF_IPCOUNTRY', 'GEOIP_COUNTRY_CODE', 'HTTP_X_COUNTRY_CODE' );
	foreach ( $header_keys as $key ) {
		if ( ! empty( $_SERVER[ $key ] ) && strlen( $_SERVER[ $key ] ) === 2 ) {
			$country = strtoupper( sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) );
			set_transient( $cache_key, $country, DAY_IN_SECONDS );
			return $country;
		}
	}

	$admin_ip = jh_getvisitor_IP();
	$is_local = empty( $admin_ip ) || in_array( $admin_ip, array( '127.0.0.1', '::1' ), true ) || filter_var( $admin_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) === false;

	// ip-api.com free tier requires http:// (https returns SSL unavailable)
	$api_url = 'http://ip-api.com/json/' . ( $is_local ? '' : rawurlencode( $admin_ip ) );

	$response = wp_remote_get( $api_url, array(
		'timeout'     => 3,
		'httpversion' => '1.1',
		'headers'     => array( 'Accept' => 'application/json' ),
	) );

	if ( is_wp_error( $response ) ) {
		return '';
	}

	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body, true );

	$country_code = ( ! empty( $data['countryCode'] ) && strlen( $data['countryCode'] ) === 2 ) ? strtoupper( sanitize_text_field( $data['countryCode'] ) ) : '';

	if ( ! empty( $country_code ) ) {
		set_transient( $cache_key, $country_code, DAY_IN_SECONDS );
	}

	return $country_code;
}

/**
 * Get visitor country code safely with header checks, cookie caching, and fallback API.
 */
function jh_get_visitor_country_code() {
	// 1. Server / CDN headers (Fastest & 0 external calls)
	$header_keys = array( 'HTTP_CF_IPCOUNTRY', 'GEOIP_COUNTRY_CODE', 'HTTP_X_COUNTRY_CODE' );
	foreach ( $header_keys as $key ) {
		if ( ! empty( $_SERVER[ $key ] ) && strlen( $_SERVER[ $key ] ) === 2 ) {
			return strtoupper( sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) );
		}
	}

	$visitor_ip = jh_getvisitor_IP();
	$ip_hash    = substr( md5( $visitor_ip ), 0, 8 );

	// 2. Cookie check (Bound to IP hash so switching VPN country invalidates immediately)
	if ( ! empty( $_COOKIE['jh_visitor_country_code'] ) ) {
		$cookie_parts = explode( ':', sanitize_text_field( wp_unslash( $_COOKIE['jh_visitor_country_code'] ) ) );
		if ( count( $cookie_parts ) === 2 && $cookie_parts[0] === $ip_hash && strlen( $cookie_parts[1] ) === 2 ) {
			return strtoupper( $cookie_parts[1] );
		}
	}

	// 3. Fallback to API (ip-api.com free tier requires http://)
	$is_local = empty( $visitor_ip ) || in_array( $visitor_ip, array( '127.0.0.1', '::1' ), true ) || filter_var( $visitor_ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) === false;

	// When testing on localhost with VPN, calling without IP allows ip-api.com to detect the machine's active VPN IP
	$api_url = 'http://ip-api.com/json/' . ( $is_local ? '' : rawurlencode( $visitor_ip ) );

	$response = wp_remote_get( $api_url, array(
		'timeout'     => 3,
		'httpversion' => '1.1',
		'headers'     => array( 'Accept' => 'application/json' ),
	) );

	if ( is_wp_error( $response ) ) {
		return '';
	}

	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body, true );

	$country_code = ( ! empty( $data['countryCode'] ) && strlen( $data['countryCode'] ) === 2 ) ? strtoupper( sanitize_text_field( $data['countryCode'] ) ) : '';

	if ( ! empty( $country_code ) && ! headers_sent() ) {
		$cookie_val    = $ip_hash . ':' . $country_code;
		$cookie_path   = defined( 'COOKIEPATH' ) && COOKIEPATH ? COOKIEPATH : '/';
		$cookie_domain = defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '';
		@setcookie( 'jh_visitor_country_code', $cookie_val, time() + DAY_IN_SECONDS, $cookie_path, $cookie_domain, is_ssl(), true );
	}

	return $country_code;
}

/**
 * Automatically clean up legacy transient bloat created in previous versions
 */
add_action( 'admin_init', 'jh_cleanup_legacy_country_transients' );
function jh_cleanup_legacy_country_transients() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( get_option( 'jh_cleaned_country_transients_v1' ) ) {
		return;
	}

	global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_jh_admin_country_%' OR option_name LIKE '_transient_timeout_jh_admin_country_%'" );

	update_option( 'jh_cleaned_country_transients_v1', 1, false );
}

add_action('init','jh_visitor_address_checker');
function jh_visitor_address_checker(){
	// Never block on admin dashboard, login pages, or for administrators
	$is_login = function_exists( 'jh_is_login_page' ) ? jh_is_login_page() : ( ! empty( $GLOBALS['pagenow'] ) && in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ), true ) );
	if ( is_admin() || $is_login || current_user_can( 'manage_options' ) ) {
		return;
	}

	$jh_disabled_ip_address = get_option( 'jh_disabled_option' );
	if ( empty( $jh_disabled_ip_address ) || ! is_array( $jh_disabled_ip_address ) ) {
		return;
	}

	/**
	 * IP Address Blocked Message
	*/
	if ( ! empty( $jh_disabled_ip_address['disabled_ip_section'] ) && is_array( $jh_disabled_ip_address['disabled_ip_section'] ) ) {
		$jh_visitor_ip = trim( jh_getvisitor_IP() );
		$jh_disabled_ip_address_list = array();
		foreach ( $jh_disabled_ip_address['disabled_ip_section'] as $singleip ) {
			if ( ! empty( $singleip['disabled_ip'] ) ) {
				$jh_disabled_ip_address_list[] = trim( $singleip['disabled_ip'] );
			}
		}

		if ( ! empty( $jh_visitor_ip ) && in_array( $jh_visitor_ip, $jh_disabled_ip_address_list, true ) ) {
			?>
			<div class="jh-blocked-msg-page" style="background: <?php echo !empty($jh_disabled_ip_address['ip_disable_background']) ? esc_attr($jh_disabled_ip_address['ip_disable_background']) : '#222'; ?>;position: fixed;left: 0;top: 0;width: 100%;height: 100vh;display: flex;align-items: center;justify-content: center;">
			<span style="color: <?php echo !empty($jh_disabled_ip_address['ip_disable_color']) ? esc_attr($jh_disabled_ip_address['ip_disable_color']) : 'red'; ?>;font-size: 30px;padding: 0 20px;">
			<?php echo !empty( $jh_disabled_ip_address['disabled-ip-notify-text'] ) ? esc_html($jh_disabled_ip_address['disabled-ip-notify-text']) : 'Your IP is blocked !'; ?>
			<span> 
			</div>
			<?php
			exit();
			wp_die();
		}
	}

	/**
	 * Country Blocked Message
	*/
	if ( ! empty( $jh_disabled_ip_address['disabled_ip_country'] ) && is_array( $jh_disabled_ip_address['disabled_ip_country'] ) ) {
		$visitor_country = jh_get_visitor_country_code();
		if ( ! empty( $visitor_country ) && in_array( $visitor_country, $jh_disabled_ip_address['disabled_ip_country'], true ) ) {
			?>
			<div class="jh-blocked-msg-page" style="background: <?php echo !empty($jh_disabled_ip_address['country_disable_background']) ? esc_attr($jh_disabled_ip_address['country_disable_background']) : '#222'; ?>;position: fixed;left: 0;top: 0;width: 100%;height: 100vh;display: flex;align-items: center;justify-content: center;">
			<span style="color: <?php echo !empty($jh_disabled_ip_address['country_disable_color']) ? esc_attr($jh_disabled_ip_address['country_disable_color']) : 'red'; ?>;font-size: 30px;padding: 0 20px;">
			<?php echo !empty( $jh_disabled_ip_address['disabled-country-notify-text'] ) ? esc_html($jh_disabled_ip_address['disabled-country-notify-text']) : 'Your Country are blocked !'; ?>
			<span> 
			</div>
			<?php
			exit();
			wp_die();
		}
	}

    /**
	 * Maintenance Mode Message
	*/
	if ( ! is_admin() && ! jh_is_login_page() ) {
	    if (!empty($jh_disabled_ip_address['enabled-maintenance']) && $jh_disabled_ip_address['enabled-maintenance']=="1" ) {
	    	
			echo '<div class="jh-blocked-msg-page" style="background: #222;position: fixed;left: 0;top: 0;width: 100%;height: 100vh;display: flex;align-items: center;justify-content: center;">';
			echo '<span style="color: red;font-size: 30px;padding: 0 20px;">';
			echo !empty( $jh_disabled_ip_address['maintenance-text'] ) ? esc_html($jh_disabled_ip_address['maintenance-text']) : 'Our Website is under Maintenance, We will get back to you Soon.';
			echo '<span>';
			echo '</div>';
			exit();
			wp_die();
				
	    }
	}
}

/**
 * Maintenance Accessable Setting
*/
if ( !function_exists( 'jh_is_login_page' ) ) {
	function jh_is_login_page() {
	    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
	}
}

add_action('wp_head','jh_disable_notifcation_style');
function jh_disable_notifcation_style(){
	$jh_disabled_notifications= get_option( 'jh_disabled_option' );
	if( !empty($jh_disabled_notifications['disabled-notify-background']) || !empty($jh_disabled_notifications['disabled-notify-color']) ){
		echo '<style>
		.notifyjs-bootstrap-base {
			background-color: ' .esc_attr($jh_disabled_notifications['disabled-notify-background']). ' !important;
			border-color: ' .esc_attr($jh_disabled_notifications['disabled-notify-background']). '!important;
			color: ' .esc_attr($jh_disabled_notifications['disabled-notify-color']). '!important;
			background-position: 3px 10px !important;
		}
		</style>';
	}
}

// Permission by roles
add_filter('jh_disable_roles_permission', 'jh_disable_roles_wise_permission_callback');
function jh_disable_roles_wise_permission_callback($roles_permission){
	$jhdoption = get_option( 'jh_disabled_option' );
	$permission_roles = !empty($jhdoption['disable-roles']) && 'customer'!=$jhdoption['disable-roles'] ? $jhdoption['disable-roles'] : ['customer'];

	if( is_user_logged_in() ){
		$jh_user = wp_get_current_user();
        if( !empty($jh_user->roles[0]) && !empty($permission_roles) && in_array($jh_user->roles[0], $permission_roles)){
			return true;
		}else{
			return false;
		}
	}
}

// Permission by pages
add_filter('jh_disable_pages_permission', 'jh_disable_pages_wise_permission_callback');
function jh_disable_pages_wise_permission_callback($pages_permission){
	$jhdoption = get_option( 'jh_disabled_option' );
	$permission_pages = !empty($jhdoption['disable-pages']) ? $jhdoption['disable-pages'] : ['all'];
	$permission_post_types = !empty($jhdoption['disable-post-type']) ? $jhdoption['disable-post-type'] : '';
	
	if ( $permission_pages === ['all'] ) {
		if( !empty($permission_pages) && in_array('all', $permission_pages)){
			return true;
		}elseif( !empty($permission_pages) && in_array(get_the_ID(), $permission_pages) ){
			return true;
		}else{
			if( empty($permission_post_types) && is_single() ){
				return true;
			}elseif( !empty($permission_post_types) && is_single() ){
				if( in_array(get_post_type(), $permission_post_types)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}else{
		if (is_front_page()) {
			if( !empty($permission_pages) && in_array('jh_disable_front', $permission_pages)){
				return true;
			}
		}else{
			if( !empty($permission_pages) && in_array('all', $permission_pages)){
				return true;
			}elseif( !empty($permission_pages) && in_array(get_the_ID(), $permission_pages) ){
				return true;
			}else{
				if( empty($permission_post_types) && is_single() ){
					return true;
				}elseif( !empty($permission_post_types) && is_single() ){
					if( in_array(get_post_type(), $permission_post_types)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}
		}
	}
}

// Permission by post type
add_filter('jh_disable_post_type_permission', 'jh_disable_post_type_permission_callback');
function jh_disable_post_type_permission_callback($post_type_permission){
	$jhdoption = get_option( 'jh_disabled_option' );
	$permission_post_types = !empty($jhdoption['disable-post-type']) ? $jhdoption['disable-post-type'] : '';

	if ( is_single() ){
		
		if(!empty($permission_post_types)){
			if( in_array(get_post_type(), $permission_post_types)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
		
	}else{
		return true;
	}
}

add_action( 'admin_init', 'jh_disable_check_frontend_post_types' );
function jh_disable_check_frontend_post_types() {
  $post_types = get_post_types( 
      array( 
          'public' => true, 
          'publicly_queryable' => true 
      ), 
      'objects' 
  );
  $all_post_types = [];
  if(!empty($post_types)){
	unset( $post_types['attachment'] );
	foreach ( $post_types as $post_type ) {
		$all_post_types[ $post_type->name ] = $post_type->label;
	}
  }
  
  // Retrieve the current saved option value
  $current_saved_value = get_option('jh_disable_post_types');

  // Only update if there is a difference
  if ($current_saved_value !== $all_post_types) {
	update_option('jh_disable_post_types', $all_post_types);
  }
}

if ( ! function_exists( 'disable_get_all_author_roles' ) ) {
	function disable_get_all_author_roles() {
		$roles = wp_roles()->get_names();
    $all_roles = [];
    foreach ($roles as $role => $name) {
      if("administrator"!=$role){
        $all_roles[$role] = $name;
      }
    }
    return $all_roles;
	}
}

if ( ! function_exists( 'disable_get_all_pages' ) ) {
	function disable_get_all_pages() {
		// Get all pages
		$pages = get_pages();
		
		$all_pages = ['jh_disable_front' => 'Front Page -- Home Page'];

		foreach ( $pages as $page ) {
			$all_pages[$page->ID] = $page->post_title;
		}
		return $all_pages;
	}
}

// Post Type
if ( ! function_exists( 'disable_get_all_post_type' ) ) {
	function disable_get_all_post_type() {
    $all_post_types =  get_option('jh_disable_post_types');
    return $all_post_types;
	}
}

if ( ! function_exists( 'magic_login_callback' ) ) {
	function magic_login_callback() {
		$users = get_users( [
			'orderby' => 'display_name',
			'order'   => 'ASC',
			'fields'  => [ 'ID', 'display_name', 'user_login' ],
		] );

		$is_pro = class_exists( 'CTBlock_Magic_Login' );
		$links  = $is_pro ? CTBlock_Magic_Login::get_active_links() : [];
		$nonce  = wp_create_nonce( 'jh_magic_login_nonce' );
		?>
		<div class="jh-magic-wrap <?php echo ! $is_pro ? 'jh-magic-wrap-disabled' : ''; ?>">

			<!-- Header -->
			<div class="jh-magic-header">
				<div class="jh-magic-header-icon">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M15 4V2"></path>
						<path d="M15 16v-2"></path>
						<path d="M8 9h2"></path>
						<path d="M20 9h2"></path>
						<path d="M17.8 11.8 19 13"></path>
						<path d="M15 9h0"></path>
						<path d="M17.8 6.2 19 5"></path>
						<path d="m3 21 9-9"></path>
						<path d="M12.2 6.2 11 5"></path>
					</svg>
				</div>
				<div class="jh-magic-header-text">
					<h3><?php esc_html_e( 'Magic Login (Temporary Passwordless Access)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></h3>
					<p><?php esc_html_e( 'Generate password-free, time-limited login links for any user role. Perfect for granting instant, temporary access to developers, clients, or support teams without sharing passwords.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
				</div>
			</div>

			<!-- Form Card -->
			<div class="jh-magic-card">
				<h4 class="jh-magic-card-title">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
					<?php esc_html_e( 'Generate New Magic Login Link', 'disabled-source-disabled-right-click-and-content-protection' ); ?>
				</h4>

				<div id="jh-magic-login-form">
					<input type="hidden" id="jh_magic_login_nonce" name="_nonce" value="<?php echo esc_attr( $nonce ); ?>">
					<div class="jh-magic-grid">

						<!-- User Select -->
						<div class="jh-magic-form-group">
							<label for="jh-ml-user"><?php esc_html_e( 'Select User', 'disabled-source-disabled-right-click-and-content-protection' ); ?> <span class="jh-required">*</span></label>
							<select name="user_id" id="jh-ml-user" class="jh-magic-select" <?php disabled( ! $is_pro ); ?> required>
								<option value=""><?php esc_html_e( '— Choose a user —', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<?php foreach ( $users as $u ) : 
									$user_obj  = get_userdata( $u->ID );
									$user_role = ( $user_obj && ! empty( $user_obj->roles ) ) ? ucfirst( reset( $user_obj->roles ) ) : 'User';
								?>
									<option value="<?php echo esc_attr( $u->ID ); ?>">
										<?php echo esc_html( $u->display_name . ' (' . $u->user_login . ') — ' . $user_role ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>

						<!-- Expiration -->
						<div class="jh-magic-form-group">
							<label for="jh-ml-duration"><?php esc_html_e( 'Link Expires In', 'disabled-source-disabled-right-click-and-content-protection' ); ?></label>
							<select name="duration" id="jh-ml-duration" class="jh-magic-select" <?php disabled( ! $is_pro ); ?>>
								<option value="1h"><?php esc_html_e( '1 Hour', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="24h" selected><?php esc_html_e( '24 Hours (1 Day)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="7d"><?php esc_html_e( '7 Days (1 Week)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="30d"><?php esc_html_e( '30 Days (1 Month)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
							</select>
						</div>

						<!-- Max Uses -->
						<div class="jh-magic-form-group">
							<label for="jh-ml-max-uses"><?php esc_html_e( 'Max Allowed Uses', 'disabled-source-disabled-right-click-and-content-protection' ); ?></label>
							<select name="max_uses" id="jh-ml-max-uses" class="jh-magic-select" <?php disabled( ! $is_pro ); ?>>
								<option value="1" selected><?php esc_html_e( '1 — Single use (Recommended)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="0"><?php esc_html_e( '0 — Unlimited uses until expired', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="5"><?php esc_html_e( '5 uses', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="10"><?php esc_html_e( '10 uses', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
							</select>
						</div>

						<!-- Label / Note -->
						<div class="jh-magic-form-group">
							<label for="jh-ml-label"><?php esc_html_e( 'Label / Purpose (Optional)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></label>
							<input type="text" name="label" id="jh-ml-label" class="jh-magic-input" placeholder="<?php esc_attr_e( 'e.g. Developer Access, Client Preview', 'disabled-source-disabled-right-click-and-content-protection' ); ?>" <?php disabled( ! $is_pro ); ?>>
						</div>

						<!-- Redirect Target -->
						<div class="jh-magic-form-group jh-magic-grid-full">
							<label for="jh-ml-redirect"><?php esc_html_e( 'Redirect After Login', 'disabled-source-disabled-right-click-and-content-protection' ); ?></label>
							<select name="redirect_to" id="jh-ml-redirect" class="jh-magic-select" <?php disabled( ! $is_pro ); ?>>
								<option value="<?php echo esc_attr( admin_url() ); ?>"><?php esc_html_e( 'WP Admin Dashboard (Default)', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
								<option value="<?php echo esc_attr( home_url( '/' ) ); ?>"><?php esc_html_e( 'Website Homepage', 'disabled-source-disabled-right-click-and-content-protection' ); ?></option>
							</select>
						</div>

					</div>

					<?php if ( $is_pro ) : ?>
					<div class="jh-magic-actions">
						<button type="button" id="jh-magic-generate-btn" class="jh-magic-btn jh-magic-btn-primary">
							<svg class="jh-btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 4V2"></path><path d="M15 16v-2"></path><path d="M8 9h2"></path><path d="M20 9h2"></path><path d="M17.8 11.8 19 13"></path><path d="M15 9h0"></path><path d="M17.8 6.2 19 5"></path><path d="m3 21 9-9"></path></svg>
							<span class="jh-btn-text"><?php esc_html_e( 'Generate Magic Login Link', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
							<span class="jh-btn-spinner" style="display:none;"></span>
						</button>
					</div>
					<?php endif; ?>

				</div>

				<!-- Success Result Box -->
				<div id="jh-magic-result-card" class="jh-magic-result-card" style="display:none;">
					<div class="jh-magic-result-header">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
						<span id="jh-magic-result-message"><?php esc_html_e( 'Magic login link created successfully!', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
					</div>
					<div id="jh-magic-result-meta" class="jh-magic-result-meta"></div>
					<div class="jh-magic-result-url-wrap">
						<input type="text" id="jh-magic-result-url" class="jh-magic-result-input" readonly>
						<button type="button" id="jh-magic-copy-main-btn" class="jh-magic-btn jh-magic-btn-copy">
							<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
							<span class="jh-copy-text"><?php esc_html_e( 'Copy Link', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
						</button>
					</div>
				</div>
			</div>

			<!-- Active Links Card -->
			<div class="jh-magic-card" style="margin-top: 24px;">
				<div class="jh-magic-card-header">
					<h4 class="jh-magic-card-title">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
						<?php esc_html_e( 'Active Temporary Login Links', 'disabled-source-disabled-right-click-and-content-protection' ); ?>
					</h4>
					<span id="jh-magic-count-badge" class="jh-magic-badge"><?php echo count( $links ); ?></span>
				</div>

				<div id="jh-magic-table-wrap" class="jh-magic-table-wrap">
					<?php if ( empty( $links ) ) : ?>
						<div id="jh-magic-empty-state" class="jh-magic-empty-state">
							<svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#6b7280" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><path d="m4.93 4.93 14.14 14.14"></path></svg>
							<p><?php esc_html_e( 'No active temporary login links.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
							<span><?php esc_html_e( 'Use the form above to generate a passwordless magic login link.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
						</div>
					<?php else : ?>
						<table class="jh-magic-table" id="jh-magic-table">
							<thead>
								<tr>
									<th>#</th>
									<th><?php esc_html_e( 'User / Label', 'disabled-source-disabled-right-click-and-content-protection' ); ?></th>
									<th><?php esc_html_e( 'Expires In', 'disabled-source-disabled-right-click-and-content-protection' ); ?></th>
									<th><?php esc_html_e( 'Usage', 'disabled-source-disabled-right-click-and-content-protection' ); ?></th>
									<th><?php esc_html_e( 'Magic Link', 'disabled-source-disabled-right-click-and-content-protection' ); ?></th>
									<th><?php esc_html_e( 'Actions', 'disabled-source-disabled-right-click-and-content-protection' ); ?></th>
								</tr>
							</thead>
							<tbody id="jh-magic-tbody">
								<?php foreach ( $links as $i => $link ) :
									$link_user  = get_userdata( $link['user_id'] );
									$login_url  = class_exists( 'CTBlock_Magic_Login' ) ? CTBlock_Magic_Login::get_login_url( $link['token'] ) : add_query_arg( 'jh_magic_login', rawurlencode( $link['token'] ), home_url( '/' ) );
									$user_role  = ( $link_user && ! empty( $link_user->roles ) ) ? ucfirst( reset( $link_user->roles ) ) : 'User';
									$uses_text  = ( isset( $link['max_uses'] ) && $link['max_uses'] > 0 ) ? ( $link['use_count'] . ' / ' . $link['max_uses'] ) : ( $link['use_count'] . ' / ∞' );
									$is_soon    = ( $link['expires'] - time() ) < 3600;
								?>
									<tr id="jh-ml-row-<?php echo esc_attr( $link['token'] ); ?>" data-token="<?php echo esc_attr( $link['token'] ); ?>">
										<td class="jh-ml-num"><?php echo absint( $i + 1 ); ?></td>
										<td>
											<strong class="jh-ml-user-name">
												<?php echo $link_user ? esc_html( $link_user->display_name ) : esc_html__( '(Deleted User)', 'disabled-source-disabled-right-click-and-content-protection' ); ?>
											</strong>
											<div class="jh-ml-user-meta">
												<span class="jh-ml-role-chip"><?php echo esc_html( $user_role ); ?></span>
												<?php if ( ! empty( $link['label'] ) ) : ?>
													<span class="jh-ml-label-text">"<?php echo esc_html( $link['label'] ); ?>"</span>
												<?php endif; ?>
											</div>
										</td>
										<td>
											<span class="jh-ml-date <?php echo $is_soon ? 'jh-ml-soon' : ''; ?>">
												<?php echo esc_html( date_i18n( 'M j, Y g:i a', $link['expires'] ) ); ?>
											</span>
											<?php if ( $is_soon ) : ?>
												<span class="jh-ml-soon-tag"><?php esc_html_e( 'Expiring Soon', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
											<?php endif; ?>
										</td>
										<td>
											<span class="jh-ml-usage"><?php echo esc_html( $uses_text ); ?></span>
										</td>
										<td>
											<button type="button" class="jh-magic-btn jh-magic-btn-sm jh-magic-row-copy-btn" data-url="<?php echo esc_attr( $login_url ); ?>">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
												<span class="jh-copy-text"><?php esc_html_e( 'Copy Link', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
											</button>
										</td>
										<td>
											<button type="button" class="jh-magic-btn jh-magic-btn-sm jh-magic-btn-danger jh-magic-revoke-btn" data-token="<?php echo esc_attr( $link['token'] ); ?>">
												<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
												<span><?php esc_html_e( 'Revoke', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
											</button>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
			</div>

		</div>
		<?php
	}
}