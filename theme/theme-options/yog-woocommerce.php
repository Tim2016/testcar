<?php

$this->sections[] = array(
	'title' => esc_html__( 'Woocommerce', 'engines' ),
	'icon'  => 'el-icon-shopping-cart'
);

$this->sections[] = array(
	'title'      => esc_html__( 'Shop Settings', 'engines' ),
	'subsection' => true,
	'fields'     => array(
		
        array(
            'id'        => 'engines-shop-column',
            'type'      => 'slider',
            'title'     => esc_html__('Shop column', 'engines'),
            'subtitle'  => esc_html__('Choose Shop Gird Column.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 4, step: 1, default value: 4', 'engines'),
            "default"   => 4,
            "min"       => 1,
            "step"      => 1,
            "max"       => 4,
            'display_value' => 'label'
        ),
        
        array(
            'id'        => 'engines-shop-limit',
            'type'      => 'slider',
            'title'     => esc_html__('Shop Products', 'engines'),
            'subtitle'  => esc_html__('Choose Shop Products.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 40, step: 4, default value: 16', 'engines'),
            "default"   => 6,
            "min"       => 1,
            "step"      => 1,
            "max"       => 40,
            'display_value' => 'label'
        ),
        
        array(
            'id'    => 'engines-shop-info',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Shop Top Bar', 'engines' ),
            'desc'  => esc_html__( 'Please choose shop top bar setting', 'engines' ),
        ),
        
        array(
            'id'=>'engines-top-bar',
            'type' => 'switch',
            'title' => esc_html__('Show top bar', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'=>'engines-result-count',
            'type' => 'switch',
            'title' => esc_html__('Show Result Count', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'=>'engines-shop-filter',
            'type' => 'switch',
            'title' => esc_html__('Show Catalog Ordering', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'=>'engines-shop-pagination',
            'type' => 'switch',
            'title' => esc_html__('Show Pagination', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'=>'engines-shop-adds',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Adds', 'engines'),
            'default' => array(
                'url' => yog()->load_assets( 'img/shop/adds.png' )
            )
        ),
        
        array(
    		'title' => esc_html__( 'Link', 'engines' ),
    		'type' => 'text',
            'default' => esc_html__( '#', 'engines' ),
            'id' => 'engines-shop-adds-link',
            'desc' => esc_html__('Insert link.', 'engines'),
    	)
	) 
);

$this->sections[] = array(
	'title' => esc_html__( 'Single Product', 'engines' ),
	'subsection' => true,
	'fields' => array(
			
        array(
            'id'=>'engines-product-tab',
            'type' => 'switch',
            'title' => esc_html__('Product Tab', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'    => 'engines-shop-info-one',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Related Products', 'engines' ),
            'desc'  => esc_html__( 'Please choose related products setting', 'engines' ),
        ),
        
        array(
            'id'=>'engines-product-related',
            'type' => 'switch',
            'title' => esc_html__('Related Products', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'        => 'engines-product-rel-column',
            'type'      => 'slider',
            'title'     => esc_html__('Related Products column', 'engines'),
            'subtitle'  => esc_html__('Choose Related Products Column.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 4, step: 1, default value: 4', 'engines'),
            "default"   => 4,
            "min"       => 1,
            "step"      => 1,
            "max"       => 4,
            'display_value' => 'label',
      
        ),
        
        array(
            'id'        => 'engines-product-rel-limit',
            'type'      => 'slider',
            'title'     => esc_html__('Related Products', 'engines'),
            'subtitle'  => esc_html__('Choose Related Products.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 40, step: 4, default value: 16', 'engines'),
            "default"   => 8,
            "min"       => 1,
            "step"      => 1,
            "max"       => 40,
            'display_value' => 'label'
        ),
        
        array(
            'id'    => 'engines-shop-info-two',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Up Sell Products', 'engines' ),
            'desc'  => esc_html__( 'Please choose up sell products setting', 'engines' ),
        ),
        
        array(
            'id'=>'engines-product-sell',
            'type' => 'switch',
            'title' => esc_html__('Up Sell Products', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'        => 'engines-product-sell-column',
            'type'      => 'slider',
            'title'     => esc_html__('Up Sell Products column', 'engines'),
            'subtitle'  => esc_html__('Choose Up Sell Products Column.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 4, step: 1, default value: 4', 'engines'),
            "default"   => 4,
            "min"       => 1,
            "step"      => 1,
            "max"       => 4,
            'display_value' => 'label',
            
        ),
        
        array(
            'id'        => 'engines-product-sell-limit',
            'type'      => 'slider',
            'title'     => esc_html__('Up Sell Products', 'engines'),
            'subtitle'  => esc_html__('Choose Up Sell Products.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 40, step: 4, default value: 16', 'engines'),
            "default"   => 8,
            "min"       => 1,
            "step"      => 1,
            "max"       => 40,
            'display_value' => 'label'
        ),
        
        array(
            'id'    => 'engines-shop-info-three',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Cross Sell Products', 'engines' ),
            'desc'  => esc_html__( 'Please choose cross sell products setting', 'engines' ),
        ),
        
        array(
            'id'=>'engines-product-cross',
            'type' => 'switch',
            'title' => esc_html__('Cross Sell Products', 'engines'),
            'default' => true,
            'on' => esc_html__('Yes', 'engines'),
            'off' => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'        => 'engines-product-cross-column',
            'type'      => 'slider',
            'title'     => esc_html__('Cross Products column', 'engines'),
            'subtitle'  => esc_html__('Choose Cross Products Column.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 4, step: 1, default value: 4', 'engines'),
            "default"   => 4,
            "min"       => 1,
            "step"      => 1,
            "max"       => 4,
            'display_value' => 'label',
            
        ),
        
        array(
            'id'        => 'engines-product-cross-limit',
            'type'      => 'slider',
            'title'     => esc_html__('Cross Sell Products', 'engines'),
            'subtitle'  => esc_html__('Choose Cross Sell Products.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 40, step: 4, default value: 16', 'engines'),
            "default"   => 8,
            "min"       => 1,
            "step"      => 1,
            "max"       => 40,
            'display_value' => 'label'
        )
		
	)
);
	
?>