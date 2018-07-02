<?php
/*
 * Inventory Section
*/
$this->sections[] = array(
	'title'  => esc_html__('Inventory', 'engines'),
	'icon'   => 'el-icon-file-edit'
);

$this->sections[] = array(
	'title'      => esc_html__('General', 'engines'),
	'subsection' => true,
	'fields'     => array(
    
        array(
			'id'       => 'inventory-price-currency',
			'type'	   => 'text',
            'default'  => '$',
			'title'    => esc_html__('Price Currency', 'engines'),
            'subtitle' => esc_html__('Insert inventory price currency.', 'engines')
		),
        
        array(
			'id'       => 'inventory-price-currency-postion',
			'type'	   => 'select',
            'default'  => 'left',
			'title'    => esc_html__('Price Currency Psosition', 'engines'),
            'subtitle' => esc_html__('Choose inventory price currency position.', 'engines'),
            'options'  => array(
                'left'  => esc_html__( 'Left', 'engines' ),
                'right' => esc_html__( 'Right', 'engines' ),
            )
		),
        
        array(
			'id'       => 'inventory-stock',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Stock', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show stock of inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-compare',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Compare', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show compare button of inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-certified-logo1',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Certified Logo 1', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show certified logo 1 of inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-certified-logo2',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Certified Logo 2', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show certified logo 2 of inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		)
    )
);

$this->sections[] = array(
	'title'      => esc_html__('Single Inventory', 'engines'),
	'subsection' => true,
	'fields'     => array(
    
        array(
            'id'    => 'opt-test-drive-info',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Test Drive Form', 'engines' ),
            'desc'  => esc_html__( 'Please insert user test drive popup form.', 'engines' ),
        ),
        
        array(
			'id'       => 'inventory-test-drive',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Test Drive Form', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show test drive popup form', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-test-drive-heading',
			'type'	   => 'text',
			'title'    => esc_html__('Test Drive Form Heading', 'engines'),
            'subtitle' => esc_html__('Insert test drive form heading.', 'engines'),
            'required' => array('inventory-test-drive','equals',true),
		),
        
        array(
			'id'       => 'inventory-test-drive-shortcode',
			'type'	   => 'text',
			'title'    => esc_html__('Test Drive Form', 'engines'),
            'subtitle' => esc_html__('Insert test drive contact form seven shortcode.', 'engines'),
            'required' => array('inventory-test-drive','equals',true),
		),
        
        array(
			'id'       => 'inventory-test-drive-btn',
			'type'	   => 'text',
			'title'    => esc_html__('Test Drive Button Heading', 'engines'),
            'subtitle' => esc_html__('Insert test drive button heading.', 'engines'),
            'required' => array('inventory-test-drive','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-key-features',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Key Featurs', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show key features of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-technical',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Technical Details', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show technical details of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-extra-feature',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Extra Features', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show extra features of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-manual',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Manual Download', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show manual download file of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-manual-heading',
			'type'	   => 'text',
			'title'    => esc_html__('Manual Download Heading', 'engines'),
            'subtitle' => esc_html__('Insert single inventory manual download files heading.', 'engines'),
            'required' => array('inventory-single-manual','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-calculator',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Loan Calculator', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show loan calculator of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-calculator-heading',
			'type'	   => 'text',
			'title'    => esc_html__('Calculator Heading', 'engines'),
            'subtitle' => esc_html__('Insert single inventory calculator heading.', 'engines'),
            'required' => array('inventory-single-calculator','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-offer',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Special Offers', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show special offers of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-offer-heading',
			'type'	   => 'text',
            'default'  => esc_html__( 'Special Offers', 'engines' ),
			'title'    => esc_html__('Special Offers Heading', 'engines'),
            'subtitle' => esc_html__('Insert single inventory special offers heading text.', 'engines'),
            'required' => array('inventory-single-offer','equals',true),
		),
        
        array(
            'id'      => 'opt-contact-form-info',
            'type'    => 'info',
            'style'   => 'info',
            'title'   => esc_html__( 'Contact Form Setting', 'engines' ),
            'desc'    => esc_html__( 'Please insert contact form settings using options ( Contact Form Enable / Disable, Shortcode ).', 'engines' ),
        ),
        
        array(
			'id'       => 'inventory-single-contact-form',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Contact Form', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show contact form of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-contact-shortcode',
			'type'	   => 'text',
			'title'    => esc_html__('Contact Form Shortcode', 'engines'),
            'subtitle' => esc_html__('Insert single inventory contact form seven shortcode.', 'engines'),
            'required' => array('inventory-single-contact-form','equals',true),
		),
        
        array(
            'id'       => 'opt-contact-info',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => esc_html__( 'Contact Details Setting', 'engines' ),
            'desc'     => esc_html__( 'Please insert contact details settings using options ( Contact Details Enable / Disable, Address, Emial, Phone, Fax ).', 'engines' ),
        ),
        
        array(
			'id'       => 'inventory-single-contact',
			'type'	   => 'switch',
			'title'    => esc_html__('Activate Contact Details', 'engines'),
			'subtitle' => esc_html__('Turn on if you want to show contact details of single inventory.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
		),
        
        array(
			'id'       => 'inventory-single-contact-address',
			'type'	   => 'textarea',
			'title'    => esc_html__('Contact Address', 'engines'),
            'subtitle' => esc_html__('Insert single inventory contact address text.', 'engines'),
            'required' => array('inventory-single-contact','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-contact-email',
			'type'	   => 'text',
			'title'    => esc_html__('Contact Email', 'engines'),
            'subtitle' => esc_html__('Insert single inventory contact email text.', 'engines'),
            'required' => array('inventory-single-contact','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-contact-phone',
			'type'	   => 'text',
			'title'    => esc_html__('Contact Phone', 'engines'),
            'subtitle' => esc_html__('Insert single inventory contact phone text.', 'engines'),
            'required' => array('inventory-single-contact','equals',true),
		),
        
        array(
			'id'       => 'inventory-single-contact-fax',
			'type'	   => 'text',
			'title'    => esc_html__('Contact Fax', 'engines'),
            'subtitle' => esc_html__('Insert single inventory contact fax text.', 'engines'),
            'required' => array('inventory-single-contact','equals',true),
		) 
    )
);

$this->sections[] = array(
	'title'      => esc_html__('Inventory Archive', 'engines'),
	'subsection' => true,
	'fields'     => array(
    
        array(
			'id'       => 'inventory-arch-display',
			'type'	   => 'select',
			'title'    => esc_html__('Display Style', 'engines'),
            'subtitle' => esc_html__('Choose display style ( list / grid ).', 'engines'),
            'options'  => array(
                'grid' => esc_html__( 'Grid', 'engines' ),
                'list' => esc_html__( 'List', 'engines' ),
            ),'default'=> 'list'
		),
        
        array(
			'id'       => 'inventory-arch-grid',
			'type'	   => 'select',
			'title'    => esc_html__('Grid Column', 'engines'),
            'subtitle' => esc_html__('Choose grid column.', 'engines'),
            'options'  => array(
                '2'    => esc_html__( 'Two', 'engines' ),
                '3'    => esc_html__( 'Three', 'engines' ),
            ),'default'=> '3',
            'required' => array('inventory-arch-display','equals','grid'),
		),
        
        array(
            'title'       => esc_html__('Animation', 'engines'),
			'type'        => 'select',
			'id'          => 'inventory-arch-animation',
			'options'     => array_flip( yog_get_theme_animations() ),
			'description' => esc_html__('Choose Animation from the drop down list.', 'engines'),
		 ), 
         
         array(
            'title'    => esc_html__( 'Delay','engines'),
            'type'     => 'text',
            'id'       => 'inventory-arch-delay',
         )
    )
);

//Get list of all pages
$yog_types = array();
$yog_types[] = esc_html__( '--- Default ---', 'engines' );
$yog_query        = get_posts( array( 'post_type' => 'page', 'posts_per_page' => - 1 ) );
if ( $yog_query ) {
	foreach ( $yog_query as $yog_post ) {
		$yog_types[ $yog_post->ID ] = get_the_title( $yog_post->ID );
	}
}

$this->sections[] = array(
	'title'      => esc_html__('Inventory Compare', 'engines'),
	'subsection' => true,
	'fields'     => array(
    
        array(
			'id'       => 'compare-page',
			'type'     => 'select',
            'options'  => $yog_types,
			'title'    => esc_html__( 'Inventory Compare Page', 'engines' ),
            'subtitle' => esc_html__('Choose page for display compare results', 'engines')
		),
        
        array(
			'id'       => 'inventory-com-heading',
			'type'	   => 'text',
			'title'    => esc_html__('Compare Heading', 'engines'),
            'subtitle' => esc_html__('Insert compare page heading.', 'engines')
		),
        
        array(
			'id'       => 'inventory-com-ads',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Ads Banner', 'engines'),
			'subtitle' => esc_html__('Select an image file for ads banner.', 'engines'),
		),
        
        array(
			'id'       => 'inventory-com-ads-link',
			'type'     => 'text',
			'title'    => esc_html__('Ads Banner Link', 'engines'),
			'subtitle' => esc_html__('Insert link for ads banner image.', 'engines'),
		),
        
        array(
            'title'       => esc_html__('Animation', 'engines'),
			'type'        => 'select',
			'id'          => 'inventory-animation',
			'options'     => array_flip( yog_get_theme_animations() ),
			'description' => esc_html__('Choose Animation from the drop down list.', 'engines'),
		 ), 
         
         array(
            'title'   => esc_html__( 'Delay','engines'),
            'type'    => 'text',
            'id'      => 'inventory-delay',
         )
    )
 );
 
$current_taxonomies = get_object_taxonomies('inventory', 'objects');
$taxonomies_ordered = apply_filters('filters_taxonomy_order', array_keys($current_taxonomies), 'inventory');
$yog_categries = array();
if ($taxonomies_ordered){
    foreach ( $taxonomies_ordered as $key ){
   
       $taxonomy = $current_taxonomies[$key];
       $yog_categries[$taxonomy->name] = $taxonomy->label;
    }  
} 

$this->sections[] = array(
	'title'      => esc_html__('Inventory Advance Ajax Fliter', 'engines'),
	'subsection' => true,
	'fields'     => array(
        array(
            'id'       => 'cat-checkbox',
            'type'     => 'select',
            'title'    => esc_html__('Check Box Field', 'engines'), 
            'subtitle' => esc_html__('Choose Categories that want to show in checkbox field', 'engines'),
            'desc'     => esc_html__('Note: All choosen categories display in checkbox fields so those categories which you do not choose will be display in dropdown select fields', 'engines'),
            'options'  => $yog_categries,
            'multi'    => true
        ),
        
        array(
            'id'       => 'cat-exclude',
            'type'     => 'select',
            'title'    => esc_html__('Categories Exclude', 'engines'), 
            'subtitle' => esc_html__('Choose Categories that you do not want to show in advance ajax filter', 'engines'),
            'options'  => $yog_categries,
            'multi'    => true
        ),
        
        array(
			'id'       => 'inventory-cat-display',
			'type'	   => 'select',
			'title'    => esc_html__('Display Style', 'engines'),
            'subtitle' => esc_html__('Choose display style ( list / grid ).', 'engines'),
            'options'  => array(
                'grid' => esc_html__( 'Grid', 'engines' ),
                'list' => esc_html__( 'List', 'engines' ),
            ),'default'=> 'list'
		),
        
        array(
			'id'       => 'inventory-cat-grid',
			'type'	   => 'select',
			'title'    => esc_html__('Grid Column', 'engines'),
            'subtitle' => esc_html__('Choose grid column.', 'engines'),
            'options'  => array(
                '2'    => esc_html__( 'Two', 'engines' ),
                '3'    => esc_html__( 'Three', 'engines' ),
                '4'    => esc_html__( 'Four', 'engines' ),
            ),'default'=> '3',
            'required' => array('inventory-cat-display','equals','grid'),
		)
    )
);