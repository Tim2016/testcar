<?php
/*
 * Page 404
*/
$this->sections[] = array (
	'title'      => esc_html__( '404 Page', 'engines' ),
	'subsection' => true,
	'fields'     => array(
        
        array(
            'id'       => 'page-404-title',
            'type'     => 'text',
            'title'    => esc_html__('Page Title', 'engines'),
            'default'  => esc_html__( '404', 'engines' )
        ),
        
        array(
            'id'       => 'page-404-subtitle',
            'type'     => 'text',
            'title'    => esc_html__('Sub Title', 'engines'),
            'default'  => esc_html__( 'Oops! the page you were looking for, could not be found.', 'engines' )
        ),
        
        array(
            'id'       => 'page-404-body',
            'type'     => 'textarea',
            'title'    => esc_html__('Content', 'engines'),
            'default'  => esc_html__( 'Try the search below to find matching pages:', 'engines' )
        ),

		array(
			'id'       => 'error-404-enable-search',
			'type'	   => 'button_set',
			'title'    => esc_html__('Enable Search', 'engines'),
			'subtitle' => esc_html__('If on, the search module will be displayed.', 'engines'),
			'options'  => array(
				'on'   => 'On',
				'off'  => 'Off'
			),
			'default'  => 'on'
		),

		array(
			'id'       => 'error-404-search-title',
			'type'     => 'text',
			'title'    => esc_html__( 'Search Title', 'engines' ),
			'subtitle' => '',
			'default'  => 'Search..',
			'required' => array(
				'error-404-enable-search',
				'equals',
				'on'
			)
		)
	)
);
