<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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
?>
<div class="cart">
    <div class="row">
        <?php wc_print_notices(); ?>
        
        <div class="col-md-3 col-sm-12">
            <?php
                /**
                 * My Account navigation.
                 * @since 2.6.0
                 */
                do_action( 'woocommerce_account_navigation' );
            
            ?>
        </div>
        <div class="col-md-9 col-sm-12">
            <?php
        		/**
        		 * My Account content.
        		 * @since 2.6.0
        		 */
        		do_action( 'woocommerce_account_content' );
        	?>
        </div>
    </div>
</div>
