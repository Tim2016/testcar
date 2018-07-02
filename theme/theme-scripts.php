<?php
/**
 * The Asset Manager
 * Enqueue scripts and styles for the frontend
 */

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Yog_Theme_Assets extends Yog_Base {

    /**
     * Hold data for wa_theme for frontend
     * @var array
     */
    private static $theme_json = array();
    
    /**
	 * Hold an instance of Yog_Theme_Assets class.
	 * @var Yog_Theme_Assets
	 */
	protected static $instance = null;
    
    /**
	 * Main Yog_Theme_Assets instance.
	 *
	 * @return Yog_Theme_Assets - Main instance.
	 */
	public static function instance() {

		if(null == self::$instance) {
			self::$instance = new Yog_Theme_Assets();
		}

		return self::$instance;
	}

	/**
	 * [__construct description]
	 * @method __construct
	 */
    public function __construct() {

        // Frontend
        $this->add_action( 'wp_enqueue_scripts', 'enqueue', 25 );
        $this->add_action( 'wp_footer', 'script_data' );

        self::add_config( 'links', array(
            'ajax'    => esc_url( admin_url('admin-ajax.php') ),
            'theme_settings'  => esc_url( $this->get_assets_uri() ),
            
        ));
    }

    /**
     * Enqueue google fonts
     * @method enqueue
     * @return [type]  [description]
     */
    function google_fonts_url() {
        $fonts_url = '';
         
        /* Translators: If there are characters in your language that are not
        * supported by Open Sans, translate this to 'off'. Do not translate
        * into your own language.
        */
        $open_sans = _x( 'on', 'Open Sans font: on or off', 'engines' );
         
        if ( 'off' !== $open_sans ) {
            $font_families = array();
             
            if ( 'off' !== $open_sans ) {
                $font_families[] = 'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
            }
             
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin-ext' ),
            );
             
            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
         
        return esc_url_raw( $fonts_url ); 
        
    }

    /**
     * Enqueue Scripts and Styles
     * @method enqueue
     * @return [type]  [description]
     */
    public function enqueue() {
        
        // Add custom fonts, used in the main stylesheet.
    	wp_enqueue_style( 'yog-google-fonts', $this->google_fonts_url(), array(), null );
        
		//Icons
        wp_enqueue_style( 'font-awesome-min',$this->get_css_uri('font-awesome.min'), false, false );
        wp_enqueue_style( 'flaticon', $this->get_assets_uri('fonts/icon/font/flaticon.css'), false, false );
        wp_enqueue_style( 'montserrat-bold', $this->get_assets_uri('fonts/montserrat/montserrat-bold/styles.css'), false, false );
        wp_enqueue_style( 'montserrat-regular', $this->get_assets_uri('fonts/montserrat/montserrat-regular/styles.css'), false, false );
        wp_enqueue_style( 'montserrat-semibold', $this->get_assets_uri('fonts/montserrat/montserrat-semibold/styles.css'), false, false );
        wp_enqueue_style( 'montserrat-light', $this->get_assets_uri('fonts/montserrat/montserrat-light/styles.css'), false, false );
        
        //Plugins
        wp_enqueue_style( 'bootstrap', $this->get_css_uri('bootstrap'), false, false );
        wp_enqueue_style( 'yog-animate', $this->get_css_uri( 'animate' ), false, false );
        wp_enqueue_style( 'carousel', $this->get_css_uri( 'carousel' ), false, false );
        wp_enqueue_style( 'bootstrap-select', $this->get_css_uri( 'bootstrap-select' ), false, false );
        wp_enqueue_style( 'prettyPhoto', $this->get_css_uri('prettyPhoto'), false, false );
        wp_enqueue_style( 'yog-settings-panel', $this->get_css_uri('settings-panel'), false, false );
        
        //Basic Styles
        wp_enqueue_style( 'yog-style', $this->get_css_uri( 'style' ), false, false );
        wp_enqueue_style( 'yog-colors', $this->get_css_uri( 'colors' ), false, false );
        wp_enqueue_style( 'yog-responsive', $this->get_css_uri( 'responsive' ), false, false );
        
        // Theme Skin Class
        $yog_skin = ( yog_helper()->get_option( 'page-skin', 'raw', false, 'post' ) )? yog_helper()->get_option( 'page-skin', 'raw', false, 'post' ) : yog_helper()->get_theme_option( 'page-skin' );
        if( $yog_skin ){
            wp_enqueue_style( "{$yog_skin}", $this->get_css_uri( "{$yog_skin}" ), false, false );
        }
        
        // comment reply
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
        
        // Plugins
        wp_enqueue_script( 'prettyPhoto', $this->get_js_uri( 'jquery.prettyPhoto' ), array('jquery'), false, true );
        wp_enqueue_script( 'jquery-cookies', $this->get_js_uri( 'js.cookie' ), false, false, true );
        wp_enqueue_script( 'yog-inventory', $this->get_js_uri( 'inventory' ), false, false, true );
        wp_enqueue_script( 'jflickrfeed', $this->get_js_uri( 'jflickrfeed.min' ), false, false, true );
        wp_enqueue_script( 'yog-all', $this->get_js_uri( 'all' ), false, false, true );
        wp_enqueue_script( 'yog-custom', $this->get_js_uri( 'custom' ), false, false, true );
        wp_enqueue_script( 'googleapis', ( is_ssl() )? 'https://maps.googleapis.com/maps/api/js?key=' . yog_helper()->get_theme_option( 'google-api-key' ) : 'http://maps.googleapis.com/maps/api/js?key=' . yog_helper()->get_theme_option( 'google-api-key' ), false, false, false );
    }

    /**
     * Inline Css Script
     * @method yog_inline_css_script
     * @return [type]      [description]
     */
    public function yog_inline_css_script( $custom_css = '') {
        
        //check
        if( empty( $custom_css ) )return;
        
        wp_enqueue_style(
            'yog-custom-style',
            get_template_directory_uri() . '/assets/css/custom-script.css'
        );
        wp_add_inline_style( 'yog-custom-style', $custom_css );
        
    }
    
    /**
     * Localize Data Object
     * @method script_data
     * @return [type]      [description]
     */
    public function script_data() {

        wp_localize_script( 'yog-all', 'yogTheme', self::$theme_json );
    }


    /**
     * Add items to JSON object
     * @method add_config
     * @param  [type]     $id    [description]
     * @param  string     $value [description]
     */
    public static function add_config( $id, $value = '' ) {

        if(!$id) {
            return;
        }

        if(isset(self::$theme_json[$id])) {
            if(is_array(self::$theme_json[$id])) {
                self::$theme_json[$id] = array_merge(self::$theme_json[$id],$value);
            }
            elseif(is_string(self::$theme_json[$id])) {
                self::$theme_json[$id] = self::$theme_json[$id].$value;
            }
        }
        else {
            self::$theme_json[$id] = $value;
        }
    }

    // Uri Helpers ---------------------------------------------------------------
    public function get_theme_uri($file = '') {
        return get_template_directory_uri() . '/' . $file;
    }

    public function get_child_uri($file = '') {
        return get_stylesheet_directory_uri() . '/' . $file;
    }

    public function get_css_uri($file = '') {
        return get_template_directory_uri() . '/assets/css/'. $file .'.css';
    }

    public function get_js_uri($file = '') {
        return get_template_directory_uri() . '/assets/js/'. $file .'.js';
    }

    public function get_assets_uri($file = '') {
        return get_template_directory_uri() . '/assets/'. $file;
    }
}
/**
 * Main instance of Yog_Theme_Assets.
 *
 * Returns the main instance of Yog_Theme_Assets to prevent the need to use globals.
 *
 * @return Yog_Theme_Assets
 */
function yog_theme_assets() {
	return Yog_Theme_Assets::instance();
}
yog_theme_assets(); // init it
