<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
$classes[] = yog_get_column( $woocommerce_loop['columns'] )
?>
<div <?php post_class( $classes ); ?>>
    <div class="shop-wrapper car-wrapper clearfix">
        <div class="post-media entry">
            <?php 
                woocommerce_show_product_loop_sale_flash();
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
                echo '<img src="'. esc_url( $thumb[0] ) .'" alt="" class="img-responsive">'; 
            ?>
        </div><!-- end post-media -->

        <div class="car-title clearfix">
            <div class="pull-left">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php woocommerce_template_loop_price(); //Price?>
            </div>
            <?php
                /**
            	 * woocommerce_after_shop_loop_item_title hook.
            	 *
            	 * @hooked woocommerce_template_loop_rating - 5
            	 * @hooked woocommerce_template_loop_price - 10
            	 */
            	do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div><!-- end car-title -->
        <?php
            /**
        	 * woocommerce_after_shop_loop_item hook.
        	 *
        	 * @hooked woocommerce_template_loop_product_link_close - 5
        	 * @hooked woocommerce_template_loop_add_to_cart - 10
        	 */
        	do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div><!-- end clearfix -->
</div>