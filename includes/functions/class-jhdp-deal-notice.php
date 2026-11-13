<?php

defined( 'ABSPATH' ) || exit;

class JHDP_Deal_Notice {

    /* ---------- Campaign config: edit these for each campaign ---------- */
    const CAMPAIGN          = 'bf2026';
    const START             = '2026-11-13 00:00:00 UTC';
    const END               = '2026-12-15 23:59:59 UTC';
    const LAST_CHANCE_FROM  = '2026-12-12 00:00:00 UTC'; // snoozed users see it once more from here
    const COUPON            = 'BFDEAL';
    const DISCOUNT          = 45;
    const SNOOZE_DAYS       = 7;
    const MIN_INSTALL_DAYS  = 3;
    /* ------------------------------------------------------------------- */

    const META_KEY      = 'jhdp_deal_state';
    const INSTALL_OPT   = 'jhdp_installed_at';
    const NONCE         = 'jhdp-deal-nonce';
    const SETTINGS_SLUG = 'disabled-source-disabled-right-click-and-content-protection';
    const TD            = 'disabled-source-disabled-right-click-and-content-protection';

    public static function init() {
        $self = new self();

        add_action( 'admin_init',            [ $self, 'maybe_set_install_time' ] );
        add_action( 'admin_notices',         [ $self, 'render_notice' ] );
        add_action( 'admin_enqueue_scripts', [ $self, 'enqueue_assets' ] );
        add_action( 'csf_options_before',    [ $self, 'render_settings_banner' ] );
        add_action( 'wp_ajax_jhdp_deal_dismiss', [ $self, 'ajax_dismiss' ] );
    }

    /**
     * Activation hook: a fresh install gets the "new install" grace period.
     * Updates don't run this, so a missing option later means an existing user.
     */
    public static function on_activate() {
        if ( ! get_option( self::INSTALL_OPT ) ) {
            update_option( self::INSTALL_OPT, time(), false );
        }
    }

    /* ======================= Conditions ======================= */

    private function is_preview() {
        return isset( $_GET['jhdp_deal_preview'] ) && current_user_can( 'manage_options' ); // phpcs:ignore WordPress.Security.NonceVerification
    }

    private function is_pro() {
        if ( class_exists( 'CTBLOCK_PRO_INIT' ) || defined( 'CTBLOCK_PRO_VERSION' ) ) {
            return true;
        }
        if ( function_exists( 'dsdrcacp_fs' ) ) {
            $fs = dsdrcacp_fs();
            if ( $fs && method_exists( $fs, 'is_paying' ) && $fs->is_paying() ) {
                return true;
            }
        }
        return false;
    }

    private function in_campaign_window() {
        $now = time();
        return $now >= strtotime( self::START ) && $now <= strtotime( self::END );
    }

    /** Base eligibility shared by the notice and the settings banner. */
    private function campaign_eligible() {
        if ( ! current_user_can( 'manage_options' ) || $this->is_pro() ) {
            return false;
        }
        return $this->is_preview() || $this->in_campaign_window();
    }

    private function on_settings_page() {
        $screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
        return $screen && 'toplevel_page_' . self::SETTINGS_SLUG === $screen->id;
    }

    private function should_show_notice() {
        if ( ! $this->campaign_eligible() ) {
            return false;
        }
        if ( $this->is_preview() ) {
            return true;
        }

        $screen = get_current_screen();
        if ( ! $screen || 'dashboard' !== $screen->id ) {
            return false;
        }

        $installed = (int) get_option( self::INSTALL_OPT, 0 );
        if ( $installed && ( time() - $installed ) < self::MIN_INSTALL_DAYS * DAY_IN_SECONDS ) {
            return false;
        }

        $state = $this->get_state();
        if ( 'dismissed' === $state['status'] ) {
            return false;
        }
        if ( 'snoozed' === $state['status'] ) {
            $last_chance = strtotime( self::LAST_CHANCE_FROM );
            // Snoozed before the last-chance window opened -> show once more.
            if ( time() >= $last_chance && $state['at'] < $last_chance ) {
                return true;
            }
            return time() >= $state['until'];
        }
        return true;
    }

