<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! empty( $breadcrumb ) ) {

    //Get Page Meta Data.
    $engines_page_breadcrumb_bg = '';
    if( function_exists( 'rwmb_meta' ) ){
        //Get Post Meta Value.
        $engines_page_breadcrumb = rwmb_meta( 'engines_page_breadcrumb', false, get_queried_object_id() );
        $engines_page_breadcrumb_bg = rwmb_meta( 'engines_page_breadcrumb_bg', false, get_queried_object_id() );
        if( isset( $engines_page_breadcrumb_bg ) && !empty( $engines_page_breadcrumb_bg ) ){
            $engines_page_breadcrumb_bg = $engines_page_breadcrumb_bg['full_url'];
        }
        if( isset( $engines_page_breadcrumb ) && !empty( $engines_page_breadcrumb ) ){ 
           return; 
        }
    }
?>
<div class="section page-title">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="title-area pull-left">
                    <h2><?php 
                        $engines_counter = 1;
                        foreach ( $breadcrumb as $key => $crumb ) {
                            if( $engines_counter == 2 ){
                                echo esc_html( $crumb[0] );
                            }
                            
                            $engines_counter++;
                    	} 
                     ?></h2>
                </div><!-- /.pull-right -->
                <div class="pull-right">
                    <div class="bread">
                        <ol class="breadcrumb">
                            <?php                    
                                if(function_exists('bcn_display')) {
                                    bcn_display_list();
                                }  
                            ?>
                        </ol>
                    </div><!-- end bread -->
                </div><!-- /.pull-right -->
            </div><!-- end col -->
        </div><!-- end page-title -->
    </div><!-- end container -->
</div><!-- end section -->
<?php }