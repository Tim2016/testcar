<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="shop_single_page">
    <div class="product_details">
        <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="product_top_section row">
                <div class="col-md-6">
                    <?php
                		/**
                		 * woocommerce_before_single_product_summary hook.
                		 *
                		 * @hooked woocommerce_show_product_sale_flash - 10
                		 * @hooked woocommerce_show_product_images - 20
                		 */
                		do_action( 'woocommerce_before_single_product_summary' );
                  
                	?>
                </div>
                    
                 <div class="col-md-6">
                    <div class="item_description">
                        <h4 itemprop="name"><?php the_title(); ?></h4>
                        <?php woocommerce_template_single_rating(); ?>
                        <?php woocommerce_template_single_price(); ?>
                        <?php woocommerce_template_single_excerpt(); ?>
                        <?php woocommerce_template_single_add_to_cart(); ?>
                        <?php woocommerce_template_single_meta(); ?>
                    </div>
            	</div><!-- .summary -->
            </div>  
        	<?php
        		/**
        		 * woocommerce_after_single_product_summary hook.
        		 *
        		 * @hooked woocommerce_output_product_data_tabs - 10
        		 * @hooked woocommerce_upsell_display - 15
        		 * @hooked woocommerce_output_related_products - 20
        		 */
        		do_action( 'woocommerce_after_single_product_summary' );
        	?>
            
        </div>
        <?php do_action( 'woocommerce_after_single_product' ); ?>
    </div>
</div>
    