<?php
/**
 * Theme Framework
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [yog_get_header_view description]
 * @method yog_get_header_view
 * @return [type]             [description]
 */
add_action( 'yog_header', 'yog_get_header_view' );
function yog_get_header_view() {
	$yog_header_layout = ( yog_helper()->get_option( 'header-template', 'raw', false, 'post' ) )? yog_helper()->get_option( 'header-template', 'raw', false, 'post' ) : yog_helper()->get_option( 'engines-header-type', 'raw', 'v1', 'options' );   
    get_template_part( 'templates/header/header', $yog_header_layout );    
}

/**
 * [yog_get_footer_view description]
 * @method yog_get_footer_view
 * @return [type]             [description]
 */
add_action( 'yog_footer', 'yog_get_footer_view' );
function yog_get_footer_view() {
	$yog_footer_layout = ( yog_helper()->get_option( 'footer-template', 'raw', false, 'post' ) )? yog_helper()->get_option( 'footer-template', 'raw', false, 'post' ) : yog_helper()->get_option( 'engines-footer-type', 'raw', 'v1', 'options' );   
    get_template_part( 'templates/footer/footer', $yog_footer_layout );
}

/**
 * [yog_custom_sidebars description]
 * @method yog_custom_sidebars
 * @return [type]                [description]
 */
add_action( 'widgets_init', 'yog_custom_sidebars' );
function yog_custom_sidebars() {

	//adding custom sidebars defined in theme options
	$custom_sidebars = yog_helper()->get_theme_option( 'custom-sidebars' );
	$custom_sidebars = array_filter( (array)$custom_sidebars );

	if ( !empty( $custom_sidebars ) ) {

		foreach ( $custom_sidebars as $sidebar ) {

			register_sidebar ( array (
				'name' => $sidebar,
				'id' => sanitize_title( $sidebar ),
				'before_widget' => '<div id="%1$s" class="primary widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title'  => '<div class="section-title clearfix"><h5>',
				'after_title'   => '</h5><hr class="custom"></div>',
			) );
		}
	}
}

/**
 * Remove ver variable from enqueued scripts and css files
 * E.g. http://yourdomain/style.css?ver=1.3
 *
 * @method yog_clear_files_query_string
 * @param  [type]                         $src [description]
 * @return [type]                              [description]
 */

add_action( 'init', function(){
	if ( yog_helper()->get_theme_option( 'clear-static-files' ) ) {
		add_filter( 'script_loader_src', 'yog_clear_files_query_string', 9999 );
		add_filter( 'style_loader_src', 'yog_clear_files_query_string', 9999 );
	}
});
function yog_clear_files_query_string( $src ) {

	$src = remove_query_arg( 'ver', $src );

	return $src;
}

/**
 * Remove type and id attribute from stylesheet
 * @method yog_html5_stylesheet
 * @param  [type]                 $html   [description]
 * @param  [type]                 $handle [description]
 * @return [type]                         [description]
 */

if( current_theme_supports( 'html5', 'yog-assets' ) ) {
	add_filter( 'style_loader_tag', 'yog_html5_stylesheet', 10, 2 );
	add_filter( 'script_loader_tag', 'yog_html5_stylesheet', 10, 2 );
}
function yog_html5_stylesheet( $html, $handle ) {

	$html = str_replace(" type='text/css'", '', $html );
	$html = str_replace(" type='text/javascript'", '', $html );
    return str_replace( " id='$handle-css' ", '', $html );
}


/**
 * [yog_wrapper_start description]
 * @method yog_wrapper_start
 * @return [type]             [description]
 */
