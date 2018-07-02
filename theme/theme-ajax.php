<?php
/**
 * Theme Framework
 * The ajax initiate the theme engine
 */

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Soting
add_action('wp_ajax_yogSorting', 'yog_inventoy_shorting'); 
add_action('wp_ajax_nopriv_yogSorting', 'yog_inventoy_shorting');

function yog_inventoy_shorting(){
    
    //Get variable 
    $yog_limit = json_decode(stripslashes($_POST['limit']));
    $yog_columns = $_POST['column'];
    $yog_animation = $_POST['animation'];
    $yog_layout = $_POST['layout'];

    //Default arguments
    $yog_args = array(
        'post_type' => array( 'inventory'),
        'post__in' => $yog_limit,
        'posts_per_page' => '-1'
	);
    
    //Meta field arguments
    $yog_paged = get_query_var( 'paged', 1 );
	$yog_args_query = array(
		'paged' => $yog_paged
	);
    
    //Shorting  Arguments
    if(!empty($_POST['sort_order'])) {
		switch (sanitize_text_field($_POST['sort_order'])) {
		    case "price_low":
      		    $yog_args_query['order'] = 'ASC';
				$yog_args_query['orderby'] = 'meta_value_num';
                $yog_args_query['type'] = 'numeric';
                $yog_args_query['meta_key'] = 'inv_price';

		        break;
		    case "price_high":
		        $yog_args_query['order'] = 'DESC';
				$yog_args_query['orderby'] = 'meta_value_num';
                $yog_args_query['type'] = 'numeric';
				$yog_args_query['meta_key'] = 'inv_price';

		        break;
		    case "date_low":
		        $yog_args_query['order'] = 'DESC';
				$yog_args_query['orderby'] = 'date';

		        break;
		    case "mileage_low":
		        $yog_args_query['order'] = 'ASC';
				$yog_args_query['orderby'] = 'meta_value_num';
                $yog_args_query['type'] = 'numeric';
				$yog_args_query['meta_key'] = 'inv_mileage';

		        break;
		    case "mileage_high":
		        $yog_args_query['order'] = 'DESC';
				$yog_args_query['orderby'] = 'meta_value_num';
                $yog_args_query['type'] = 'numeric';
				$yog_args_query['meta_key'] = 'inv_mileage';

		        break;
		    default:
		    	$yog_args_query['order'] = 'ASC';
				$yog_args_query['orderby'] = 'date';

		}
	}
    
    //Merage arguments
    $yog_merged_query_args = array_merge( $yog_args, $yog_args_query );
    
    //Custom query    
    $yog_query = new WP_Query( $yog_merged_query_args );
    
    //Loop query    
	if( $yog_query->have_posts() ) :
    
       if( $yog_layout == 'grid' ):
        
            $yog_column_counter = 0;
            while ( $yog_query->have_posts() ) {
                $yog_query->the_post();
                
                //Meta fields values.
                $inv_sale_price = get_post_meta( get_the_ID(), 'inv_sale_price', true );
                $inv_price = get_post_meta( get_the_ID(), 'inv_price', true );
                $inv_kilometres = get_post_meta( get_the_ID(), 'inv_kilometres_mpg', true );
                $inv_video_link = get_post_meta( get_the_ID(), 'inv_video_link', true );
                
                //Fuel Type.
                $inv_fuel_type = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'year' );
                
                //Classes
                $yog_classes = array( yog_get_column( $yog_columns ) );
                $yog_classes[] = ( isset( $yog_animation ) && !empty( $yog_animation ) )? "animation animation-visible {$yog_animation} " : '';
                        
                //Columns
                $yog_column_counter++;
    
                //Row Container Start
                if ( $yog_column_counter == 1 ) {
                    echo '<div class="row">';
                    $yog_close = true;
                }
                ?>
                <div class="<?php echo esc_attr( join( ' ', $yog_classes ) ); ?> col-sm-6 col-xs-12" >
                    <div class="car-wrapper clearfix car-grid">
                        <div class="post-media entry">
                            <?php if( isset( $inv_video_link ) && !empty( $inv_video_link ) ){ ?>
                                <a data-rel="prettyPhoto" href="<?php echo esc_url( $inv_video_link ); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                    <div class="magnifier"><i class="flaticon-play-button"></i></div><!-- end magnifier -->
                                </a>
                             <?php }else{ ?>
                                <a data-rel="prettyPhoto" href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID() ) ); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?>
                                    <div class="magnifier"><i class="fa fa-image"></i></div><!-- end magnifier -->
                                </a>
                            <?php }
                                if( $inv_sale_price ){
                                    printf( '<div class="car-price sell-price"><p>%s</p></div>', yog_get_inv_price( $inv_sale_price ) );
                                    
                                    if( $inv_price ){
                                        printf( '<div class="car-price reg-price"><p>%s</p></div>', yog_get_inv_price( $inv_price ) );
                                    }
                                }elseif( $inv_price ){
                                    printf( '<div class="car-price"><p>%s</p></div>', yog_get_inv_price( $inv_price ) );
                                }
                            ?>
                            <ul class="list-inline">
                                <?php 
                                    //kilometres
                                    if( !empty( $inv_kilometres ) ){
                                        printf( '<li class="car-km"><p><i class="fa fa-road"></i> %s</p></li>', $inv_kilometres );
                                    }
                                    
                                    //Full Type
                                    if( !empty( $inv_fuel_type ) ){
                                        printf( '<li class="car-oil"><p><i class="fa fa-car"></i> %s</p></li>', join( ' ', $inv_fuel_type ) );
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
            
        elseif( $yog_layout == 'list' ):
        
            while ( $yog_query->have_posts() ) {
                $yog_query->the_post();
                
                //Meta fields values.
                $yog_inv_price = get_post_meta( get_the_ID(), 'inv_price', true );
                $yog_inv_kilometres = get_post_meta( get_the_ID(), 'inv_kilometres_mpg', true );
                $yog_inv_stock_number = get_post_meta( get_the_ID(), 'inv_stock_number', true );
                $yog_inv_logo_primary = get_post_meta( get_the_ID(), 'inv_logo_primary', true );
                $yog_inv_logo_primary_link = get_post_meta( get_the_ID(), 'inv_logo_primary_link', true );
                $yog_inv_logo_sec = get_post_meta( get_the_ID(), 'inv_logo_sec', true );
                $yog_inv_logo_sec_link = get_post_meta( get_the_ID(), 'inv_logo_sec_link', true );
                
                //Taxonomy.
                $yog_inv_fuel_types = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                $yog_engine = yog_get_taxonomies( get_the_ID(), 'engine' );
                $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'year' );
                $yog_transmission = yog_get_taxonomies( get_the_ID(), 'transmission' );
                
                //Animation Classes
                $yog_classes = ( isset( $yog_animation ) && !empty( $yog_animation ) )? "animation animation-visible {$yog_animation} " : '';
                ?>
                <div class="car-list clearfix row <?php echo esc_attr( $yog_classes ); ?>">
                    <div class="col-md-4">
                        <?php if( has_post_thumbnail() ): ?>
                            <div class="post-media entry">
                                <i class="flaticon-play-button"></i>
                                <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?></a>
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
                            <div class="car-price"><p><?php echo yog_get_inv_price( $yog_inv_price ); ?></p></div>
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
                                    if( !empty( $yog_inv_kilometres ) ){
                                        printf( '<li><i class="fa fa-road"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-km' ), $yog_inv_kilometres );
                                    }
                                    
                                    //Fuel Type
                                    if( !empty( $yog_inv_fuel_types ) ){
                                        printf( '<li><i class="fa fa-car"></i>%s <small>%s</small></li>', yog_get_translation( 'tr-inv-list-fuel-type' ), join( ' ', $yog_inv_fuel_types ) );
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
                                    if( $yog_inv_stock_number && yog_helper()->get_option( 'inventory-stock', 'raw', false, 'options' )){
                                        printf( '<span class="stock">%s#  %s</span>', yog_get_translation( 'tr-inv-list-stock' ), $yog_inv_stock_number );
                                    } 
                                ?>
                                <a href="<?php the_permalink(); ?>" class="stock"><?php yog_translation( 'tr-inv-list-single-link' ); ?></a>
                            </div><!-- end pull-left -->

                            <div class="pull-right hidden-xs">
                                <?php 
                                    //Primary Logo
                                    if( isset( $yog_inv_logo_primary['url'] ) && !empty( $yog_inv_logo_primary['url'] ) && !empty( $yog_inv_logo_primary_link ) && yog_helper()->get_option( 'inventory-certified-logo1', 'raw', false, 'options' ) ){
                                        ?><a href="<?php echo esc_url( $yog_inv_logo_primary_link ); ?>" class=""><img src="<?php echo esc_url( $yog_inv_logo_primary['url'] ); ?>" alt="<?php echo get_post_meta( $yog_inv_logo_primary['id'], '_wp_attachment_image_alt', true); ?>"></a><?php
                                    }
                                    
                                    //Secondary Logo
                                    if( isset( $yog_inv_logo_sec['url'] ) && !empty( $yog_inv_logo_primary['url'] ) && !empty( $yog_inv_logo_sec_link ) && yog_helper()->get_option( 'inventory-certified-logo2', 'raw', false, 'options' ) ){
                                        ?><a href="<?php echo esc_url( $yog_inv_logo_sec_link ); ?>" class=""><img src="<?php echo esc_url( $yog_inv_logo_sec['url'] ); ?>" alt="<?php echo get_post_meta( $yog_inv_logo_sec['id'], '_wp_attachment_image_alt', true); ?>"></a><?php
                                    }
                                ?>
                            </div><!-- end pull-left -->
                        </div><!-- end car-top -->
                    </div><!-- end col -->
                </div><!-- end car-list -->
                <?php
            }
            
        endif;
       
    else :
		echo esc_html__( 'No inventory posts found', 'engines' );
	endif;
    
    die();
}

