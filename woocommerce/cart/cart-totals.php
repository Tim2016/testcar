<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="submit_form wow fadeInUp <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h4 class="text-left"><?php _e( 'Cart Totals', 'woocommerce' ); ?></h4><br />
    
    <div class="table-responsive">
    
    	<table cellspacing="0" class="table table-2">
    
    		<tr class="cart-subtotal">
    			<td><span><?php _e( 'Subtotal', 'woocommerce' ); ?></span></td>
    			<td data-title="<?php _e( 'Subtotal', 'woocommerce' ); ?>"><span><?php wc_cart_totals_subtotal_html(); ?></span></td>
    		</tr>
    
    		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
    			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
    				<td><span><?php wc_cart_totals_coupon_label( $coupon ); ?></span></td>
    				<td data-title="<?php wc_cart_totals_coupon_label( $coupon ); ?>"></span><?php wc_cart_totals_coupon_html( $coupon ); ?></span></td>
    			</tr>
    		<?php endforeach; ?>
    
    		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
    
    			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
    
    			<?php wc_cart_totals_shipping_html(); ?>
    
    			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
    
	  	  <?php elseif ( WC()->cart->needs_shipping() ) : ?>
    
    			<tr class="shipping">
    				<td><span><?php _e( 'Shipping', 'woocommerce' ); ?></span></td>
    				<td data-title="<?php _e( 'Shipping', 'woocommerce' ); ?>"><span><?php woocommerce_shipping_calculator(); ?></span></td>
    			</tr>
    
    		<?php endif; ?>
    
    		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
    			<tr class="fee">
    				<td><span><?php echo esc_html( $fee->name ); ?></span></td>
    				<td data-title="<?php echo esc_html( $fee->name ); ?>"><span><?php wc_cart_totals_fee_html( $fee ); ?></span></td>
    			</tr>
    		<?php endforeach; ?>
    
    		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) :
    			$taxable_address = WC()->customer->get_taxable_address();
    			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
    					? sprintf( ' <small>(estimated for %s)</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
    					: '';
    
    			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
    				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
    					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
    						<td><span><?php echo esc_html( $tax->label ) . $estimated_text; ?></span></td>
    						<td data-title="<?php echo esc_html( $tax->label ); ?>"><span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span></td>
    					</tr>
    				<?php endforeach; ?>
    			<?php else : ?>
    				<tr class="tax-total">
    					<td><span><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></span></td>
    					<td data-title="<?php echo esc_html( WC()->countries->tax_or_vat() ); ?>"><span><?php wc_cart_totals_taxes_total_html(); ?></span></td>
    				</tr>
    			<?php endif; ?>
    		<?php endif; ?>
    
    		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
    
    		<tr class="order-total">
    			<td><span><?php _e( 'Total', 'woocommerce' ); ?></span></td>
    			<td data-title="<?php _e( 'Total', 'woocommerce' ); ?>"><span><?php wc_cart_totals_order_total_html(); ?></span></td>
    		</tr>
    
    		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
    
    	</table>
    
    </div>
	
    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>