    private function get_state() {
        $all   = get_user_meta( get_current_user_id(), self::META_KEY, true );
        $state = ( is_array( $all ) && isset( $all[ self::CAMPAIGN ] ) ) ? $all[ self::CAMPAIGN ] : [];
        return wp_parse_args( $state, [ 'status' => '', 'at' => 0, 'until' => 0 ] );
    }

    /* ======================= Hooks ======================= */

    public function maybe_set_install_time() {
        if ( get_option( self::INSTALL_OPT ) ) {
            return;
        }
        // Not set by the activation hook, so the plugin was already installed
        // before this version: treat it as a long-time install.
        update_option( self::INSTALL_OPT, time() - 30 * DAY_IN_SECONDS, false );
    }

    public function enqueue_assets() {
        if ( ! ( $this->on_settings_page() ? $this->campaign_eligible() : $this->should_show_notice() ) ) {
            return;
        }

        $css = 'includes/admin/assets/css/deal.css';
        $js  = 'includes/admin/assets/js/deal.js';
        if ( ! file_exists( JH_PATH . $css ) || ! file_exists( JH_PATH . $js ) ) {
            return;
        }

        wp_enqueue_style( 'jhdp-deal', JH_URL . $css, [], JH_VERSION . '.' . filemtime( JH_PATH . $css ) );
        wp_enqueue_script( 'jhdp-deal', JH_URL . $js, [], JH_VERSION . '.' . filemtime( JH_PATH . $js ), true );
        wp_localize_script( 'jhdp-deal', 'jhdp_deal', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( self::NONCE ),
            'copied'   => __( 'Copied!', 'disabled-source-disabled-right-click-and-content-protection' ),
        ] );
    }

    public function ajax_dismiss() {
        check_ajax_referer( self::NONCE, 'nonce' );
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( null, 403 );
        }

        $type    = isset( $_POST['type'] ) ? sanitize_key( wp_unslash( $_POST['type'] ) ) : 'snooze';
        $user_id = get_current_user_id();
        $all     = get_user_meta( $user_id, self::META_KEY, true );
        $all     = is_array( $all ) ? $all : [];

        $all[ self::CAMPAIGN ] = ( 'dismiss' === $type )
            ? [ 'status' => 'dismissed', 'at' => time(), 'until' => 0 ]
            : [ 'status' => 'snoozed',   'at' => time(), 'until' => time() + self::SNOOZE_DAYS * DAY_IN_SECONDS ];

        update_user_meta( $user_id, self::META_KEY, $all );
        wp_send_json_success();
    }

    /* ======================= Rendering ======================= */

    private function upgrade_url() {
        // Freemius merges $_GET into the pricing/checkout config, so the coupon
        // is forwarded and pre-filled where the checkout supports it.
        return add_query_arg( 'coupon', rawurlencode( self::COUPON ), admin_url( 'admin.php?page=' . self::SETTINGS_SLUG . '-pricing' ) );
    }

    private function is_last_chance() {
        return time() >= strtotime( self::LAST_CHANCE_FROM );
    }

    private function render_howto() {
        ?>
        <p class="jhdp-deal-howto">
            <?php
            /* translators: %s: coupon code */
            printf( esc_html__( 'How to redeem: copy %s, choose your plan, then apply the code in the coupon field at checkout before paying.', 'disabled-source-disabled-right-click-and-content-protection' ), '<strong>' . esc_html( self::COUPON ) . '</strong>' );
            ?>
        </p>
        <?php
    }

    private function render_coupon() {
        ?>
        <button type="button" class="jhdp-deal-coupon" data-code="<?php echo esc_attr( self::COUPON ); ?>" title="<?php esc_attr_e( 'Click to copy', 'disabled-source-disabled-right-click-and-content-protection' ); ?>">
            <span class="jhdp-deal-coupon-code"><?php echo esc_html( self::COUPON ); ?></span>
            <span class="jhdp-deal-coupon-copy"><?php esc_html_e( 'Copy', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
        </button>
        <?php
    }

    private function render_claim_label() {
        /* translators: %d: discount percentage */
        printf( esc_html__( 'Claim %d%% Off', 'disabled-source-disabled-right-click-and-content-protection' ), (int) self::DISCOUNT );
    }

    private function render_badge() {
        ?>
        <div class="jhdp-deal-badge">
            <span class="jhdp-deal-badge-num"><?php echo (int) self::DISCOUNT; ?>%</span>
            <span class="jhdp-deal-badge-off"><?php esc_html_e( 'OFF', 'disabled-source-disabled-right-click-and-content-protection' ); ?></span>
        </div>
        <?php
    }

    public function render_notice() {
        if ( ! $this->should_show_notice() ) {
            return;
        }
        $eyebrow = $this->is_last_chance()
            ? __( 'Last chance · Black Friday Deal', 'disabled-source-disabled-right-click-and-content-protection' )
            : __( 'Black Friday Deal', 'disabled-source-disabled-right-click-and-content-protection' );
        ?>
        <div class="notice jhdp-deal-notice" id="jhdp-deal-notice">
            <button type="button" class="jhdp-deal-close" data-type="snooze" aria-label="<?php esc_attr_e( 'Remind me later', 'disabled-source-disabled-right-click-and-content-protection' ); ?>">&times;</button>

            <?php $this->render_badge(); ?>

            <div class="jhdp-deal-body">
                <p class="jhdp-deal-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
                <h3 class="jhdp-deal-title">
                    <?php
                    /* translators: %d: discount percentage */
                    printf( esc_html__( 'Get %d%% off Content Protection Pro', 'disabled-source-disabled-right-click-and-content-protection' ), (int) self::DISCOUNT );
                    ?>
                </h3>
                <p class="jhdp-deal-features"><?php esc_html_e( 'Image watermarks · Password-protected pages · Hide login URL · Magic login links · Disable REST API', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>

                <div class="jhdp-deal-actions">
                    <?php $this->render_coupon(); ?>
                    <a href="<?php echo esc_url( $this->upgrade_url() ); ?>" class="button button-primary jhdp-deal-cta"><?php $this->render_claim_label(); ?></a>
                    <button type="button" class="button-link jhdp-deal-dismiss" data-type="snooze"><?php esc_html_e( 'Remind me later', 'disabled-source-disabled-right-click-and-content-protection' ); ?></button>
                    <button type="button" class="button-link jhdp-deal-dismiss" data-type="dismiss"><?php esc_html_e( "Don't show again", 'disabled-source-disabled-right-click-and-content-protection' ); ?></button>
                </div>
                <?php $this->render_howto(); ?>
            </div>
        </div>
        <?php
    }

    public function render_settings_banner() {
        // csf_options_before fires for every Codestar options page, so only
        // render on this plugin's own settings page.
        if ( ! $this->on_settings_page() || ! $this->campaign_eligible() ) {
            return;
        }
        ?>
        <div class="jhdp-deal-banner">
            <?php $this->render_badge(); ?>
            <div class="jhdp-deal-body">
                <p class="jhdp-deal-eyebrow"><?php esc_html_e( 'Black Friday Deal', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
                <h3 class="jhdp-deal-title"><?php esc_html_e( 'Unlock every Pro protection feature this Black Friday', 'disabled-source-disabled-right-click-and-content-protection' ); ?></h3>
                <p class="jhdp-deal-features"><?php esc_html_e( 'Watermark your images, password protect pages, hide your login URL, share magic login links, and lock down the REST API.', 'disabled-source-disabled-right-click-and-content-protection' ); ?></p>
                <?php $this->render_howto(); ?>
            </div>
            <div class="jhdp-deal-actions">
                <?php $this->render_coupon(); ?>
                <a href="<?php echo esc_url( $this->upgrade_url() ); ?>" class="jhdp-deal-cta-alt"><?php $this->render_claim_label(); ?></a>
            </div>
        </div>
        <?php
    }
}
