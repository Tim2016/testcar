<?php
/*
 * Custom Code
*/

$this->sections[] = array(
	'title'  => esc_html__( 'Custom CSS', 'engines' ),
	'icon'   => 'el-icon-css',
	'fields' => array(

		array(
		    'id'       => 'custom_css',
		    'type'     => 'ace_editor',
		    'title'    => esc_html__( 'CSS Code', 'engines'),
		    'subtitle' => esc_html__( 'Enter your CSS code in the field below. Do not include any tags or HTML in the field. Custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed. Don\'t URL encode image or svg paths. Contents of this field will be auto encoded.', 'engines' ),
		    'mode'     => 'css',
			'theme'    => 'chrome',
			'options'  => array( 'minLines' => 40, 'maxLines' => 60 )
		)
	)
);
