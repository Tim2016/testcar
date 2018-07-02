<?php if( yog_helper()->get_option(  'engines-header-top', 'raw', false, 'options' ) ): ?>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 box-leasing">
                    <a href="#">
                        <img src="http://hyip-info.ru/wp-content/themes/engines/img/kamazleasing.png" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <div class="logo-wrapper clearfix">
                        <?php 
                            //Logo.
                            $yog_logo = ( $yog_page_logo = yog_helper()->get_option(  'header-logo', 'raw', false, 'post' ) )? $yog_page_logo : yog_helper()->get_option(  'header-logo', 'raw', false );
                            //Theme Logo.
                            if( isset( $yog_logo['url'] ) && !empty( $yog_logo['url'] ) ){
                                echo '<a class="navbar-brand" href="'. esc_url( home_url( '/' ) ). '" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" ><img src="'. esc_url( $yog_logo['url'] ) .'" class="img-responsive" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'"/></a>';
                            }else{
                                echo '<a class="navbar-brand" href="'. esc_url( home_url( '/' ) ). '" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" >'. esc_html( get_bloginfo( 'name' ) ) .'</a>';
                            }
                        ?>
                    </div><!-- end logo -->
                </div><!-- end col -->
    
                <div class="col-md-11 col-sm-11 col-xs-12">
                    <h1 class="header-size">Официальный дилер ПАО КАМАЗ в Челябинской области и ЯМАО - компания УРАЛКАМ</h1>

                    <?php if( $yog_address = yog_helper()->get_option(  'engines-header-address', 'raw', false, 'options' ) ): ?>
                        <div class="header-contact clearfix" style="width: 30%">
                            <p><i class="flaticon-technology alignleft"></i> <?php echo wp_kses( $yog_address, array( 'br' => array() ) ); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if( $yog_schedule = yog_helper()->get_option(  'engines-header-schedule', 'raw', false, 'options' ) ): ?>
                        <div class="header-contact clearfix" style="width: 23%">
                            <p><!--i class="flaticon-icon-818 alignleft"></i--> <?php echo wp_kses( $yog_schedule, array( 'br' => array() ) ); ?></p>
                        </div><!-- end header-contact -->
                    <?php endif; ?>
                    <?php if( $yog_number = yog_helper()->get_option(  'engines-header-number-v1', 'raw', false , 'options') ): ?>
                        <div class="header-contact clearfix" style="width: 42%; border-left: 1px solid #00559e;">
                            <p><i class="flaticon-icon-818 alignleft"></i> <?php echo wp_kses( $yog_number, array( 'br' => array() ) ); ?></p>
                        </div><!-- end header-contact -->
                    <?php endif; ?>
                    <?php if( yog_helper()->get_option(  'engines-header-search', 'raw', false, 'options' ) ): ?>
                        <div class="hidden-xs header-search clearfix text-right">
                            <form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>" class="search-form">
                                <div class="form-group has-feedback">
                                    <label for="search" class="sr-only"><?php echo esc_html( yog_helper()->get_option(  'engines-header-search-placeholder', 'raw', false ) ); ?></label>
                                    <input type="text" class="form-control" name="s" id="search" placeholder="<?php echo esc_attr( yog_helper()->get_option(  'engines-header-search-placeholder', 'raw', false ) ); ?>" />
                                    <span class="fa fa-search form-control-feedback"></span>
                                </div>
                            </form>
                        </div><!-- end header-contact -->
                    <?php endif; ?>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end header -->
<?php endif; ?>
<div class="transparent-header">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <?php 
                //Define Verables.
                $yog_page_menu = $yog_menu = '';
                
                //Get Post Meta Value.
                $yog_page_menu = yog_helper()->get_option(  'engines_page_menu', 'url', false, 'post' );

                //Responsive Menu Icon
                if( !empty( $yog_page_menu ) || has_nav_menu( 'primary' ) ){
            ?>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'engines' ); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            <?php 
                }
                
                echo '<div id="navbar" class="navbar-collapse collapse">';
                
                    if( !empty( $yog_page_menu ) ){
                        //Menu Arguments    
                        wp_nav_menu( array(
                            'container' => false,
                            'menu_class' => 'nav navbar-nav',
                            'menu_id' => '',
                            'menu' => $yog_page_menu,
                            'walker' => new Engines_Walker_Nav_Menu
                        ) );   
                    }elseif( has_nav_menu( 'primary' ) ){
                        //Menu Arguments    
                        wp_nav_menu( array(
                            'container' => false,
                            'menu_class' => 'nav navbar-nav',
                            'menu_id' => '',
                            'theme_location' => 'primary',
                            'walker' => new Engines_Walker_Nav_Menu
                        ));
                    }
                    
                    echo '<ul class="nav navbar-nav navbar-right">';
                        
                        //Get Social Icons
                        $yog_social_links = yog_helper()->get_option( 'page-social-identities', 'raw', false, 'options' );
                        
                        //Check & Print
                        if( yog_helper()->get_option( 'engines-header-social-links', 'raw', false, 'options' ) && $yog_social_links ):
                            $yog_link = array(); $yog_counter = 0;
                            foreach( $yog_social_links['url'] as $yog_social_link ){
                                $yog_link[] = $yog_social_link;
                            }
                            
                            foreach( $yog_social_links['network'] as $yog_social_icon ){
                                echo '<li class="social-header"><a href="'. esc_url( $yog_link[$yog_counter] ) .'"><i class="fa '. esc_attr( $yog_social_icon ) .'"></i></a></li>';
                                $yog_counter++;
                            }
                            
                        endif;
                        
                       //Cart
                       if( yog_helper()->get_option( 'engines-header-menu-cart', 'raw', false, 'options' ) && class_exists( 'Woocommerce' ) &&  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
                    ?>
                        <li class="navbar-cart"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><!--?php echo esc_html__( 'Cart', 'engines' ); ?--> Корзина <i class="fa fa-shopping-cart"></i> <small><?php echo WC()->cart->get_cart_contents_count(); ?></small></a></li>
                    <?php endif; ?>
                    <?php 
                        //Get compare page
            		    $compare_page = yog_helper()->get_option(  'compare-page', 'raw', false, 'options' ) ;
            		    
                        if(function_exists('icl_object_id')) {
                			$id   = icl_object_id( $compare_page, 'page', false, ICL_LANGUAGE_CODE );
                			if(is_page($id)) {
                				$compare_page = $id;
                			}
                		}
                        $compare_ids = ( isset( $_COOKIE['compare_ids'] ) && !empty( $_COOKIE['compare_ids'] ) && is_array( $_COOKIE['compare_ids'] ) )? count( $_COOKIE['compare_ids'] ) : 0;
                        if(!empty($compare_page)):
                    ?>
                        <li class="navbar-cart"><a href="<?php echo esc_url( get_permalink( $compare_page ) ); ?>"><?php echo esc_html__( 'Compare', 'engines' )?> <i class="flaticon-car"></i> <small class="compare-count"><?php echo $compare_ids;?></small></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div><!--/.container-fluid -->
    </nav><!-- end nav -->
</div><!-- end transparent header -->
<div class="cleafix"></div>