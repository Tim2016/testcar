<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>
<div class="box-content">
    
    <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order" role="login">
    
    	<div class="form-group"><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></div>
        
        <div class="row">
        	<div class="form-group">
                <div class="col-md-12">
                    <label for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label> 
                    <input class="input-text form-control" type="text" name="orderid" id="orderid" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" />
                </div>
            </div>
        </div>
        
    	<div class="row">
        	<div class="form-group">
                <div class="col-md-12">
                    <label for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label> 
                    <input class="input-text form-control" type="text" name="order_email" id="order_email" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'woocommerce' ); ?>" />
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
    	       <div class="form-group"><input type="submit" class="button btn-md pull-right" name="track" value="<?php esc_attr_e( 'Track', 'woocommerce' ); ?>" /></div>
    	    </div>
        </div>
        <?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
    
    </form>
    
</div>