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

add_filter( 'yog_attr_post', 'yog_attributes_post' );
add_filter( 'yog_attr_entry', 'yog_attributes_post' );
/**
 * [yog_attributes_post description]
 * @method yog_attributes_post
 * @param  [type]             $attributes [description]
 * @return [type]                         [description]
 */
function yog_attributes_post( $attributes ) {

	$post = get_post();
	$post_type = get_post_type();

	// Make sure we have a real post first.
	if ( ! empty( $post ) ) {

		$attributes['id']        = 'post-' . get_the_ID();
		$attributes['class']     = join( ' ', get_post_class( $attributes['class'] ) );
		$attributes['itemscope'] = 'itemscope';

		if ( 'post' === $post_type ) {

			$attributes['itemtype']  = 'http://schema.org/BlogPosting';

			/* Add itemprop if within the main query. */
			if ( is_main_query() && ! is_search() ) {
				$attributes['itemprop'] = 'blogPost';
			}
		}
		elseif( 'attachment' === $post_type ) {

			if ( wp_attachment_is_image() ) {
				$attributes['itemtype'] = 'http://schema.org/ImageObject';
			}
			elseif ( yog_helper()->is_attachment_audio() ) {
				$attributes['itemtype'] = 'http://schema.org/AudioObject';
			}
			elseif ( yog_helper()->is_attachment_video() ) {
				$attributes['itemtype'] = 'http://schema.org/VideoObject';
			}
		}
		else {
			$attributes['itemtype']  = 'http://schema.org/CreativeWork';
		}

	}
	else {

		$attributes['id']    = 'post-0';
		$attributes['class'] = join( ' ', get_post_class() );
	}

	return $attributes;
}

add_filter( 'yog_attr_entry-title', 'yog_attributes_entry_title', 5 );
/**
 * [yog_attributes_entry_title description]
 * @method yog_attributes_entry_title
 * @param  [type]                    $attributes [description]
 * @return [type]                                [description]
 */
function yog_attributes_entry_title( $attributes ) {

	$attributes['class']    = 'entry-title' . ( isset( $attributes['class'] ) ? ' '.$attributes['class'] : '');
	$attributes['itemprop'] = 'headline';

	return $attributes;
}

add_filter( 'yog_attr_entry-content', 'yog_attributes_entry_content', 5 );
/**
 * [yog_attributes_entry_content description]
 * @method yog_attributes_entry_content
 * @param  [type]                      $attributes [description]
 * @return [type]                                  [description]
 */
function yog_attributes_entry_content( $attributes ) {
    
    $attributes['class']    = 'entry-content' . ( isset( $attributes['class'] ) ? ' '.$attributes['class'] : '');
	$attributes['itemprop'] = 'post' === get_post_type() ? 'articleBody' : 'text';

	return $attributes;
}

add_filter( 'yog_attr_entry-author', 'yog_attributes_entry_author', 5 );
/**
 * [yog_attributes_entry_author description]
 * @method yog_attributes_entry_author
 * @param  [type]                     $attributes [description]
 * @return [type]                                 [description]
 */
function yog_attributes_entry_author( $attributes ) {

    $attributes['class']     = 'entry-author' . ( isset( $attributes['class'] ) ? ' '.$attributes['class'] : '');
	$attributes['itemprop']  = 'author';
	$attributes['itemscope'] = 'itemscope';
	$attributes['itemtype']  = 'http://schema.org/Person';

	return $attributes;
}

add_filter( 'yog_attr_entry-published', 'yog_attributes_entry_published', 5 );
/**
 * [yog_attributes_entry_published description]
 * @method yog_attributes_entry_published
 * @param  [type]                        $attributes [description]
 * @return [type]                                    [description]
 */
function yog_attributes_entry_published( $attributes ) {

    $attributes['class']    = 'entry-published updated' . ( isset( $attributes['class'] ) ? ' '.$attributes['class'] : '');
	$attributes['datetime'] = get_the_time( 'Y-m-d\TH:i:sP' );
	$attributes['itemprop'] = 'datePublished';

	// Translators: Post date/time "title" attribute.
	$attributes['title']    = get_the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'engines' ) );

	return $attributes;
}


add_filter( 'yog_attr_entry-summary', 'yog_attributes_entry_summary', 5 );
/**
 * [yog_attributes_entry_summary description]
 * @method yog_attributes_entry_summary
 * @param  [type]                      $attributes [description]
 * @return [type]                                  [description]
 */
