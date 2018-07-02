<?php
/**
 * Theme Framework
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * [yog_attributes_head description]
 * @method yog_attributes_head
 * @param  [type]                $attributes [description]
 * @return [type]                            [description]
 */
add_filter( 'yog_attr_head', 'yog_attributes_head' );
function yog_attributes_head( $attributes ) {

	unset( $attributes['class'] );
	if ( ! is_front_page() ) {
		return $attributes;
	}

	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WebSite';

	return $attributes;
}

/**
 * [yog_attributes_body description]
 * @method yog_attributes_body
 * @param  [type]                $attributes [description]
 * @return [type]                            [description]
 */
add_filter( 'yog_attr_body', 'yog_attributes_body' );
function yog_attributes_body( $attributes ) {

	$attributes['class']     = join( ' ', get_body_class() );
	$attributes['dir']       = is_rtl() ? 'rtl' : 'ltr';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/WebPage';

	if ( is_singular( 'post' ) || is_home() || is_archive() ) {
		$attributes['itemtype'] = 'http://schema.org/Blog';
	}

	if ( is_search() ) {
		$attributes['itemtype'] = 'http://schema.org/SearchResultsPage';
	}

	return $attributes;
}

/**
 * [yog_attributes_content description]
 * @method yog_attributes_content
 * @param  [type]                   $attributes [description]
 * @return [type]                               [description]
 */
add_filter( 'yog_attr_content', 'yog_attributes_content' );
function yog_attributes_content( $attributes ) {

	$attributes['id'] = 'content';
	$attributes['role'] = 'main';

	if ( ! is_singular( 'post' ) && ! is_home() && ! is_archive() ) {
		$attributes['itemprop'] = 'mainContentOfPage';
	}

	return $attributes;

}
