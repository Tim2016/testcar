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
 * 3. Template Tags
 */

// 1. Hooks ------------------------------------------------------
//

/**
 * [at_meta_mobile_app description]
 * @method at_meta_mobile_app
 * @return [type]             [description]
 */
add_action( 'wp_head', 'yog_meta_mobile_app', 0 );
function yog_meta_mobile_app() {

	echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
	echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
	printf( '<meta name="apple-mobile-web-app-title" content="%s - %s">' . "\n", esc_html( get_bloginfo('name') ), esc_html( get_bloginfo('description') ) );
}

/**
 * [yog_meta_name_url description]
 * @method yog_meta_name_url
 * @return [type]          [description]
 */
add_action( 'wp_head', 'yog_meta_name_url', 1 );
function yog_meta_name_url() {

	if ( ! is_front_page() ) {
		return;
	}

	printf( '<meta itemprop="name" content="%s" />' . "\n", get_bloginfo( 'name' ) );
	printf( '<meta itemprop="url" content="%s" />' . "\n", trailingslashit( esc_url( home_url() ) ) );
}

/**
 * [yog_meta_pingback description]
 * @method yog_meta_pingback
 * @return [type]              [description]
 */
add_action( 'wp_head', 'yog_meta_pingback', 0 );
function yog_meta_pingback() {

	if ( 'open' === get_option( 'default_ping_status' ) ) {
		echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
	}
}

/**
 * [yog_load_favicon description]
 * @method yog_load_favicon
 * @return [type]             [description]
 */
add_action( 'wp_head', 'yog_load_favicon' );
function yog_load_favicon() {
?>
	<link rel="shortcut icon" href="<?php yog_helper()->get_option_print( 'favicon.url', 'url', get_template_directory_uri() . '/favicon.ico') ?>" />
	<?php
	if ( $icon = yog_helper()->get_option( 'iphone_icon.url' ) ) : ?>
		<!-- For iPhone -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo $icon ?>">
	<?php endif;

	if ( $icon = yog_helper()->get_option( 'iphone_icon_retina.url' ) ) : ?>
		<!-- For iPhone 4 Retina display -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $icon ?>">
	<?php endif;

	if ( $icon = yog_helper()->get_option( 'ipad_icon.url' ) ) : ?>
		<!-- For iPad -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $icon ?>">
	<?php endif;

	if ( $icon = yog_helper()->get_option( 'ipad_icon_retina.url' ) ) : ?>
		<!-- For iPad Retina display -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $icon ?>">
	<?php endif;
}

/**
 * [yog_output_advance_code description]
 * @method yog_output_advance_code
 * @return [type]                  [description]
 */
add_action( 'wp_head', 'yog_output_advance_code', 999 );
function yog_output_advance_code() {

	echo yog_helper()->get_theme_option( 'google_analytics' );

	echo yog_helper()->get_theme_option( 'space_head' );
}