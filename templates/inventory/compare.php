<?php
//Get Id
if(empty($_COOKIE['compare_ids'])) {
	$compare_ids = array();
} else {
	$compare_ids = $_COOKIE['compare_ids'];
}

$empty_cars = 3 - count($compare_ids);
$counter = 0;

//Get Animation Theme Option.
$yog_animation = yog_helper()->get_option( 'inventory-animation', 'raw', false, 'options' );
$yog_delay = yog_helper()->get_option( 'inventory-delay', 'raw', false, 'options' );
?>
<div class="section">
    <div class="container">
        <?php if(!empty($compare_ids) or count($compare_ids) != 0): ?>
    		<?php $args = array(
    			'post_type' => 'inventory',
    			'post_status' => 'publish',
    			'posts_per_page' => 3,
    
    			'post__in' => $compare_ids,
    		);
    		$compares = new WP_Query($args);
    
    		if($compares->have_posts()): ?>
                <div class="row">
                    <div <?php yog_helper()->attr( false, array( 'class' => 'col-md-3 col-sm-12 col-xs-12', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                        <?php if( $yog_heading = yog_helper()->get_option( 'inventory-com-heading', 'raw', false, 'options' ) ): ?>
                            <div class="section-title clearfix">
                                <h5><?php echo esc_html( $yog_heading ); ?></h5>
                                <hr class="custom">
                            </div><!-- end section-title -->
                        <?php endif; ?>
                        <div class="car-top">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="main-feature" /> <?php  echo esc_html__( 'Hide Main Features', 'engines' ); ?>
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="additional-feature" /> <?php  echo esc_html__( 'Hide Additional Features', 'engines' ); ?>
                                </label>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-9 col-sm-12 m30">
                        <div class="row yog-compare-row">
                            <?php while($compares->have_posts()): $compares->the_post(); $counter++; 
                                        $yog_sale_price = get_post_meta( get_the_ID(), 'inv_sale_price', true );
                                        $yog_price = get_post_meta( get_the_ID(), 'inv_price', true );
                            
                            
                            ?>
                                <div class="col-md-4 col-sm-4 col-xs-12 compare-yog-header-<?php echo esc_attr(get_the_ID()); ?>" <?php yog_helper()->attr( false, array( 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                                    <div class="comparebox clearfix">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); ?></a>
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
                                        <div
                    						class="car-action-unit remove-from-compare btn btn-primary pull-right"
                    						data-id="<?php echo esc_attr(get_the_id()); ?>"
                    						data-title="<?php the_title(); ?>"
                                            data-action="remove">
                    						<i class="fa fa-minus"></i>
                    						<?php esc_html_e('Remove from list', 'engines'); ?>
                    					</div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php for($i=0; $i<$empty_cars; $i++){?>
        						<div <?php yog_helper()->attr( false, array( 'class' => 'col-md-4 col-sm-4 col-xs-12', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                                    <div class="comparebox clearfix">
                                        <a href="#">
                                            <h3><?php echo esc_html__( 'Add to Compare', 'engines' ); ?></h3>
                                            <img src="<?php echo esc_url( yog()->load_theme_assets('images/compare_empty.png') )?>" alt="" class="img-responsive" />
                                        </a>
                                    </div>
        						</div>
        					<?php } ?>
                        </div>
                    </div>
                </div><hr class="invis1" />
                <?php if( $yog_ads = yog_helper()->get_option( 'inventory-com-ads', 'raw', false, 'options' ) ): ?>
                    <!-- end checkwrap -->
                    <div <?php yog_helper()->attr( false, array( 'class' => 'banner-wrapper', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                        <a href="<?php echo yog_helper()->get_option( 'inventory-com-ads-link', 'url', false, 'options' ); ?>"><img src="<?php echo esc_url( $yog_ads['url'] ); ?>" alt="<?php echo esc_url( $yog_ads['alt'] ); ?>" class="img-responsive"></a>
                    </div>  <hr class="invis1" />
                <?php endif; ?> 
            <?php endif; ?>
            <?php if($compares->have_posts()): ?>
                <div <?php yog_helper()->attr( false, array( 'class' => 'row comparetable main-features', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                    <div class="col-md-12">
                        <h4><?php echo esc_html__( 'Main Features', 'engines' ); ?></h4>
                        <div class="row yog-compare-body">
                            <div class="col-md-3">
                                <table class="table">
                                    <tbody>
                                         <tr>
                                            <td class="col-md-3"><?php echo esc_html__( 'Body', 'engines' ); ?></td>
                                         </tr>
                                         <tr>
                                            <td class="col-md-3"><?php echo esc_html__( 'Model', 'engines' ); ?></td>
                                         </tr>
                                         <tr>
                                            <td class="col-md-3"><?php echo esc_html__( 'Mileage', 'engines' ); ?></td>
                                         </tr>
                                         <tr>   
                                            <td class="col-md-3"><?php echo esc_html__( 'Fuel Type', 'engines' ); ?></td>
                                         </tr>
                                         <tr>  
                                            <td class="col-md-3"><?php echo esc_html__( 'Engine', 'engines' ); ?></td>
                                         </tr>
                                         <tr>   
                                            <td class="col-md-3"><?php echo esc_html__( 'Reg.Year', 'engines' ); ?></td>
                                         </tr>
                                         <tr>  
                                            <td class="col-md-3"><?php echo esc_html__( 'Transmission', 'engines' ); ?></td>
                                         </tr>
                                         <tr>  
                                            <td class="col-md-3"><?php echo esc_html__( 'Fuel Economy', 'engines' ); ?></td>
                                         </tr>
                                         <tr>                                              
                                            <td class="col-md-3"><?php echo esc_html__( 'Exterior Color', 'engines' ); ?></td>
                                         </tr>
                                         <tr>                                              
                                            <td class="col-md-3"><?php echo esc_html__( 'Interior Color', 'engines' ); ?></td>
                                         </tr>
                                     </tbody>
                                </table>
                            </div>
                            <?php while($compares->have_posts()): $compares->the_post(); ?>
                                <?php 
                                
                                    //Fuel Category.
                                    $yog_body = yog_get_taxonomies( get_the_ID(), 'body' );
                                    $yog_model = yog_get_taxonomies( get_the_ID(), 'model' );
                                    $yog_fuel_types = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                                    $yog_engine = yog_get_taxonomies( get_the_ID(), 'engine' );
                                    $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'registration_year' );
                                    $yog_fuel_consumption = yog_get_taxonomies( get_the_ID(), 'fuel_consumption' );
                                    $yog_transmission = yog_get_taxonomies( get_the_ID(), 'transmission' );
                                    $yog_exterior_color = yog_get_taxonomies( get_the_ID(), 'exterior_color' );
                                    $yog_interior_color = yog_get_taxonomies( get_the_ID(), 'interior_color' );
                                    $yog_fuel_economy = yog_get_taxonomies( get_the_ID(), 'fuel_economy' );
                                    $yog_inv_mileage = get_post_meta( get_the_ID(), 'inv_mileage', true );
                                    
                                ?>
                                <div class="col-md-3 compare-yog-body-<?php echo esc_attr(get_the_ID()); ?>">
                                     <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><strong><?php echo join( ', ', $yog_body ); ?></strong></td>
                                             </tr>
                                             <tr>
                                                <td><strong><?php echo join( ', ', $yog_model ); ?></strong></td>
                                             </tr>
                                             <tr>   
                                                <td><strong><?php echo esc_html( $yog_inv_mileage ); ?></strong></td>
                                             </tr>
                                             <tr>   
                                                <td><strong><?php echo join( ', ', $yog_fuel_types ); ?></strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong><?php echo join( ', ', $yog_engine ); ?></strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong><?php echo join( ', ', $yog_reg_year ); ?></strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong><?php echo join( ', ', $yog_transmission ); ?></strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong><?php echo join( ', ', $yog_fuel_economy ); ?></strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong><?php echo join( ', ', $yog_exterior_color ); ?></strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong><?php echo join( ', ', $yog_interior_color ); ?></strong></td>
                                             </tr>
                                        </tbody>
                                     </table>
                                </div>
                             <?php endwhile; ?>
                             <?php wp_reset_postdata(); ?>       
                             <?php for($i=0; $i<$empty_cars; $i++){?>
                                <div class="col-md-3">
                                    <table class="table text-center">
                                        <tbody>
                                             <tr>
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>   
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>   
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>  
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong>----------</strong></td>
                                             </tr>
                                             <tr>                                              
                                                <td><strong>----------</strong></td>
                                             </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>  
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: //If empty cars, just everything without cars =) ?>
            <div class="row">
                <div <?php yog_helper()->attr( false, array( 'class' => 'col-md-3 col-sm-12', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                    <?php if( $yog_heading = yog_helper()->get_option( 'inventory-com-heading', 'raw', false, 'options' ) ): ?>
                        <div class="section-title clearfix">
                            <h5><?php echo esc_html( $yog_heading ); ?></h5>
                            <hr class="custom">
                        </div><!-- end section-title -->
                    <?php endif; ?>
                    <div class="car-top">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="main-feature" /> <?php  echo esc_html__( 'Hide Main Features', 'engines' ); ?>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="additional-feature" /> <?php  echo esc_html__( 'Hide Additional Features', 'engines' ); ?>
                            </label>
                        </div>
                    </div>     
                </div><!-- end col -->
                <div class="col-md-9 col-sm-12 m30">
                    <div class="row">
                        <?php for($i=0; $i<$empty_cars; $i++){?>
							<div <?php yog_helper()->attr( false, array( 'class' => 'col-md-4 col-sm-4 col-xs-12', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                                <div class="comparebox clearfix">
                                    <a href="#">
                                        <h3><?php echo esc_html__( 'Add to Compare', 'engines' ); ?></h3>
                                        <img src="<?php echo esc_url( yog()->load_theme_assets('images/compare_empty.png') )?>" alt="" class="img-responsive" />
                                    </a>
                                </div>
							</div>
						<?php } ?>
                    </div>
                </div>
            </div><hr class="invis1" />
            <?php if( $yog_ads = yog_helper()->get_option( 'inventory-com-ads', 'raw', false, 'options' ) ): ?>
                <!-- end checkwrap -->
                <div <?php yog_helper()->attr( false, array( 'class' => 'banner-wrapper', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                    <a href="<?php echo yog_helper()->get_option( 'inventory-com-ads-link', 'url', false, 'options' ); ?>"><img src="<?php echo esc_url( $yog_ads['url'] ); ?>" alt="<?php echo esc_url( $yog_ads['alt'] ); ?>" class="img-responsive"></a>
                </div>  <hr class="invis1" />
            <?php endif; ?> 
    
            <div <?php yog_helper()->attr( false, array( 'class' => 'row comparetable main-features', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
                <div class="col-md-12">
                    <h4><?php echo esc_html__( 'Main Features', 'engines' ); ?></h4>
                    <div class="row yog-compare-body">
                        <div class="col-md-3">
                            <table class="table">
                                <tbody>
                                     <tr>
                                        <td class="col-md-3"><?php echo esc_html__( 'Body', 'engines' ); ?></td>
                                     </tr>
                                     <tr>
                                        <td class="col-md-3"><?php echo esc_html__( 'Model', 'engines' ); ?></td>
                                     </tr>
                                     <tr>
                                        <td class="col-md-3"><?php echo esc_html__( 'Mileage', 'engines' ); ?></td>
                                     </tr>
                                     <tr>   
                                        <td class="col-md-3"><?php echo esc_html__( 'Fuel Type', 'engines' ); ?></td>
                                     </tr>
                                     <tr>  
                                        <td class="col-md-3"><?php echo esc_html__( 'Engine', 'engines' ); ?></td>
                                     </tr>
                                     <tr>   
                                        <td class="col-md-3"><?php echo esc_html__( 'Reg.Year', 'engines' ); ?></td>
                                     </tr>
                                     <tr>  
                                        <td class="col-md-3"><?php echo esc_html__( 'Transmission', 'engines' ); ?></td>
                                     </tr>
                                     <tr>  
                                        <td class="col-md-3"><?php echo esc_html__( 'Fuel Economy', 'engines' ); ?></td>
                                     </tr>
                                     <tr>                                              
                                        <td class="col-md-3"><?php echo esc_html__( 'Exterior Color', 'engines' ); ?></td>
                                     </tr>
                                     <tr>                                              
                                        <td class="col-md-3"><?php echo esc_html__( 'Interior Color', 'engines' ); ?></td>
                                     </tr>
                                 </tbody>
                            </table>
                        </div>
                            
                        <?php for($i=0; $i<$empty_cars; $i++){?>
                            <div class="col-md-3">
                                <table class="table text-center">
                                    <tbody>
                                         <tr>
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>   
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>   
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>  
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>  
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>  
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>                                              
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>                                              
                                            <td><strong>----------</strong></td>
                                         </tr>
                                         <tr>                                              
                                            <td><strong>----------</strong></td>
                                         </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>  
                        <?php wp_reset_postdata(); ?>  
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!--Additional features-->
		<?php if(!empty($compares)): ?>
			<?php if($compares->have_posts()): ?>
				<hr class="invis2">
                <div <?php yog_helper()->attr( false, array( 'class' => 'row comparetable additional-features row', 'data-animation' => $yog_animation, 'data-animation-delay' => $yog_delay ) ); ?>>
					<div class="col-md-3 col-sm-3">
						<h4 class="stm-compare-features"><?php echo esc_attr('Additional features', 'engines'); ?></h4>
					</div>
					<?php while($compares->have_posts()): $compares->the_post(); ?>
						<?php $features =  get_post_meta(get_the_ID(), 'inv_extra_features', true); ?>
						<?php if(!empty($features)): ?>
							<div class="col-md-3 col-sm-3 compare-yog-footer-<?php echo esc_attr(get_the_ID()); ?>">
								<?php $features = explode(',', $features); ?>
								<ul class="car-list-wrapper-2">
									<?php foreach($features as $feature): ?>
										<li><i class="fa fa-angle-double-right"></i> <?php echo esc_attr($feature); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>

				</div>
			<?php endif; ?>
		<?php endif; ?>
    </div>
</div>

<div class="compare-empty-car-top" style="display: none;">
    <div class="col-md-4 col-sm-4 col-xs-12 wow fadeIn" >
        <div class="comparebox clearfix">
            <a href="#">
                <h3><?php echo esc_html( 'Add to compare', 'engines' ); ?></h3>
                <img src="<?php echo esc_url( yog()->load_theme_assets('images/compare_empty.png') )?>" alt="" class="img-responsive" />
            </a>
        </div>
    </div>
</div>

<div class="compare-empty-car-bottom" style="display: none;">
    <div class="col-md-3">
        <table class="table text-center">
            <tbody>
                 <tr>
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>   
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>   
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>  
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>  
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>  
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>                                              
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>                                              
                    <td><strong>----------</strong></td>
                 </tr>
                 <tr>                                              
                    <td><strong>----------</strong></td>
                 </tr>
            </tbody>
        </table>
    </div>
</div>