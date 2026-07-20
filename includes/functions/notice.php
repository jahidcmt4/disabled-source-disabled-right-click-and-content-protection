<?php 

// don't load directly
defined( 'ABSPATH' ) || exit;

// Disabled Source Plugin Set Admin Notice Status
if(!function_exists('jh_review_activation_status')){

    function jh_review_activation_status(){ 
        $jh_installation_date = get_option('jh_installation_date'); 
        if( !isset($_COOKIE['jh_installation_date']) && empty($jh_installation_date) && $jh_installation_date == 0){
            setcookie('jh_installation_date', 1, time() + (86400 * 7), "/"); 
        }else{
            update_option( 'jh_installation_date', '1' );
        }
    }
    add_action('admin_init', 'jh_review_activation_status');
}

// Disabled Source Plugin Review Admin Notice
if(!function_exists('jh_review_notice')){
    
     function jh_review_notice(){ 
        $get_current_screen = get_current_screen();  
        $current_user = wp_get_current_user();
        $current_user_role = ! empty( $current_user->roles[0] ) ? $current_user->roles[0] : '';

        if( !empty($current_user_role) && 'administrator'==$current_user_role && $get_current_screen->base == 'dashboard'){
            $current_user = wp_get_current_user();
            $security_nonce = wp_create_nonce( 'jh_notice' );
        ?>
            <div class="notice notice-info jh_disable_review_notice"> 
               
                <!-- translators: 1: Current user's display name, 2: Plugin name -->
                <?php echo sprintf( 
                        esc_html__( ' Hey %1$s 👋, You have been using %2$s for quite a while. If you feel %2$s is helping your business to grow in any way, would you please help %2$s to grow by simply leaving a ★★★★★ review on the WordPress Forum?', 'disabled-source-disabled-right-click-and-content-protection' ),
                        esc_html($current_user->display_name),
                        '<b>Disabled Source, Disabled Right Click and Content Protection</b>'
                    ); ?> 
                
                <ul>
                    <li><a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/plugin/disabled-source-disabled-right-click-and-content-protection/reviews/?filter=5/#new-post') ?>" class=""><span class="dashicons dashicons-external"></span><?php esc_html_e(' Ok, you deserve it!', 'disabled-source-disabled-right-click-and-content-protection' ) ?></a></li>
                    <li><a href="#" class="already_done" data-status="already" data-nonce="<?php echo esc_attr($security_nonce); ?>"><span class="dashicons dashicons-smiley"></span> <?php esc_html_e('I already did', 'disabled-source-disabled-right-click-and-content-protection') ?></a></li>
                    <li><a href="#" class="later" data-status="later" data-nonce="<?php echo esc_attr($security_nonce); ?>"><span class="dashicons dashicons-calendar-alt"></span> <?php esc_html_e('Maybe Later', 'disabled-source-disabled-right-click-and-content-protection') ?></a></li>
                    <li><a href="#" class="never" data-status="never" data-nonce="<?php echo esc_attr($security_nonce); ?>"><span class="dashicons dashicons-dismiss"></span><?php esc_html_e('Never show again', 'disabled-source-disabled-right-click-and-content-protection') ?> </a></li> 
                </ul>
                <button type="button" class="notice-dismiss review_notice_dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.', 'disabled-source-disabled-right-click-and-content-protection') ?></span></button>
            </div>

            <!--   Disabled Source Plugin Review Admin Notice Script -->
            <script>
                jQuery(document).ready(function($) {
                    $(document).on('click', '.already_done, .later, .never', function( event ) {
                        event.preventDefault();
                        var $this = $(this);
                        var status = $this.attr('data-status'); 
                        var security_nonce = $this.attr('data-nonce');
                        $this.closest('.jh_disable_review_notice').css('display', 'none')
                        data = {
                            action : 'jh_review_notice_callback',
                            _nonce: security_nonce,
                            status : status,
                        };

                        $.ajax({
                            url: ajaxurl,
                            type: 'post',
                            data: data,
                            success: function (data) { ;
                            },
                            error: function (data) { 
                            }
                        });
                    });

                    $(document).on('click', '.review_notice_dismiss', function( event ) {
                        event.preventDefault(); 
						var $this = $(this);
                        $this.closest('.jh_disable_review_notice').css('display', 'none')
                        
                    });
                });

            </script>
        <?php  
        }
     }
     $jh_review_notice_status = get_option('jh_review_notice_status'); 
     $jh_installation_date = get_option('jh_installation_date'); 
     if(isset($jh_review_notice_status) && $jh_review_notice_status <= 0 && $jh_installation_date == 1 && !isset($_COOKIE['jh_review_notice_status']) && !isset($_COOKIE['jh_installation_date'])){ 
        add_action( 'admin_notices', 'jh_review_notice' );  
     }
     
}

 
// Disabled Source Review Admin Notice Ajax Callback 
if(!function_exists('jh_review_notice_callback')){

    function jh_review_notice_callback(){
        //Security Verify
        check_ajax_referer('jh_notice', '_nonce');

        $status = $_POST['status'];
        if( $status == 'already'){ 
            update_option( 'jh_review_notice_status', '1' );
        }else if($status == 'never'){ 
            update_option( 'jh_review_notice_status', '2' );
        }else if($status == 'later'){
            $cookie_name = "jh_review_notice_status";
            $cookie_value = "1";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 7), "/"); 
            update_option( 'jh_review_notice_status', '0' ); 
        }  
        wp_die();
    }
    add_action( 'wp_ajax_jh_review_notice_callback', 'jh_review_notice_callback' );

}