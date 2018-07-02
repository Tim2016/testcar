<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ){
  return;  
} 
?>

<div class="comments">
    
    <?php 
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ){ 
            echo '<div class="section-title small-margin-title clearfix"><h5>' . esc_html( yog_get_translation( 'tr-blog-comment-off' ) ) . '</h5><hr class="custom"></div>'; 
        }else{
            //Get Number of Comments.
            $yog_num_comments = get_comments_number( get_queried_object_id() );
            if( $yog_num_comments != 1 ){
                printf( '<div class="section-title small-margin-title clearfix"><h5>%2$s %1$s</h5><hr class="custom"></div>', esc_html( yog_get_translation( 'tr-blog-comments' ) ), number_format_i18n( $yog_num_comments ) );
            }else{
                printf( '<div class="section-title small-margin-title clearfix"><h5>%2$s %1$s</h5><hr class="custom"></div>', esc_html( yog_get_translation( 'tr-blog-comment' ) ), number_format_i18n( $yog_num_comments ) );
            }    
        }
        
        if ( have_comments() ) {
            
         ?>		
            <ul class="comment-list">
    			<?php
    				wp_list_comments( array(
    					'format'      => 'html5',
    					'short_ping'  => true,
                        'callback' => 'yog_comments_callback'
    				) );
    			?>
      		</ul><!-- .comment-list -->
		<?php
			// Are there comments to navigate through?
			get_template_part( 'templates/comment/nav' );
        }
    ?>
    <div class="clearfix"></div>  
    <div class="search-tab lightversion clearfix">
        <div class="search-wrapper"> 
            <?php
                $req = get_option( 'require_name_email' );
                $aria_req = ( $req ? " aria-required='true'" : '' );
                
                //Form Fields Arguments.
                $yog_fields = array();
                $yog_fields['author'] = '<div class="row"><div class="col-md-4 col-sm-6 col-xs-12"><input id="author" name="author" type="text" class="form-control text" placeholder="'. esc_attr__( 'Name', 'engines' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div>';
                $yog_fields['email']  = '<div class="col-md-4 col-sm-6 col-xs-12"><input id="email" name="email" type="text" class="form-control text" placeholder="'. esc_attr__( 'Email', 'engines' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div>';
                $yog_fields['url']    = '<div class="col-md-4 col-sm-6 col-xs-12"><input id="url" name="url" type="text" class="form-control" placeholder="'. esc_attr__( 'Website', 'engines' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>';

                $yog_args = array(
                    'fields'        => $yog_fields,
                    'comment_field' => '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12 blog-grid"><textarea id="comment" name="comment" class="text textarea form-control" placeholder="'. esc_attr__( 'Comment', 'engines' ) .'"></textarea></div></div>',
                    'format'        => 'html5',
                    'label_submit'  => esc_html__('Submit Comment', 'engines'),
                    'comment_notes_before' => '',
                    'comment_notes_after'  => ''
                );
            
                ob_start();
                comment_form( $yog_args );
                $yog_comment_form = ob_get_clean();
                
                //Form class replacement.
                $yog_comment_form = str_replace( '<h3', '<div class="section-title small-margin-title clearfix"><h3', $yog_comment_form );
                $yog_comment_form = str_replace( '</h3>', '</h3><hr class="custom"></div>', $yog_comment_form );
                $yog_comment_form = str_replace( 'class="submit"', 'class="btn btn-primary"', $yog_comment_form );
                
                //Print Form.
                print( $yog_comment_form );
            ?>
        </div>
    </div>
</div>