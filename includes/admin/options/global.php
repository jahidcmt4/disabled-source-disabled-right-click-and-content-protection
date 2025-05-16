<?php
defined( 'ABSPATH' ) || exit;

$badge_up     = '<div class="disable-up-badge"><span class="disable-upcoming">' .__("Upcoming", "disabled-source-disabled-right-click-and-content-protection"). '</span></div>';

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

if( class_exists( 'CSF' ) ) {

  $prefix = 'jh_disabled_option';

  CSF::createOptions( $prefix, array(
    'framework_title'         =>   __( 'Disabled Settings', 'disabled-source-disabled-right-click-and-content-protection' ),
    'menu_title'              =>   __( 'Disabled Settings', 'disabled-source-disabled-right-click-and-content-protection' ),
    'menu_slug'               =>   'disabled-source-disabled-right-click-and-content-protection',
    'menu_icon'               =>   'dashicons-lock',
    'menu_position'           =>   25,
    'show_sub_menu'           =>   false,
    'theme'                   =>   'dark',   
    'footer_text'             => 'Thanks for Active our Plugin',
  ) );

  // Images and Content Protection

  CSF::createSection( $prefix, array(
    'title'  => __( 'Images and Content', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(

    array(
      'id'    => 'disabled-content-select',
      'type'  => 'switcher',
      'title' => __( 'Disable Content Copy', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-right-click',
      'type'  => 'switcher',
      'title' => __( 'Disable Right Click', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-img-drag',
      'type'  => 'switcher',
      'title' => __( 'Disable Images Dragging', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true
    ),
    array(
      'id'    => 'disabled-ct-u',
      'type'  => 'switcher',
      'title' => __( 'Disable Source (CTRL+U)', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-ct-s',
      'type'  => 'switcher',
      'title' => __( 'Disable Save (CTRL+S)', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true
    ),
    array(
      'id'    => 'disabled-ct-p',
      'type'  => 'switcher',
      'title' => __( 'Disable Print Preview (CTRL+P)', 'disabled-source-disabled-right-click-and-content-protection' )
    ),
    array(
      'id'    => 'disabled-f12',
      'type'  => 'switcher',
      'title' => __( 'Disable F12', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-ct-st-i',
      'type'  => 'switcher',
      'title' => __( 'Disable Ctrl+Shift+I and Ctrl+I', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-ct-st-j',
      'type'  => 'switcher',
      'title' => __( 'Disable Ctrl+Shift+J and Ctrl+J', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),
    array(
      'id'    => 'disabled-ct-st-c',
      'type'  => 'switcher',
      'title' => __( 'Disable Ctrl+Shift+C and Ctrl+C', 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => true,
    ),

    )
  ) );

  // Disabled Notification

  CSF::createSection( $prefix, array(
    'title'  => __( 'Disable Notification', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'id'    => 'disabled-notification-status',
        'type'  => 'switcher',
        'title' => __( 'Notification Status', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => false,
      ),
      array(
        'id'          => 'disabled-notification-position',
        'type'        => 'select',
        'title'       => __( 'Notification Position', 'disabled-source-disabled-right-click-and-content-protection' ),
        'options'     => array(
          'left top'  => __( 'Left Top', 'disabled-source-disabled-right-click-and-content-protection' ),
          'left center'  => __( 'Left Center', 'disabled-source-disabled-right-click-and-content-protection' ),
          'left bottom'  => __( 'Left Bottom', 'disabled-source-disabled-right-click-and-content-protection' ),
          'right top'  => __( 'Right Top', 'disabled-source-disabled-right-click-and-content-protection' ),
          'right center'  => __( 'Right Center', 'disabled-source-disabled-right-click-and-content-protection' ),
          'right bottom'  => __( 'Right Bottom', 'disabled-source-disabled-right-click-and-content-protection' ),
          'top center'  => __( 'Top Center', 'disabled-source-disabled-right-click-and-content-protection' ),
          'bottom center'  => __( 'Bottom Center', 'disabled-source-disabled-right-click-and-content-protection' ),
        ),
        'default'     => 'right center',
        'dependency' => array( 'disabled-notification-status', '==', 'true' ),
      ),
      array(
        'id'         => 'disabled-notify-text',
        'type'       => 'text',
        'title'      => __( 'Notification Text', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default'      => __( 'You cannot copy content of this Page', 'disabled-source-disabled-right-click-and-content-protection' ),
        'dependency' => array( 'disabled-notification-status', '==', 'true' ),
      ),
      array(
        'id'    => 'disabled-notify-background',
        'type'  => 'color',
        'title' => __( 'Notification Background Color', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#F2DEDE',
        'dependency' => array( 'disabled-notification-status', '==', 'true' )
      ),
      array(
        'id'    => 'disabled-notify-color',
        'type'  => 'color',
        'title' => __( 'Notification Text Color', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#B94A48',
        'dependency' => array( 'disabled-notification-status', '==', 'true' )
      ),
    )
  ) );

  // Disabled Comments

  CSF::createSection( $prefix, array(
    'title'  => __( 'Disable Comments', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
      'id'    => 'disabled-comments',
      'type'  => 'switcher',
      'title' => __( 'Disable Comments', 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
    )
  ) );

  // Website Maintenance Mode

  CSF::createSection( $prefix, array(
    'title'  => __( 'Maintenance Mode', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'type'    => 'notice',
        'style'   => 'danger',
        'class'   => 'jh_admin_feature_notice',
        'content' => __( "<b> Note: If you enable these settings, You can access only (wp-admin, wp-login.php, and wp-register.php) These pages. Don't accept your custom login URL. </b>", 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
      array(
      'id'    => 'enabled-maintenance',
      'type'  => 'switcher',
      'title' => __( 'Maintenance Mode', 'disabled-source-disabled-right-click-and-content-protection' ),
      'subtitle' => __( "This Option Enable you to show a message about the technical break in you Website.", 'disabled-source-disabled-right-click-and-content-protection' ),
      'default' => false,
      ),
      array(
        'id'         => 'maintenance-text',
        'type'       => 'textarea',
        'title'      => __( 'Maintenance Message', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default'      => __( 'Our Website is under Maintenance, We will get back to you Soon.', 'disabled-source-disabled-right-click-and-content-protection' ),
        'dependency' => array( 'enabled-maintenance', '==', 'true' ),
      )
    )
  ) );

  // Disabled IP Address

  CSF::createSection( $prefix, array(
    'id' => 'disabled_ip_address',
    'title'  => __( 'Block by IP Address', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'type'    => 'notice',
        'style'   => 'danger',
        'class'   => 'jh_admin_feature_notice',
        'content' => __( "<b>Note: Never use your own IP Address. For Example, if your IP Address is 127.0.0.1, then never add this into a field. Otherwise, you can't access your own Website Without VPN.</b>", 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
      array(
        'id'     => 'disabled_ip_section',
        'class'     => 'jh-warning-title',
        'type'   => 'repeater',
        'title'  => __( 'IP Address', 'disabled-source-disabled-right-click-and-content-protection' ),
        'fields' => array(
          array(
            'id'    => 'disabled_ip',
            'type'  => 'text'
          )
        )
      ),
      array(
        'id'         => 'disabled-ip-notify-text',
        'type'       => 'textarea',
        'title'      => __( 'Disable IP Notification', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default'      => __( 'Your IP is blocked !', 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
      array(
        'id'    => 'ip_disable_background',
        'type'  => 'color',
        'title' => __( 'Disable Page Background', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#222'
      ),
      array(
        'id'    => 'ip_disable_color',
        'type'  => 'color',
        'title' => __( 'Disable Text Color', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#FF0000'
      ),
    )
  ) );

   // Disabled IP Address by Country

  CSF::createSection( $prefix, array(
    'id' => 'disabled_ip_country_address',
    'title'  => __( 'IP Block by Country', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'type'    => 'notice',
        'style'   => 'danger',
        'class'   => 'jh_admin_feature_notice',
        'content' => __( "<b>Note: Never select your own Country. For Example, if your Country is the United Kingdom, then you never select the United Kingdom. Otherwise, you can't access your own Website Without VPN.</b>", 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
      array(
        'id'         => 'disabled_ip_country',
        'class'     => 'jh-warning-title',
        'type'       => 'checkbox',
        'title'  => __( 'Block By Country', 'disabled-source-disabled-right-click-and-content-protection' ),
        'inline'  => true,
        'options'    => array(
          'AF' => __( "Afghanistan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AL' => __( "Albania", 'disabled-source-disabled-right-click-and-content-protection' ),
          'DZ' => __( "Algeria", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AS' => __( "American Samoa", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AD' => __( "Andorra", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AR' => __( "Argentina", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AM' => __( "Armenia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AU' => __( "Australia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AT' => __( "Austria", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AW' => __( "Aruba", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BS' => __( "Bahamas", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BH' => __( "Bahrain", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BD' => __( "Bangladesh", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BB' => __( "Barbados", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BY' => __( "Belarus", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BE' => __( "Belgium", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BM' => __( "Bermuda", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BO' => __( "Bolivia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'BR' => __( "Brazil", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KH' => __( "Cambodia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CM' => __( "Cameroon", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CA' => __( "Canada", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CL' => __( "Chile", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CN' => __( "China", 'disabled-source-disabled-right-click-and-content-protection' ),
          'HK' => __( "Hong Kong", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CO' => __( "Colombia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CR' => __( "Costa Rica", 'disabled-source-disabled-right-click-and-content-protection' ),
          'HR' => __( "Croatia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CU' => __( "Cuba", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CY' => __( "Cyprus", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CZ' => __( "Czech Republic", 'disabled-source-disabled-right-click-and-content-protection' ),
          'DK' => __( "Denmark", 'disabled-source-disabled-right-click-and-content-protection' ),
          'EC' => __( "Ecuador", 'disabled-source-disabled-right-click-and-content-protection' ),
          'EG' => __( "Egypt", 'disabled-source-disabled-right-click-and-content-protection' ),
          'EE' => __( "Estonia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ET' => __( "Ethiopia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ER' => __( "Eritrea", 'disabled-source-disabled-right-click-and-content-protection' ),
          'FI' => __( "Finland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'FI' => __( "France", 'disabled-source-disabled-right-click-and-content-protection' ),
          'GE' => __( "Georgia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'DE' => __( "Germany", 'disabled-source-disabled-right-click-and-content-protection' ),
          'GH' => __( "Ghana", 'disabled-source-disabled-right-click-and-content-protection' ),
          'GR' => __( "Greece", 'disabled-source-disabled-right-click-and-content-protection' ),
          'GY' => __( "Guyana", 'disabled-source-disabled-right-click-and-content-protection' ),
          'HT' => __( "Haiti", 'disabled-source-disabled-right-click-and-content-protection' ),
          'HN' => __( "Honduras", 'disabled-source-disabled-right-click-and-content-protection' ),
          'HU' => __( "Hungary", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IS' => __( "Iceland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IN' => __( "India", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ID' => __( "Indonesia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IR' => __( "Iran", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IQ' => __( "Iraq", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IE' => __( "Ireland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IL' => __( "Israel", 'disabled-source-disabled-right-click-and-content-protection' ),
          'IT' => __( "Italy", 'disabled-source-disabled-right-click-and-content-protection' ),
          'JM' => __( "Jamaica", 'disabled-source-disabled-right-click-and-content-protection' ),
          'JP' => __( "Japan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KZ' => __( "Kazakhstan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KE' => __( "Kenya", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KP' => __( "Korea (North)", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KR' => __( "Korea (South)", 'disabled-source-disabled-right-click-and-content-protection' ),
          'KW' => __( "Kuwait", 'disabled-source-disabled-right-click-and-content-protection' ),
          'LY' => __( "Libya", 'disabled-source-disabled-right-click-and-content-protection' ),
          'LT' => __( "Lithuania", 'disabled-source-disabled-right-click-and-content-protection' ),
          'LU' => __( "Luxembourg", 'disabled-source-disabled-right-click-and-content-protection' ),
          'LR' => __( "Liberia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MW' => __( "Malawi", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MY' => __( "Malaysia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MV' => __( "Maldives", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MT' => __( "Malta", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MX' => __( "Mexico", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MN' => __( "Mongolia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MA' => __( "Morocco", 'disabled-source-disabled-right-click-and-content-protection' ),
          'MM' => __( "Myanmar", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NA' => __( "Namibia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NP' => __( "Nepal", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NL' => __( "Netherlands", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NZ' => __( "New Zealand", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NG' => __( "Nigeria", 'disabled-source-disabled-right-click-and-content-protection' ),
          'NO' => __( "Norway", 'disabled-source-disabled-right-click-and-content-protection' ),
          'OM' => __( "Oman", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PK' => __( "Pakistan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PA' => __( "Panama", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PG' => __( "Papua New Guinea", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PH' => __( "Philippines", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PL' => __( "Poland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PT' => __( "Portugal", 'disabled-source-disabled-right-click-and-content-protection' ),
          'PY' => __( "Paraguay", 'disabled-source-disabled-right-click-and-content-protection' ),
          'QA' => __( "Qatar", 'disabled-source-disabled-right-click-and-content-protection' ),
          'RO' => __( "Romania", 'disabled-source-disabled-right-click-and-content-protection' ),
          'RU' => __( "Russia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SA' => __( "Saudi Arabia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SN' => __( "Senegal", 'disabled-source-disabled-right-click-and-content-protection' ),
          'RS' => __( "Serbia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SG' => __( "Singapore", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SK' => __( "Slovakia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ZA' => __( "South Africa", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ES' => __( "Spain", 'disabled-source-disabled-right-click-and-content-protection' ),
          'LK' => __( "Sri Lanka", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SD' => __( "Sudan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SZ' => __( "Swaziland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SE' => __( "Sweden", 'disabled-source-disabled-right-click-and-content-protection' ),
          'SC' => __( "Seychelles", 'disabled-source-disabled-right-click-and-content-protection' ),
          'CH' => __( "Switzerland", 'disabled-source-disabled-right-click-and-content-protection' ),
          'UG' => __( "Uganda", 'disabled-source-disabled-right-click-and-content-protection' ),
          'TH' => __( "Thailand", 'disabled-source-disabled-right-click-and-content-protection' ),
          'TN' => __( "Tunisia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'TR' => __( "Turkey", 'disabled-source-disabled-right-click-and-content-protection' ),
          'TW' => __( "Taiwan", 'disabled-source-disabled-right-click-and-content-protection' ),
          'UA' => __( "Ukraine", 'disabled-source-disabled-right-click-and-content-protection' ),
          'AE' => __( "United Arab Emirates", 'disabled-source-disabled-right-click-and-content-protection' ),
          'GB' => __( "United Kingdom", 'disabled-source-disabled-right-click-and-content-protection' ),
          'US' => __( "United States of America", 'disabled-source-disabled-right-click-and-content-protection' ),
          'UY' => __( "Uruguay", 'disabled-source-disabled-right-click-and-content-protection' ),
          'VN' => __( "Viet Nam", 'disabled-source-disabled-right-click-and-content-protection' ),
          'YE' => __( "Yemen", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ZM' => __( "Zambia", 'disabled-source-disabled-right-click-and-content-protection' ),
          'ZW' => __( "Zimbabwe", 'disabled-source-disabled-right-click-and-content-protection' ),
        )
      ),
      array(
        'id'         => 'disabled-country-notify-text',
        'type'       => 'textarea',
        'title'      => __( 'Disable Country Notification', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default'      => __( 'Your Country are blocked !', 'disabled-source-disabled-right-click-and-content-protection' ),
      ),
      array(
        'id'    => 'country_disable_background',
        'type'  => 'color',
        'title' => __( 'Disable Page Background', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#222'
      ),
      array(
        'id'    => 'country_disable_color',
        'type'  => 'color',
        'title' => __( 'Disable Text Color', 'disabled-source-disabled-right-click-and-content-protection' ),
        'default' => '#FF0000'
      ),
    )
  ) );

  // Disable By pages
  CSF::createSection( $prefix, array(
    'title'  => __( 'Block By Pages', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'id'    => 'disable-pages',
        'type'  => 'select',
        'title' => __( 'Block By Pages', 'disabled-source-disabled-right-click-and-content-protection' ),
        'options'     => function_exists( 'disable_get_all_pages' ) ? disable_get_all_pages() : '',
        'chosen'      => true,
        'multiple'    => true,
        'placeholder' => "If left empty, it will affect all pages.",
      ),
    )
  ) );

   // Disable By roles
   CSF::createSection( $prefix, array(
    'title'  => __( 'Disable By Roles', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'id'    => 'disable-roles',
        'type'  => 'checkbox',
        'title' => __( 'Disable By Roles', 'disabled-source-disabled-right-click-and-content-protection' ),
        'options' => function_exists( 'disable_get_all_author_roles' ) ? disable_get_all_author_roles() : '',
        'default' => 'customer'
      ),
    )
  ) );

   // Disable By Post Type
   CSF::createSection( $prefix, array(
    'title'  => __( 'Disable By Post Type', 'disabled-source-disabled-right-click-and-content-protection' ),
    'fields' => array(
      array(
        'id'    => 'disable-post-type',
        'type'  => 'select',
        'title' => __( 'Disable By Post Type', 'disabled-source-disabled-right-click-and-content-protection' ),
        'options' => function_exists( 'disable_get_all_post_type' ) ? disable_get_all_post_type() : '',
        'chosen'      => true,
        'multiple'    => true,
        'placeholder' => "If left empty, it will affect all post type.",
      ),
    )
  ) );

}