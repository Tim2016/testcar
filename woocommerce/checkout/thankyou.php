<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="section cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">             
                <?php if ( $order ) : ?>
                
                	<?php if ( $order->has_status( 'failed' ) ) : ?>
                        <div class="emtrycart">
                    		<h4 class="woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></h4>
                    
                    		<div class="woocommerce-thankyou-order-failed-actions bluebg continueshop text-center">
                    			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
                    			<?php if ( is_user_logged_in() ) : ?>
                    				<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My Account', 'woocommerce' ); ?></a>
                    			<?php endif; ?>
                    		</div>
                        </div>
                
                	<?php else : ?>
                
                		<div class="emtrycart"><h4 class="woocommerce-thankyou-order-received"><i class="fa fa-check"></i> <?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h4></div>
                        
                            <div class="shopcart">
                                <table class="cart-table account-table table table-bordered">
                                    <thead>
                                		<tr class="woocommerce-thankyou-order-details order_details">
                            				<th><?php _e( 'Order Number:', 'woocommerce' ); ?></th>
                                            <th><?php _e( 'Date:', 'woocommerce' ); ?></th>
                                            <th><?php _e( 'Total:', 'woocommerce' ); ?></th>
                                            <?php if ( $order->payment_method_title ) : ?>
                                                <th><?php _e( 'Payment Method:', 'woocommerce' ); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                            				<td><?php echo $order->get_order_number(); ?></td>
                            				<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
                            				<td><?php echo $order->get_formatted_order_total(); ?></td>
                        			        <?php if ( $order->payment_method_title ) : ?>
                            				    <td><?php echo $order->payment_method_title; ?></td>
                        			        <?php endif; ?>
                                		</tr>
                                    </tbody>
                                </table>
                            </div>
                        
                	<?php endif; ?>
                    <div class="box-content">
                    	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
                    </div>
                    <?php do_action( 'woocommerce_thankyou', $order->id ); ?>
                 
                <?php else : ?>
                
                	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>