add_action( 'yog_before', 'yog_wrapper_start', 0 );
function yog_wrapper_start() {
    
    //Wrapper Start.
    $yog_class = yog_helper()->get_option( 'page-layout', 'raw', 'wide', 'options' );
    echo '<div id="wrap" class="wrapper '. esc_attr( $yog_class ) .'">';
    
    // Box Background
	$bg_img = $custom_css = '';
	$bg_type = yog_helper()->get_option( 'page-background-type', 'raw', '', 'options' );
    $theme_color = yog_helper()->get_option( 'page-color', 'raw', '', 'options' );
    
	if( 'solid' === $bg_type && $color = yog_helper()->get_option( 'page-bar-solid', 'raw', '', 'options' ) ) {
		$bg_img = 'background-color: ' . $color;
	}
	elseif( 'gradient' === $bg_type && $gradient = yog_helper()->get_option( 'page-bar-gradient', 'raw', '', 'options' ) ) {
		$gradient = explode( '|', $gradient );
		$gradient[0] = 'background-image:' . $gradient[0];
		$bg_img = join( ';', $gradient );
	}
	elseif( 'image' === $bg_type && $bg = yog_helper()->get_option( 'page-bar-bg', 'raw', '', 'options' ) ) {
		$bg_img = 'background-image: url('.$bg['url'].');background-size: cover;';
	}
    //Body Css
    if( !empty( $bg_img ) && $yog_class != 'wide'){
        $custom_css = "body{{$bg_img}}";
    }
    
    //Body Css
    if( !empty( $theme_color ) && $theme_color != 'transparent' ){
        $custom_css .= "
        .color1,
        .woocommerce-MyAccount-navigation li:hover a {
            background-color: {$theme_color};
        }
        
        .color2 {
            background-color: {$theme_color};
            filter: brightness(85%);
        }
        
        .header {
            border-top-color: {$theme_color};
        }
        
        .banner-message .badge,
        .pagination > li > a:hover,
        .pagination > li > a:focus,
        .pagination > li > span:hover,
        .pagination > li > span:focus,
        a.stock:hover,
        .loan-cart,
        a.stock:focus,
        .list-top .list-inline li:hover a,
        .list-top .list-inline li:focus a,
        .list-top .list-inline li.active a,
        .section.bg,
        .tagcloud a:hover,
        .owl-theme .owl-dots .owl-dot span,
        .car-km,
        .car-oil,
        .car-date,
        .car-price,
        .rv-banner .contact_us,
        .btn-primary,
        .color1_bg,
        .hephaistos.tparrows .arrow-holder,
        .navbar-inverse .dropdown-menu > li > a:hover,
        .navbar-inverse .dropdown-menu > li > a:focus,
        .navbar-cart small {
            color: #ffffff !important;
            border-color: {$theme_color};
            background-color: {$theme_color};
        }
        
        .btn-primary:hover,
        .btn-primary:focus {
            color: #ffffff !important;
            border-color: #ea5d01;
            background-color: #ea5d01;
        }
        
        .cart .shop_cart_table .icon_holder,
        .post-share li a:hover,
        .post-share li a:focus,
        .blogread:hover,
        .blogread:focus,
        .blog-list .blog-details .alignleft,
        .custom-sidebar .tagcloud a:hover,
        .custom-sidebar .tagcloud a:focus,
        .faqs-wrapper li:hover,
        .faqs-wrapper li.active,
        .shop-wrapper:hover img,
        .shop-button:hover,
        .shop-button:focus,
        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus,
        .calculator-body .btn-default {
            color: #ffffff !important;
            border-color: {$theme_color} !important;
            background-color: {$theme_color} !important;
        }
        
        .about-list .service-hover:hover,
        .price_slider_wrapper .ui-slider-range {
            background: {$theme_color} !important;
        }
        
        .comparebox .btn-info.active,
        .comparebox .btn-info:active,
        .comparebox .open > .dropdown-toggle.btn-info,
        .comparebox .btn-info:hover,
        .comparebox .btn-info:focus {
            border-color: {$theme_color} !important;
        }
        
        .shop_single_page .product_details .product-review-tab .add_your_review ul li:hover,
        .newprice,
        .shop-wrapper .woocommerce-Price-amount,
        .shop_single_page .product_details .product_top_section .item_description .item_price,
        .rating i,
        .author-details a,
        .blog-description li i,
        .blog-dark .blog-details li i,
        .blog-meta li i,
        .team-desc p,
        .widget-footer .val,
        .calculate-details span,
        .color,
        #accordion-first .accordion-heading .accordion-toggle > em,
        .special-offer small,
        .normallist i,
        .car-list-wrapper-2 li i,
        .car-table:hover i,
        .car-table:hover p,
        .brochures i,
        .totalpay,
        .custom-sidebar .search-tab a.customa,
        .glyphicon-time,
        a:hover,
        a:focus,
        .breadcrumb > li + li::before,
        .service-hours sup,
        .service-hours i,
        .search-wrapper small,
        .search-wrapper sup,
        .customlist i,
        .service-hover i,
        .contact-version i,
        .navbar-inverse .navbar-nav > li > a.active,
        .custom-title,
        .related-post small,
        .contact-widget li a,
        .footer .twitter-widget p a,
        .twitter-widget i,
        .rating i,
        .testimonial small,
        .readmore,
        .service-box small,
        .magnifier .magni-desc i,
        .car-wrapper:hover h4 a,
        .search-tab .dropdown-menu > li:hover a,
        .search-tab-nav.nav-tabs > li.active > a,
        .search-tab-nav.nav-tabs > li.active > a:focus,
        .search-tab-nav.nav-tabs > li.active > a:hover,
        .stat-wrap i,
        .copyrights .text-left a,
        .copyrights small,
        .hephaistos.tparrows.tp-rightarrow .arrow-holder:before,
        .hephaistos.tparrows.tp-leftarrow .arrow-holder:before,
        .navbar-inverse .navbar-nav > li:hover a:after,
        .navbar-inverse .navbar-nav li:hover a,
        .navbar-inverse .navbar-nav > .active > a:focus,
        .navbar-inverse .navbar-nav > .active > a:hover .navbar-inverse .navbar-nav > .active > a,
        .header-contact i{
            color: {$theme_color};
        }
        .tabs-left > .nav-tabs .active > a:focus:after, 
        .tabs-left > .nav-tabs .active > a:hover:after, 
        .tabs-left > .nav-tabs .active > a:after{
            border-left-color: {$theme_color};
        }
        .search-tab .btn-info:hover,
        .search-tab .btn-info:focus,
        .search-tab .btn-info.active.focus,
        .search-tab .btn-info.active:focus,
        .search-tab .btn-info.active:hover,
        .search-tab .btn-info.focus:active,
        .search-tab .btn-info:active:focus,
        .search-tab .btn-info:active:hover,
        .search-tab .open > .dropdown-toggle.btn-info,
        .search-tab .open > .dropdown-toggle.btn-info.focus,
        .search-tab .open > .dropdown-toggle.btn-info:focus,
        .search-tab .open > .dropdown-toggle.btn-info:hover {
            border-color: {$theme_color} !important;
            color: #ffffff;
        }
        
        .navbar-inverse .navbar-nav li:hover .dropdown-menu li a {
            color: #222222 !important;
        }
        
        .navbar-inverse .navbar-nav li:hover .dropdown-menu > li > a:hover,
        .navbar-inverse .navbar-nav li:hover .dropdown-menu > li > a:focus {
            color: #ffffff !important;
            background-color: {$theme_color};
        }";
    }
    
    if( isset( $custom_css ) && !empty( $custom_css ) ){
        yog_theme_assets()->yog_inline_css_script($custom_css);
    }
}

