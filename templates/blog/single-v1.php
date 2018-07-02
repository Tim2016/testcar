<div <?php yog_helper()->attr( 'post', array( 'class' => 'row blog-list' ) ) ?>>
    <div class="col-md-12">
        <div class="blog-dark">
            <?php 
                echo "2222222222222222222222222222222222222222222222222222string";
                // running this in the view so it can be used by multiple functions
                $yog_attachments = get_posts(array(
                	'post_type' => 'attachment',
                	'numberposts' => -1,
                	'post_status' => null,
                	'post_parent' => get_the_ID(),
                	'order' => 'ASC',
                	'orderby' => 'menu_order ID',
                ));
                
                if( get_post_format() == 'gallery' && $yog_attachments ){
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
                                        echo '<div class="item'. esc_attr( $yog_cls ) .'" data-slide-number="'. esc_attr( $yog_counter ) .'">'. wp_get_attachment_image($yog_attachment->ID, 'full', false, array( 'class' => 'img-responsive' ) ) .'</div>';
                                	    $yog_counter++;
                                    }
                                ?>
                             </div>
                             <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-double-left"></i></a>
                             <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
            <?php }elseif( has_post_thumbnail() ){ ?>
                <div class="post-media entry">
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                </div><!-- end media -->
            <?php } ?>
            
            <div class="blog-details wbg">
                <div class="alignleft hidden-xs">
                    <p <?php echo yog_helper()->get_attr( 'entry-published' ); ?>><?php echo get_the_date( 'd' ); ?><small><?php echo get_the_date( 'M' ); ?></small></p>
                </div>
                <h4 <?php echo yog_helper()->get_attr( 'entry-title' ); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <ul class="list-inline hidden-xs">
                    <li <?php echo yog_helper()->get_attr( 'entry-author' ); ?>><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a></li>
                    <?php 
                        //Comments
                        $yog_num_comments = get_comments_number(); 
                        if( $yog_num_comments != 1 ){
                            printf( '<li><i class="fa fa-comment-o"></i> %1$s %2$s</li>', esc_html( yog_get_translation( 'tr-blog-comments' ) ), number_format_i18n( $yog_num_comments ) );
                        }else{
                            printf( '<li><i class="fa fa-comment-o"></i> %1$s %2$s</li>', esc_html( yog_get_translation( 'tr-blog-comment' ) ), number_format_i18n( $yog_num_comments ) );
                        }
                        
                         //Tags
                        the_tags('<li '. yog_helper()->get_attr( 'entry-terms', array( 'taxonomy' => 'post_tag' ) ) .'><i class="fa fa-tag"></i>', ', ', '</li>');
                        
                        //Category
                        the_terms( get_the_ID(), 'category', '<li '. yog_helper()->get_attr( 'entry-terms', array( 'taxonomy' => 'category' ) ) .'><i class="fa fa-folder-open"></i>', ' ',  '</li>' );
                    ?>
                </ul>
            </div><!-- end meta -->

            <div <?php yog_helper()->attr( 'entry-content', array( 'class' => 'blog-meta-desc' )  ) ?>>
                <?php
                    //Content 
                    the_content( sprintf(
					esc_html__( 'Continue reading %s', 'engines' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
					) ); 
                ?>
            </div><!-- end blog-meta-desc -->

            <?php if( yog_helper()->get_option( 'engines-post-single-socials', 'raw', false, 'options' ) || yog_helper()->get_option( 'engines-post-single-nav', 'raw', false, 'options' ) ): ?>
                <div class="post-share clearfix">
                    
                    <?php if( yog_helper()->get_option( 'engines-post-single-socials', 'raw', false, 'options' ) ): ?>
                        <div class="pull-left">
                            <ul class="list-inline">
                                <li><h4><?php echo yog_helper()->get_option( 'engines-author-social-title', 'html', false, 'options' ); ?></h4></li>
                                <?php 
                                    //Facebook Social Icon
                                    echo '<li><a  href="http://www.facebook.com/sharer.php?u='. get_permalink() .'&amp;t='. get_the_title() .'" title="'. esc_attr__( 'Share on Facebook.', 'engines' ) .'"><i class="fa fa-facebook"></i></a></li> ';
                                    echo '<li><a  href="http://twitter.com/home/?status='. get_the_title() .' - '. get_permalink() .'" title="'. esc_attr__( 'Tweet this!', 'engines' ) .'"><i class="fa fa-twitter"></i></a></li> ';
                                ?>
                                <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
                            </ul><!-- end ul -->
                        </div>
                    <?php endif; ?>
    
                    <?php if( yog_helper()->get_option( 'engines-post-single-nav', 'raw', false, 'options' ) ): ?>
                        <div class="pull-right">
                            <?php previous_post_link('<i class="fa fa-angle-left"></i> %link', esc_html__('Prev', 'engines') );?> | <?php previous_post_link('%link <i class="fa fa-angle-right"></i>', esc_html__('Next','engines') );?>
                        </div><!-- end right -->
                    <?php endif; ?>
                    
                </div><!-- end share -->
            <?php endif; ?>
            
            <?php 
                //Author Bio
                get_template_part( 'author', 'bio' ); 
                
                // If comments are open or we have at least one comment, load up the comment template.
 			    if ( comments_open(get_queried_object_id()) || get_comments_number() ) :
    				comments_template();
 			    endif;
            ?>
        </div><!-- end blog-wrapper -->
    </div><!-- end col --> 
</div><!-- end row -->   