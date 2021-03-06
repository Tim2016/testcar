<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>

<div class="section cart">
    <div class="container">
        <?php wc_print_notices(); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <h4><i class="fa fa-shopping-cart"></i> <?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></h4>
                <?php do_action( 'woocommerce_cart_is_empty' ); ?>
                <a class="pay-btn wc-backward btn btn-primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
            		<?php _e( 'Return To Shop', 'woocommerce' ) ?>
            	</a>
            </div>
        </div>
    </div>
</div>

<?php endif;