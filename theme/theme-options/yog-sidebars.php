<?php
/*
 * Sidebar Section
*/
$this->sections[] = array(
	'title'  => esc_html__('Sidebars', 'engines'),
	'icon'   => 'el-icon-photo'
);

// Page Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Page', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'page-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Pages', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the same sidebar on all pages. This option overrides by the page options.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'page-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global Page Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on all pages.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('page-enable-global','equals',true),
		),

		array(
 			'id'        => 'page-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global Page Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for all pages.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('page-sidebar','not','' ),
		)
	)
);

// Blog Posts Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Blog Posts', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'blog-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Blog Posts', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebar on all blog posts.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'blog-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global Blog Posts Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on all blog posts.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('blog-enable-global','equals',true),
		),

		array(
 			'id'        => 'blog-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global Blog Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for all blog posts.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('blog-sidebar','not','' ),
		)
	)
);

// Blog Single Post Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Blog Single Post', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'blog-single-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Single Blog Post', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on single blog post.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'blog-single-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global Single Blog Post Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on single blog post.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('blog-single-enable-global','equals',true),
		),

		array(
 			'id'        => 'blog-single-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global Blog Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for single blog post.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('blog-single-sidebar','not',''),
		)
	)
);

// Blog Archive Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Blog Archive', 'engines'),
	'subsection' => true,
	'fields'     => array(
        array(
			'id'        => 'blog-archive-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Archive Posts', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on all blog posts render on archive.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),
        
		array(
 			'id'        => 'blog-archive-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Blog Archive Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on the blog archive page.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('blog-archive-enable-global','equals',true),
		),
        
        array(
 			'id'        =>'blog-archive-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Archive Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for the archive results page.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('blog-archive-sidebar','not',''),
		)
	)
);

// Search page Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Search Page', 'engines'),
	'subsection' => true,
	'fields'     => array(
        array(
			'id'        => 'blog-search-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Search Page', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on all blog posts render on search page.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),
        
		array(
 			'id'        => 'search-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Search Page Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on the search results page.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('blog-search-enable-global','equals',true),
		),

		array(
 			'id'        => 'search-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Search Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for the search results page.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('search-sidebar','not',''),
		)
	)
);

// Inventory Posts Sidebar
$this->sections[] = array(
	'title'      => esc_html__('Inventory Archive Posts', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'inventory-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For Inventory Archive Posts', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on all inventory posts render on its archive page.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'inventory-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global Inventory Archive Posts Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on all inventory archive posts.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('inventory-enable-global','equals',true),
		),

		array(
 			'id'        => 'inventory-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global Inventory Archive Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for all inventory archive posts.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('inventory-sidebar','not',''),
		)
	)
);

// Shop Sidebar
$this->sections[] = array(
	'title'      => esc_html__('WooCommerce Shop', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'shop-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For WooCommerce Shop Page', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on WooCommerce shop page.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'shop-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global WooCommerce Shop Page Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on all WooCommerce shop page.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('shop-enable-global','equals',true),
		),

		array(
 			'id'        => 'shop-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global WooCommerce Page Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for WooCommerce shop page.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('shop-sidebar','not',''),
		)
	)
);

// Product Single Sidebar
$this->sections[] = array(
	'title'      => esc_html__('WooCommerce Single Product', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'        => 'product-enable-global',
			'type'	    => 'switch',
			'title'     => esc_html__('Activate Global Sidebar For WooCommerce Single Product', 'engines'),
			'subtitle'  => esc_html__('Turn on if you want to use the sidebars on WooCommerce single product.', 'engines'),
			'default'   => true,
            'on'        => esc_html__('Yes', 'engines'),
            'off'       => esc_html__('No', 'engines'),
		),

		array(
 			'id'        => 'product-sidebar',
 			'type'      => 'select',
 			'title'     => esc_html__('Global WooCommerce Single Product Sidebar', 'engines'),
 			'subtitle'  => esc_html__('Select sidebar that will display on all WooCommerce single product.', 'engines'),
			'data'      => 'sidebars',
            'default'   => 'primary',
            'required'  => array('product-enable-global','equals',true),
		),

		array(
 			'id'        => 'product-sidebar-position',
 			'type'      => 'button_set',
 			'title'     => esc_html__('Global WooCommerce Single Product Sidebar Position', 'engines'),
 			'subtitle'  => esc_html__('Controls the position of sidebar for WooCommerce single product.', 'engines'),
			'options'   => array(
				'left'  => esc_html__( 'Left', 'engines' ),
				'right' => esc_html__( 'Right', 'engines' )
			),
			'default'   => 'right',
            'required'  => array('product-sidebar','not',''),
		)
	)
);


