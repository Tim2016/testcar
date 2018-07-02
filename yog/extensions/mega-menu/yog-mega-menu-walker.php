<?php
/**
 * The Menu Walker
 * Menu Walker class extends from Nav Menu Walker
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Engines_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    private $caret = ' <span class="fa fa-angle-down"></span>';
    
    /**
     * @see Walker::start_el()
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        // Generate classes for <li>
        $classes = array();
        
        // Dropdown Class
		if( $this->has_children && $depth == 0 ) {
		  $classes[] = 'dropdown hasmenu';
        }
        
        if( $this->has_children && $depth == 1 ) {
        	$classes[] = 'dropdown-submenu';
        }
        
        $class_names = implode( ' ',  $classes );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		// Generate <a> attribute
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? esc_attr( $item->attr_title ) : '';
		$atts['target'] = ! empty( $item->target )     ? esc_attr( $item->target )     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? esc_attr( $item->xfn )        : '';
		$atts['href']   = ! empty( $item->url )        ? esc_url( $item->url )        : '';
        
        $args->link_after = '';
        // If has dropdown or mega menu
		if(  $this->has_children && $depth == 0 ) {
            $atts['class'] = 'dropdown-toggle';
            $atts['data-toggle'] = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        $attributes = yog_helper()->html_attributes( $atts );        

        // html <a>
		$item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';

                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				
				// Output Span
				if( $item->description ) {
					$item_output .= ' <span>' . $item->description . '</span>';
				}
                
                // Output Dropdown Caret
				if( $this->has_children && $depth == 0 ) {
					$item_output .= $this->caret;
				}

            $item_output .= '</a>';
        $item_output .= $args->after;	
       
		
		// Output <li>
		$output .= $indent . '<li' . $class_names .'>';
	
		// Output <a>
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		
   	}

 	/**
	 * @see Walker::end_el()
	 */
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
    	
   			$output .= "</li>\n";
   	}

   	/**
	 * @see Walker::start_lvl()
	 */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    	$indent = str_repeat("\t", $depth);
    	
    	// Dropdown <ul> classes
        if( 0 == $depth ){
            $classes = 'dropdown-menu';
        }else{
            $classes = 'dropdown-menu';
        }
		$output .= "\n$indent<ul class=\"$classes depth-$depth\" role='menu'>\n";

   	}

   	/**
	 * @see Walker::end_lvl()
	 */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
    	$indent = str_repeat("\t", $depth);
		
		$output .= "$indent</ul>\n";
   	}
}