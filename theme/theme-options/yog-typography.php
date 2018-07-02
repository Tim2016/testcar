<?php
/*
 * Typography Section
*/

$this->sections[] = array(
	'title'  => esc_html__('Typography', 'engines'),
	'icon'   => 'el-icon-fontsize'
);

// Body
$this->sections[] = array(
	'title'      => esc_html__('Body Typography', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'             => 'body_typography',
			'title'          => esc_html__( 'Body Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all body text.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'PT Sans',
				'font-size'      => '13px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#747474',
			)
		)
	)
);


// Headers
$this->sections[] = array(
	'title'  => esc_html__('Headers Typography', 'engines'),
	'subsection' => true,
	'fields' => array(

		'h1_typography'      => array(
			'id'             => 'h1_typography',
			'title'          => esc_html__( 'H1 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H1 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '34px',
				'font-weight'    => '400',
				'line-height'    => '1.4',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		),

		'h2_typography'      => array(
			'id'             => 'h2_typography',
			'title'          => esc_html__( 'H2 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H2 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '18px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		),

		'h3_typography'      => array(
			'id'             => 'h3_typography',
			'title'          => esc_html__( 'H3 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H3 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '16px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		),

		'h4_typography'      => array(
			'id'             => 'h4_typography',
			'title'          => esc_html__( 'H4 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H4 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '13px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		),

		'h5_typography'      => array(
			'id'             => 'h5_typography',
			'title'          => esc_html__( 'H5 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H5 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '12px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		),

		'h6_typography'      => array(
			'id'             => 'h6_typography',
			'title'          => esc_html__( 'H6 Headers Typography', 'engines' ),
			'subtitle'       => esc_html__( 'These settings control the typography for all H6 Headers.', 'engines' ),
			'type'           => 'typography',
			'letter-spacing' => true,
			'text-align'     => false,
			'compiler'       => true,
			'units'          => '%',
			'default'        => array(
				'font-family'    => 'Antic Slab',
				'font-size'      => '11px',
				'font-weight'    => '400',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#333333'
			)
		)
	)
);