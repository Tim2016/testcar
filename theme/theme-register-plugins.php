<?php
/**
 * Themeyog Theme Framework
 * Include the TGM_Plugin_Activation class and register the required plugins.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 */

yog()->load_library( 'class-tgm-plugin-activation' );

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', 'yog_register_required_plugins' );
function yog_register_required_plugins() {

	$yog_assets = 'http://yogthemes.com/plugin/';
	$yog_images = get_template_directory_uri() . '/theme/plugins/images';

	$yog_plugins = array(
    
        array(
            'name'            => esc_html__( 'Engines Core Addons', 'engines' ),
            'required'        => true,
            'slug'            => 'yog-addons',
            'source'          => 'engines/yog-addons.zip',
            'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__(  'YOGThemes', 'engines' ),
			'yog_description' => esc_html__( 'A part of Engines Theme.', 'engines' )
        ),
        
        array(
			'name' 		      => esc_html__( 'WPBakery Visual Composer', 'engines' ),
			'slug' 		      => 'js_composer',
			'required' 	      => true,
            'source'          => 'general/js_composer.zip',
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'Michael M - WPBakery.com', 'engines' ),
			'yog_description' => esc_html__( 'Drag and drop page builder for WordPress.', 'engines' )
		),
        
		array(
			'name' 		      => esc_html__( 'Redux Framework', 'engines' ),
			'slug' 		      => 'redux-framework',
			'required' 	      => true,
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'Team Redux','engines' ),
			'yog_description' => esc_html__( 'Redux truly extensible options framework.', 'engines' )
		),
        
        array(
			'name' 		      => esc_html__( 'Woocommerce', 'engines' ),
			'slug' 		      => 'woocommerce',
			'required' 	      => true,
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'WooThemes','engines' ),
			'yog_description' => esc_html__( 'An e-commerce toolkit that helps you sell anything. Beautifully.','engines' )
		),
        
        array(
			'name' 		      => esc_html__( 'Revolution Slider', 'engines' ),
			'slug' 		      => 'revslider',
			'required' 	      => true,
            'source'          => 'general/revslider.zip',
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'ThemePunch', 'engines' ),
			'yog_description' => esc_html__( 'Slider Revolution - Premium responsive slider', 'engines' )
		),
        
        array(
			'name'            => esc_html__( 'Contact Form 7', 'engines' ),
			'slug'            => 'contact-form-7',
			'required'        => false,
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'Takayuki Miyoshi','engines' ),
			'yog_description' => esc_html__( 'Contact Form 7 can manage multiple contact forms, plus you can customize the form and the mail contents.','engines' )
		),
        
        array(
			'name' 		      => esc_html__( 'MailChimp', 'engines' ),
			'slug' 		      => 'mailchimp-for-wp',
			'required' 	      => false,
			'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'Ibericode','engines' ),
			'yog_description' => esc_html__( 'MailChimp for WordPress by ibericode. Adds various highly effective sign-up methods to your site.','engines' )
		),
        
        array(
            'name'            => esc_html__( 'Breadcrumb NavXT','engines' ),
            'slug'            => 'breadcrumb-navxt',
            'required'        => false,
            'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'John Havlik','engines' ),
			'yog_description' => esc_html__( 'Adds a breadcrumb navigation showing the visitor&#39;s path to their current location.','engines' )
        ),
        
        array(
            'name'            => esc_html__( 'Widget Importer & Exporter','engines' ),
            'slug'            => 'widget-importer-exporter',
            'required'        => false,
            'yog_logo'        => $yog_images . '/extension-placeholder.jpg',
			'yog_author'      => esc_html__( 'churchthemes.com','engines' ),
			'yog_description' => esc_html__( 'Widget Importer & Exporter is useful for moving widgets from one WordPress site to another.','engines' )
        )
	);

	$yog_config = array(
		'id'           => 'engines',
		'default_path' => $yog_assets
	);

	tgmpa( $yog_plugins, $yog_config );
}
