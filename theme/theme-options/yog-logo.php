<?php
/*
 * Logo Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Logo', 'engines'),
	'icon'   => 'el-icon-plus-sign'
);

// Body
$this->sections[] = array(
	'title'      => esc_html__('Logo', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'header-logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Default Logo', 'engines'),
			'subtitle' => esc_html__('Select an image file for your logo.', 'engines'),
		),
        array(
            'id'    => 'engines-footer-logo',
            'type'  => 'media',
            'url'   => true,
            'title' => esc_html__('Logo', 'engines')
        )
	)
);

// Headers
$this->sections[] = array(
	'title'       => esc_html__('Favicon', 'engines'),
	'subsection'  => true,
	'fields'      => array(

		array(
			'id'          => 'favicon',
			'type'        => 'media',
			'title'       => esc_html__( 'Favicon', 'engines' ),
			'subtitle'    => esc_html__( 'Favicon for your website at 16px x 16px.', 'engines' )
		),

		array(
			'id'          => 'iphone_icon',
			'type'        => 'media',
			'title'       => esc_html__( 'Apple iPhone Icon Upload', 'engines' ),
			'subtitle'    => esc_html__( 'Favicon for Apple iPhone at 57px x 57px.', 'engines' )
		),

		array(
			'id'          => 'iphone_icon_retina',
			'type'        => 'media',
			'title'       => esc_html__( 'Apple iPhone Retina Icon Upload', 'engines' ),
			'subtitle'    => esc_html__( 'Favicon for Apple iPhone Retina Version at 114px x 114px.', 'engines' ),
		),

		array(
			'id'          => 'ipad_icon',
			'type'        => 'media',
			'title'       => esc_html__( 'Apple iPad Icon Upload', 'engines' ),
			'subtitle'    => esc_html__( 'Favicon for Apple iPad at 72px x 72px.', 'engines' )
		),

		array(
			'id'          => 'ipad_icon_retina',
			'type'        => 'media',
			'title'       => esc_html__( 'Apple iPad Retina Icon Upload', 'engines' ),
			'subtitle'    => esc_html__( 'Favicon for Apple iPad Retina Version at 144px x 144px.', 'engines' ),
		)
	)
);
