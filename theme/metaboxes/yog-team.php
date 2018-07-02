<?php
/*
 * Team Section
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
	'post_types' => array( 'team' ),
	'title'      => esc_html__('Team Meta', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(

		array(
            'id'    => "team-member-email",
            'type'  => 'text',
            'title' => esc_html__('Email', 'engines'),
        ),   
         
        array(
            'id'     => "team-member-number",
            'type'   => 'text',
            'title'  => esc_html__('Phone Number', 'engines'),
        )
        
	) // #fields
);

$sections[] = array(
	'post_types' => array( 'team' ),
	'title'      => esc_html__('Team Social Icons', 'engines'),
	'icon'       => 'el-icon-cog',
	'fields'     => array(
    
        array(
			'id'           => 'page-social-identities',
			'type'         => 'repeater',
			'group_values' => true,
			'title'        => esc_html__('Social identities', 'engines'),
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
