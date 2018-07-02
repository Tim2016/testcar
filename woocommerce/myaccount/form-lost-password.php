<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices(); ?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="account_page">
                
                    <form method="post" role="login">
                        
                        <div class="section-title clearfix">
                            <h5><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></h5>
                            <hr class="custom" />
                        </div><!-- end section-title -->
                        
                    	<div class="row">
                            <div class="col-md-12 form_group">
                                <label for="user_login"><?php _e( 'Username or email', 'woocommerce' ); ?></label>
                	            <div class="input_group">
                                    <input class="input-text" type="text" name="user_login" id="user_login" />
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                            </div>
                    	</div>
                    
                    	<?php do_action( 'woocommerce_lostpassword_form' ); ?>
                    
                    	<div class="row">
                            <div class="col-md-12">
                    		  <input type="hidden" name="wc_reset_password" value="true" />
                    		  <input type="submit" class="btn btn-primary" value="<?php esc_attr_e( 'Reset Password', 'woocommerce' ); ?>" />
                    	    </div>
                        </div>
                
                	   <?php wp_nonce_field( 'lost_password' ); ?>
                       
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>