<div class="transparent-header header-2">
    <?php if( yog_helper()->get_option(  'engines-header-top', 'raw', false, 'options' ) ): ?>
        <div class="topbar hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php 
                            //Tag Line
                            if( $yog_tag_line = yog_helper()->get_option( 'engines-header-tags-v3', 'raw', false, 'options' ) ):
                                echo wp_kses( $yog_tag_line, array( 'p' => array(), 'a' => array( 'href' => array() ) ) );
                            endif;
                        ?>
                    </div><!-- end col -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <ul class="list-inline text-right">
                            <?php 
                                //Email
                                if( $yog_email = yog_helper()->get_option( 'engines-header-email', 'raw', false, 'options' ) ):
                                    echo '<li class="hidden-sm hidden-xs bord"><i class="fa fa-envelope-o"></i> '. esc_html( $yog_email ) .'</li>';
                                endif;
                                
                                //Phone Number
                                if( $yog_number = yog_helper()->get_option( 'engines-header-number-v3', 'raw', false, 'options' ) ):
                                    echo '<li><i class="fa fa-phone bord"></i> '. esc_html( $yog_number ) .'</li>';
                                endif;
                                
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
                            ?>
                        </ul>
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
                <div class="logobg"></div>
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
                    
                    //Button
                    if( $yog_btn_link = yog_helper()->get_option( 'engines-header-btn-link', 'url', false, 'options' ) ):
                        echo '<ul class="nav navbar-nav navbar-right hidden-sm">
                                <li><a class="active" href="'. esc_url( $yog_btn_link ) .'">'. esc_html( yog_helper()->get_option( 'engines-header-btn-txt', 'html', false, 'options' ) ) .'</a></li>
                              </ul>';
                    endif;
                ?>
            </div>
        </div>
    </nav>
</div>