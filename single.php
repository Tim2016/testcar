<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */
 
 get_header(); 
    
    //Breadcrumb
    get_template_part( 'templates/page/breadcrumb' );
    
    //Single Layout.  
    // $yog_sidebar  = yog_helper()->get_option( 'blog-single-enable-global', 'raw', false, 'options' ); 
    // $yog_layout   = yog_helper()->get_option( 'blog-single-sidebar-position', 'raw', 'right', 'options' );
    // $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    // $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

?>


<?php
    // условие вывода страницы родукта из каталога
    $single_cat = get_the_category( $post->ID );
    $parent_slug = $single_cat[1]->slug;
    if ($parent_slug == 'product') {
        get_template_part( 'templates/part/part', 'single-product' );        
    } 
    else{
        get_template_part( 'templates/part/part', 'single-default' );        
    }

?>


<h1>Страница записи</h1>

<?php get_template_part( 'templates/part/part', 'partners' ); ?>
<?php get_template_part( 'templates/part/part', 'contacts' ); ?>
<?php get_template_part( 'templates/part/part', 'map' ); ?>
<?php get_template_part( 'templates/part/part', 'spare-modal' ); ?>





    
<?php get_footer(); 