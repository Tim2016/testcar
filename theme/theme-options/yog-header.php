<?php
/*
 * Header Section
*/
if (!function_exists('yog_header_types')):
    function yog_header_types() {
        return array(
            // 'v1' => array('alt' => esc_html__('Header Type 1', 'engines'), 'img' => yog()->load_assets( 'img/header/header-v1.png' ) ), 
            // 'v2' => array('alt' => esc_html__('Header Type 2', 'engines'), 'img' => yog()->load_assets( 'img/header/header-v2.png' ) ),
            // 'v3' => array('alt' => esc_html__('Header Type 3', 'engines'), 'img' => yog()->load_assets( 'img/header/header-v3.png' ) ),
            // 'v4' => array('alt' => esc_html__('Header Type 4', 'engines'), 'img' => yog()->load_assets( 'img/header/header-v4.png' ) ),
            // 'v5' => array('alt' => esc_html__('Header Type 4', 'engines'), 'img' => yog()->load_assets( 'img/header/header-v5.png' ) ),        
        );
    }
endif;

$this->sections[] = array(
	'title'  => esc_html__('Header', 'engines'),
	'icon'   => 'el-icon-photo',
	'fields' => array(

		array(
            'id'         => 'engines-header-type',
            'type'       => 'image_select',
            'full_width' => true,
            'title'      => esc_html__('Header Type', 'engines'),
            'options'    => yog_header_types(),
            'default'    => 'v1'
        ), 
                   
        array(
            'id'       => 'opt-top-info',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => esc_html__( 'Header Top Bar Setting', 'engines' ),
            'desc'     => esc_html__( 'Please insert header top bar settings using options ( Top Bar Enable / Disable, Address, Phone Number, Search Form ).', 'engines' ),
        ),   
                 
        array(
            'id'       => 'engines-header-top',
            'type'     => 'switch',
            'title'    => esc_html__('Show Top Bar', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
        ),  
                  
        array(
            'id'       => "engines-header-address",
            'type'     => 'textarea',
            'default'  => esc_html__( '007 Edgar Buildings,<br>George Street, CA 03, USA', 'engines' ),
            'title'    => esc_html__('Address', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v1', 'v5'),
                array('engines-header-top','equals',true)
            )
        ), 
        
        array(
            'id'       => "engines-header-schedule",
            'type'     => 'textarea',
            'default'  => esc_html__( 'Mon - Sat 9.00 - 20.00,<br>Sunday CLOSED', 'engines' ),
            'title'    => esc_html__('Schedule', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v1', 'v5'),
                array('engines-header-top','equals',true)
            )
        ),
        
        array(
            'id'       => "engines-header-email",
            'type'     => 'text',
            'default'  => esc_html__( 'support@steelthemes.com', 'engines' ),
            'title'    => esc_html__('Email', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v3'),
                array('engines-header-top','equals',true)
            )
        ),  
        
        array(
            'id'       => "engines-header-email-v4",
            'type'     => 'text',
            'default'  => esc_html__( 'support@steelthemes.com', 'engines' ),
            'title'    => esc_html__('Email', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v4'),
                array('engines-header-top','equals',true)
            )
        ),   
         
        array(
            'id'       => "engines-header-number-v1",
            'type'     => 'text',
            'default'  => esc_html__( '+1 888 122 9000<br>Call us for enquiry', 'engines' ),
            'title'    => esc_html__('Phone Number', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v1', 'v5'),
                array('engines-header-top','equals',true)
            )
        ),  
        
        array(
            'id'       => "engines-header-number-v3",
            'type'     => 'text',
            'default'  => esc_html__( '+321 586 856 6147', 'engines' ),
            'title'    => esc_html__('Phone Number', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v3'),
                array('engines-header-top','equals',true)
            )
        ), 
        
        array(
            'id'       => "engines-header-number-v4",
            'type'     => 'text',
            'default'  => esc_html__( '+321 586 856 6147', 'engines' ),
            'title'    => esc_html__('Phone Number', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v4'),
                array('engines-header-top','equals',true)
            )
        ),  
        
        array(
            'id'       => "engines-header-tags-v2",
            'type'     => 'editor',
            'title'    => esc_html__('Tag Line', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-top','equals',true)
            )
        ),  
        
        array(
            'id'       => "engines-header-tags-v3",
            'type'     => 'editor',
            'title'    => esc_html__('Tag Line', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v3'),
                array('engines-header-top','equals',true)
            )
        ),   
             
        array(
            'id'       => 'engines-header-search',
            'type'     => 'switch',
            'title'    => esc_html__('Show Search Form', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v1', 'v5'),
                array('engines-header-top','equals',true),
            )
        ),    
               
        array(
            'id'       => "engines-header-search-placeholder",
            'type'     => 'text',
            'default'  => esc_html__( 'Search on this site..', 'engines' ),
            'title'    => esc_html__('Search Placeholder Text', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v1', 'v5'),
                array('engines-header-top','equals',true),
                array('engines-header-search','equals',true)
            )
        ), 
        
        array(
            'id'       => 'engines-header-user',
            'type'     => 'switch',
            'title'    => esc_html__('User Sign Up Links', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-top','equals',true),
            )
        ),
        
        array(
            'id'       => 'opt-user-sign-in-info',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => esc_html__( 'User Sign In Title Setting', 'engines' ),
            'desc'     => esc_html__( 'Please insert user ( Sign In and Register ) links title.', 'engines' ),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-user','equals',true),
            )
        ),  
        
        array(
            'id'       => "engines-header-sign-in",
            'type'     => 'text',
            'default'  => esc_html__( 'Sign in', 'engines' ),
            'title'    => esc_html__('Sign In', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-user','equals',true),
            )
        ),
        
        array(
            'id'      => "engines-header-register",
            'type'    => 'text',
            'default' => esc_html__( 'Register', 'engines' ),
            'title'   => esc_html__('Register', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-user','equals',true),
            )
        ),  
        
        array(
            'id'       => 'opt-user-sign-out-info',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => esc_html__( 'User Sign In Title Setting', 'engines' ),
            'desc'     => esc_html__( 'Please insert user ( Sign In and Register ) links title.', 'engines' ),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-user','equals',true),
            )
        ),  
        
        array(
            'id'       => "engines-header-sign-out",
            'type'     => 'text',
            'default'  => esc_html__( 'Sign out', 'engines' ),
            'title'    => esc_html__('Sign Out', 'engines'),
            'required' => array(
                array('engines-header-type','equals','v2'),
                array('engines-header-user','equals',true),
            )
        ), 
               
        array(
            'id'       => 'opt-menu-info',
            'type'     => 'info',
            'style'    => 'info',
            'title'    => esc_html__( 'Header Menu Bar Setting', 'engines' ),
            'desc'     => esc_html__( 'Please insert header menu bar settings using options ( Cart Icon Enable / Disable, Reservation Button ).', 'engines' ),
        ), 
                   
        array(
            'id'       => 'engines-header-menu-cart',
            'type'     => 'switch',
            'title'    => esc_html__('Show Cart Icon', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
            'required' => array('engines-header-type','!=','v3'),
        ),
        
        array(
            'id'       => "engines-header-btn-txt",
            'type'     => 'text',
            'default'  => esc_html__( 'Find a Car', 'engines' ),
            'title'    => esc_html__('Button Text', 'engines'),
            'required' => array('engines-header-type','equals','v3'),
        ),
        
        array(
            'id'       => "engines-header-btn-link",
            'type'     => 'text',
            'title'    => esc_html__('Button Link', 'engines'),
            'required' => array('engines-header-type','equals','v3'),
        ),
        
        array(
            'id'       => "engines-header-social-links",
            'type'     => 'switch',
            'title'    => esc_html__('Social Link', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
        ),
        
        array(
            'id'       => 'engines-header-search-v4',
            'type'     => 'switch',
            'title'    => esc_html__('Show Search Form', 'engines'),
            'default'  => true,
            'on'       => esc_html__('Yes', 'engines'),
            'off'      => esc_html__('No', 'engines'),
            'required' => array(
                array('engines-header-type','!=','v1'),
                array('engines-header-type','!=','v5'),
                array('engines-header-type','!=','v3'),
            )
        ),    
               
        array(
            'id'       => "engines-header-search-placeholder-v4",
            'type'     => 'text',
            'default'  => esc_html__( 'Search on this site..', 'engines' ),
            'title'    => esc_html__('Search Placeholder Text', 'engines'),
            'required' => array(
                array('engines-header-type','!=','v1'),
                array('engines-header-type','!=','v5'),
                array('engines-header-type','!=','v3'),
                array('engines-header-search-v4','equals',true)
            )
        ) 
	)
);
