<?php
/**
 * Theme Framework
 * The Yog_Theme initiate the theme translation
 */
 
 if ( ! function_exists( 'yog_set_translation' ) ) :
    /**
     * [yog_set_translation description]
     * @method yog_set_translation
     * @return [type]             [description]
     */
    function yog_set_translation() {
        global $yog_translation;
        
        $yog_translate = yog_helper()->get_option( 'enable-translation', 'raw', false, 'options' );
    
        $yog_translation = array(
    
            //Blog Translation  
            'blog-cat'       => $yog_translate ? yog_helper()->get_option( 'tr-blog-cat', 'html', false ) : esc_html__( 'Category: %s', 'engines' ),
            'blog-tag'       => $yog_translate ? yog_helper()->get_option( 'tr-blog-tag', false ) : esc_html__( 'Tags: %s', 'engines' ),
            'blog-day'       => $yog_translate ? yog_helper()->get_option( 'tr-blog-day', false ) : esc_html__( 'Day: %s', 'engines' ),
            'blog-monthly'   => $yog_translate ? yog_helper()->get_option( 'tr-blog-monthly', false ) : esc_html__( 'Monthly: %s', 'engines' ),
            'blog-yearly'    => $yog_translate ? yog_helper()->get_option( 'tr-blog-yearly', false ) : esc_html__( 'Yearly: %s', 'engines' ),
            'tr-blog-search' => $yog_translate ? yog_helper()->get_option( 'tr-blog-search', false ) : esc_html__( 'Search..', 'engines' ),
            'tr-blog-search-result'       => $yog_translate ? yog_helper()->get_option( 'tr-blog-search-result', false ) : esc_html__( 'Search Result: %s', 'engines' ),
            
            //Comments
            'tr-blog-comment'       => $yog_translate ? yog_helper()->get_option( 'tr-blog-comment', false ) : esc_html__( 'Comment', 'engines' ),
            'tr-blog-comments'      => $yog_translate ? yog_helper()->get_option( 'tr-blog-comments', false ) : esc_html__( 'Comments', 'engines' ),
            'tr-blog-comment-off'   => $yog_translate ? yog_helper()->get_option( 'tr-blog-comment-off', false ) : esc_html__( 'Comments Off', 'engines' ),
            'tr-blog-comment-reply' => $yog_translate ? yog_helper()->get_option( 'tr-blog-comment-reply', false ) : esc_html__( 'Reply', 'engines' ),        
        
            //Inventory List Style
            'tr-inv-list-km'            => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-km', false ) : esc_html__( 'KMs', 'engines' ),
            'tr-inv-list-fuel-type'     => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-fuel-type', false ) : esc_html__( 'Fuel Type', 'engines' ),
            'tr-inv-list-transmission'  => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-transmission', false ) : esc_html__( 'Transmission', 'engines' ),
            'tr-inv-list-reg-year'      => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-reg-year', false ) : esc_html__( 'Reg.Year', 'engines' ),
            'tr-inv-list-engine'        => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-engine', false ) : esc_html__( 'Engine', 'engines' ),
            'tr-inv-list-stock'         => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-stock', false ) : esc_html__( 'Stock', 'engines' ),
            'tr-inv-list-single-link'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-single-link', false ) : esc_html__( 'More Info', 'engines' ),
            
            //Inventory List Compare
            'tr-inv-list-compare-add'    => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-compare-add', false ) : esc_html__( 'Add to compare', 'engines' ),
            'tr-inv-list-compare-added'  => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-compare-added', false ) : esc_html__( 'In compare list', 'engines' ),
            'tr-inv-list-compare-remove' => $yog_translate ? yog_helper()->get_option( 'tr-inv-list-compare-remove', false ) : esc_html__( 'Remove from list', 'engines' ),
            
            //Inventory Order Filter Translation
            'tr-inv-order-fiter'        => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-fiter', false ) : esc_html__( 'Sort by:', 'engines' ),
            'tr-inv-order-by'           => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-by', false ) : esc_html__( 'Order By', 'engines' ),
            'tr-inv-order-price-high'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-price-high', false ) : esc_html__( 'Price: Highest First', 'engines' ),
            'tr-inv-order-price-low'    => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-price-low', false ) : esc_html__( 'Price: Lowest First', 'engines' ),
            'tr-inv-order-mileage-high' => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-mileage-high', false ) : esc_html__( 'Mileage: Highest First', 'engines' ),
            'tr-inv-order-mileage-low'  => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-mileage-low', false ) : esc_html__( 'Mileage: Lowest First', 'engines' ),
            'tr-inv-order-date-highest' => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-date-highest', false ) : esc_html__( 'Date: Highest First', 'engines' ),
            'tr-inv-order-date-lowest'  => $yog_translate ? yog_helper()->get_option( 'tr-inv-order-date-lowest', false ) : esc_html__( 'Date: Lowest First', 'engines' ),
            
            // Inventory Filter Translation
            'tr-inv-search-make'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-make', false ) : esc_html__( 'Make:', 'engines' ),
            'tr-inv-search-models' => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-models', false ) : esc_html__( 'Models:', 'engines' ),
            'tr-inv-search-body'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-body', false ) : esc_html__( 'Body:', 'engines' ),
            'tr-inv-search-year'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-year', false ) : esc_html__( 'Year:', 'engines' ),
            'tr-inv-search-min-price' => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-min-price', false ) : esc_html__( 'Min Price:', 'engines' ),
            'tr-inv-search-max-price' => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-max-price', false ) : esc_html__( 'Max Price:', 'engines' ),
            'tr-inv-search-transmission' => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-transmission', false ) : esc_html__( 'Transmission:', 'engines' ),
            'tr-inv-search-color' => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-color', false ) : esc_html__( 'Color:', 'engines' ),
            'tr-inv-search-btn'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-search-btn', false ) : esc_html__( 'Apply filter', 'engines' ),
            
            //Inventory Loan Calculator Form.
            'tr-inv-cal-price'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-price', false ) : esc_html__( 'Vehicle Price', 'engines' ),
            'tr-inv-cal-down-payment'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-down-payment', false ) : esc_html__( 'Down Payment', 'engines' ),
            'tr-inv-cal-month'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-month', false ) : esc_html__( 'Term (Month)', 'engines' ),
            'tr-inv-cal-interest'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-interest', false ) : esc_html__( 'Interest Rate', 'engines' ),
            'tr-inv-cal-btn'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-btn', false ) : esc_html__( 'CALCULATE NOW', 'engines' ),
            
            //Calculator Form Reslt.
            'tr-inv-cal-result-month'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-result-month', false ) : esc_html__( 'Monthly Payment:', 'engines' ),
            'tr-inv-cal-result-interset'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-result-interset', false ) : esc_html__( 'Total Interest to Pay:', 'engines' ),
            'tr-inv-cal-result-amount'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-cal-result-amount', false ) : esc_html__( 'Total Amount:', 'engines' ),
            
            //Inventory Single
            'tr-inv-single-fatures'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-fatures', false ) : __( '<strong>Key Features</strong> of %s', 'engines' ),
            'tr-inv-single-technical' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-technical', false ) : __( '<strong>Technical Details</strong> of %s', 'engines' ),
            'tr-inv-single-extra-feature' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-extra-feature', false ) : __( '<strong>Extra Features</strong> of %s', 'engines' ),
            
            //Inventory Key Features
            'tr-inv-single-feature-body' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-body', false ) : esc_html__( 'Body', 'engines' ),
            'tr-inv-single-feature-km'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-km', false ) : esc_html__( 'Total Kilometres', 'engines' ),
            'tr-inv-single-feature-fuel' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-fuel', false ) : esc_html__( 'Fuel Type', 'engines' ),
            'tr-inv-single-feature-reg'  => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-reg', false ) : esc_html__( 'Reg.Year', 'engines' ),
            'tr-inv-single-feature-transmission' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-transmission', false ) : esc_html__( 'Transmission', 'engines' ),
            'tr-inv-single-feature-engine' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-engine', false ) : esc_html__( 'Engine', 'engines' ),
            'tr-inv-single-feature-fuel-economy'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-fuel-economy', false ) : esc_html__( 'Fuel Economy', 'engines' ),
            'tr-inv-single-feature-exterior-color' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-exterior-color', false ) : esc_html__( 'Exterior Color', 'engines' ),
            'tr-inv-single-feature-interior-color' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-interior-color', false ) : esc_html__( 'Interior Color', 'engines' ),
            'tr-inv-single-feature-vin' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-vin', false ) : esc_html__( 'Vin', 'engines' ),
            'tr-inv-single-feature-mileage' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-feature-mileage', false ) : esc_html__( 'Mileage', 'engines' ),
            
            //Contact Detais
            'tr-inv-single-contact-heading' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-contact-heading', false ) : esc_html__( 'Contact Us', 'engines' ),
            'tr-inv-single-contact-address' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-contact-address', false ) : esc_html__( 'Address:', 'engines' ),
            'tr-inv-single-contact-email' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-contact-email', false ) : esc_html__( 'Have any questions?', 'engines' ),
            'tr-inv-single-contact-phone' => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-contact-phone', false ) : esc_html__( 'Call us & Hire us', 'engines' ),
            'tr-inv-single-contact-fax'   => $yog_translate ? yog_helper()->get_option( 'tr-inv-single-contact-fax', false ) : esc_html__( 'Fax', 'engines' ),
            
        );
    }
    add_action( 'init', 'yog_set_translation' );
 endif;

 if ( ! function_exists( 'yog_get_translation' ) ) :
    /**
     * [yog_get_translation description]
     * @method yog_get_translation
     * @return [type]             [description]
     */
    function yog_get_translation( $yog_id ) {
        global $yog_translation;
        
        //Check Id
        if( empty( $yog_id ) ){
            return;
        }
        
        //Return Content.
        return $yog_translation[$yog_id];
    }
 endif;

 if ( ! function_exists( 'yog_translation' ) ) :
    /**
     * [yog_translation description]
     * @method yog_translation
     * @return [type]             [description]
     */
    function yog_translation( $yog_id ) {
        echo yog_get_translation( $yog_id );
    }
 endif;