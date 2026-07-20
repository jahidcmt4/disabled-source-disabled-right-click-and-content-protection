<?php
defined( 'ABSPATH' ) || exit;

// Register Submenu Page
add_action( 'admin_menu', 'jh_disabled_register_more_plugins_page', 999 );
function jh_disabled_register_more_plugins_page() {
    add_submenu_page(
        'disabled-source-disabled-right-click-and-content-protection',
        __( 'Explore Extensions', 'disabled-source-disabled-right-click-and-content-protection' ),
        __( 'Explore Extensions', 'disabled-source-disabled-right-click-and-content-protection' ),
        'manage_options',
        'disabled-source-more-plugins',
        'jh_disabled_more_plugins_render'
    );
}

// Enqueue styles specifically for this page
add_action( 'admin_enqueue_scripts', 'jh_disabled_more_plugins_styles' );
function jh_disabled_more_plugins_styles( $hook ) {
    if ( strpos( $hook, 'disabled-source-more-plugins' ) !== false ) {
        wp_enqueue_style( 'jh-disabled-more-plugins-css', JH_URL . 'includes/admin/assets/css/more-plugins.css', array(), JH_VERSION );
    }
}

// Suppress foreign notices on this specific page
add_action( 'admin_head', 'jh_disabled_suppress_notices_on_more_plugins', 1 );
function jh_disabled_suppress_notices_on_more_plugins() {
    $screen = get_current_screen();
    if ( $screen && strpos( $screen->id, 'disabled-source-more-plugins' ) !== false ) {
        remove_all_actions( 'admin_notices' );
        remove_all_actions( 'all_admin_notices' );
        remove_all_actions( 'user_admin_notices' );
        remove_all_actions( 'network_admin_notices' );
    }
}

