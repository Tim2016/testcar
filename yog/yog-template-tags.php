<?php
/**
 * Theme Framework
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * [yog_get_taxonomies description]
 * @method yog_get_taxonomies
 * @return [type]                     [description]
 */
function yog_get_taxonomies( $id = '', $tax = '' ) {
    
    if ( ! $tax && ! $id ) return array();

    $terms = get_the_terms( $id, $tax );
    $taxs = array();
    if ( !empty( $terms ) )
        foreach ( $terms as $term )
            $taxs[] = $term->name;

    return $taxs;
}

/**
 * [yog_get_animations description]
 * @method yog_get_animations
 * @return [type]                     [description]
 */
function yog_get_theme_animations() {
    return array( 
		esc_html__("No Animation","engines") => "",
        esc_html__("Bounce","engines") => "bounce",
        esc_html__("Bounce In","engines") => "bounceIn",
        esc_html__("Bounce In Up","engines") => "bounceInUp",
        esc_html__("Bounce In Down","engines") => "bounceInDown",
        esc_html__("Bounce In Left","engines") => "bounceInLeft",
        esc_html__("Bounce In Right","engines") => "bounceInRight",
        esc_html__("Fade In","engines") => "fadeIn",
        esc_html__("Fade In Up","engines") => "fadeInUp",
        esc_html__("Fade In Down","engines") => "fadeInDown",
        esc_html__("Fade In Left","engines") => "fadeInLeft",
        esc_html__("Fade In Right","engines") => "fadeInRight",
        esc_html__("Fade In Up Big","engines") => "fadeInUpBig",
        esc_html__("Fade In Down Big","engines") => "fadeInDownBig",
        esc_html__("Fade In Left Big","engines") => "fadeInLeftBig",
        esc_html__("Fade In Right Big","engines") => "fadeInRightBig",
		esc_html__("Flash","engines") => "flash",
        esc_html__("Flip In X","engines") => "flipInX",
        esc_html__("Flip In Y","engines") => "flipInY",
        esc_html__("Jello","engines") => "jello",
        esc_html__("Pulse","engines") => "pulse",
		esc_html__("Shake","engines") => "shake",
		esc_html__("Swing","engines") => "swing",
		esc_html__("Tada","engines") => "tada",
		esc_html__("Rotate In","engines") => "rotateIn",
        esc_html__("Rotate In Up Left","engines") => "rotateInUpLeft",
        esc_html__("Rotate In Down Left","engines") => "rotateInDownLeft",
        esc_html__("Rotate In Up Right","engines") => "rotateInUpRight",
        esc_html__("Rotate In Down Right","engines") => "rotateInDownRight",
        esc_html__("Rubber Band","engines") => "rubberBand",
		esc_html__("Wobble","engines") => "wobble",
		esc_html__("Wiggle","engines") => "wiggle",
        esc_html__("Zoom In","engines") => "zoomIn",
        esc_html__("Zoom In Up","engines") => "zoomInUp",
        esc_html__("Zoom In Down","engines") => "zoomInDown",
        esc_html__("Zoom In Left","engines") => "zoomInLeft",
        esc_html__("Zoom In Right","engines") => "zoomInRight",
        esc_html__("Zoom Out","engines") => "zoomOut",
        esc_html__("Zoom Out Up","engines") => "zoomOutUp",
        esc_html__("Zoom Out Down","engines") => "zoomOutDown",
        esc_html__("Zoom Out Left","engines") => "zoomOutLeft",
        esc_html__("Zoom Out Right","engines") => "zoomOutRight",
    );
}

/**
 * [yog_get_column description]
 * @method yog_get_column
 * @return [type]                     [description]
 */
if(!function_exists('yog_get_column')) {
    function yog_get_column( $column = '' ) {
        
        //Check
        if( empty( $column ) ){
            return;
        }
        
        //Create Column class array.
        $yog_columns = array(
            '1' => 'col-md-12',
            '2' => 'col-md-6',
            '3' => 'col-md-4',
            '4' => 'col-md-3',
            '6' => 'col-md-2',
        );
        
        return $yog_columns[$column];
    }
 }

/**
 * [yog_column description]
 * @method yog_column
 * @return [type]                     [description]
 */
if(!function_exists('yog_column')) {
    function yog_column( $columns = ''  ){
        echo yog_get_column( $columns );
    }
}