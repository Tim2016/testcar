<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Footer', 'engines'),
	'icon'   => 'el-icon-photo',
	'fields' => array(

		array(
            'id'       => 'engines-footer-type',
            'type'     => 'select',
            'title'    => esc_html__('Footer Type', 'engines'),
            'options'  => array(
                'v1'   => esc_html__( 'Style One', 'engines' ),
                'v2'   => esc_html__( 'Style Two', 'engines' ),
            ),
            'default'  => 'v1'
        ), 
         
        array(
            'id'       => 'engines-footer-social',
            'type'     => 'switch',
            'title'    => esc_html__('Footer Social', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
            'required' => array('engines-footer-type','equals','v2')
        ),
        
        array(
            'id'       => 'engines-footer-menu',
            'type'     => 'switch',
            'title'    => esc_html__('Footer Menu', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines')
        ),  
                                    
        array(
            'id'       => "engines-footer-copyright",
            'type'     => 'editor',
            'title'    => esc_html__('Copyright', 'engines'),
            'default'  => esc_html__('Copyright Steelthemes 2017. All Rights Reserved', 'engines')
        )
	)
);
