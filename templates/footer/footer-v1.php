<?php 
/**
 * The template for displaying the footer version one
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
 //Check Active Sidebar.
 if( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' )  || is_active_sidebar( 'footer-4' )  ):
?>
<div <?php yog_helper()->attr( 'footer', array( 'class' => 'section' ) ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-1' ) ){
                        dynamic_sidebar( 'footer-1' );
                    }
                ?>
            </div><!-- end col -->

            <div class="col-md-8 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-2' ) ){
                        dynamic_sidebar( 'footer-2' );
                    }
                ?>
            </div><!-- end col -->
        </div><!-- end row -->

        <hr />

        <div class="row">
            <div class="col-md-3 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-3' ) ){
                        dynamic_sidebar( 'footer-3' );
                    }
                ?>
            </div><!-- end col -->

            <div class="col-md-3 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-4' ) ){
                        dynamic_sidebar( 'footer-4' );
                    }
                ?>
            </div><!-- end col -->

            <div class="col-md-3 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-5' ) ){
                        dynamic_sidebar( 'footer-5' );
                    }
                ?>
            </div><!-- end col -->

            <div class="col-md-3 col-sm-12">
                <?php 
                    if( is_active_sidebar( 'footer-6' ) ){
                        dynamic_sidebar( 'footer-6' );
                    }
                ?>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end footer -->
<?php endif; ?>
<div class="copyrights">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12 text-left">
                <p><?php echo yog_helper()->get_option( 'engines-footer-copyright', 'raw', esc_html__( 'Copyright Steelthemes 2017. All Rights Reserved', 'engines' ), 'options' ); ?></p>
            </div><!-- end col -->

            <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                <?php 
                    if( yog_helper()->get_option( 'engines-footer-menu', 'raw', false, 'options' ) && has_nav_menu('footer') ){
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
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end copyrights -->