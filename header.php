<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */
?>
<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ) ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php yog_action( 'before' ) ?>

		<?php
			if( is_single( $post ) ):
				// header for single post, not have options in admin menu
				$yog_header_layout = "v1";
            	get_template_part( 'templates/header/header', $yog_header_layout );
            else:
				yog_action( 'before_header' );
				yog_action( 'header' );
				yog_action( 'after_header' );
				yog_action( 'before_content' );
			endif;
		?>
        <div id="loader-wrapper" class="in-visiable">
			<div id="loader"></div>
		</div>