<li <?php yog_helper()->attr( 'comment' ); ?>>
    
    <div class="author-details">
        <?php 
            $yog_avt =  get_avatar( $comment, 100 ); 
            echo str_replace( 'photo', 'photo alignleft', $yog_avt );
        ?>
        
        <h3 <?php yog_helper()->attr( 'comment-author' ); ?>><?php comment_author(); ?></h3>
        
        <small <?php yog_helper()->attr( 'comment-published' ); ?>>
            <?php printf( esc_html__( '%1$s at %2$s / %3$s', 'engines' ), get_comment_date(), get_comment_time(), yog_get_comment_reply_link() ) ?>
        </small>
        
        <?php if ( $comment->comment_approved == '0' ) { ?>
            <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'engines' ); ?></em><br />
        <?php
          }else{
            echo '<div '. yog_helper()->get_attr( 'comment_content' ) .'>';
            
                //Comment Text
                comment_text();  
                
            echo '</div>';
          }
        ?>
    </div><!-- end details -->