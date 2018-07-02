<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() ) {
	return;
}

?>
<div class="shop-widget-wrapper login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
    <div class="box-content">
        <form method="post" role="login" class="logregform">
        
        	<?php do_action( 'woocommerce_login_form_start' ); ?>
        
        	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
        
        	<div class="form-group">
        		<label for="username"><?php _e( 'Username or email', 'woocommerce' ); ?> <span class="required">*</span></label>
        		<input type="text" class="input-text form-control" name="username" id="username" />
                <span class="fa fa-user"></span>
        	</div>
        	<div class="form-group">
        		<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
        		<input class="input-text form-control" type="password" name="password" id="password" />
                <span class="fa fa-lock"></span>
        	</div>
        	<div class="clear"></div>
            
            <?php do_action( 'woocommerce_login_form' ); ?>
            
            <div class="form-group checkbox">
                <?php wp_nonce_field( 'woocommerce-login' ); ?>
   				<input type="submit" class="pay-btn" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
			    <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" /> 
            </div>
            <div class="row">	
    			<div class="checkbox col-md-5 nopad">
    				<label for="rememberme" class="inline">
    					<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
    				</label>
    			</div>
    			<div class="col-md-7 ">
                    <p></p>
    				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
    			</div>
            </div>    
        
        	<div class="clear"></div>
        
        	<?php do_action( 'woocommerce_login_form_end' ); ?>
        
        </form>
    </div>
</div>
