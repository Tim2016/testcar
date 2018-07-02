<?php
/**
 * The template for displaying inventory archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); 
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    
    //Blog Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'inventory-enable-global', 'raw', false, 'options' );  
    $yog_layout   = yog_helper()->get_option( 'inventory-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';
        
    ?>
     <div class="section"> 
        <div class="container">
            <div class="row">
                <?php if( 'left' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'inventory-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'inventory-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
                
                <div class="<?php echo esc_attr( $yog_class ); ?>">
                    <?php
                        if ( have_posts() ) :
                            
                            ?>
                            <div class="car-list-wrapper clearfix">
                                
                                <div class="list-top clearfix">
                                    <?php 
                                        //Global Query
                                        global $wp_query;
                                        
                                        //Get all posts ids
                                        $yog_post_ids = array();
                                        foreach( $wp_query->posts  as $items ){
                                            $yog_post_ids[] = $items->ID;
                                        }
                                        
                                        //Theme Option fields.
                                        $yog_style = yog_helper()->get_option( 'inventory-arch-display', 'raw', 'list', 'options' );
                                        $yog_columns = yog_helper()->get_option( 'inventory-arch-grid', 'raw', '2', 'options' );
                                        $yog_animation = yog_helper()->get_option( 'inventory-arch-animation', 'raw', 'list', 'options' );
                                        $yog_delay = yog_helper()->get_option( 'inventory-arch-delay', 'raw', 'list', 'options' );
                                        
                                        //Grid Cookie Value
                                        if( isset( $_COOKIE['gridcookie'] ) ){
                                            $yog_style = $_COOKIE['gridcookie'];
                                        }
                                        
                                        //Order Filter
                                        yog_inventory_order_filter( array('layout' =>  $yog_style, 'limit' => json_encode( $yog_post_ids ), 'columns' => $yog_columns, 'animation' => $yog_animation ) );
                                        
                                        //Grid Filter
                                        yog_inventory_grid_filter_html($yog_style);
                                    ?>
                                </div><!-- end list-top -->
                            
                                <div class="inventory-items">
                                    <?php 
                                    
                                        while ( have_posts() ) { the_post();
                    
                                            if( $yog_style == 'grid' ){
                                                
                                                //Columns
                                                $yog_column_counter++;
                                
                                                //Row Container Start
                                                if ( $yog_column_counter == 1 ) {
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
                                                $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'year' );
                                                
                                                ?>
                                                <div <?php yog_helper()->attr( false, array( 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?> class="<?php echo esc_attr( yog_get_column( $yog_columns ) ); ?> col-sm-6 col-xs-12">
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
                                                                //Sale Price
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
                                                                    //Kilometres
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
                                                if ( $yog_column_counter == $yog_columns && $yog_style != 'slides' ) {
                                                    $yog_column_counter = 0;
                                                    echo '</div>';
                                                    $yog_close = false;
                                                }
                                                           
                                            }else{
                                                
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
                                                $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'year' );
                                                $yog_transmission = yog_get_taxonomies( get_the_ID(), 'transmission' );
                                                
                                                ?>
                                                <div <?php yog_helper()->attr( false, array( 'class' => 'car-list clearfix row', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
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
                                                                //Price
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
                                        }
                                        
                                        //Row Container Close.
                                        if ( isset( $yog_close ) && !empty( $yog_close ) ) {
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div><?php
                            
                            //Pagination
                            yog_wp_paginate( array( 'before' => '<div class="col-md-12 text-center">', 'after' => '</div>', 'class' => 'pagination pagination-lg', 'title' => false, 'nextpage' => '<i class="fa fa-angle-right"></i>', 'previouspage' => '<i class="fa fa-angle-left"></i>' ) );    
                    
                    	// If no content, include the "No posts found" template.
                    	else :
                    		get_template_part( 'templates/page/content', 'none' );
                    
                    	endif;
                    ?>
                </div>
                
                <?php if( 'right' == $yog_layout && ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) ) ){ ?>
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php 
                            if( is_dynamic_sidebar( yog_helper()->get_option( 'inventory-sidebar', 'raw', 'primary', 'options' ) ) ):
                                dynamic_sidebar( yog_helper()->get_option( 'inventory-sidebar', 'raw', 'primary', 'options' ) ); 
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
         </div>
     </div>   
    <?php
 get_footer(); 
