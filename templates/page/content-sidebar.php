<?php 

    //Page Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'page-enable-global', 'raw', false, 'options' );
    if( current_theme_supports( 'theme-demo' ) && !empty( $_GET['ps'] ) ) {
		$yog_sidebar = $_GET['ps'];
	}  
    $yog_layout = ( yog_helper()->get_option( 'page-sidebar-position', 'raw', 'right', 'post' ) )? yog_helper()->get_option( 'page-sidebar-position', 'raw', 'right', 'post' ) : yog_helper()->get_option( 'page-sidebar-position', 'raw', 'right', 'options' );
    $yog_sidebar = ( yog_helper()->get_option( 'page-sidebar', 'raw', false, 'post' ) )? yog_helper()->get_option( 'page-sidebar', 'raw', false, 'post' ) : yog_helper()->get_option( 'page-sidebar', 'raw', 'primary', 'options' );
    $yog_class = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';
?>

<h1>content-sidebar</h1>
<div class="section">
    <div class="container">
        <div class="row">
            <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ): ?>
                <div class="custom-sidebar col-md-3 col-sm-12">
                    <?php 
                        if( is_dynamic_sidebar( $yog_sidebar ) ):
                            dynamic_sidebar( $yog_sidebar ); 
                        endif;
                     ?>
                </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr( $yog_class ); ?>">
                <article <?php yog_helper()->attr( 'post' ) ?> id="response">

                	<div <?php yog_helper()->attr( 'entry-content' ) ?>>
                		<?php
                            if ( have_posts() ) :
                
                        		// Start the loop.
                        		while ( have_posts() ) : the_post();
                                    
                                    //Page Contents
                                     the_content(); 
                                                
                                     //Page Pagination
                                     wp_link_pages( array(
                        				'before'           => '<div class="col-md-12 text-center"><ul class="pagination-nav"><li>',
                        				'after'            => '</li></ul></div>',
                        				'link_before'      => '',
                                        'link_after'       => '',
                                        'next_or_number'   => 'number',
                                        'separator'        => '</li><li>',
                                        'nextpagelink'     => esc_html__( 'Next', 'engines' ),
                                        'previouspagelink' => esc_html__( 'Previous', 'engines' ),
                                        'pagelink'         => '%',
                        			 ) );
                                    
                                     // If comments are open or we have at least one comment, load up the comment template.
                        			 if ( comments_open( get_queried_object_id() ) || get_comments_number() ) :
                                        comments_template();
                        			 endif;
                        
                        		// End the loop.
                        		endwhile;
                                
                            // If no content, include the "No posts found" template.
                        	else :
                        		get_template_part( 'templates/page/content', 'none' );
                        
                        	endif;  
                		?>
                	</div><!-- .entry-content -->
                
                </article><!-- #post-## -->
            </div>
            <?php if( 'right' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ): ?>
                <div class="custom-sidebar col-md-3 col-sm-12">
                    <?php 
                        if( is_dynamic_sidebar( $yog_sidebar ) ):
                            dynamic_sidebar( $yog_sidebar ); 
                        endif;
                     ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>