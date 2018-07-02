<?php
/**
 * Theme Framework
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Table of content
 *
 * 1. Hooks
 * 2. Functions
 */

// 1. Hooks ------------------------------------------------------
//

/**
 * [yog_output_space_body description]
 * @method yog_output_space_body
 * @return [type]                  [description]
 */
add_action( 'wp_footer', 'yog_output_space_body', 999 );
function yog_output_space_body() {

	echo yog_helper()->get_theme_option( 'space_body' );
}

/**
 * [yog_attributes_footer description]
 * @method yog_attributes_footer
 * @param  [type]                  $attributes [description]
 * @return [type]                              [description]
 */
add_filter( 'yog_attr_footer', 'yog_attributes_footer' );
function yog_attributes_footer( $attributes ) {

	$attributes['id'] = 'footer';
	$attributes['class'] = !empty( $attributes['class'] ) ? 'footer site-footer ' . $attributes['class'] : 'site-footer';
	$attributes['role'] = 'contentinfo';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WPFooter';

	return $attributes;

}

/**
 * [yog_footer_backtotop description]
 * @method yog_footer_backtotop
 * @return [type]                 [description]
 */
add_action( 'yog_after_footer', 'yog_footer_backtotop' );
function yog_footer_backtotop() {
    if( yog_helper()->get_option( 'enable-go-top', 'raw', false, 'options' ) ){
        echo '<div class="dmtop"><i class="fa fa-angle-up"></i></div>';
    }
}

/**
 * [yog_attributes_footer description]
 * @method yog_attributes_footer
 * @param  [type]                  $attributes [description]
 * @return [type]                              [description]
 */
add_filter( 'wp_footer', 'yog_style_switcher' );
function yog_style_switcher() {
    $style_switcher = yog_helper()->get_option( 'page-style-switcher', 'raw', false, 'options' );
    if( $style_switcher ): 
    ?>
    <div class="b-settings-panel">
    	<div class="settings-section">
    		<span><?php echo esc_html__( 'Boxed', 'engines' ); ?></span>
    		<div class="b-switch">
    			<div class="switch-handle"></div>
    		</div>
    		<span><?php echo esc_html__( 'Wide', 'engines' ); ?></span>
    	</div>
    
    	<hr class="dashed" style="margin: 15px 0px;">
    
    	<h5><?php echo esc_html__( 'Main Background', 'engines' ); ?></h5>
    	<div class="settings-section bg-list">
    		<div class="bg-wood_pattern"></div>
    		<div class="bg-shattered"></div>
    		<div class="bg-vichy"></div>
    		<div class="bg-random-grey-variations"></div>
    		<div class="bg-irongrip "></div>
    		<div class="bg-gplaypattern"></div>
    		<div class="bg-diamond_upholstery"></div>
    		<div class="bg-denim"></div>
    		<div class="bg-crissXcross"></div>
    		<div class="bg-climpek"></div>
    	</div>
    
    	<hr class="dashed" style="margin: 15px 0px;">
    
    	<h5><?php echo esc_html__( 'Color Scheme', 'engines' ); ?></h5>
    	<div class="settings-section color-list">
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" style="background: #fd6502"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/grass-green.css" style="background: #64be33"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/green.css" style="background: #2bba57"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/turquoise.css" style="background: #2eafbb"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/blue.css" style="background: #07c1e9"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/klein-blue.css" style="background: #4874cd"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/purple.css" style="background: #7e47da"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/pink.css" style="background: #ea5192"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/red.css" style="background: #e34735"></div>
    		<div data-src="<?php echo get_template_directory_uri(); ?>/assets/css/color-scheme/orange.css" style="background: #ff6029"></div>
    	</div>
    
    	<a href="#" data-src="css/style.css" class="reset"><span class="bg-wood_pattern"><?php echo esc_html__( 'Reset', 'engines' ); ?></span></a>
    
    	<div class="btn-settings"></div>
    </div>
    <?php
    endif;
}