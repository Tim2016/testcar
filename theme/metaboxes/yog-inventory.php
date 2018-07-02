<?php
/*
 * Inventory Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/
// get posts
$yog_args = array(
    'post_type'      => 'bucket',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'asc'
);

$yog_buckets = array('Choose Buckets');
$yog_posts = get_posts( $yog_args );
if ( !empty( $yog_posts ) ) {
    foreach ( $yog_posts as $yog_item ) {
        $yog_buckets[$yog_item->ID] = $yog_item->post_title;
    }
}

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Main Options', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
        array(
			'id'       => 'inv_condition',
			'type'     => 'select',
			'title'    => esc_html__( 'Condition', 'engines' ),
            'options'  => array(
                'new'  => esc_html__( 'New Car', 'engines' ),
                'old'  => esc_html__( 'Used Car', 'engines' ),
            )
		),
        
        array(
			'id'       => 'inv_sale_price',
			'type'     => 'text',
			'title'    => esc_html__( 'Sale Price', 'engines' )
		),
        
        array(
			'id'       => 'inv_price',
			'type'     => 'text',
			'title'    => esc_html__( 'Price', 'engines' )
		),
        
        array(
			'id'       => 'inv_stock_number',
			'type'     => 'text',
			'title'    => esc_html__( 'Stock Number', 'engines' )
		),
        
        array(
			'id'       => 'inv_vin',
			'type'     => 'text',
			'title'    => esc_html__( 'Vin', 'engines' )
		),
        
        array(
			'id'       => 'inv_profile_book',
			'type'     => 'media',
            'mode'     => 'pdf',
			'title'    => esc_html__( 'Profile Book (.pdf)', 'engines' )
		),
        
        array(
			'id'       => 'inv_manual_book',
			'type'     => 'media',
            'mode'     => 'pdf', 
			'title'    => esc_html__( 'Manual Book (.pdf)', 'engines' )
		),
        
        array(
			'id'       => 'inv_kilometres_mpg',
			'type'     => 'text',
			'title'    => esc_html__( 'Kilometres', 'engines' )
		),
        
        array(
			'id'       => 'inv_mileage',
			'type'     => 'text',
			'title'    => esc_html__( 'Mileage', 'engines' )
		),
        
        array(
			'id'       => 'inv_hoursepower',
			'type'     => 'text',
			'title'    => esc_html__( 'Hoursepower', 'engines' )
		)
    )
);

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Logo & Video', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
        array(
			'id'       => 'inv_logo_primary',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo One', 'engines' ),
            'desc'     => esc_html__( 'Upload primary logo of car', 'engines' )
		),
        
        array(
			'id'       => 'inv_logo_primary_link',
			'type'     => 'text',
			'title'    => esc_html__( 'Link', 'engines' ),
            'desc'     => esc_html__( 'Insert primary logo link', 'engines' )
		),
        
        array(
			'id'       => 'inv_logo_sec',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Two', 'engines' ),
            'desc'     => esc_html__( 'Upload secondary logo of car', 'engines' )
		),
        
        array(
			'id'       => 'inv_logo_sec_link',
			'type'     => 'text',
			'title'    => esc_html__( 'Link', 'engines' ),
            'desc'     => esc_html__( 'Upload secondary logo of car', 'engines' )
		),
        
        array(
			'id'       => 'inv_video_link',
			'type'     => 'text',
			'title'    => esc_html__( 'Video Link', 'engines' ),
            'desc'     => esc_html__( 'Insert hosted video link ( Vimeo, youtube )', 'engines' )
		)
    )
);

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Technical Details', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
        array(
			'id'       => 'inv_technical_lists',
			'type'     => 'select',
			'title'    => esc_html__( 'Details Bucket', 'engines' ),
            'options'  => $yog_buckets
	    )
    )
);

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Extra Features', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
       array(
			'id'       => 'inv_extra_features',
			'type'     => 'textarea',
			'title'    => esc_html__('Extra Features', 'engines'),
            'subtitle' => esc_html__( 'Separate features with commas, ex: Auxiliary Heating,Bluetooth,CD Player,Central Locking', 'engines' )
        )	
    )
);

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Images Gallery', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
       array(
			'id'       => 'inv_image_gallery',
			'type'     => 'gallery',
			'title'    => esc_html__('Add/Edit Gallery', 'engines'),
            'subtitle' => esc_html__( 'Create a new gallery by selecting existing or uploading new images using the WordPress native uploader', 'engines' )
        )	
    )
);

$sections[] = array(
	'post_types' => array( 'inventory' ),
	'title'      => esc_html__('Special Offers', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(
    
       array(
			'id'       => 'inv_offer_lists',
			'type'     => 'select',
			'title'    => esc_html__( 'Offers List Bucket', 'engines' ),
            'options'  => $yog_buckets
	   ),
       
       array(
			'id'       => 'inv_image_banner',
			'type'     => 'media',
			'title'    => esc_html__('Media w/ URL', 'engines'),
            'subtitle' => esc_html__( 'Upload any image for banner using the WordPress native uploader', 'engines' )
       ),
       
       array(
			'id'       => 'inv_image_banner_url',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Link', 'engines' )
	   )
    )
);