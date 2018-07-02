<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
 }

 //WooCommerce Layout.  
 if( is_singular( 'product' ) ):
     $yog_sidebar_enable  = ( isset( $_GET['sidebar'] ) && !empty( $_GET['sidebar'] ) )? $_GET['sidebar'] : yog_helper()->get_option( 'product-enable-global', 'raw', false, 'options' );  
     $yog_layout   = yog_helper()->get_option( 'product-sidebar-position', 'raw', 'right', 'options' );
     $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
     $yog_class    = ( isset( $yog_sidebar_enable ) && !empty( $yog_sidebar_enable ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';
     $yog_sidebar  = yog_helper()->get_option( 'product-sidebar', 'raw', false, 'options' );  
 else:
     $yog_sidebar_enable  = ( isset( $_GET['sidebar'] ) && !empty( $_GET['sidebar'] ) )? $_GET['sidebar'] : yog_helper()->get_option( 'shop-enable-global', 'raw', false, 'options' );   
     $yog_layout   = yog_helper()->get_option( 'shop-sidebar-position', 'raw', 'right', 'options' );
     $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
     $yog_class    = ( isset( $yog_sidebar_enable ) && !empty( $yog_sidebar_enable ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';
     $yog_sidebar  = yog_helper()->get_option( 'shop-sidebar', 'raw', false, 'options' );  
 endif; 

 woocommerce_breadcrumb();  //Include Page Breadcrumb Html. 

?>
<div class="section">
    <div class="container">
        <div class="row">
        
            <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar_enable ) && !empty( $yog_sidebar_enable ) ) ): ?>
            
                 <div class="custom-sidebar col-md-3 col-sm-12">
                 
                    <?php 
                        if( $yog_sidebar ):
                            dynamic_sidebar( $yog_sidebar ); 
                        endif;
                    ?>
                    
                 </div>
                 
            <?php endif; ?>
            
            <div class="<?php echo esc_attr( $yog_class ); ?>">