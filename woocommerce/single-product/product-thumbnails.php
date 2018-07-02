<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

$thumbnail = $thumbnail_image = '';

if ( $attachment_ids && has_post_thumbnail() ) {
    
    $loop = 0; 
	
    foreach ( $attachment_ids as $attachment_id ) {

		$classes = array( 'zoom' );

		$image_link = wp_get_attachment_url( $attachment_id );

		if ( ! $image_link )
			continue;

		$image_title 	= esc_attr( get_the_title( $attachment_id ) );
		$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

		$image_class = esc_attr( implode( ' ', $classes ) );
        $yog_cls = ( $loop == 0 )? ' active' : '';
        $thumbnail_image .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="item'. esc_attr( $yog_cls ) .'"><a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]"><img src="%s" alt="%s" title="%s" class="img-responsive"/></a></div>', $image_link, $image_class, $image_caption, $image_link,$image_title, $image_title  ), $attachment_id, $post->ID, $image_class );
        
        $loop++;
	}
?>
<div id="carousel-bounding-box">
    <div id="myCarousel" class="carousel slide">
        <div class="carousel-inner">
        	<?php echo $thumbnail_image; ?>
         </div>
         <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
         <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div>
</div>
<?php }else{
    
    if( has_post_thumbnail() ){
        
		$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
        $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
        $full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
        $image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
        $placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
        $wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
        	'woocommerce-product-gallery',
        	'woocommerce-product-gallery--' . $placeholder,
        	'woocommerce-product-gallery--columns-' . absint( $columns ),
        	'images',
        ) );
        
		$attributes = array(
			'title'                   => $image_title,
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);

		if ( has_post_thumbnail() ) {
			$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
			$html .= '</a></div>';
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );

		do_action( 'woocommerce_product_thumbnails' );
        
	} 
    do_action( 'woocommerce_product_thumbnails' ); 
}
    
