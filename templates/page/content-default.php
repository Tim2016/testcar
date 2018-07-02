<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
?>
<h1>content-Default</h1>
<div <?php yog_helper()->attr( 'post', array( 'class' => 'section' ) ); ?>>
    <!--?php 
        $sss = yog_helper()->attr( 'post', array( 'class' => 'section' ) );
        echo $sss;
     ?-->
	<div <?php yog_helper()->attr( 'entry-content', array( 'class' => 'container entry-content' ) ); ?>>
		<?php
            if ( have_posts() ) :

        		// Start the loop.
        		while ( have_posts() ) : the_post();
                    
                    //Page Contents
                     the_content();
                     // get_template_part( 'templates/page/content-suka-local');


                                
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

</div><!-- #post-## -->
