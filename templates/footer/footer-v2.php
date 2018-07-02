<?php 
/**
 * The template for displaying the footer version two
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
?>

<div <?php yog_helper()->attr( 'footer', array( 'class' => 'section' ) ); ?>>
    <div class="container posico hidden-xs">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 text-left">
               <?php
                    //Get Social Icons
                    $yog_social_links = yog_helper()->get_option( 'page-social-identities', 'raw', false, 'options' );
                    
                    //Check & Print
                    if( yog_helper()->get_option( 'engines-footer-social', 'raw', false, 'options' ) && $yog_social_links ):
                        $yog_link = array(); $yog_counter = 0;
                        foreach( $yog_social_links['url'] as $yog_social_link ){
                            $yog_link[] = $yog_social_link;
                        }
                        echo '<ul class="social-icons list-inline">';
                        foreach( $yog_social_links['network'] as $yog_social_icon ){
                            echo '<li class="social-header"><a href="'. esc_url( $yog_link[$yog_counter] ) .'"><i class="fa '. esc_attr( $yog_social_icon ) .'"></i></a></li>';
                            $yog_counter++;
                        }
                        echo '</ul>';
                    endif;
                ?>   
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                <?php 
                    //Theme Logo.
                    if( $yog_logo = yog_helper()->get_option( 'engines-footer-logo', 'raw', false, 'options' ) ){
                        echo '<a href="'. esc_url( home_url( '/' ) ). '" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" ><img src="'. esc_url( $yog_logo['url'] ) .'" class="img-responsive" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'"/></a>';
                    }
                ?>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 text-right">
                <?php 
                    if( yog_helper()->get_option( 'engines-footer-menu', 'raw', false, 'options'  ) && has_nav_menu('footer') ){
                        $yog_args = array(
                            'theme_location' => 'footer',
                            'container'   => false,
                            'menu_class' => 'list-inline',
                            'depth' => 1,
                            'walker' => new Engines_Walker_Nav_Menu
                        );
                        wp_nav_menu( $yog_args );
                    }
                ?>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
    <?php if( is_active_sidebar( 'footer-7' ) || is_active_sidebar( 'footer-8' ) ): //Check Active Sidebar.?>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <?php 
                        if( is_active_sidebar( 'footer-7' ) ){
                            dynamic_sidebar( 'footer-7' );
                        }
                    ?>
                </div><!-- end col -->
    
                <div class="col-md-4 col-sm-12">
                    <?php 
                        if( is_active_sidebar( 'footer-8' ) ){
                            dynamic_sidebar( 'footer-8' );
                        }
                    ?>
                </div><!-- end col -->
            </div>
        </div><!-- end container -->
    <?php endif; ?>
</div><!-- end footer -->
<?php if( yog_helper()->get_option( 'engines-footer-copyright', 'raw', false, 'options' ) ): ?>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                    <p><?php echo yog_helper()->get_option( 'engines-footer-copyright', 'raw', false, 'options' ); ?></p>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end copyrights -->
<?php endif; ?>