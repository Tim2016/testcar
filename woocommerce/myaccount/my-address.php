<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', esc_html__( 'My Addresses', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => esc_html__( 'Billing Address', 'woocommerce' ),
		'shipping' => esc_html__( 'Shipping Address', 'woocommerce' )
	), $customer_id );
} else {
	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', esc_html__( 'My Address', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  esc_html__( 'Billing Address', 'woocommerce' )
	), $customer_id );
}

$col = 1;
?>
<div class="ma-address">

    <h3 class="text-left"><?php echo $page_title; ?></h3>
           
    <p class="myaccount_address">
    	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); ?>
    </p>
    
    <div class="row">
    <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) echo '<div class=" addresses">'; ?>
        <?php foreach ( $get_addresses as $name => $title ) : ?>
        
        	<div class="col-md-6 address">
    			<h4>
                    <?php echo $title; ?><a href="<?php echo wc_get_endpoint_url( 'edit-address', $name ); ?>" class="edit"> <?php _e( 'Edit', 'woocommerce' ); ?></a>
                </h4>
        		<address>
        			<?php
        				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
        					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
        					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
        					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
        					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
        					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
        					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
        					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
        					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
        					'country'     => get_user_meta( $customer_id, $name . '_country', true )
        				), $customer_id, $name );
        
        				$formatted_address = WC()->countries->get_formatted_address( $address );
        
        				if ( ! $formatted_address )
        					_e( 'You have not set up this type of address yet.', 'woocommerce' );
        				else
        					echo $formatted_address;
        			?>
        		</address>
        	</div>
        
        <?php endforeach; ?>
    </div>
    <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) echo '</div>'; ?>
</div>