function yog_attributes_entry_summary( $attributes ) {

    $attributes['class']    = 'entry-summary' . ( isset( $attributes['class'] ) ? ' '.$attributes['class'] : '');
	$attributes['itemprop'] = 'description';

	return $attributes;
}

add_filter( 'yog_attr_entry-terms', 'yog_attributes_entry_terms', 5 );
/**
 * [yog_attributes_entry_terms description]
 * @method yog_attributes_entry_terms
 * @param  [type]                    $attributes [description]
 * @param  [type]                    $context    [description]
 * @return [type]                                [description]
 */
function yog_attributes_entry_terms( $attributes ) {

	$context = isset( $attributes['taxonomy'] )? $attributes['taxonomy'] : 'category';
	unset( $attributes['taxonomy'] );

	if ( !empty( $context ) ) {

		$attributes['class'] = 'entry-terms ' . sanitize_html_class( $context );

		if ( 'category' === $context ) {
			$attributes['itemprop'] = 'articleSection';
		}

		else if ( 'post_tag' === $context ) {
			$attributes['itemprop'] = 'keywords';
		}
	}

	return $attributes;
}


/**
 * [yog_get_post_grid_class description]
 * @method yog_get_post_grid_class
 * @return [type]      [description]
 */
function yog_get_post_grid_class( ) {
    $yog_class = array( 'two' => 'col-md-6 col-sm-6 col-xs-12', 'three' => 'col-md-4 col-sm-6 col-xs-12', 'full' => 'col-md-12 col-xs-12' );
    return $yog_class[yog_helper()->get_option( 'engines-blog-columns', 'raw', 'three', 'options' )];
}

/**
 * [yog_get_excerpt description]
 * @method yog_get_excerpt
 * @param  [type]                    $args [description]
 * @param  [type]                    $context    [description]
 * @return [type]                                [description]
 */
function yog_get_excerpt( $args = '' ) {

    global $post;

    $defaults = array(
        'yog_by'            => yog_helper()->get_option( 'excerpt-by', 'raw', 'words', 'options' ),
        'yog_length'        => yog_helper()->get_option( 'excerpt-length','raw', '120', 'options' ),
        'yog_ellipsis'      => yog_helper()->get_option( 'excerpt-ellipsis','raw', false, 'options' ),
        'yog_before_text'   => yog_helper()->get_option( 'excerpt-before','raw', '<p>', 'options' ),
        'yog_after_text'    => yog_helper()->get_option( 'excerpt-after','raw', '</p>', 'options' ),
        'yog_link_to_post'  => yog_helper()->get_option( 'excerpt-readmore','raw', false, 'options' ),
        'yog_link_text'     => yog_helper()->get_option( 'excerpt-readmore-txt', 'html', 'Read More', 'options' ),
        'yog_class'         => 'blogread',
        'yog_text'          => ''
    );

    $yog_args = wp_parse_args( $args, $defaults );
    extract( $yog_args );

    // Retrieve the post content
    if ( '' == $yog_text ) {
        $yog_text = get_the_content( '' );
    }

    $yog_raw_excerpt = $yog_text;

    // Delete all shortcodes, scripts and tags
    $yog_text = strip_shortcodes( $yog_text );
    $yog_text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $yog_text );
    $yog_text = strip_tags( $yog_text, '<em><strong><i><b>' );

    // by words
    if ( $yog_by == 'words' ) {

        $yog_words = explode( ' ', $yog_text, $yog_length + 1 );
        if ( count( $yog_words ) > $yog_length ) {
            array_pop( $yog_words );
            $yog_text = implode( ' ', $yog_words );
        }
    }
    else {

        $yog_text = substr( $yog_text, 0, $yog_length );
        $yog_text = substr( $yog_text, 0, strripos( $yog_text, " " ) );
        $yog_text = trim( preg_replace( '/\s+/', ' ', $yog_text ) );
    }

    // Check emptiness
    if ( empty( $yog_text ) ) return '';

    $yog_text = stripslashes( $yog_before_text ) . $yog_text . $yog_ellipsis . stripslashes( $yog_after_text );
    if ( $yog_link_to_post ) {
        $yog_permalink = get_permalink( $post->ID );
        $yog_text .= ' <a class="'. esc_attr( $yog_class ) .'" href="' . esc_url( $yog_permalink ) . '">' . $yog_link_text . '</a>';
    }

    // Apply fixes
    $yog_text = wptexturize( $yog_text );
    $yog_text = convert_smilies( $yog_text );
    $yog_text = convert_chars( $yog_text );

    // Return
    return apply_filters( 'wp_trim_excerpt', $yog_text, $yog_raw_excerpt );
}
