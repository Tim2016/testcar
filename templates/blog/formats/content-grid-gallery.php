<div <?php yog_helper()->attr( 'post', array( 'class' => yog_get_post_grid_class() ) ) ?>>
    <div class="blog-wrapper">
        <?php
            // running this in the view so it can be used by multiple functions
            $engines_attachments = get_posts(array(
            	'post_type' => 'attachment',
            	'numberposts' => -1,
            	'post_status' => null,
            	'post_parent' => get_the_ID(),
            	'order' => 'ASC',
            	'orderby' => 'menu_order ID',
            ));
            if ($engines_attachments) {
            	if (is_ssl()) {
            		add_filter('wp_get_attachment_image_attributes', 'cfpf_ssl_gallery_preview', 10, 2);
            	} ?>
            	<div class="col-md-12" id="carousel-bounding-box">
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                        	<?php
                                $engines_counter = 0;
                                foreach ($engines_attachments as $engines_attachment) {
                            		$engines_cls = ( $engines_counter == 0 )? ' active' : '';
                                    echo '<div class="item'. esc_attr( $engines_cls ) .'" data-slide-number="'. esc_attr( $engines_counter ) .'">'.wp_get_attachment_image($engines_attachment->ID, 'full', false, array( 'class' => 'img-responsive' ) ).'</div>';
                            	    $engines_counter++;
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
            <h4 <?php yog_helper()->attr( 'entry-title' ) ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div <?php yog_helper()->attr( 'entry-summary' ) ?>><?php echo yog_get_excerpt( array( 'yog_link_to_post' => false ) ); ?></div>
        </div><!-- end details -->

        <div class="blog-meta">
            <ul class="list-inline">
                <li <?php yog_helper()->attr( 'entry-author' ); ?>><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a></li>
                <?php 
                    //Date
                    printf( '<li '. yog_helper()->get_attr( 'entry-published' ) .'><a href="'. get_permalink() .'" %1$s><i class="fa fa-clock-o"></i> %2$s</a></li>', yog_helper()->get_attr( 'entry-published' ), get_the_date(get_option('date_format')) );
                    
                    //Comments
                    $yog_num_comments = get_comments_number(); 
                    if( $yog_num_comments != 1 ){
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comments', 'html', 'Comments', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }else{
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comment', 'html', 'Comment', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }
                ?>
            </ul>
        </div><!-- end meta -->
    </div><!-- end blog-wrapper -->
</div>