<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

//Check Inventory post archive 
if( get_post_type() == 'inventory' ){
    get_template_part('archive-inventory');
    exit();
}

get_header(); 
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    
    //Search Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-archive-enable-global', 'raw', false, 'options' );  
    $yog_layout   = yog_helper()->get_option( 'blog-archive-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

    ?>
     <div class="section"> 
        <div class="container">
            <div class="row">
                <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-archive-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-archive-sidebar', 'raw', 'primary', 'options' ) ); 
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
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-archive-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-archive-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
         </div>
     </div>   
    <?php
 get_footer(); 