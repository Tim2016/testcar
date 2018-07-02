<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<section class="shop-content">
    <div class="container">
        <div class="row">
            <div class="emtrycart col-md-6 col-md-offset-3 text-center">
                <h4><i class="fa fa-fa-thumbs-o-down"></i> <?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></h4>
                <?php do_action( 'woocommerce_cart_is_empty' ); ?>
                <div class="bluebg continueshop text-center">
                    <h4>
                        <a class="pay-btn wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                    		<?php _e( 'Return To Shop', 'woocommerce' ) ?>
                    	</a>
                    </h4>
                </div>
            </div><!-- end emtrycart -->
        </div>
    </div><!-- end container -->
</section>