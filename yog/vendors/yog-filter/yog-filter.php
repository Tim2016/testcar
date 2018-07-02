<?php
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

if ( ! class_exists( 'Yog_Filter' ) ) :
/**
 * Main Filter Core Class
 *
 * @class Yog_Filter
 * @version	1.2
 */
final class Yog_Filter {
    
    /**
     * Hold an instance of Yog_Filter class.
     * @var Yog_Filter
     */
    protected static $instance = null;
    
    /**
	 * Main Yog_Filter instance.
	 *
	 * @return Yog_Filter - Main instance.
	 */
    public static function instance() {

		if(null == self::$instance) {
            self::$instance = new Yog_Filter();
        }

        return self::$instance;
    }
    
    /**
	 * Yog_Filter Constructor.
	 */
	public function __construct() {
	      
	    add_action('wp_enqueue_scripts', array( $this, 'yog_add_head_scripts' ) ); 
        add_action( 'wp_loaded', array( $this, 'yog_ajax_check_submission_and_process' ));
        
        //Shortcodes
        add_shortcode( 'yog_filter', array( $this, 'yog_filter_func' ));
        
        //Filter Widget
        $this->yog_add_widget();
	}
    
    /**
	 * Enqueue JS & CSS Files.
	 */
    function yog_add_head_scripts() {
    	
        //Css File
        wp_enqueue_style( 'yog-filter', yog_theme_assets()->get_theme_uri( 'yog/vendors/yog-filter/assets/css/yog-filter.css' ) ); 
        wp_enqueue_style( 'yog-datepicker', yog_theme_assets()->get_theme_uri( 'yog/vendors/yog-filter/assets/datepicker/css/datepicker.css' ) ); 
        
        //Js File
        wp_enqueue_script( 'yog-datepicker', yog_theme_assets()->get_theme_uri( 'yog/vendors/yog-filter/assets/datepicker/js/bootstrap-datepicker.js' ),  array( 'jquery','jquery-form' ),   false, true );
    	wp_enqueue_script( 'yog-ui', yog_theme_assets()->get_theme_uri( 'yog/vendors/yog-filter/assets/js/jquery-ui.js' ),   false, true ); 
        wp_enqueue_script( 'yog-filter', yog_theme_assets()->get_theme_uri( 'yog/vendors/yog-filter/assets/js/yog-filter.js' ),   false, true ); 
    } 
    
    /**
	 * Ajax submission process.
	 */
    function yog_ajax_check_submission_and_process() {
	
    	 if ( isset( $_GET['searchy_ajax_results'] ) ) {  
    	   include( "inc/perform-search.php" );  
           die; 
         }
    
    }  
    
    /**
	 * Shortcode content generator function.
	 */
    function yog_filter_func( $atts ){
        
        global $yog_filter_callback_html_store;
    	$yog_filter_callback_html_store = "";
        
    	ob_start( $this->yog_filter_html_callback );
    		
    	require_once("inc/search-filters.php");
    		   
    	ob_end_flush();
    	
    	return $yog_filter_callback_html_store;
        
    }
    
    /**
	 * Shortcode Callback function.
	 */
    function yog_filter_html_callback( $buffer ){
        
        global $yog_filter_callback_html_store;
        $yog_filter_callback_html_store=$buffer;
        return;
        
    }
    
    /**
	 * Widget callback function.
	 */
    function yog_filter_widgetfunc( $args ) {
    	
    	echo $args['before_widget'];
        	
            // print some HTML for the widget to display here
        	echo do_shortcode("[yog_filter]");
            
    	echo $args['after_widget'];
    }
    
    /**
	 * Add Widget.
	 */
    function yog_add_widget(){
        
        wp_register_sidebar_widget(
            'yog_filter_widget',        // your unique widget id
            'Engines: Advance Ajax Search Filter',          // widget name
            array( $this, 'yog_filter_widgetfunc' ),
            array(                  // options
                'description' => 'Inventory Posts Search By Advance Ajax Search Filter'
            )
        );
        
    }
}

/**
 * Main instance of Yog_Filter.
 *
 * Returns the main instance of Yog_Filter to prevent the need to use globals.
 *
 * @return Yog_Filter
 */
function yog_filter() {
	return Yog_Filter::instance();
}
yog_filter(); // init Yog_Filter Class

endif;