<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating   = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    
    <div class="author-details">
        <?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) : ?>

			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
				<?php echo str_repeat( '<i class="fa fa-star"></i>', $rating ); ?>
			</div>
            
        <?php 
            endif;
            
            //Avatar.
            $engines_avatar =  get_avatar( $comment, 100 ); 
            echo str_replace( 'photo', 'alignleft', $engines_avatar );
        ?>
        
        <h3 itemprop="author"><?php comment_author(); ?></h3>
        
        <small itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>">
            <?php printf( esc_html__( '%1$s at %2$s', 'woocommerce' ), get_comment_date( wc_date_format() ), get_comment_time( wc_date_format() ) ) ?> / 
            <?php 
                //Comment Reply Link
                comment_reply_link( array_merge( $args, array(
                    'depth' => $depth,
                    'reply_text' => esc_attr( yog_helper()->get_option(  'tr-blog-comment-reply', 'raw', 'Reply', 'options' ) ),
                    'max_depth' => $args['max_depth'],
                ) ) );
            ?>
        </small>
        
        <?php if ( $comment->comment_approved == '0' ) : ?>
			
            <p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
		
        <?php endif; ?>
        
        <?php do_action( 'woocommerce_review_before_comment_text', $comment ); ?>
		  
          <p itemprop="description" class="description"><?php comment_text(); ?></p>
          
		<?php do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
        
    </div>