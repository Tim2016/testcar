<?php
/*
 * Blog
 */
  // Blog Layout Selecter
 if (!function_exists('yog_blog_layout')):
    function yog_blog_layout() {
        return array(
            'simple' => array('alt' => esc_html__('Default Layout', 'engines'), 'img' => yog()->load_assets( 'img/blog/full-width.png' ) ), 
            'list'   => array('alt' => esc_html__('List Layout', 'engines'),    'img' => yog()->load_assets( 'img/blog/list-style.png' ) ), 
            'grid'   => array('alt' => esc_html__('Grid Layout', 'engines'),    'img' => yog()->load_assets( 'img/blog/masonry-style.png' ) ),
        );
    }
 endif;

 //Blog Columns
 if (!function_exists('yog_blog_columns_types')):
    function yog_blog_columns_types(){
        return array(
            'two'   => array('title' => esc_html__('Two Column', 'engines'), 'alt'   => esc_html__('Two Column', 'engines'), 'img' => yog()->load_assets( 'img/blog/two-column.png' ) ),
            'full'  => array('title' => esc_html__('Full Column', 'engines'), 'alt'  => esc_html__('Full Column', 'engines'), 'img' => yog()->load_assets( 'img/blog/one-column.png' ) ),
            'three' => array('title' => esc_html__('Three Column', 'engines'), 'alt' => esc_html__('Three Column', 'engines'), 'img' => yog()->load_assets( 'img/blog/three-column.png' ) ),
        );
    }
 endif;
 
$this->sections[] = array(
	'title'  => esc_html__('Blog', 'engines'),
	'icon'   => 'el-icon-file-edit'
);

$this->sections[] = array(
	'title'      => esc_html__('General', 'engines'),
	'subsection' => true,
	'fields'     => array(

		array(
            'id'         =>'engines-blog-layout',
            'type'       => 'image_select',
            'full_width' => true,
            'title'      => esc_html__('Blog Type', 'engines'),
            'options'    => yog_blog_layout(),
            'default'    => 'simple',
            'width'      => '120px',
            'height'     => '120px',
        ),
        
        array(
            'id'         =>'engines-blog-columns',
            'type'       => 'image_select',
            'full_width' => true,
            'title'      => esc_html__('Blog Column', 'engines'),
            'options'    => yog_blog_columns_types(),
            'default'    => 'three',
            'width'      => '120px',
            'height'     => '120px',
            'required'   => array('engines-blog-layout','equals','grid')
        )
	)
);

// Blog Single Post
$this->sections[] = array(
	'title'  => esc_html__('Single Post', 'engines'),
	'subsection' => true,
	'fields' => array(
        array(
            'id'      => 'engines-blog-single-layout',
            'type'    => 'select',
            'title'   => esc_html__('Layout', 'engines'),
            'options' => array(
                'one'   => esc_html__( 'Style One', 'engines' ),
                'two'   => esc_html__( 'Style Two', 'engines' ),
            ),'default' => 'one'
        ),
        
        array(
			'id'   => 'info_blog_social',
			'type' => 'info',
			'desc' => esc_html__('Blog Social Share Icons', 'engines')
		),   
        
        array(
			'id'       => 'engines-post-single-socials',
			'type'	   => 'switch',
			'title'    => esc_html__('Social Share', 'engines'),
			'subtitle' => esc_html__( 'Did You Like This Post? Please Share on', 'engines' ),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines')
		),
        
        array(
			'id'       => 'info_blog_nav',
			'type'     => 'info',
			'desc'     => esc_html__('Blog Navigation Link', 'engines')
		),
        
        array(
			'id'       => 'engines-post-single-nav',
			'type'	   => 'switch',
			'title'    => esc_html__('Navigation Link', 'engines'),
			'subtitle' => esc_html__( 'Turn Yes to display the post navigation link', 'engines' ),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines')
		),
        
        array(
			'id'       => 'info_blog_author_keys',
			'type'     => 'info',
			'desc'     => esc_html__('Author Bio Box', 'engines')
		),  
        
        array(
			'id'       => 'engines-author-box',
			'type'	   => 'switch',
			'title'    => esc_html__('Author Info Box', 'engines'),
			'subtitle' => esc_html__('Turn Yes to display the author info box below post.', 'engines'),
			'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines')
		),           
                  
        array(
            'id'       => "engines-author-title",
            'type'     => 'text',
            'default'  => esc_html__( 'About Author', 'engines' ),
            'title'    => esc_html__('Author Box Heading Text', 'engines'),
            'required' => array('engines-author-box','equals',true),
        )
	)
);

// Blog Excerpt Setting   
$this->sections[] = array(
    'title'      => esc_html__('Blog Post Excerpt', 'engines'),
    'subsection' => true,
    'fields'     => array( 
    
        array(
			'id'    => 'info_blog_exc_keys',
			'type'  => 'info',
			'desc'  => esc_html__('Excerpt Settings', 'engines')
		),
        
        array(
            'id'      =>'excerpt-by',
            'type'    => 'select',
            'title'   => esc_html__('Length by', 'engines'),
            'options' => array(
                ''      => '',
                'words' => esc_html__( 'Words', 'engines' ),
                'chars' => esc_html__( 'Character', 'engines' ),
            ),
            'default'   => 'words'
        ),
        
        array(
            'id'        => 'excerpt-length',
            'type'      => 'slider',
            'title'     => esc_html__('Excerpt Length', 'engines'),
            'subtitle'  => esc_html__('Choose Excerpt Length.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 200, step: 1, default value: 120', 'engines'),
            "default"   => 30,
            "min"       => 1,
            "step"      => 1,
            "max"       => 200
        ),
        
        array(
    		'title'    => esc_html__( 'Ellipsis', 'engines' ),
    		'type'     => 'text',
            'id'       => 'excerpt-ellipsis',
            'default'  => esc_html__( '&hellip;', 'engines' ),
    	),
        
        array(
    		'title'    => esc_html__( 'Before Text', 'engines' ),
    		'type'     => 'text',
            'subtitle' => esc_html__('Additional information appear before read more link', 'engines'),
            'id'       => 'excerpt-before',
            'default'  => '<p>',
    	),
        
        array(
    		'title'    => esc_html__( 'After Text', 'engines' ),
    		'type'     => 'text',
            'subtitle' => esc_html__('Additional information appear after read more link', 'engines'),
            'id'       => 'excerpt-after',
            'default'  => '</p>',
    	),
        
        array(
            'title'    => esc_html__('Show Read More', 'engines'),
            'id'       =>'excerpt-readmore',
            'type'     => 'switch',
            'subtitle' => esc_html__('If yes, will be show the Read More Link.', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
        ),
        
        array(
    		'title'    => esc_html__( 'Link Text', 'engines' ),
    		'type'     => 'text',
            'default'  => esc_html__( 'Read More', 'engines' ),
            'id'       => 'excerpt-readmore-txt',
            'subtitle' => esc_html__('Insert text fo ream more link.', 'engines'),
            
    	)
    )
);
