<?php
/**
 * Theme Framework
 * The Yog_Theme initiate the theme engine
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


add_theme_support( 'theme-demo' );

// Custom Post Type Supports
add_theme_support( 'team' );
add_theme_support( 'testimonial' );

//Theme Support
add_theme_support( 'custom-header', array() );
add_theme_support( 'custom-background', array() );

// Custom Extensions
add_theme_support( 'yog-extension', array(
	'mega-menu',
    'pagination'
) );

// Set theme options
yog()->set_option_name( 'engines' );
add_theme_support( 'yog-theme-options', array(
	'general',
	'header',
	'logo',
	'footer',
	'sidebars',
	'typography',
	'blog',
    'inventory',
	'woocommerce',
	'extras',
	'advanced',
	'custom-code',
	'export'
));


//Set available metaboxes
add_theme_support( 'yog-metaboxes', array(
	'page',
	'team',
	'testimonial',
    'inventory'
));


//Enable support for Post Formats.
//See http://codex.wordpress.org/Post_Formats
add_theme_support( 'post-formats', array(
	'image', 'gallery'
) );


// Sets up theme navigation locations.
register_nav_menus( array(
   'primary' => esc_html__( 'Primary Menu', 'engines' ),
   'footer' => esc_html__( 'Footer Menu', 'engines' )
));

//Set menu support
add_theme_support( 'yog-core-menus', array(
    'primary' => 'Primary Menu',
    'footer' => 'Footer Menu'
) );

// Tell the TinyMCE editor to use a custom stylesheet
add_editor_style( get_template_directory_uri().'/assets/css/editor-style.css' );

// Register Widgets Area.
function yog_widgets_init() {
    
	//Primary Sidebar
    register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar Widget Area', 'engines' ),
		'id'            => 'primary',
		'description'   => esc_html__( 'Appears in primary sidebar area.', 'engines' ),
		'before_widget' => '<div id="%1$s" class="primary widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="section-title clearfix"><h5>',
		'after_title'   => '</h5><hr class="custom"></div>',
	) );
    
    //Woocommerce Sidebar
    register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Sidebar', 'engines' ),
		'id'            => 'woocommerce',
		'description'   => esc_html__( 'Appears in WooCommerce sidebar area.', 'engines' ),
		'before_widget' => '<div id="%1$s" class="primary widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="section-title clearfix"><h5>',
		'after_title'   => '</h5><hr class="custom"></div>',
	) );
    
    $yog_sidebars = $yog_args = array();
    
    $yog_footer_sidebars = 6;
    for ( $i = 0; $i < $yog_footer_sidebars; $i++ ){
        $yog_sidebars['footer-' . ( $i + 1 )] = array(
            'name' => esc_html__( 'Footer ', 'engines' ) . ( $i + 1 ),
            'description' => esc_html__( 'A widget area loaded in the footer style one of the site.', 'engines' ),
            'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<div class="widget-title"><h4>',
    		'after_title'   => '</h4></div>',
        );
    }
    
    //Footer Sidebar.
    foreach( $yog_sidebars as $yog_id => $yog_arg ){
        $yog_args = $yog_arg;
        $yog_args['id'] = ( isset( $yog_arg[$yog_id] ) ? sanitize_key( $yog_arg[$yog_id] ) : sanitize_key( $yog_id ) );
        
        // Register the sidebar.
        register_sidebar( $yog_args );
    } 
    
    //Footer Style Two Sidebar
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'engines' ),
		'id'            => 'footer-7',
		'description'   => esc_html__( 'A widget area loaded in the footer style two of the site.', 'engines' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) ); 
    
    //Footer Style Two Sidebar
    register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'engines' ),
		'id'            => 'footer-8',
		'description'   => esc_html__( 'A widget area loaded in the footer style two of the site.', 'engines' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) );   
        
}
add_action( 'widgets_init', 'yog_widgets_init' );

// Demos
add_theme_support( 'yog-demos', array(

	'engines' => array(
		'title' => esc_html__( 'Engines', 'engines' ),
		'description' => esc_html__( 'import complete demo of theme', 'engines' ),
		'screenshot' => get_template_directory_uri() . '/theme/demo/engines/screenshot.jpg',
		'preview' => esc_url( 'http://yogthemes.com/engines/' )
	)
));


posts_nav_link();
paginate_links();
the_posts_pagination();
the_posts_navigation();
next_posts_link();
previous_posts_link();