<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
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
	exit;
}
?>
<div class="shopcart">

    <h3 class="uppercase"><?php _e( 'Customer Details', 'woocommerce' ); ?></h3>
   
    <table class="cart-table account-table table table-bordered">
    	<?php if ( $order->get_customer_note() ) : ?>s
    		<tr>
    			<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
    			<td><?php echo wptexturize( $order->customer_note ); ?></td>
    		</tr>
    	<?php endif; ?>
    
    	<?php if ( $order->billing_email ) : ?>
    		<tr>
    			<th><?php _e( 'Email:', 'woocommerce' ); ?></th>
    			<td><?php echo esc_html( $order->billing_email ); ?></td>
    		</tr>
    	<?php endif; ?>
    
    	<?php if ( $order->billing_phone ) : ?>
    		<tr>
    			<th><?php _e( 'Telephone:', 'woocommerce' ); ?></th>
    			<td><?php echo esc_html( $order->billing_phone ); ?></td>
    		</tr>
    	<?php endif; ?>
    
    	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
    </table>
</div>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

<div class="ma-address row">
	<div class="col-md-6">

<?php endif; ?>

    <h3 class="uppercase"><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
    
    <address>
    	<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : esc_html__( 'N/A', 'woocommerce' ); ?>
    </address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
	</div>
	<div class="col-md-6">
        <h4 class="uppercase"><?php _e( 'Shipping Address', 'woocommerce' ); ?></h4>
		<address>
			<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html__( 'N/A', 'woocommerce' ); ?>
		</address>
	</div>
</div>

<?php endif; ?>

