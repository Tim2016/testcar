<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */

 get_header(); 
    
    get_template_part( 'templates/page/slider' );   // Page Slider
    get_template_part( 'templates/page/breadcrumb' ); // Page Breadcrumb
?>
	<div id="primary" class="content-area">
		<main <?php yog_helper()->attr( 'content', array( 'class' => 'site-main' ) ); ?>>

		<?php
            //Get compare page
		    $yog_compare_page = yog_helper()->get_option(  'compare-page', 'raw', false, 'options' ) ;
            if(function_exists('icl_object_id')) {
    			$id   = icl_object_id( $yog_compare_page, 'page', false, ICL_LANGUAGE_CODE );
    			if(is_page($id)) {	$yog_compare_page = $id;	}
    		}
            
            if(!empty($yog_compare_page) and get_the_id() == $yog_compare_page):        		
        		get_template_part('templates/inventory/compare');         		
	        else: 

                //Get Page Meta Data.
                $yog_page_layout = yog_helper()->get_option( 'page_layout', 'html', false, 'post' );
    			// Include the page content template.
    		    get_template_part( 'templates/page/content', $yog_page_layout );
                         
           	endif;      
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
    <?php get_template_part( 'templates/part/part', 'spare-modal' ); ?>

<?php get_footer(); 