<?php 
// don't load directly
defined( 'ABSPATH' ) || exit;

/**
 * Admin assets Enqueue
*/

add_action('admin_enqueue_scripts', 'disabled_source_admin_page_script');
function disabled_source_admin_page_script(){
	wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/admin/assets/css/admin.css', false, '1.1.0');
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
				wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/assets/css/style.css', false, '1.0.0');
			}
			if( !empty($jhdoption['disabled-notification-status']) && $jhdoption['disabled-notification-status']=="1" ){
				wp_enqueue_script( 'notify-js', JH_URL.'includes/assets/js/notify.min.js', array('jquery'), '1.1.3', true );
			}

			wp_enqueue_script( 'disabled-source-and-content-protection-js', JH_URL.'includes/assets/js/protection.js', array('jquery'), '1.0.0', true );
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
					wp_enqueue_style( 'disabled-source-and-content-protection-css', JH_URL.'includes/assets/css/style.css', false, '1.0.0');
				}
				if( !empty($jhdoption['disabled-notification-status']) && $jhdoption['disabled-notification-status']=="1" ){
					wp_enqueue_script( 'notify-js', JH_URL.'includes/assets/js/notify.min.js', array('jquery'), '1.1.3', true );
				}
				
				wp_enqueue_script( 'disabled-source-and-content-protection-js', JH_URL.'includes/assets/js/protection.js', array('jquery'), '1.0.0', true );
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

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
		return $_SERVER['HTTP_CLIENT_IP']; 
	} 
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
		return $_SERVER['HTTP_X_FORWARDED_FOR']; 
	} 
	else { 
		return $_SERVER['REMOTE_ADDR']; 
	} 
}


add_action('init','jh_visitor_address_checker');
function jh_visitor_address_checker(){
	$jh_disabled_ip_address= get_option( 'jh_disabled_option' );

	/**
	 * IP Address Blocked Message
	*/
    if (!empty($jh_disabled_ip_address['disabled_ip_section'])) {
    	$jh_visitor_ip = jh_getvisitor_IP();
		$jh_visitor_info = @unserialize(file_get_contents('http://ip-api.com/php/'.$jh_visitor_ip));

		$jh_disabled_ip_address_list = [];
    	foreach($jh_disabled_ip_address['disabled_ip_section'] as $singleip){
    		$jh_disabled_ip_address_list[] = $singleip['disabled_ip'];
    	}

		if(!empty($jh_visitor_info['query'])){
			if (in_array($jh_visitor_info['query'], $jh_disabled_ip_address_list)){
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
    }

	/**
	 * Country Blocked Message
	*/
    if (!empty($jh_disabled_ip_address['disabled_ip_country'])) {
    	$jh_visitor_ip = jh_getvisitor_IP();
		$jh_visitor_info = @unserialize(file_get_contents('http://ip-api.com/php/'.$jh_visitor_ip));
		if(!empty($jh_visitor_info['countryCode'])){
			if (in_array($jh_visitor_info['countryCode'], $jh_disabled_ip_address['disabled_ip_country'])){
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

?>