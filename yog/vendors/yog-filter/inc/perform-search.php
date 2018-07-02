<?php
    //INIT CONDITIONS META QUERY
    $array_meta_query = array();
    $array_tax_query  = array();
   
    $categories = array( 'body', 'make', 'model', 'fuel_type', 'engine', 'registration_year', 'fuel_consumption', 'transmission', 'fuel_economy', 'exterior_color', 'interior_color', 'mileage' );
    $search_cats = array();
    foreach( $categories as $key ){
        if (isset($_POST[$key]) && $_POST[$key][0] != 0){
            $array_tax_query[]=
    		array(
    			'taxonomy' => $key,
    			'field'    => 'id',
    			'terms'    => $_POST[$key],
    			'operator' => 'IN',
    		);
            
            $search_cats[] = $key;
        }
    }
   
   if( ( isset( $_POST['year-to'] ) && !empty( $_POST['year-to'] ) ) || ( isset( $_POST['year-from'] ) && !empty( $_POST['year-from'] ) ) ){
      $data_to   = explode( '/', $_POST['year-to'] );
      $date_from = explode( '/', $_POST['year-from'] );
      $date = array();
      $date[] = $data_to[2];
      $date[] = $date_from[2];
      
      $array_tax_query[] = array(
          'taxonomy' => 'registration_year',
          'field'    => 'slug',
          'terms'    => $date
      );
   }
   
   //INIT MAIN QUERY AFTER ALL CONDITIONS HAVE BEEN DECLARED
   $args = array(
	  'post_type'        => 'inventory',
	  'post_status'      => 'publish',
      'posts_per_page'   => 999,
      'tax_query'        => $array_tax_query,
	  'order'            => 'ASC',
    );
    
    //SEARCH
    if( isset( $_POST['SearchybyName'] ) && !empty( $_POST['SearchybyName'] ) ){
        $args['s'] = $_POST['SearchybyName'];
    }
    
    $args['meta_query'][] = 'AND';
    
    //PRICE
    $price_min = ( $_POST['price_min'] == 1 )? 2 : $_POST['price_min'];
    $price_max = ( $_POST['price_max'] == 100000 )? 999999 : $_POST['price_max'];
    $args['meta_query'][] = array(
        'key'     => 'inv_price',
		'value'   => array( $price_min, $price_max ),
		'compare' => 'between'
    );
    
    //MILEAGE
    $mileage_min = ( $_POST['mileage_min'] == 1 )? 2 : $_POST['mileage_min'];
    $mileage_max = ( $_POST['mileage_max'] == 10000 )? 99999 : $_POST['mileage_max'];
    $args['meta_query'][] = array(
        'key'     => 'inv_mileage',
		'value'   => array( $mileage_min, $mileage_max ),
		'compare' => 'between'
    );
    
    //STOCK NUMBER
    if( isset( $_POST['stock-number'] ) && !empty( $_POST['stock-number'] ) ){
        $args['meta_query'][] = array(
            'key'   => 'inv_stock_number',
            'value' => $_POST['stock-number']
        );
    }
	
	//EXECUTE THE QUERY	   
	$yog_query = new WP_Query( $args );
	if ( $yog_query->have_posts() ) { 
	   
       //Get Filter Option Values
       $yog_style     = yog_helper()->get_option( 'inventory-cat-display', 'raw', 'grid', 'options' );
       $yog_columns   = yog_helper()->get_option( 'inventory-cat-grid', 'raw', 2, 'options' );
       
       if( isset( $_COOKIE['gridcookie'] ) ){
            $yog_style = $_COOKIE['gridcookie'];
        }
        
        //Get Post Ids
        $post_ids = array();
        foreach( $yog_query->posts  as $items ){
            $post_ids[] = $items->ID;
        }
                        
        //Check and Print Posts
        if( $yog_style == 'grid' ){
           ?>
           <div class="car-list-wrapper clearfix">
                <div class="list-top clearfix">
                    <div class="pull-left">
                        <div class="form-input">
                            <label class=""><?php yog_translation('tr-inv-order-fiter'); ?></label>
                            <?php  
                                if( isset( $search_cats ) && !empty( $search_cats ) ){
                                    
                                    echo '<div class="filter-tags">';
                                        
                                        foreach( $search_cats as $search_cat ){
                                            $cat = str_replace( '_', ' ', $search_cat );
                                            echo '<span class="filter-tag">'. ucwords( $cat ) .'</span>';
                                        }
                                        
                                    echo '</div>';
                                
                                }
                            ?>
                        </div><!-- end form-input -->
                    </div>
                    <?php
                        //Grid Filter
                        yog_inventory_grid_filter_html('grid');
                    ?>
                </div><!-- end list-top -->
                <?php 
                echo '<div class="grid-wrapper inventory-items">';
               
                    $yog_column_counter = 0;
                    while ( $yog_query->have_posts() ) {
                        $yog_query->the_post();
                        
                        //Columns
                        $yog_column_counter++;
        
                        //Row Container Start
                        if ( $yog_column_counter == 1 && $yog_style != 'slides' ) {
                            echo '<div class="row">';
                            $yog_close = true;
                        }
                        
                        //Meta fields values.
                        $yog_sale_price = get_post_meta( get_the_ID(), 'inv_sale_price', true );
                        $yog_price = get_post_meta( get_the_ID(), 'inv_price', true );
                        $yog_kilometres = get_post_meta( get_the_ID(), 'inv_kilometres_mpg', true );
                        $yog_video_link = get_post_meta( get_the_ID(), 'inv_video_link', true );
                        
                        //Fuel Type.
                        $yog_fuel_type = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                        $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'registration_year' );
                        
                        ?>
                        <div class="<?php echo esc_attr( yog_get_column( $yog_columns ) ); ?> col-sm-6 col-xs-12">
                            <div class="car-wrapper clearfix car-grid">
                                <div class="post-media entry">
                                     <?php if( isset( $yog_video_link ) && !empty( $yog_video_link ) ){ ?>
                                        <a data-rel="prettyPhoto" href="<?php echo esc_url( $yog_video_link ); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                            <div class="magnifier"><i class="flaticon-play-button"></i></div><!-- end magnifier -->
                                        </a>
                                     <?php }else{ ?>
                                        <a data-rel="prettyPhoto" href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() ) ); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                            <div class="magnifier"><i class="fa fa-image"></i></div><!-- end magnifier -->
                                        </a>
                                    <?php }
                                    
                                        if( $yog_sale_price ){
                                            printf( '<div class="car-price sell-price"><p>%s</p></div>', yog_get_inv_price( $yog_sale_price ) );
                                            
                                            if( $yog_price ){
                                                printf( '<div class="car-price reg-price"><p>%s</p></div>', yog_get_inv_price( $yog_price ) );
                                            }
                                        }elseif( $yog_price ){
                                            printf( '<div class="car-price"><p>%s</p></div>', yog_get_inv_price( $yog_price ) );
                                        }
                                    ?>
                                    <ul class="list-inline">
                                        <?php 
                                            //kilometres
                                            if( !empty( $yog_kilometres ) ){
                                                printf( '<li class="car-km"><p><i class="fa fa-road"></i> %s</p></li>', $yog_kilometres );
                                            }
                                            
                                            //Full Type
                                            if( !empty( $yog_fuel_type ) ){
                                                printf( '<li class="car-oil"><p><i class="fa fa-car"></i> %s</p></li>', join( ' ', $yog_fuel_type ) );
                                            }
                                            
                                            //Registration Year
                                            if( !empty( $yog_reg_year ) ){
                                                printf( '<li class="car-date"><p><i class="fa fa-clock-o"></i> %s</p></li>', join( ' ', $yog_reg_year ) );
                                            }
                                        ?>
                                    </ul>
                                </div><!-- end post-media -->
                            
                                <div class="car-title clearfix">
                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                </div><!-- end car-title -->
                            </div><!-- end clearfix -->
                        </div>
                        <?php
                        
                        //Row Container Close.
                        if ( $yog_column_counter == $yog_columns ) {
                            $yog_column_counter = 0;
                            echo '</div>';
                            $yog_close = false;
                        }
                    }
                    
                    //Row Container Close.
                    if ( isset( $yog_close ) && !empty( $yog_close ) ) {
                        echo '</div>';
                    }
                ?>
            </div>
           <?php
           
        }elseif( $yog_style == 'list' ){
            
            ?>
            <div class="car-list-wrapper clearfix">
                <div class="list-top clearfix">
                    <div class="pull-left">
                        <div class="form-input">
                            <label class=""><?php yog_translation('tr-inv-order-fiter'); ?></label>
                            <?php  
                                if( isset( $search_cats ) && !empty( $search_cats ) ){
                                    
                                    echo '<div class="filter-tags">';
                                        
                                        foreach( $search_cats as $search_cat ){
                                            $cat = str_replace( '_', ' ', $search_cat );
                                            echo '<span class="filter-tag">'. ucwords( $cat ) .'</span>';
                                        }
                                        
                                    echo '</div>';
                                
                                }
                            ?>
                        </div><!-- end form-input -->
                    </div>
                    <?php 
                        //Grid Filter
                        yog_inventory_grid_filter_html();
                    ?>
                </div><!-- end list-top -->
                <div class="inventory-items">
                    <?php 
                        while ( $yog_query->have_posts() ) {
                            $yog_query->the_post();
           
                            //Meta fields values.
                            $yog_kilometres = get_post_meta( get_the_ID(), 'inv_kilometres_mpg', true );
                            $yog_stock_number = get_post_meta( get_the_ID(), 'inv_stock_number', true );
                            $yog_logo_primary = get_post_meta( get_the_ID(), 'inv_logo_primary', true );
                            $yog_logo_primary_link = get_post_meta( get_the_ID(), 'inv_logo_primary_link', true );
                            $yog_logo_sec = get_post_meta( get_the_ID(), 'inv_logo_sec', true );
                            $yog_logo_sec_link = get_post_meta( get_the_ID(), 'inv_logo_sec_link', true );
                            $yog_sale_price = get_post_meta( get_the_ID(), 'inv_sale_price', true );
                            $yog_price = get_post_meta( get_the_ID(), 'inv_price', true );
                            $yog_video_link = get_post_meta( get_the_ID(), 'inv_video_link', true );
                            
                            //Taxonomy.
                            $yog_fuel_types = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                            $yog_engine = yog_get_taxonomies( get_the_ID(), 'engine' );
                            $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'registration_year' );
                            $yog_transmission = yog_get_taxonomies( get_the_ID(), 'transmission' );
                            
                            ?>
                            <div class="car-list clearfix row">
                                <div class="col-md-4">
                                    <?php if( has_post_thumbnail() ): ?>
                                        <div class="post-media entry">
                                            <?php if( isset( $yog_video_link ) && !empty( $yog_video_link ) ){ ?>
                                                <i class="flaticon-play-button"></i>
                                                <a data-rel="prettyPhoto" href="<?php echo esc_url( $yog_video_link ); ?>">
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                                </a>
                                            <?php }else{ ?>
                                                <i class="fa fa-image"></i>
                                                <a data-rel="prettyPhoto" href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() ) ); ?>">
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                                </a>
                                            <?php }?>
                                        </div><!-- end post-media -->
                                    <?php endif; ?>
                                </div><!-- end col -->

                                <div class="col-md-8">
                                    <div class="car-top clearfix">
                                        <div class="pull-left">
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        </div><!-- end pull-left -->
                                    </div><!-- end car-top -->

                                    <div class="car-details clearfix">
                                        <?php 
                                            if( $yog_sale_price ){
                                                printf( '<div class="car-price sell-price"><p>%s</p></div>', yog_get_inv_price( $yog_sale_price ) );
                                                
                                                if( $yog_price ){
                                                    printf( '<div class="car-price reg-price"><p>%s</p></div>', yog_get_inv_price( $yog_price ) );
                                                }
                                            }elseif( $yog_price ){
                                                printf( '<div class="car-price"><p>%s</p></div>', yog_get_inv_price( $yog_price ) );
                                            }
                                        ?>
                                        <div class="pull-right hidden-xs">
                                            <?php 
                                                if(empty($_COOKIE['compare_ids'])) {
                                                	$compare_ids = array();
                                                } else {
                                                	$compare_ids = $_COOKIE['compare_ids'];
                                                }
                                                if( in_array( get_the_ID(), $compare_ids ) ){
                                                    ?>
                                                    <div
                                						class="car-action-unit add-to-compare btn btn-primary yog-added btn btn-primary"
                                						data-id="<?php echo esc_attr(get_the_id()); ?>"
                                						data-title="<?php the_title(); ?>"
                                                        data-action="remove">
                                						<span class="yog-unhover"><i class="fa fa-plus"></i> <?php yog_translation( 'tr-inv-list-compare-added' ); ?></span>
                                                        <div class="yog-show-on-hover">
                                                            <i class="fa fa-minus"></i> <?php yog_translation( 'tr-inv-list-compare-remove' ); ?>
                                                        </div>
                                					</div>
                                                    <?php
                                                }else{ 
                                            ?>
                                            <div
                        						class="car-action-unit add-to-compare btn btn-primary"
                        						data-id="<?php echo esc_attr(get_the_id()); ?>"
                        						data-title="<?php the_title(); ?>">
                        						<i class="fa fa-area-chart"></i>
                        						<?php yog_translation( 'tr-inv-list-compare-add' ); ?>
                        					</div>
                                            <?php } ?>
                                            
                                        </div><!-- end pull-left -->
                                    </div><!-- end details -->

                                    <div class="car-details clearfix">
                                        <ul class="list-inline">
                                            <?php 
                                                //Kilometres
                                                if( !empty( $yog_kilometres ) ){
                                                    printf( '<li><i class="fa fa-road"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-km' ), $yog_kilometres );
                                                }
                                                
                                                //Fuel Type
                                                if( !empty( $yog_fuel_types ) ){
                                                    printf( '<li><i class="fa fa-car"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-fuel-type' ), join( ' ', $yog_fuel_types ) );
                                                }
                                                
                                                //Reg.Year
                                                if( !empty( $yog_reg_year ) ){
                                                    printf( '<li><i class="fa fa-clock-o"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-reg-year' ), join( ' ', $yog_reg_year ) );
                                                }
                                                
                                                //Transmission
                                                if( !empty( $yog_transmission ) ){
                                                    printf( '<li><i class="fa fa-gears"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-transmission' ), join( ' ', $yog_transmission ) );
                                                }
                                                
                                                //Engine
                                                if( !empty( $yog_engine ) ){
                                                    printf( '<li><i class="fa fa-level-up"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-engine' ), join( ' ', $yog_engine ) );
                                                }
                                            ?>
                                        </ul>
                                    </div><!-- end car-details -->

                                    <div class="car-bottom clearfix">
                                        <div class="pull-left">
                                            <?php
                                                //Stock Number  
                                                if( $yog_stock_number && yog_helper()->get_option( 'inventory-stock', 'raw', false, 'options' )){
                                                    printf( '<span class="stock">%s#  %s</span>', yog_get_translation( 'tr-inv-list-stock' ), $yog_stock_number );
                                                } 
                                            ?>
                                            <a href="<?php the_permalink(); ?>" class="stock"><?php yog_translation( 'tr-inv-list-single-link' ); ?></a>
                                        </div><!-- end pull-left -->

                                        <div class="pull-right hidden-xs">
                                            <?php 
                                                //Primary Logo
                                                if( isset( $yog_logo_primary['url'] ) && !empty( $yog_logo_primary['url'] ) && !empty( $yog_logo_primary_link ) && yog_helper()->get_option( 'inventory-certified-logo1', 'raw', false, 'options' ) ){
                                                    ?><a href="<?php echo esc_url( $yog_logo_primary_link ); ?>" class=""><img src="<?php echo esc_url( $yog_logo_primary['url'] ); ?>" alt="<?php echo get_post_meta( $yog_logo_primary['id'], '_wp_attachment_image_alt', true); ?>"></a><?php
                                                }
                                                
                                                //Secondary Logo
                                                if( isset( $yog_logo_sec['url'] ) && !empty( $yog_logo_primary['url'] ) && !empty( $yog_logo_sec_link ) && yog_helper()->get_option( 'inventory-certified-logo2', 'raw', false, 'options' ) ){
                                                    ?><a href="<?php echo esc_url( $yog_logo_sec_link ); ?>" class=""><img src="<?php echo esc_url( $yog_logo_sec['url'] ); ?>" alt="<?php echo get_post_meta( $yog_logo_sec['id'], '_wp_attachment_image_alt', true); ?>"></a><?php
                                                }
                                            ?>
                                        </div><!-- end pull-left -->
                                    </div><!-- end car-top -->
                                </div><!-- end col -->
                            </div><!-- end car-list -->
                            <?php
                        }
                    ?>
                </div>
            </div><?php
        }
        
        //Pagination
        yog_wp_paginate( array( 'query' =>  $yog_query, 'before' => '<div class="col-md-12 text-center" '. yog_atts( array( 'animation' => $yog_animation , 'animation-delay' => $yog_delay ), 'data-' ) .'>', 'after' => '</div>', 'class' => 'pagination pagination-lg', 'title' => false, 'nextpage' => '<i class="fa fa-angle-right"></i>', 'previouspage' => '<i class="fa fa-angle-left"></i>' ) );
        
        //Reset Post Date
        wp_reset_postdata();
       
    }else{
        ?>
        <div class="car-list-wrapper clearfix">
            <div class="list-top clearfix">
                <div class="pull-left">
                    <div class="form-input">
                        <label class=""><?php yog_translation('tr-inv-order-fiter'); ?></label>
                        <?php  
                            if( isset( $search_cats ) && !empty( $search_cats ) ){
                                
                                echo '<div class="filter-tags">';
                                    
                                    foreach( $search_cats as $search_cat ){
                                        $cat = str_replace( '_', ' ', $search_cat );
                                        echo '<span class="filter-tag">'. ucwords( $cat ) .'</span>';
                                    }
                                    
                                echo '</div>';
                            
                            }
                        ?>
                    </div><!-- end form-input -->
                </div>
            </div>
            <div class="jumbotron text-center">
              <h1><?php esc_html_e( 'Oh, No!', 'engines' ); ?></h1>
              <p><?php esc_html_e( 'No Results found for your search', 'engines' ); ?></p>
            </div>
        </div>
        <?php
    }