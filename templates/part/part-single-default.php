<!--?php
    
    //Breadcrumb
    get_template_part( 'templates/page/breadcrumb' );
    
    //Single Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-single-enable-global', 'raw', false, 'options' ); 
    $yog_layout   = yog_helper()->get_option( 'blog-single-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

    ?-->
     <div class="section"> 
        <div class="container">
            <div class="row">
                <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-single-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-single-sidebar', 'raw', 'primary', 'options' ) ); 
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
                                 $yog_layouts = yog_helper()->get_option( 'engines-blog-single-layout', 'raw', 'one', 'options' );
                        		 if( isset( $_GET['blog_single_style'] ) && !empty( $_GET['blog_single_style'] ) ) {
                        			$yog_layouts = $_GET['blog_single_style'];
                        		 }
                                 
                                 // форматы вывода записи
                                 if( 'one' == $yog_layouts ):
                                    // get_template_part( 'templates/blog/single', 'v1' );
                                    get_template_part( 'templates/blog/single', 'v2' );

                                 else:
                                    get_template_part( 'templates/blog/single', 'v2' );
                                 endif;
                    			
                                
                                //Page Pagination
                                wp_link_pages( array(
                    				'before'      => '<div class="col-md-12 text-center"><ul class="pagination-nav"><li>',
                    				'after'       => '</li></ul></div>',
                    				'link_before'      => '',
                                    'link_after'       => '',
                                    'next_or_number'   => 'number',
                                    'separator'        => '</li><li>',
                                    'nextpagelink'     => esc_html__( 'Next', 'engines' ),
                                    'previouspagelink' => esc_html__( 'Previous', 'engines' ),
                                    'pagelink'         => '%',
                    			) );
                    
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
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'blog-single-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'blog-single-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
         </div>
     </div>   
