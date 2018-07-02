<?php
/**
 * The main template file
 *
 * @package base-theme
 */
get_header(); 
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    
    //Blog Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-enable-global', 'raw', false, 'options' ); 
    $yog_layout   = yog_helper()->get_option( 'blog-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

    ?>
     <div class="section"> 
        <div class="container-fluid">
            <div class="row">
                <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
                
                <div class="<?php echo esc_attr( $yog_class ); ?>">
                    <?php
                        if ( have_posts() ) :
                    
                            // Start the loop.
                    		while ( have_posts() ) : the_post();
                    
                    			/*
                    			 * Include the Post-Format-specific template for the content.
                    			 * If you want to override this in a child theme, then include a file
                    			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                    			 */
                                 $yog_layouts = yog_helper()->get_option( 'engines-blog-layout', 'raw', 'simple', 'options' );
                        		 if( current_theme_supports( 'theme-demo' ) && !empty( $_GET['p'] ) ) {
                        			$yog_layouts = $_GET['p'];
                        		 }
                                 
                                 if( 'list' == $yog_layouts ):
                                    get_template_part( 'templates/blog/formats/content-list', get_post_format() );
                                 elseif( 'grid' == $yog_layouts ):
                                    get_template_part( 'templates/blog/formats/content-grid', get_post_format() );
                                 else:
                                    get_template_part( 'templates/blog/formats/content', get_post_format() );
                                 endif;
                    
                    		// End the loop.
                    		endwhile;
                            
                            //Pagination
                            yog_wp_paginate( array( 'before' => '<div class="col-md-12 text-center">', 'after' => '</div>', 'class' => 'pagination pagination-lg', 'title' => false, 'nextpage' => '<i class="fa fa-angle-right"></i>', 'previouspage' => '<i class="fa fa-angle-left"></i>' ) );    
                    
                    	// If no content, include the "No posts found" template.
                    	else :
                    		get_template_part( 'templates/page/content', 'none' );
                    
                    	endif;
                    ?>
                </div>
                
                <?php if( 'right' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
         </div>
     </div>   
    <?php
 get_footer(); 