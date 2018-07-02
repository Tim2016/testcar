<?php
/*
 * Page Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array( 'page' ),
	'title'      => esc_html__('Page', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(

		array(
			'id'       => 'page-enable-breadcrumb',
			'type'	   => 'switch',
			'title'    => esc_html__('Disable Breadcrumb', 'engines'),
			'subtitle' => esc_html__('Choose to show or hide the breadcrumb.', 'engines'),
		),
        
        array(
 			'id'       => 'page-skin',
 			'type'     => 'select',
 			'title'    => esc_html__('Page Skin', 'engines'),
 			'subtitle' => esc_html__('Select which color skin displays on this page, this skin override the default theme options skin.', 'engines'),
 			'options'  => array(
                ''      => esc_html__( 'Default Skin', 'engines' ),
                'home1' => esc_html__( 'Skin One', 'engines' ),
                'home2' => esc_html__( 'Skin Two', 'engines' ),   
                'home3' => esc_html__( 'Skin Three', 'engines' ),                                
            )
		),
		
        array(
 			'id'       => 'page_layout',
 			'type'     => 'select',
 			'title'    => esc_html__('Page Layout', 'engines'),
 			'subtitle' => esc_html__('Select which layout displays on this page.', 'engines'),
 			'options'  => array(
                'default' => esc_html__( 'Default', 'engines' ),
                'page'    => esc_html__( 'Full Width', 'engines' ),
                'sidebar' => esc_html__( 'Sidebar', 'engines' )                                   
            )
		),
        
        array(
 			'id'       => 'page-sidebar',
 			'type'     => 'select',
 			'title'    => esc_html__('Select Sidebar', 'engines'),
 			'subtitle' => esc_html__('Select sidebar that will display on this page. Choose "No Sidebar" for full width.', 'engines'),
			'data'     => 'sidebars',
            'required' => array('page_layout','equals','sidebar'),
		),

		array(
 			'id'       =>'page-sidebar-position',
 			'type'     => 'button_set',
 			'title'    => esc_html__('Sidebar Position', 'engines'),
 			'subtitle' => esc_html__('Select the sidebar position. ', 'engines'),
			'options'  => array(
				''      => esc_html__( 'Default', 'engines' ),
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
            'required'  => array('page-sidebar','not','' ),
		)
	)
);
$sections[] = array(
	'post_types' => array( 'page' ),
	'title'      => esc_html__('Header', 'engines'),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

        array(
			'id'       => 'header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Page Logo', 'engines'),
			'subtitle' => esc_html__('Select an image file for your logo that will override theme options logo.', 'engines'),
		),
        
        array(
            'id'         => 'header-template',
            'type'       => 'image_select',
            'full_width' => true,
            'title'      => esc_html__('Header Type', 'engines'),
            'subtitle'   => esc_html__('Select which header display on this page, this header override the default header.', 'engines'),
            'options'    => yog_header_types()
        ), 
        
		array(
			'id'         => 'header-primary-menu',
			'type'       => 'select',
			'title'      => esc_html__( 'Main Navigation Menu', 'engines' ),
			'subtitle'   => esc_html__( 'Select which menu display on this page, this menu override the header menu set at primary location.', 'engines' ),
			'data'       => 'menus',
			'default'    => ''
		)
	)
);

$sections[] = array(
	'post_types' => array( 'page' ),
	'title'      => esc_html__('Footer', 'engines'),
	'icon'       => 'el-icon-cog',
	'fields'     => array(

		array(
 			'id'       => 'footer-template',
 			'type'     => 'select',
 			'title'    => esc_html__('Footer Template', 'engines'),
 			'subtitle' => esc_html__('Select which footer display on this page, this footer override the theme options footer style.', 'engines'),
 			'options'  => array(
                'v1'   => esc_html__( 'One', 'engines' ),
                'v2'   => esc_html__( 'Two', 'engines' ),                                     
            )
		)
	) 
);


if ( class_exists( 'RevSlider' ) ) {
    $yog_slider     = new RevSlider();
    $yog_arrSliders = $yog_slider->getArrSlidersShort();
    $sections[] = array(
    	'post_types' => array( 'page' ),
    	'title'      => esc_html__('Revolution Slider', 'engines'),
    	'icon'       => 'el-icon-adjust-alt',
    	'fields'     => array(

    		array(
     			'id'       =>'rev_slider',
     			'type'     => 'select',
     			'title'    => esc_html__('Revolution Slider', 'engines'),
     			'subtitle' => esc_html__('Select a slider for site page.', 'engines'),
     			'options'  => $yog_arrSliders
    		)
        )  
	);
}