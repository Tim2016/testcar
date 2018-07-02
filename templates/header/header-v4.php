<div class="transparent-header header-2 v4">
    <?php if( yog_helper()->get_option(  'engines-header-top', 'raw', false, 'options' ) ): ?>
        <div class="topbar hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul class="list-inline text-left">
                            <?php 
                                //Phone Number
                                if( $yog_number = yog_helper()->get_option(  'engines-header-number-v4', 'raw', false, 'options' )):
                                    echo '<li><i class="fa fa-phone"></i> '. wp_kses( $yog_number, array( 'br' => array() ) ) .'</li>';
                                endif;
                                
                                //Email
                                if( $yog_email = yog_helper()->get_option(  'engines-header-email-v4', 'raw', false, 'options' ) ):
                                    echo '<li class="hidden-sm hidden-xs"><i class="fa fa-envelope-o"></i> '. wp_kses( $yog_email, array( 'br' => array() ) ) .'</li>';
                                endif;
                            ?>
                        </ul>
                    </div><!-- end col -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php 
                           //Get Social Icons
                            $yog_social_links = yog_helper()->get_option( 'page-social-identities', 'raw', false, 'options' );
                            
                            //Check & Print
                            if( yog_helper()->get_option( 'engines-header-social-links', 'raw', false, 'options' ) && $yog_social_links ):
                                $yog_link = array(); $yog_counter = 0;
                                foreach( $yog_social_links['url'] as $yog_social_link ){
                                    $yog_link[] = $yog_social_link;
                                }
                                echo '<ul class="list-inline text-right">';
                                    foreach( $yog_social_links['network'] as $yog_social_icon ){
                                        echo '<li class="social-header"><a href="'. esc_url( $yog_link[$yog_counter] ) .'"><i class="fa '. esc_attr( $yog_social_icon ) .'"></i></a></li>';
                                        $yog_counter++;
                                    }
                                echo '</ul>';
                                
                            endif;
                        ?>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <?php 
                    //Define Verables.
                    $yog_page_menu = $yog_menu = $yog_page_logo = '';
                    
                    //Get Page Meta Data.
                    $yog_page_menu = yog_helper()->get_option(  'engines_page_menu', 'url', false, 'post' );
                    
                    //Responsive Menu Icon
                    if( !empty( $yog_page_menu ) || has_nav_menu( 'primary' ) ){
                ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'engines' ); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php 
                    }
                    
                    //Logo.
                    $yog_logo = ( $yog_page_logo = yog_helper()->get_option(  'header-logo', 'raw', false, 'post' ) )? $yog_page_logo : yog_helper()->get_option(  'header-logo', 'raw', false );
                    
                    //Theme Logo.
                    if( isset( $yog_logo['url'] ) && !empty( $yog_logo['url'] ) ){
                        echo '<a class="navbar-brand" href="'. esc_url( home_url( '/' ) ). '" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" ><img src="'. esc_url( $yog_logo['url'] ) .'" class="img-responsive" alt="'. esc_attr( get_bloginfo( 'name' ) ) .'"/></a>';
                    }else{
                        echo '<a class="navbar-brand" href="'. esc_url( home_url( '/' ) ). '" title="'. esc_attr( get_bloginfo( 'name' ) ) .'" >'. esc_html( get_bloginfo( 'name' ) ) .'</a>';
                    }
                ?>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php 
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
                ?>
                <ul class="nav navbar-nav navbar-right hidden-sm">
                    
                    <?php if( yog_helper()->get_option( 'engines-header-menu-cart', 'raw', false, 'options' ) && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
                        <li class="navbar-cart"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart <i class="fa fa-shopping-cart"></i> <small><?php echo WC()->cart->get_cart_contents_count(); ?></small></a></li>
                    <?php endif; ?>
                    <?php if( yog_helper()->get_option(  'engines-header-search-v4', 'raw', false, 'options' ) ): ?>
                        <li class="dropdown searchmenu hasmenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
                            <ul class="dropdown-menu start-right">
                                <li>
                                    <form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
                                        <div id="custom-search-input">
                                            <div class="input-group col-md-12">
                                                <input type="text" class="form-control input-lg" placeholder="<?php echo esc_attr( yog_helper()->get_option(  'engines-header-search-placeholder-v4', 'raw', false ) ); ?>" />
                                                <span class="input-group-btn"><button class="btn btn-primary btn-lg" type="submit"><i class="fa fa-search"></i></button></span>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav><!-- end nav -->
</div><!-- end transparent header -->