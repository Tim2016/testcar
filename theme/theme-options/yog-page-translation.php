<?php
/*
 * Page Translation
*/

$this->sections[] = array (
	'title'      => esc_html__( 'Translation', 'engines' ),
	'subsection' => true,
	'fields'     => array(

		array(
            'id'        => 'enable-translation',
            'type'      => 'switch',
            'title'     => esc_html__( 'Enable Theme Translation', 'engines' ),
            'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
        ),
        
        array(
			'id'        => 'info_tr_blog',
			'type'      => 'info',
            'style'     => 'info',
			'title'     => esc_html__( 'Blog Breadcrumb Translation', 'engines' )
		),
        
        array(
            'id'        => 'tr-blog-cat',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Category', 'engines' ),
            'default'   => esc_html__( 'Category: %s', 'engines' ),
            'subtitle'  => esc_html__( 'Enter Blog Category Breadcrumb Title', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-tag',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Tags', 'engines' ),
            'default'   => esc_html__( 'Tags: %s', 'engines' ),
            'subtitle'  => esc_html__( 'Enter Blog Tag Breadcrumb Title', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-day',
            'type'      => 'text',
            'title'     => esc_html__('Blog Day', 'engines'),
            'default'   => esc_html__( 'Day: %s', 'engines' ),
            'subtitle'  => esc_html__( 'Enter Blog Day Breadcrumb Title', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-monthly',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Monthly', 'engines' ),
            'default'   => esc_html__( 'Monthly: %s', 'engines' ),
            'subtitle'  => esc_html__( 'Enter Blog Monthly Breadcrumb Title', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-yearly',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Yearly', 'engines' ),
            'default'   => esc_html__( 'Yearly: %s', 'engines' ),
            'subtitle'  => esc_html__( 'Enter Blog Yearly Breadcrumb Title', 'engines' )
        ),
        
        array(
			'id'        => 'info_tr_blog_comments',
			'type'      => 'info',
            'style'     => 'info',
			'title'     => esc_html__( 'Blog Comments Translation', 'engines' )
		),
        
        array(
            'id'        => 'tr-blog-comment',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Comment', 'engines' ),
            'default'   => esc_html__( 'Comment', 'engines' ),
            'subtitle'  => esc_html__( 'Blog Comment Template Singular Comment', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-comments',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Comments', 'engines' ),
            'default'   => esc_html__( 'Comments', 'engines' ),
            'subtitle'  => esc_html__( 'Blog Comment Template Comments', 'engines' )
        ),
        
        array(
            'id'        => 'tr-blog-comment-off',
            'type'      => 'text',
            'title'     => esc_html__( 'Blog Comment Off', 'engines' ),
            'default'   => esc_html__( 'Comment Off', 'engines' ),
            'subtitle'  => esc_html__( 'Blog Comment Template Comments Off', 'engines' )
        ),
        
        array(
			'id'       => 'info_tr_blog_search',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Blog Search Translation', 'engines' )
		),
        
        array(
            'id'       => 'tr-blog-comment-reply',
            'type'     => 'text',
            'title'    => esc_html__( 'Blog Comment Reply', 'engines' ),
            'default'  => esc_html__( 'Reply', 'engines' ),
            'subtitle' => esc_html__( 'Blog Comment Template Comments Reply', 'engines' )
        ),
        
        array(
            'id'       => 'tr-blog-search',
            'type'     => 'text',
            'title'    => esc_html__( 'Search Form', 'engines' ),
            'default'  => esc_html__( 'Search..', 'engines' ),
            'subtitle' => esc_html__( 'Enter Search Form Placholder', 'engines' )
        ),
        
        array(
            'id'       => 'tr-blog-search-result',
            'type'     => 'text',
            'title'    => esc_html__( 'Search Form Result', 'engines' ),
            'default'  => esc_html__( 'Search Result of %s', 'engines' ),
            'subtitle' => esc_html__( 'Enter Search Form Result', 'engines' )
        ),
        
        array(
			'id'       => 'info_tr_inventory-list-style',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory List Style Visual Composer Element Translation', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-list-km',
            'type'     => 'text',
            'title'    => esc_html__( 'KM', 'engines' ),
            'default'  => esc_html__( 'KMs', 'engines' ),
            'subtitle' => esc_html__( 'Enter kilometer field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-fuel-type',
            'type'     => 'text',
            'title'    => esc_html__( 'Fuel Type', 'engines' ),
            'default'  => esc_html__( 'Fuel Type', 'engines' ),
            'subtitle' => esc_html__( 'Enter fuel type field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-reg-year',
            'type'     => 'text',
            'title'    => esc_html__( 'Reg.Year', 'engines' ),
            'default'  => esc_html__( 'Reg.Year', 'engines' ),
            'subtitle' => esc_html__( 'Enter registeration year field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-transmission',
            'type'     => 'text',
            'title'    => esc_html__( 'Transmission', 'engines' ),
            'default'  => esc_html__( 'Transmission', 'engines' ),
            'subtitle' => esc_html__( 'Enter transmission field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-engine',
            'type'     => 'text',
            'title'    => esc_html__( 'Engine', 'engines' ),
            'default'  => esc_html__( 'Engine', 'engines' ),
            'subtitle' => esc_html__( 'Enter engine field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-stock',
            'type'     => 'text',
            'title'    => esc_html__( 'Stock', 'engines' ),
            'default'  => esc_html__( 'Stock', 'engines' ),
            'subtitle' => esc_html__( 'Enter stock field value heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-list-single-link',
            'type'     => 'text',
            'title'    => esc_html__( 'More Info', 'engines' ),
            'default'  => esc_html__( 'More Info', 'engines' ),
            'subtitle' => esc_html__( 'Enter inventory single page link heading', 'engines' )
        ),
        
        array(
			'id'       => 'info_tr_inventory-list-compae',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory List Style Compare Translation', 'engines' )
		),
        
        array(
			'id'       => 'tr-inv-list-compare-add',
			'type'     => 'text',
            'title'    => esc_html__( 'Add to compare', 'engines' ),
            'default'  => esc_html__( 'Add to compare', 'engines' ),
            'subtitle' => esc_html__( 'Enter add to compare button heading', 'engines' )
		),
        
        array(
			'id'       => 'tr-inv-list-compare-added',
			'type'     => 'text',
            'title'    => esc_html__( 'In compare list', 'engines' ),
            'default'  => esc_html__( 'In compare list', 'engines' ),
            'subtitle' => esc_html__( 'Enter in compare list button heading', 'engines' )
		),
        
        array(
			'id'       => 'tr-inv-list-compare-remove',
			'type'     => 'text',
            'title'    => esc_html__( 'Remove from list', 'engines' ),
            'default'  => esc_html__( 'Remove from list', 'engines' ),
            'subtitle' => esc_html__( 'Enter remove from list button heading', 'engines' )
		),
        
        array(
			'id'       => 'info_tr_inventory-oder-filter',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory Order Filter Translation', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-order-fiter',
            'type'     => 'text',
            'title'    => esc_html__( 'Sort by:', 'engines' ),
            'default'  => esc_html__( 'Sort by:', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter title', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-by',
            'type'     => 'text',
            'title'    => esc_html__( 'Order By', 'engines' ),
            'default'  => esc_html__( 'Order By', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter default value', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-price-high',
            'type'     => 'text',
            'title'    => esc_html__( 'Price: Highest First', 'engines' ),
            'default'  => esc_html__( 'Price: Highest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter price hightest order heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-price-low',
            'type'     => 'text',
            'title'    => esc_html__( 'Price: Lowest First', 'engines' ),
            'default'  => esc_html__( 'Price: Lowest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter price lowest order heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-mileage-high',
            'type'     => 'text',
            'title'    => esc_html__( 'Mileage: Highest First', 'engines' ),
            'default'  => esc_html__( 'Mileage: Highest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter mileage highest order heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-mileage-low',
            'type'     => 'text',
            'title'    => esc_html__( 'Mileage: Lowest First', 'engines' ),
            'default'  => esc_html__( 'Mileage: Lowest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter mileage lowest order heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-date-highest',
            'type'     => 'text',
            'title'    => esc_html__( 'Date: Highest First', 'engines' ),
            'default'  => esc_html__( 'Date: Highest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter date highest order heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-order-date-lowest',
            'type'     => 'text',
            'title'    => esc_html__( 'Date: Lowest First', 'engines' ),
            'default'  => esc_html__( 'Date: Lowest First', 'engines' ),
            'subtitle' => esc_html__( 'Enter order filter date lowest order heading', 'engines' )
        ),
        
        array(
			'id'       => 'info_tr_inventory-search-filter',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory Search Filter Translation', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-search-make',
            'type'     => 'text',
            'title'    => esc_html__( 'Make:', 'engines' ),
            'default'  => esc_html__( 'Make:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter make category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-models',
            'type'     => 'text',
            'title'    => esc_html__( 'Models:', 'engines' ),
            'default'  => esc_html__( 'Models:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter models category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-body',
            'type'     => 'text',
            'title'    => esc_html__( 'Body:', 'engines' ),
            'default'  => esc_html__( 'Body:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter body category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-year',
            'type'     => 'text',
            'title'    => esc_html__( 'Year:', 'engines' ),
            'default'  => esc_html__( 'Year:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter year category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-min-price',
            'type'     => 'text',
            'title'    => esc_html__( 'Min Price:', 'engines' ),
            'default'  => esc_html__( 'Min Price:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter min price category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-max-price',
            'type'     => 'text',
            'title'    => esc_html__( 'Max Price:', 'engines' ),
            'default'  => esc_html__( 'Max Price:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter max price category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-transmission',
            'type'     => 'text',
            'title'    => esc_html__( 'Transmission:', 'engines' ),
            'default'  => esc_html__( 'Transmission:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter transmission category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-color',
            'type'     => 'text',
            'title'    => esc_html__( 'Color:', 'engines' ),
            'default'  => esc_html__( 'Color:', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter color category selector heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-btn',
            'type'     => 'text',
            'title'    => esc_html__( 'Button', 'engines' ),
            'default'  => esc_html__( 'Apply filter', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter button label text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-search-btn',
            'type'     => 'text',
            'title'    => esc_html__( 'Filter Reset', 'engines' ),
            'default'  => esc_html__( 'Reset all', 'engines' ),
            'subtitle' => esc_html__( 'Enter search filter reset link label text', 'engines' )
        ),
        
        array(
			'id'       => 'info-tr-calculator',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory Loan Calculator Form Feilds', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-cal-price',
            'type'     => 'text',
            'title'    => esc_html__( 'Price', 'engines' ),
            'default'  => esc_html__( 'Vehicle Price', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator price input field label', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-cal-down-payment',
            'type'     => 'text',
            'title'    => esc_html__( 'Down Payment', 'engines' ),
            'default'  => esc_html__( 'Down Payment', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator down payment input field label', 'engines' )
        ),
        
        array(
            'id'       =>'tr-inv-cal-month',
            'type'     => 'text',
            'title'    => esc_html__('Month', 'engines'),
            'default'  => esc_html__( 'Term (Month)', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator month input field label', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-cal-interest',
            'type'     => 'text',
            'title'    => esc_html__( 'Interest Rate', 'engines'),
            'default'  => esc_html__( 'Interest Rate', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator interest rate input field label', 'engines' )
        ),
        
        array(
            'id'       =>'tr-inv-cal-btn',
            'type'     => 'text',
            'title'    => esc_html__( 'Form Submit Button', 'engines' ),
            'default'  => esc_html__( 'CALCULATE NOW', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator form submit button label', 'engines' )
        ),
        
        array(
			'id'       => 'info-tr-calculator-result',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory Loan Calculator Result', 'engines' )
		),
        
        array(
            'id'       =>'tr-inv-cal-result-month',
            'type'     => 'text',
            'title'    => esc_html__( 'Monthly Payment', 'engines' ),
            'default'  => esc_html__( 'Monthly Payment:', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator result label for monthly payment', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-cal-result-interset',
            'type'     => 'text',
            'title'    => esc_html__( 'Total Interest', 'engines' ),
            'default'  => esc_html__( 'Total Interest to Pay:', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator result label for total interest', 'engines' )
        ),
        
        array(
            'id'       =>'tr-inv-cal-result-amount',
            'type'     => 'text',
            'title'    => esc_html__( 'Total Amount', 'engines' ),
            'default'  => esc_html__( 'Total Amount:', 'engines' ),
            'subtitle' => esc_html__( 'Enter loan calculator result label for total amount', 'engines' )
        ),
        
        array(
			'id'       => 'info-tr-inventory-single',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__('Inventory Single Page', 'engines')
		),
        
        array(
            'id'       => 'tr-inv-single-fatures',
            'type'     => 'text',
            'title'    => esc_html__( 'Key Feature', 'engines' ),
            'default'  => esc_html__( '<strong>Key Features</strong> of %s', 'engines' ),
            'subtitle' => esc_html__( 'Enter key feature section heading text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-technical',
            'type'     => 'text',
            'title'    => esc_html__( 'Technical Details', 'engines' ),
            'default'  => esc_html__( '<strong>Technical Details</strong> of %s', 'engines' ),
            'subtitle' => esc_html__( 'Enter technical details section heading text', 'engines' )
        ),
        
        array(
            'id'       =>'tr-inv-single-extra-feature',
            'type'     => 'text',
            'title'    => esc_html__( 'Extra Features', 'engines' ),
            'default'  => esc_html__( '<strong>Extra Features</strong> of %s', 'engines' ),
            'subtitle' => esc_html__( 'Enter extra feature section heading text', 'engines' )
        ),
        
        array(
			'id'       => 'info-tr-inventory-single-features',
			'type'     => 'info',
            'style'    => 'info',
			'title'    => esc_html__( 'Inventory Single Page Key Features Section', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-single-feature-body',
            'type'     => 'text',
            'title'    => esc_html__( 'Body', 'engines' ),
            'default'  => esc_html__( 'Body', 'engines' ),
            'subtitle' => esc_html__( 'Enter body category heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-km',
            'type'     => 'text',
            'title'    => esc_html__( 'Total Kilometres', 'engines' ),
            'default'  => esc_html__( 'Total Kilometres', 'engines' ),
            'subtitle' => esc_html__( 'Enter total kilometres heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-fuel',
            'type'     => 'text',
            'title'    => esc_html__( 'Fuel Type', 'engines' ),
            'default'  => esc_html__( 'Fuel Type', 'engines' ),
            'subtitle' => esc_html__( 'Enter fuel type heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-reg',
            'type'     => 'text',
            'title'    => esc_html__( 'Reg.Year', 'engines' ),
            'default'  => esc_html__( 'Reg.Year', 'engines' ),
            'subtitle' => esc_html__( 'Enter registration year heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-transmission',
            'type'     => 'text',
            'title'    => esc_html__( 'Transmission', 'engines' ),
            'default'  => esc_html__( 'Transmission', 'engines' ),
            'subtitle' => esc_html__( 'Enter transmission heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-engine',
            'type'     => 'text',
            'title'    => esc_html__( 'Engine', 'engines' ),
            'default'  => esc_html__( 'Engine', 'engines' ),
            'subtitle' => esc_html__( 'Enter engine heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-fuel-economy',
            'type'     => 'text',
            'title'    => esc_html__( 'Fuel Economy', 'engines' ),
            'default'  => esc_html__( 'Fuel Economy', 'engines' ),
            'subtitle' => esc_html__( 'Enter fuel economy heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-exterior-color',
            'type'     => 'text',
            'title'    => esc_html__( 'Exterior Color', 'engines' ),
            'default'  => esc_html__( 'Exterior Color', 'engines' ),
            'subtitle' => esc_html__( 'Enter exterior color heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-interior-color',
            'type'     => 'text',
            'title'    => esc_html__( 'Interior Color', 'engines' ),
            'default'  => esc_html__( 'Interior Color', 'engines' ),
            'subtitle' => esc_html__( 'Enter interior color heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-vin',
            'type'     => 'text',
            'title'    => esc_html__( 'Vin', 'engines' ),
            'default'  => esc_html__( 'Vin', 'engines' ),
            'subtitle' => esc_html__( 'Enter vin heading', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-feature-mileage',
            'type'     => 'text',
            'title'    => esc_html__( 'Mileage', 'engines' ),
            'default'  => esc_html__( 'Mileage', 'engines' ),
            'subtitle' => esc_html__( 'Enter mileage heading', 'engines' )
        ),
        
        array(
			'id'      => 'info-tr-inventory-single-contact',
			'type'    => 'info',
            'style'   => 'info',
			'title'   => esc_html__( 'Inventory Single Page Contact Section', 'engines' )
		),
        
        array(
            'id'       => 'tr-inv-single-contact-heading',
            'type'     => 'text',
            'title'    => esc_html__( 'Contact Us', 'engines' ),
            'default'  => esc_html__( 'Contact Us', 'engines' ),
            'subtitle' => esc_html__( 'Enter contact form seven section heading text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-contact-address',
            'type'     => 'text',
            'title'    => esc_html__( 'Address:', 'engines' ),
            'default'  => esc_html__( 'Address:', 'engines' ),
            'subtitle' => esc_html__( 'Enter address feild heading text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-contact-email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email', 'engines' ),
            'default'  => esc_html__( 'Have any questions?', 'engines' ),
            'subtitle' => esc_html__( 'Enter email feild heading text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-contact-phone',
            'type'     => 'text',
            'title'    => esc_html__( 'Phone Number', 'engines' ),
            'default'  => esc_html__( 'Call us & Hire us', 'engines' ),
            'subtitle' => esc_html__( 'Enter phone number feild heading text', 'engines' )
        ),
        
        array(
            'id'       => 'tr-inv-single-contact-fax',
            'type'     => 'text',
            'title'    => esc_html__( 'Fax', 'engines' ),
            'default'  => esc_html__( 'Fax', 'engines' ),
            'subtitle' => esc_html__( 'Enter fax feild heading text', 'engines' )
        )
	)
);