/**
 * [yog_wrapper_end description]
 * @method yog_wrapper_end
 * @return [type]             [description]
 */
add_action( 'yog_after', 'yog_wrapper_end', 0 );
function yog_wrapper_end() {
    echo '</div>'; //Wrapper Div Close
}
// Load our function when hook is set
/**
 * [yog_process_image_placeholders description]
 * @method yog_process_image_placeholders
 * @param  [type]                           $matches [description]
 * @return [type]                                    [description]
 */
if( isset( $_GET['condition'] ) && !empty( $_GET['condition'] ) ){
   function yog_modify_query_get_inventory( $query ) {
        
        $condition = ( $_GET['condition'] == 'used' )? 'old' : $_GET['condition'];
        
    	// Check if on frontend and main query is modified
    	if( ! is_admin() && $query->is_main_query() && $query->query_vars['post_type'] == 'inventory' ) {
     
    		$query->set('meta_key', 'inv_condition');
    		$query->set('meta_value', $condition);
     
    	}
        
        if( ( isset( $_GET['price_min'] ) && !empty( $_GET['price_min'] ) ) && ( isset( $_GET['price_max'] ) && !empty( $_GET['price_max'] ) ) ){
            $query->set( 'meta_query', array(
                array(
                      'key' => 'inv_price',
                      'value' => array( $_GET['price_min'], $_GET['price_max'] ),
    				  'type' => 'numeric',
    				  'compare' => 'between'
                )
           ));
        }elseif( isset( $_GET['price_min'] ) && !empty( $_GET['price_min'] ) ){
            $query->set( 'meta_query', array(
                array(
                      'key' => 'inv_price',
                      'value' => $_GET['price_min'],
    				  'type' => 'numeric',
    				  'compare' => '>'
                )
           ));
        }elseif( isset( $_GET['price_max'] ) && !empty( $_GET['price_max'] ) ){
            $query->set( 'meta_query', array(
                array(
                      'key' => 'inv_price',
                      'value' => $_GET['price_max'],
    				  'type' => 'numeric',
    				  'compare' => '<'
                )
           ));
        }
     
    }
    add_action( 'pre_get_posts', 'yog_modify_query_get_inventory' );
}

/**
 * Remove Defualt Excerpt filters 
 */
remove_all_filters( 'get_the_excerpt' );
remove_all_filters( 'the_excerpt' );