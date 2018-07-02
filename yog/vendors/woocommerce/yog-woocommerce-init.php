<?php
/**
 * Disable WooCommerce Style
 */

if(!class_exists('Woocommerce')) return;

if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	// WooCommerce 2.1 or above is active
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	// WooCommerce is less than 2.1
	define( 'WOOCOMMERCE_USE_CSS', false );
}
 
/** Remove Page Title. */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/** Remove Breadcrumb */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/** Remove Loop Result Count and Ordering */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/** Add Shop Header */
function yog_wc_shop_header() {

    if( is_single() ) return;

    wc_get_template_part( 'global/shop', 'header' );   
}
add_action( 'woocommerce_before_main_content', 'yog_wc_shop_header' );

/** Remove Sidebar */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/** Set Products Per Page */
function yog_wc_products_per_page( $limit ) {

    return yog_helper()->get_option( 'engines-shop-limit','raw', $limit, 'options' );
}
add_filter( 'loop_shop_per_page', 'yog_wc_products_per_page' );

/** Set Number of Columns */
function yog_wc_loop_columns( $cols ) {
    $cols = isset( $_GET['column'] )? $_GET['column'] : yog_helper()->get_option( 'engines-shop-column', 'raw', $cols, 'options' ); 
    return $cols;
}
add_filter( 'loop_shop_columns', 'yog_wc_loop_columns' );

/** Remove rating and price form shop page. */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/** Remove and Re-position pagination */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

/** Set Pagination */
function yog_woocommerce_pagination() {
    if( yog_helper()->get_option( 'engines-shop-pagination', 'raw',  true, 'options' ) ){
        yog_wp_paginate( array( 'before' => '<div class="col-md-12 text-center">', 'after' => '</div>', 'class' => 'pagination pagination-lg', 'title' => false, 'nextpage' => '<i class="fa fa-angle-right"></i>', 'previouspage' => '<i class="fa fa-angle-left"></i>' ) );    
    }
}
add_action( 'woocommerce_after_shop_loop', 'yog_woocommerce_pagination' );
/**
 * Init Default widgets Override
 */

function yog_woocommerce_widget() {
    get_template_part( 'woocommerce/default-woocommerce', 'widgets' );
}
add_action( 'widgets_init', 'yog_woocommerce_widget', 15 );

/**
 * Single Product
 */
 /** Gallery */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_thumbnails', 20 );

/** Product Summery */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/** Enable/Disable Features */
function yog_wc_disable_enable_features() {
    
	/** Display product tabs? */
    if ( !yog_helper()->get_option( 'engines-product-tab', 'raw', true, 'options' ) )
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    
    /** Display related products? */
    if ( !yog_helper()->get_option( 'engines-product-related', 'raw', true, 'options' ) )
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    
    /** Display cross-sell products? */
    if ( !yog_helper()->get_option( 'engines-product-sell', 'raw', true, 'options' ) )
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}
add_action( 'wp_head','yog_wc_disable_enable_features' );

/** Set limit and column on related products */
function yog_wc_related_products_args( $args ) {
    
    $args['posts_per_page'] = yog_helper()->get_option( 'engines-product-rel-limit', 'raw', $args['posts_per_page'], 'options' );
    $args['columns'] = yog_helper()->get_option( 'engines-product-rel-column', 'raw', $args['columns'], 'options' );
    
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'yog_wc_related_products_args' );


/** Remove UpSell */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/** Set limit and column on upsell products */
function yog_wc_upsell_display( $args ) {
    
    if ( !yog_helper()->get_option( 'engines-product-sell', 'raw',  true, 'options' ) ) return;
    
    $yog_limit = yog_helper()->get_option( 'engines-product-sell-limit', 'raw', 4, 'options' );
    $yog_columns = yog_helper()->get_option( 'engines-product-sell-column', 'raw', 4, 'options' );
    
    woocommerce_upsell_display( $yog_limit, $yog_columns );
}
add_action ( 'woocommerce_after_single_product_summary', 'yog_wc_upsell_display', 15 );