//Ajax add to compare
function yog_ajax_add_to_compare() {


	$response['response']    = '';
	$response['status']      = '';
	$response['empty']       = '';
	$response['empty_table'] = '';
	$response['add_to_text'] = esc_html__( 'Add to compare', 'engines' );
	$response['in_com_text'] = esc_html__( 'In compare list', 'engines' );
	$response['remove_text'] = esc_html__( 'Remove from list', 'engines' );

	if ( empty( $_COOKIE['compare_ids'] ) ) {
		$_COOKIE['compare_ids'] = array();
	}
	if ( ! empty( $_POST['post_action'] ) and $_POST['post_action'] == 'remove' ) {
		if ( ! empty( $_POST['post_id'] ) ) {
			$new_post = $_POST['post_id'];
			setcookie( 'compare_ids[' . $new_post . ']', '', time() - 3600, '/' );
			unset($_COOKIE['compare_ids'][$new_post]);

			$response['status']   = 'success';
			$response['response'] = get_the_title( $_POST['post_id'] ) . ' ' . esc_html__( 'was removed from compare', 'engines' );
		}
	} else {
		if ( ! empty( $_POST['post_id'] ) ) {
			$new_post = $_POST['post_id'];
			if ( ! in_array( $new_post, $_COOKIE['compare_ids'] ) ) {
				if ( count( $_COOKIE['compare_ids'] ) < 3 ) {
					setcookie( 'compare_ids[' . $new_post . ']', $new_post, time() + ( 86400 * 30 ), '/' );
					$_COOKIE['compare_ids'][ $new_post ] = $new_post;
					$response['status']                  = 'success';
					$response['response']                = get_the_title( $_POST['post_id'] ) . ' - ' . esc_html__( 'Added to compare', 'engines' );
				} else {
					$response['status']   = 'danger';
					$response['response'] = esc_html__( 'You have already added','engines').' '.count($_COOKIE['compare_ids']).esc_html__(' cars', 'engines' );
				}
			} else {
				$response['status']   = 'warning';
				$response['response'] = get_the_title( $_POST['post_id'] ) . ' ' . esc_html__( 'has already added', 'engines' );
			}
		}
	}

	$response['length'] = count( $_COOKIE['compare_ids'] );

	$response['ids'] = $_COOKIE['compare_ids'];
    
    $response['counter']   = count( $_COOKIE['compare_ids'] );

	$response = json_encode( $response );

	echo $response;
	exit;
}

add_action( 'wp_ajax_yog_ajax_add_to_compare', 'yog_ajax_add_to_compare' );
add_action( 'wp_ajax_nopriv_yog_ajax_add_to_compare', 'yog_ajax_add_to_compare' );