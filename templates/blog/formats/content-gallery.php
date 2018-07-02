<div <?php yog_helper()->attr( 'post', array( 'class' => 'col-md-12 blog-list no-padding' ) ) ?>>
    <div class="blog-dark">
        <?php
            // running this in the view so it can be used by multiple functions
            $yog_attachments = get_posts(array(
            	'post_type' => 'attachment',
            	'numberposts' => -1,
            	'post_status' => null,
            	'post_parent' => get_the_ID(),
            	'order' => 'ASC',
            	'orderby' => 'menu_order ID',
            ));
            if ($yog_attachments) {
            	if (is_ssl()) {
            		add_filter('wp_get_attachment_image_attributes', 'cfpf_ssl_gallery_preview', 10, 2);
            	} ?>
            	<div class="col-md-12" id="carousel-bounding-box">
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                        	<?php
                                $yog_counter = 0;
                                foreach ($yog_attachments as $yog_attachment) {
                            		$yog_cls = ( $yog_counter == 0 )? ' active' : '';
                                    echo '<div class="item'. esc_attr( $yog_cls ) .'" data-slide-number="'. esc_attr( $yog_counter ) .'">'.wp_get_attachment_image($yog_attachment->ID, 'full', false, array( 'class' => 'img-responsive' ) ).'</div>';
                            	    $yog_counter++;
                                }
                            ?>
                         </div>
                         <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                         <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <?php
            }
        ?>
        <div class="blog-details">
            <div class="alignleft hidden-xs">
                <p <?php yog_helper()->attr( 'entry-published' ); ?>><?php echo get_the_date( 'd' ); ?><small><?php echo get_the_date( 'M' ); ?></small></p>
            </div>
            <h4 <?php yog_helper()->attr( 'entry-title' ) ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <ul class="list-inline hidden-xs">
                <li <?php echo yog_helper()->get_attr( 'entry-author' ); ?>><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a></li>
                <?php 
                    //Comments
                    $yog_num_comments = get_comments_number(); 
                    if( $yog_num_comments != 1 ){
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comments', 'html', 'Comments', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }else{
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comment', 'html', 'Comment', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }
                    
                    //Tags
                    the_tags('<li '. yog_helper()->get_attr( 'entry-terms', array( 'taxonomy' => 'post_tag' ) ) .'><i class="fa fa-tag"></i>', ', ', '</li>');
                    
                    //Category
                    the_terms( get_the_ID(), 'category', '<li '. yog_helper()->get_attr( 'entry-terms', array( 'taxonomy' => 'category' ) ) .'><i class="fa fa-folder-open"></i>', ' ',  '</li>' );
                ?>
            </ul>
        </div><!-- end meta -->
    </div><!-- end blog-wrapper -->
    <?php 
        //Page Pagination
        wp_link_pages( array(
			'before'      => '<div class="col-md-12 text-center"><ul class="pagination pagination-lg"><li>',
			'after'       => '</li></ul></div>',
			'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'separator'        => '</li><li>',
            'nextpagelink'     => esc_html__( 'Next', 'engines' ),
            'previouspagelink' => esc_html__( 'Previous', 'engines' ),
            'pagelink'         => '%',
		) );
    ?>
</div><!-- end col -->