/** Remove Cross Sell */
remove_action ( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

/** Set limit and column on cross-sell products */
function yog_wc_cross_sell_display( $args ) {
    
    if ( !yog_helper()->get_option( 'engines-product-cross', 'raw', true, 'options' ) ) return;
    
    $yog_limit = yog_helper()->get_option( 'engines-product-cross-limit', 'raw', 4, 'options' );
    $yog_columns = yog_helper()->get_option( 'engines-product-cross-column', 'raw', 4, 'options');
    
    woocommerce_cross_sell_display( $yog_limit, $yog_columns );
}
add_action ( 'woocommerce_cart_collaterals', 'yog_wc_cross_sell_display', 15 );

/**
 * Checkout Page
 */
if ( ! function_exists( 'woocommerce_form_field' ) ) {

	/**
	 * Outputs a checkout/address form field.
	 *
	 * @subpackage	Forms
	 * @param string $key
	 * @param mixed $args
	 * @param string $value (default: null)
	 * @todo This function needs to be broken up in smaller pieces
	 */
	function woocommerce_form_field( $key, $args, $value = null ) {
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

		$field = '';
		$label_id = $args['id'];
		$field_container = '<div class="row %1$s" id="%2$s"><div class="col-md-12">%3$s</div></div> ';

		switch ( $args['type'] ) {
			case 'country' :

				$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( 1 === sizeof( $countries ) ) {

					$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

				} else {

					$field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . '>'
							. '<option value="">'. esc_html__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '. selected( $value, $ckey, false ) . '>'. $cvalue .'</option>';
					}

					$field .= '</select>';

					$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '" class="btn btn-info"/></noscript>';

				}

				break;
			case 'state' :

				/* Get Country */
				$country_key = 'billing_state' === $key ? 'billing_country' : 'shipping_country';
				$current_cc  = WC()->checkout->get_value( $country_key );
				$states      = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					$field_container = '<div class="row %1$s" id="%2$s" style="display: none"><div class="col-md-12">%3$s</div></div>';

					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

				} elseif ( is_array( $states ) ) {

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select  ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">'. esc_html__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'. $cvalue .'</option>';
					}

					$field .= '</select>';

				} else {

					$field .= '<input type="text" class="input-text  ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				}

				break;
			case 'textarea' :

				$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text  ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>'. esc_textarea( $value  ) .'</textarea>';

				break;
			case 'checkbox' :

				$field = '<div class="checkbox"><label class="checkbox ' . implode( ' ', $args['label_class'] ) .'" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" '.checked( $value, 1, false ) .' /> '
						 . $args['label'] . $required . '</label></div>';

				break;
			case 'password' :
			case 'text' :
			case 'email' :
			case 'tel' :
			case 'number' :

				$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $args['maxlength'] . ' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				break;
			case 'select' :

				$options = $field = '';

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						if ( '' === $option_key ) {
							// If we have a blank option, select2 needs a placeholder
							if ( empty( $args['placeholder'] ) ) {
								$args['placeholder'] = $option_text ? $option_text : esc_html__( 'Choose an option', 'woocommerce' );
							}
							$custom_attributes[] = 'data-allow_clear="true"';
						}
						$options .= '<option value="' . esc_attr( $option_key ) . '" '. selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) .'</option>';
					}

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select '. esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
				}

				break;
			case 'radio' :

				$label_id = current( array_keys( $args['options'] ) );

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						$field .= '<div class="radio"><input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
						$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $option_text . '</label></div>';
					}
				}

				break;
		}

		if ( ! empty( $field ) ) {
			$field_html = '';

			if ( $args['label'] && 'checkbox' != $args['type'] ) {
				$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
			}

			$field_html .= $field;

			if ( $args['description'] ) {
				$field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
			}

			$container_class = 'row ' . esc_attr( implode( ' ', $args['class'] ) );
			$container_id = esc_attr( $args['id'] ) . '_field';

			$after = ! empty( $args['clear'] ) ? '<div class="clearfix"></div>' : '';

			$field = sprintf( $field_container, $container_class, $container_id, $field_html ) . $after;
		}

		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

		if ( $args['return'] ) {
			return $field;
		} else {
			echo $field;
		}
	}
} 

/**
 * Customize Rating HTML
 */
add_filter( 'woocommerce_product_get_rating_html', function( $html, $rating ) {
	
	$rating = empty( $rating ) ? 0 : $rating;
	$rating_html = '';
	$rating_html .= '<div class="rating">';
		
		$rating_html .= str_repeat( '<i class="fa fa-star"></i> ', $rating );
		$rating_html .= str_repeat( '<i class="fa fa-star"></i> ', 5 - $rating );
		
	$rating_html .= '</div>';
	
	return $rating_html;
		
}, 11, 2 );