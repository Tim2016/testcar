<div <?php yog_helper()->attr( 'post', array( 'class' => 'row blog-list withimage blog-grid' ) ) ?>>
    <div class="col-md-4 col-sm-12 col-xs-12 blog-grid">
        <?php if( has_post_thumbnail() ): ?>
            <div class="blog-wrapper">
                <div class="post-media entry">
                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                    <div class="magnifier colorized">
                        <a href="<?php the_permalink(); ?>"><i class="flaticon-link"></i></a>
                    </div>
                </div><!-- end media -->
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="blog-description">
            <h4 <?php yog_helper()->attr( 'entry-title' ) ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>  
            <ul class="list-inline hidden-xs">
                <li <?php yog_helper()->attr( 'entry-author' ); ?>><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a></li>
                <?php 
                    //Date
                    printf( '<li '. yog_helper()->get_attr( 'entry-published' ) .'><a href="'. get_permalink() .'" %1$s><i class="fa fa-clock-o"></i> %2$s</a></li>', yog_helper()->get_attr( 'entry-published' ), get_the_date( get_option( 'date_format' ) ) );
                    
                    //Comments
                    $yog_num_comments = get_comments_number(); 
                    if( $yog_num_comments != 1 ){
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comments', 'html', 'Comments', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }else{
                        printf( '<li><a href="%1$s"><i class="fa fa-comment-o"></i> %2$s %3$s</a></li>', get_permalink(), yog_helper()->get_option( 'tr-blog-comment', 'html', 'Comment', 'options' ), number_format_i18n( $yog_num_comments ) );
                    }
                ?>
            </ul>
            <div <?php yog_helper()->attr( 'entry-summary' ) ?>><?php echo yog_get_excerpt( array( 'engines_length' => 50 ) ); ?></div>
        </div><!-- end blog-wrapper -->
    </div><!-- end col --> 
</div><!-- end row -->