// Renderer function
function jh_disabled_more_plugins_render() {
    // List of recommended plugins by jahidcse
    $plugins = array(
        'notifex-order-alerts-upsells-for-woocommerce' => array(
            'name'        => __( 'Notifex Order Alerts & Upsells for WooCommerce', 'disabled-source-disabled-right-click-and-content-protection' ),
            'slug'        => 'notifex-order-alerts-upsells-for-woocommerce',
            'file'        => 'notifex-order-alerts-upsells-for-woocommerce.php',
            'description' => __( 'Enhance your store sales with order notifications sent directly to Google Sheets, Slack, or Webhooks. Plus, set up conversion-boosting cart and checkout upsell popups!', 'disabled-source-disabled-right-click-and-content-protection' ),
            'category'    => 'WooCommerce',
            'icon_svg'    => '<svg class="plugin-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path><path d="M12 2v2"></path><path d="m19 4-1 1"></path><path d="m5 4 1 1"></path></svg>',
            'gradient'    => 'linear-gradient(135deg, #f43f5e 0%, #fb7185 100%)',
            'features'    => array(
                __( 'Real-time Webhook & Slack alerts', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Direct integration with Google Sheets', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Custom cart & checkout upsell triggers', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Seamless conversion tracking metrics', 'disabled-source-disabled-right-click-and-content-protection' ),
            ),
            'wporg_url'   => 'https://wordpress.org/plugins/notifex-order-alerts-upsells-for-woocommerce/',
            'settings_url'=> admin_url( 'admin.php?page=wconu-settings' )
        ),
        'admin-login-url-change' => array(
            'name'        => __( 'Admin Login URL Change', 'disabled-source-disabled-right-click-and-content-protection' ),
            'slug'        => 'admin-login-url-change',
            'file'        => 'admin-login-url-change.php',
            'description' => __( 'Protect your site from brute-force login attacks by replacing wp-admin and wp-login.php with a custom, secure slug. Keeps hackers in the dark!', 'disabled-source-disabled-right-click-and-content-protection' ),
            'category'    => 'Security',
            'icon_svg'    => '<svg class="plugin-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>',
            'gradient'    => 'linear-gradient(135deg, #0284c7 0%, #38bdf8 100%)',
            'features'    => array(
                __( 'Rename wp-login.php & wp-admin', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Brute force stealth defense shield', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Custom redirection for unauthorized access', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Super lightweight & fast configuration', 'disabled-source-disabled-right-click-and-content-protection' ),
            ),
            'wporg_url'   => 'https://wordpress.org/plugins/admin-login-url-change/',
            'settings_url'=> admin_url( 'admin.php?page=admin-login-url-change' )
        ),
        'html-tag-and-class-replace' => array(
            'name'        => __( 'HTML Tag and Class Replace', 'disabled-source-disabled-right-click-and-content-protection' ),
            'slug'        => 'html-tag-and-class-replace',
            'file'        => 'html-tag-and-class-replace.php',
            'description' => __( 'Modify HTML tags and CSS classes easily across your WordPress website without touching any code. Excellent for improving SEO structures and fixing layout styling on the fly.', 'disabled-source-disabled-right-click-and-content-protection' ),
            'category'    => 'Developer Tool',
            'icon_svg'    => '<svg class="plugin-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>',
            'gradient'    => 'linear-gradient(135deg, #10b981 0%, #059669 100%)',
            'features'    => array(
                __( 'Replace any HTML tags dynamically', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Rename or swap CSS classes in bulk', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Apply rules specifically to Header or Footer', 'disabled-source-disabled-right-click-and-content-protection' ),
                __( 'Ultra lightweight & SEO friendly execution', 'disabled-source-disabled-right-click-and-content-protection' ),
            ),
            'wporg_url'   => 'https://wordpress.org/plugins/html-tag-and-class-replace/',
            'settings_url'=> admin_url( 'options-general.php?page=html-tag-and-class-replace' )
        ),
    );

    // Make sure plugin.php is loaded
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    ?>
    <div class="wrap jh-more-plugins-wrap">
        <h2 style="display: none;"></h2>
        <div class="wp-header-end" style="display: none;"></div>
        <div class="jh-more-plugins-header">
            <div class="jh-header-content">
                <span class="jh-badge-top"><?php esc_html_e('Exclusive Recommendations', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
                <h1><?php esc_html_e('Expand Your WordPress Capabilities', 'disabled-source-disabled-right-click-and-content-protection' ); ?></h1>
                <p><?php esc_html_e('Supercharge WooCommerce sales, harden login page security, and automate workflows with our hand-crafted plugins.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
            </div>
        </div>

        <div class="jh-plugins-grid">
            <?php
            foreach ( $plugins as $slug => $data ) {
                $plugin_path = $slug . '/' . $data['file'];
                $is_installed = file_exists( WP_PLUGIN_DIR . '/' . $plugin_path );
                $is_active = $is_installed && is_plugin_active( $plugin_path );
                
                // Action URLs
                if ( ! $is_installed ) {
                    $action_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $slug ), 'install-plugin_' . $slug );
                    $btn_text = __( 'Install Plugin', 'disabled-source-disabled-right-click-and-content-protection' );
                    $btn_class = 'jh-btn-install';
                    $status_label = __( 'Not Installed', 'disabled-source-disabled-right-click-and-content-protection' );
                    $status_class = 'jh-status-not-installed';
                } elseif ( ! $is_active ) {
                    $action_url = wp_nonce_url( self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $plugin_path ) ), 'activate-plugin_' . $plugin_path );
                    $btn_text = __( 'Activate Now', 'disabled-source-disabled-right-click-and-content-protection' );
                    $btn_class = 'jh-btn-activate';
                    $status_label = __( 'Inactive', 'disabled-source-disabled-right-click-and-content-protection' );
                    $status_class = 'jh-status-inactive';
                } else {
                    $action_url = $data['settings_url'];
                    $btn_text = __( 'Configure Settings', 'disabled-source-disabled-right-click-and-content-protection' );
                    $btn_class = 'jh-btn-configure';
                    $status_label = __( 'Active', 'disabled-source-disabled-right-click-and-content-protection' );
                    $status_class = 'jh-status-active';
                }
                ?>
                <div class="jh-plugin-card <?php echo esc_attr( $status_class ); ?>">
                    <div class="jh-plugin-card-header">
                        <div class="jh-plugin-icon-box" style="background: <?php echo esc_attr( $data['gradient'] ); ?>">
                            <?php echo $data['icon_svg']; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                        <div class="jh-plugin-title-box">
                            <span class="jh-plugin-cat"><?php echo esc_html( $data['category'] ); ?></span>
                            <h3><?php echo esc_html( $data['name'] ); ?></h3>
                        </div>
                        <span class="jh-plugin-status-badge <?php echo esc_attr( $status_class ); ?>">
                            <?php echo esc_html( $status_label ); ?>
                        </span>
                    </div>

                    <div class="jh-plugin-card-body">
                        <p class="jh-plugin-desc"><?php echo esc_html( $data['description'] ); ?></p>
                        
                        <div class="jh-plugin-features">
                            <h4><?php esc_html_e('Key Features & Benefits:', 'disabled-source-disabled-right-click-and-content-protection' ); ?></h4>
                            <ul>
                                <?php foreach ( $data['features'] as $feature ) : ?>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feature-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <span><?php echo esc_html( $feature ); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="jh-plugin-card-footer">
                        <a href="<?php echo esc_url( $action_url ); ?>" class="jh-btn <?php echo esc_attr( $btn_class ); ?>">
                            <?php echo esc_html( $btn_text ); ?>
                        </a>
                        <a href="<?php echo esc_url( $data['wporg_url'] ); ?>" target="_blank" class="jh-btn jh-btn-link">
                            <?php esc_html_e('Learn More', 'disabled-source-disabled-right-click-and-content-protection' ); ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="external-link-icon"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="jh-more-plugins-footer-box">
            <div class="jh-footer-gradient-bar"></div>
            <div class="jh-footer-box-content">
                <div class="jh-footer-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <div class="jh-footer-text">
                    <h3><?php esc_html_e('Need Custom WordPress Solutions?', 'disabled-source-disabled-right-click-and-content-protection' ); ?></h3>
                    <p><?php esc_html_e('We build premium themes, custom plugins, and complete WooCommerce stores tailored to your brand goals.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
                </div>
                <div class="jh-footer-actions">
                    <a href="https://profiles.wordpress.org/jahidcse/" target="_blank" class="jh-btn jh-btn-footer-primary">
                        <?php esc_html_e('Visit Developer Profile', 'disabled-source-disabled-right-click-and-content-protection' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}
