<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title'  => esc_html__('General', 'engines'),
	'icon'   => 'el-icon-adjust-alt',
);

// General Setting
$this->sections[] = array(
	'title'      => esc_html__('General Setting', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Custom Sidebars', 'engines' ),
			'subtitle' => esc_html__( 'Custom sidebars can be assigned to any page or post.', 'engines' ),
			'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'engines' )
		),

		array(
			'id'       => 'google-api-key',
			'type'     => 'text',
			'title'    => esc_html__( 'Google map API key', 'engines' ),
			'subtitle' => '',
			'desc'     => esc_html__( 'Add your Google map API key here. You can get Google API key from https://developers.google.com/maps/documentation/javascript/get-api-key', 'engines' )
		),
        
        array(
			'id'           => 'page-social-identities',
			'type'         => 'repeater',
			'group_values' => true,
			'title'        => esc_html__('Social Identities', 'engines'),
			'fields'       => array(

				array(
					'id'       => 'network',
					'type'     => 'select',
					'title'    => esc_html__( 'Icon', 'engines' ),
                    'options'  => array(
                        'fa-dribbble'    => esc_html__( 'Dribbble', 'engines' ),
                        'fa-dropbox'     => esc_html__( 'Dropbox', 'engines' ),
                        'fa-envelope'    => esc_html__( 'Envelope', 'engines' ),
                        'fa-facebook'    => esc_html__( 'FaceBook', 'engines' ),
                        'fa-foursquare'  => esc_html__( 'Foursquare', 'engines' ),
                        'fa-github'      => esc_html__( 'Github ', 'engines' ),
                        'fa-google-plus' => esc_html__( 'Google+', 'engines' ),
                        'fa-instagram'   => esc_html__( 'Instagram', 'engines' ),
                        'fa-linkedin'    => esc_html__( 'Linkedin', 'engines' ),
                        'fa-maxcdn'      => esc_html__( 'Maxcdn', 'engines' ),
                        'fa-pinterest'   => esc_html__( 'Pinterest', 'engines' ),
                        'fa-rss'         => esc_html__( 'Rss', 'engines' ),
                        'fa-skype'       => esc_html__( 'Skype', 'engines' ),
                        'fa-tumblr'      => esc_html__( 'Tumblr', 'engines' ),
                        'fa-twitter'     => esc_html__( 'Twitter', 'engines' ),
                        'fa-vk'          => esc_html__( 'Vk', 'engines' ),
                        'fa-youtube'     => esc_html__( 'Youtube', 'engines' ), 
                    )
				),

				array(
					'id'       => 'url',
					'type'     => 'text',
					'title'    => esc_html__( 'Url', 'engines' )
				)
			)
		)
	)
);

// Theme Features
$this->sections[] = array(
	'title'  => esc_html__( 'Theme Features', 'engines' ),
	'subsection' => true,
	'fields' => array(
        
        array(
            'id'    => 'opt-layout-info',
            'type'  => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Site Layout', 'engines' ),
            'desc'  => esc_html__( 'Please insert site layout setting using options ( layout, background ).', 'engines' ),
        ),  
        
		array(
			'id'        => 'page-layout',
			'type'      => 'button_set',
			'title'     => esc_html__('Layout', 'engines'),
			'subtitle'  => esc_html__('Control the site layout.', 'engines'),
			'options'   => array(
				'wide'  => 'Wide',
				'boxed' => 'Boxed',
			),
			'default'   => 'wide'
		),

		array(
			'id'        => 'page-background-type',
			'type'      => 'select',
			'title'     => esc_html__( 'Background Type', 'engines' ),
			'options'   => array(
                'image'    => 'Image',
				'solid'    => 'Solid',
				'gradient' => 'Gradient'
			),
			'required' => array(
				'page-layout',
				'equals',
				'boxed'
			)
		),

		array(
			'id'       => 'page-bar-bg',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__('Background Image', 'engines'),
			'required' => array(
				'page-background-type',
				'equals',
				'image'
			),
		),

		array(
			'id'       => 'page-bar-solid',
			'type'     => 'color',
			'url'      => true,
			'title'    => esc_html__('Background Color', 'engines'),
			'required' => array(
				'page-background-type',
				'equals',
				'solid'
			),
		),

		array(
			'id'       => 'page-bar-gradient',
			'type'     => 'gradient',
			'url'      => true,
			'title'    => esc_html__('Background Gradient', 'engines'),
			'required' => array(
				'page-background-type',
				'equals',
				'gradient'
			),
		),
        
        array(
            'id'     => 'opt-color-info',
            'type'   => 'info',
            'style'  => 'info',
            'title'  => esc_html__( 'Site Style Switcher', 'engines' ),
            'desc'   => esc_html__( 'Please choose style switcher enable / disable setting.', 'engines' ),
        ),
        
        array(
			'id'       => 'page-style-switcher',
			'type'	   => 'switch',
            'default'  => false,
			'title'    => esc_html__('Style Switcher', 'engines'),
			'subtitle' => esc_html__('Controls the site style switcher.', 'engines'),
		),
        
        array(
            'id'     => 'opt-color-info',
            'type'   => 'info',
            'style'  => 'info',
            'title'  => esc_html__( 'Site Color', 'engines' ),
            'desc'   => esc_html__( 'Please choose color if you want to use other then default color.', 'engines' ),
        ),
        
        array(
			'id'    => 'page-color',
			'type'  => 'color',
			'url'   => true,
			'title' => esc_html__('Site Color', 'engines'),
		),
        
        array(
            'id'     => 'opt-breadcrumb-info',
            'type'   => 'info',
            'style'  => 'info',
            'title'  => esc_html__( 'Site Breadcrumb', 'engines' ),
            'desc'   => esc_html__( 'Please choose site breadcrumb setting.', 'engines' ),
        ), 
        
        array(
			'id'       => 'page-enable-breadcrumb',
			'type'	   => 'switch',
            'default'  => false,
			'title'    => esc_html__('Disable Breadcrumb', 'engines'),
			'subtitle' => esc_html__('Choose to show or hide the breadcrumb.', 'engines'),
		),
        
        array(
            'id'     => 'opt-go-info',
            'type'   => 'info',
            'style'  => 'info',
            'title'  => esc_html__( 'Go to top', 'engines' ),
            'desc'   => esc_html__( 'Please choose go to top scrolling button setting.', 'engines' ),
        ),
        
        array(
			'id'       => 'enable-go-top',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Go To Top Button', 'engines' ),
			'subtitle' => esc_html__( 'If on, a button will appear in the right bottom corner the page.', 'engines' ),
			'default'  => 1
		)
	)
);
