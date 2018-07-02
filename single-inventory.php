<?php
/**
 * The template for displaying all single inventory and attachments
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.3
 */
 
 get_header(); 
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <?php
                    if ( have_posts() ) :
                
                        // Start the loop.
                		while ( have_posts() ) : the_post();   
                        
                            //Inventory Toxonomies.
                            $yog_body = yog_get_taxonomies( get_the_ID(), 'body' );
                            $yog_fuel_types = yog_get_taxonomies( get_the_ID(), 'fuel_type' );
                            $yog_engine = yog_get_taxonomies( get_the_ID(), 'engine' );
                            $yog_reg_year = yog_get_taxonomies( get_the_ID(), 'registration_year' );
                            $yog_fuel_consumption = yog_get_taxonomies( get_the_ID(), 'fuel_consumption' );
                            $yog_transmission = yog_get_taxonomies( get_the_ID(), 'transmission' );
                            $yog_exterior_color = yog_get_taxonomies( get_the_ID(), 'exterior_color' );
                            $yog_interior_color = yog_get_taxonomies( get_the_ID(), 'interior_color' );
                            $yog_fuel_economy = yog_get_taxonomies( get_the_ID(), 'fuel_economy' );
                            
                            //Inventory Meta Data
                            $yog_technical_lists = get_post_meta( get_the_ID(), 'inv_technical_lists', true );
                            $yog_offer_lists = get_post_meta( get_the_ID(), 'inv_offer_lists', true );
                            $yog_features =  get_post_meta(get_the_ID(), 'inv_extra_features', true);
                            $yog_kilometres = get_post_meta( get_the_ID(), 'inv_kilometres_mpg', true );
                            $yog_vin = get_post_meta( get_the_ID(), 'inv_vin', true );
                            $yog_mileage = get_post_meta( get_the_ID(), 'inv_mileage', true );
                            $yog_image_banner = get_post_meta( get_the_ID(), 'inv_image_banner', true );
                            $yog_image_banner_url = get_post_meta( get_the_ID(), 'inv_image_banner_url', true );
                            $yog_reg_price = get_post_meta( get_the_ID(), 'inv_price', true );
                        	$yog_sale_price = get_post_meta( get_the_ID(), 'inv_sale_price', true );
                            $yog_profile_book = get_post_meta( get_the_ID(), 'inv_profile_book', true );
                            $yog_manual_book = get_post_meta( get_the_ID(), 'inv_manual_book', true );
                           
                            
                    ?>
                    <div class="col-md-9 col-sm-12">
                        <div class="single-car-wrapper  clearfix">
                            <div class="single-thumb">
                                <div class="overlay"></div>
                                <?php
                                    //Gallery
                        		    $yog_attachments = get_post_meta( get_the_ID(), 'inv_image_gallery', true );
                                    if ($yog_attachments) {
                                        $ids = explode( ',', $yog_attachments );
                                ?>
                                    <div id="slider">
                                        <div id="carousel-bounding-box">
                                            <div id="myCarousel" class="carousel slide">
                                                <!-- main slider carousel items -->
                                                <div class="carousel-inner">
                                                    <div class="overlay"></div>
                                                    <?php 
                                                        $yog_counter = 0;
                                                        foreach ($ids as $id) {
                                                            $yog_cls = ( $yog_counter == 0 )? ' active' : '';
                                                            echo '<div class="item'. esc_attr( $yog_cls ) .'" data-slide-number="'. esc_attr( $yog_counter ) .'">'. wp_get_attachment_image($id, 'full', false, array( 'class' => 'img-responsive' ) ). '</div>';
                                                    	    $yog_counter++;
                                                        }
                                                    ?> 
                                                </div>
                                                <a class="carousel-control left" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                                <a class="carousel-control right" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                     <!-- thumb navigation carousel -->
                                    <div class="row" id="slider-thumbs">
                                        <!-- thumb navigation carousel items -->
                                        <ul class="list-inline">
                                            <?php 
                                                $yog_counter = 0;
                                                foreach ($ids as $id) {
                                                    $yog_select = ( $yog_counter == 0 )? 'class="selected"' : '';
                                                    echo '<li class="col-md-15 col-sm-15 col-xs-6"><a id="carousel-selector-'. esc_attr( $yog_counter ) .'" '. $yog_select .'>'. wp_get_attachment_image($id, 'full', false, array( 'class' => 'img-responsive' ) ). '</a></li>';
                                                    $yog_counter++;
                                                }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                <?php 
                                    }elseif( has_post_thumbnail() ){
                                        echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive' ) ); 
                                    }
                                    
                                    //Test Drive Form
                                    if( yog_helper()->get_option( 'inventory-test-drive', 'raw', false, 'options' ) ){ 
                                ?>
                                    <div class="single-popup" id="1">
                    					<div class="popup-close"><i class="fa fa-times"></i></div>
                    				
                    					<div class="head text-center">
                    						<h3><?php echo yog_helper()->get_option( 'inventory-test-drive-heading', 'raw', esc_html__( 'Schedule a Test Drive', 'engines' ), 'options' );?></h3>
                    						<p><?php the_title(); ?></p>
                    					</div>
                    		            
                                        <?php 
                                            if( $yog_driv_form = yog_helper()->get_option( 'inventory-test-drive-shortcode', 'raw', false, 'options' ) ){
                                                echo do_shortcode( $yog_driv_form );
                                            }
                                        ?>  
                    				</div>
                                <?php } ?>
                            </div>
                            
                            <div class="car-description clearfix">
                                <?php 
                                    //Test Drive Form
                                    if( yog_helper()->get_option( 'inventory-test-drive', 'raw', false, 'options' ) ){ 
                                        echo '<a href="#" class="btn btn-default btn-block test-drive">'. yog_helper()->get_option( 'inventory-test-drive-btn', 'raw', esc_html__( 'Take a test drive', 'engines'), 'options' ) .'</a>';
                                    }
                                    
                                    //Title
                                    the_title( '<h3 '. yog_helper()->get_attr( 'entry-title' ) .' >', '</h3>' );
                                    
                                    //Content
                                    the_content(); 
                                ?>
                            </div><!-- end desc -->
                            <?php if( yog_helper()->get_option( 'inventory-single-key-features', 'raw', false, 'options' ) ): ?>
                                    <div class="car-table clearfix">
                                        <p><?php printf( yog_get_translation( 'tr-inv-single-fatures' ), get_the_title() ); ?></p>
                                        <i class="fa fa-angle-down"></i>
                                    </div><!-- end car-table --> 
                                    <div class="table-responsive">
                                        <table class="table car-table-wrapper">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        //Body
                                                        if( isset( $yog_body ) && !empty( $yog_body ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-body' ),  join( ', ', $yog_body ) );
                                                        }
                                                        
                                                        //Transmission
                                                        if( isset( $yog_transmission ) && !empty( $yog_transmission ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-transmission' ),  join( ', ', $yog_transmission ) );
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        //Kilometres
                                                        if( isset( $yog_kilometres ) && !empty( $yog_kilometres ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-km' ),   $yog_kilometres );
                                                        }
                                                        
                                                        //Engine
                                                        if( isset( $yog_engine ) && !empty( $yog_engine ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-engine' ),  join( ', ', $yog_engine ) );
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        //Fuel Type
                                                        if( isset( $yog_fuel_types ) && !empty( $yog_fuel_types ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-fuel' ),  join( ', ', $yog_fuel_types ) );
                                                        }
                                                        
                                                        //Mileage
                                                        if( isset( $yog_mileage ) && !empty( $yog_mileage ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-mileage' ),  $yog_mileage );
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        //Reg.Year
                                                        if( isset( $yog_reg_year ) && !empty( $yog_reg_year ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-reg' ),  join( ', ', $yog_reg_year ) );
                                                        }
                                                        
                                                        //Vin
                                                        if( isset( $yog_vin ) && !empty( $yog_vin ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-vin' ),  $yog_vin );
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        //Fuel Economy
                                                        if( isset( $yog_fuel_economy ) && !empty( $yog_fuel_economy ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-fuel-economy' ),  join( ', ', $yog_fuel_economy ) );
                                                        }
                                                        
                                                        //Fuel Economy
                                                        if( isset( $yog_fuel_economy ) && !empty( $yog_fuel_economy ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-fuel-economy' ),  join( ', ', $yog_fuel_economy ) );
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        //Exterior Color
                                                        if( isset( $yog_exterior_color ) && !empty( $yog_exterior_color ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-exterior-color' ),  join( ', ', $yog_exterior_color ) );
                                                        }
                                                        
                                                        //Exterior Color
                                                        if( isset( $yog_interior_color ) && !empty( $yog_interior_color ) ){
                                                            printf( '<td>%s</td><td><strong>%s</strong></td>',yog_get_translation( 'tr-inv-single-feature-interior-color' ),  join( ', ', $yog_interior_color ) );
                                                        }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- end table-responsive -->    
                                <?php 
                                    endif; //End Feature Check
                                    
                                    if( yog_helper()->get_option( 'inventory-single-technical', 'raw', false, 'options' ) && isset( $yog_technical_lists ) && !empty( $yog_technical_lists ) ):
                                ?>
                                    <div class="car-table clearfix">
                                        <p><?php printf( yog_get_translation( 'tr-inv-single-technical' ), get_the_title() ); ?></p>
                                        <i class="fa fa-angle-down"></i>
                                    </div><!-- end car-table -->    
                                    <?php
                                        if( isset( $yog_technical_lists ) && !empty( $yog_technical_lists ) ){
                                            $yog_args = array(
                                                'post_type' => 'bucket',
                                                'p' => $yog_technical_lists
                                            );
                                            $yog_query = new WP_Query( $yog_args );
                                            while( $yog_query->have_posts() ) {
                                                $yog_query->the_post();
                                                the_content( esc_html__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'engines' ) );
                                            }
                                        }  
                                    
                                    endif; //End Technical
                                    
                                    if( yog_helper()->get_option( 'inventory-single-extra-feature', 'raw', false, 'options' ) && !empty( $yog_features ) ):
                                ?>
                                    <div class="car-table clearfix">
                                        <p><?php printf( yog_get_translation( 'tr-inv-single-extra-feature' ), get_the_title() ); ?></p>
                                        <i class="fa fa-angle-down"></i>
                                    </div><!-- end car-table -->    
                                <?php
                                    $yog_features = explode(',', $yog_features);
                                    $yog_total_features =  count(  $yog_features );
                                    $yog_divider = $yog_total_features / 3;
                                    $yog_counter = 1;
                                    echo '<div class="row-fluid row-content clearfix">';
                                    foreach( $yog_features as $feature ){
                                        if( $yog_counter == 1 || $yog_counter == $yog_divider ){
                                            echo '<div class="col-md-4 col-sm-4 col-xs-12"><ul class="normallist">';
                                        }
                                        echo '<li><i class="fa fa-check"></i> <strong>'. esc_html( $feature ) .'</strong></li>';
                                        if( $yog_counter == 1 || $yog_counter == $yog_divider ){
                                            echo '</ul></div>';
                                        }
                                    }
                                    echo '</div>';
                                    
                                endif; //End Extra Feature
                                
                                if( yog_helper()->get_option( 'inventory-single-offer', 'raw', false, 'options' ) && isset( $yog_offer_lists ) && !empty( $yog_offer_lists ) ):
                                ?>
                                    <div class="banner-wrapper clearfix">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7">
                                                <div class="banner-message">
                                                    <span><?php the_title(); ?></span>
                                                    <small class="badge"><?php echo yog_helper()->get_option( 'inventory-single-offer-heading', 'html', false, 'options' ); ?></small>
                                                    <?php 
                                                        $yog_args = array(
                                                            'post_type' => 'bucket',
                                                            'p' => $yog_offer_lists
                                                        );
                                                        $yog_query = new WP_Query( $yog_args );
                                                        while( $yog_query->have_posts() ) {
                                                            $yog_query->the_post();
                                                            the_content( esc_html__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'engines' ) );
                                                        }
                                                    ?>
                                                </div><!-- end message -->
                                            </div><!-- end col -->
                                            <?php if( $yog_image_banner ): ?>
                                                <div class="col-md-5 col-sm-5">
                                                    <a href="<?php echo esc_url( $yog_image_banner_url ); ?>"><img src="<?php echo esc_url( $yog_image_banner['url'] ); ?>" alt="" class="img-responsive"></a>
                                                </div><!-- end col -->
                                            <?php endif; ?>
                                        </div><!-- end row -->
                                    </div><!-- end banner-wrapper -->
        
                                    <hr class="invis" />
                                <?php 
                                    endif; // End Offers 
                                    if( yog_helper()->get_option( 'inventory-single-contact-form', 'raw', false, 'options' ) ):
                                ?>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div class="section-title clearfix">
                                                <h5><?php echo yog_get_translation( 'tr-inv-single-contact-heading' ); ?></h5>
                                                <hr class="custom">
                                            </div><!-- end section-title -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                            //Contact Form Seven.
                                            if( yog_helper()->get_option( 'inventory-single-contact-form', 'raw', false, 'options' ) ):
                                                if( $yog_contact_shortcode = yog_helper()->get_option( 'inventory-single-contact-shortcode', 'raw', false, 'options' ) ){
                                                    ?>
                                                      <div class="col-md-8">
                                                        <div class="search-tab lightversion clearfix">
                                                            <div class="search-wrapper">
                                                                <?php echo do_shortcode( $yog_contact_shortcode ); ?>
                                                            </div>
                                                          </div>
                                                       </div>
                                                    <?php
                                                }
                                            endif; //End Contact Form Seven.
                                        
                                            //Contact Details.
                                            if( yog_helper()->get_option( 'inventory-single-contact', 'raw', false, 'options' ) ):
                                               ?>
                                               <div class="col-md-4 col-sm-4 col-xs-12 m30">
                                                    <div class="contact-departments contact-version clearfix">
                                                        <ul class="contact-widget clearfix"> 
                                                            <?php
                                                                //Address 
                                                                if( $yog_address = yog_helper()->get_option( 'inventory-single-contact-address', 'raw', false, 'options' ) ):
                                                                    printf( '<li><i class="fa fa-map-marker alignleft"></i> <strong>%s</strong> %s</li>', yog_get_translation( 'tr-inv-single-contact-address' ), wp_kses( $yog_address, array( 'br' => array() ) ) );
                                                                endif; 
                                                                
                                                                //Email 
                                                                if( $yog_email = yog_helper()->get_option( 'inventory-single-contact-email', 'raw', false, 'options' ) ):
                                                                    printf( '<li><i class="fa fa-envelope-o alignleft"></i> <strong>%s</strong> %s</li>', yog_get_translation( 'tr-inv-single-contact-email' ), esc_html( $yog_email ) );
                                                                endif; 
                                                                
                                                                //Phone 
                                                                if( $yog_phone = yog_helper()->get_option( 'inventory-single-contact-phone', 'raw', false, 'options' ) ):
                                                                    printf( '<li><i class="fa fa-phone alignleft"></i> <strong>%s</strong> %s</li>', yog_get_translation( 'tr-inv-single-contact-phone' ), esc_html( $yog_phone ) );
                                                                endif; 
                                                                
                                                                //Fax 
                                                                if( $yog_fax = yog_helper()->get_option( 'inventory-single-contact-fax', 'raw', false, 'options' ) ):
                                                                    printf( '<li><i class="fa fa-fax alignleft"></i> <strong>%s</strong> %s</li>', yog_get_translation( 'tr-inv-single-contact-fax' ), esc_html( $yog_fax ) );
                                                                endif; 
                                                            ?>
                                                        </ul>
                                                    </div>
                                               </div>
                                            <?php
                                        endif; //End Contact Details
                                    
                                    endif; //End Contact Heading
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="custom-sidebar col-md-3 col-sm-12">
                        <?php if( yog_helper()->get_option( 'inventory-single-manual', 'raw', false, 'options' ) && ( $yog_profile_book || $yog_manual_book ) ): ?>
                            <div class="widget custom-widget clearfix">
                                <?php if( $yog_man_heading = yog_helper()->get_option( 'inventory-single-manual-heading', 'raw', false, 'options' ) ): ?>
                                    <div class="section-title clearfix">
                                        <h5><?php echo esc_html( $yog_man_heading ); ?></h5>
                                        <hr class="custom">
                                    </div><!-- end section-title -->
                                <?php endif; ?>
                                <div class="brochures">
                                    <?php 
                                        if( $yog_profile_book ){
                                            echo '<a href="'. esc_url( $yog_profile_book['url'] ) .'" download><i class="fa fa-file-pdf-o"></i> '. esc_html__( 'Car Manual Book.pdf', 'engines' ) .'</a><hr class="invis2">';
                                        }
                                        if( $yog_manual_book ){
                                            echo '<a href="'. esc_url( $yog_manual_book['url'] ) .'" download><i class="fa fa-file-pdf-o"></i> '. esc_html__( 'Engines Profile.pdf', 'engines' ) .'</a>';
                                        }
                                    ?>
                                </div><!-- end brochures -->
                            </div><!-- end widget -->
                        <?php
                            endif;
                             
                            if( yog_helper()->get_option( 'inventory-single-calculator', 'raw', false, 'options' ) ):
                            	$yog_symbol = yog_helper()->get_option( 'inventory-price-currency', 'raw', '$', 'options' );
                                $yog_price = '';
                            	if(!empty($yog_sale_price)) {
                            		$yog_price = $yog_sale_price;
                            	} elseif(!empty($yog_reg_price)) {
                            		$yog_price = $yog_reg_price;
                            	} else {
                            		$yog_price = '';
                            	}
                                
                                //Form Vaildation error msg
                                $yog_validation_msg = array();
                                $yog_validation_msg['price'] = esc_html__('Please fill Vehicle Price field', 'engines');
                                $yog_validation_msg['down_payment'] = esc_html__('Please fill Down Payment field', 'engines');
                                $yog_validation_msg['down_payment_exd'] = esc_html__('Down payment can not be more than vehicle price', 'engines');
                                $yog_validation_msg['month'] = esc_html__('Please fill Period field', 'engines');
                                $yog_validation_msg['interest_rate'] = esc_html__('Please fill Interest Rate field', 'engines');

                            ?>
                            <div class="widget custom-widget clearfix">
                                <div class="calculator loan-calculator" data-currency="<?php echo $yog_symbol; ?>" data-vaildation='<?php echo json_encode( $yog_validation_msg ); ?>'>
                                    <?php if( $yog_cal_heading = yog_helper()->get_option( 'inventory-single-calculator-heading', 'raw', false, 'options' ) ): ?>
                                        <div class="calculator-title">
                                            <h4><?php echo esc_html( $yog_cal_heading ); ?></h4>
                                        </div><!-- end title -->
                                    <?php endif; ?>
                                    <div class="search-tab light-tab calculator-body">
                                        <div class="search-wrapper">
                                            <form class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-input">    
                                                        <label><?php printf( '%s (%s)', yog_get_translation( 'tr-inv-cal-price' ), $yog_symbol ); ?></label>
                                                        <input type="text" class="numbersOnly vehicle_price form-control" value="<?php echo esc_attr($yog_price); ?>"/>
                                                    </div><!-- end form-input -->
                                                    <div class="form-input">
                                                        <label><?php printf( '%s (%s)', yog_get_translation( 'tr-inv-cal-down-payment' ), $yog_symbol ); ?></label>
                                                        <input type="text" class="numbersOnly down_payment form-control" value="2000"/>
                                                    </div><!-- end form-input -->
                                                </div>
                            
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-input">
                                                        <label><?php yog_translation( 'tr-inv-cal-month' ); ?></label>
                                                        <input type="text" class="numbersOnly period_month form-control" value="12"/>
                                                    </div><!-- end form-input -->
                                                </div><!-- end col -->
                            
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-input">
                                                        <label><?php yog_translation( 'tr-inv-cal-interest' ); ?></label>
                                                        <input type="text" class="numbersOnly interest_rate form-control" value="3"/>
                                                    </div><!-- end form-input -->
                                                </div><!-- end col -->
                            
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <hr class="invis2" />
                                                    <h5><?php yog_translation( 'tr-inv-cal-result-month' ); ?></h5>
                                                    <label><p class="monthly_payment"></p></label>
                                                    <hr class="invis2" />
                                                    <h5><?php yog_translation( 'tr-inv-cal-result-interset' ); ?></h5>
                                                    <p class="total_interest_payment"></p>
                                                    <hr class="invis2" />
                                                    <h5><?php yog_translation( 'tr-inv-cal-result-amount' ); ?></h5>
                                                    <p class="total_amount_to_pay"></p>
                                                    <hr class="invis2" />
                                                    <a href="#" class="btn btn-default btn-block calculate_loan_payment"><?php yog_translation( 'tr-inv-cal-btn' ); ?></a>
                                                    <div class="calculator-alert alert alert-danger"></div>
                                                </div><!-- end col -->
                                            </form>
                                        </div><!-- end search wrapper -->
                                    </div><!-- end body -->
                                </div><!-- end calculator -->   
                            </div><!-- d widget -->
                        <?php endif; ?>
                    </div>
                    <?php 
                        endwhile;
                       
                	// If no content, include the "No posts found" template.
                	else :
                		get_template_part( 'templates/blog/content', 'none' );
                
                	endif;
                ?>
            </div>
        </div>
    </div>
    <?php
 get_footer(); 