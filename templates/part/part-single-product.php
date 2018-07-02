<div class="section">
    <div class="container cart-product">
        <!-- div class="section-title clearfix" -->
            <!-- h4 заменить h1 -->
            <!-- h1 <?php echo yog_helper()->get_attr( 'entry-title' ); ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1 -->
            <!-- <hr class="custom"> -->
        <!-- </div> -->

        <div class="row text-center">
            <div class="col-md-8 cart-product-slider">
                <!--?php echo do_shortcode('[get_sitebar_gallery id_carousel="myGallery" speed_carousel="3000" category="31" per_page="10"]'); ?-->
                <?php 
                    // вытащить галерею из single-inventory.php
                    // дописать в админку редактор галереи
                    $id_carousel = get_post_meta($post->ID, 'i_gallery', 1);
                    if ($id_carousel) { echo do_shortcode('[get_sitebar_gallery id_carousel="myGallery" speed_carousel="3000" id_img="'.$id_carousel.'" per_page="10"]'); }
                    else {
                        // просто костыль, если нет галереи
                        
                        echo "<div class='carousel-inner'>";
                        echo "<div class='item item-gallery active'>";
                        the_post_thumbnail($post->ID, medium, array( 'class' => 'img-responsive wp-post-image'));
                        echo "</div>";
                        echo "</div>";                        
                    }
                ?>
                <div class="file">
                    <i class="fa fa-file-text"></i>
                    <a href="download/advantages_of_micromorphic_technology.pdf" target="_blank">Скачать презентацию модели для подробного ознакомления</a>
                </div>
            </div>
            <div class="col-md-4 cart-product-offers">
                <h2>Основные характеристики</h2>
                <div class="row">
                    <!-- echo get_post_meta($post->ID, 'i_price', 1); -->
                    <!-- echo get_post_meta($post->ID, 'i_action', 1); -->
                    <!-- echo get_post_meta($post->ID, 'i_presentaton', 1); -->
                    <div class="col-md-8">Объем двигателя</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_volume', 1) ?></div>
                    <div class="col-md-8">Грузоподъемность</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_load', 1) ?></div>
                    <div class="col-md-8">Трансмиссия</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_transmission', 1) ?></div>
                    <div class="col-md-8">Топливо</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_fuel', 1) ?></div>
                    <div class="col-md-8">Объем кузова</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_body', 1) ?></div>
                    <div class="col-md-8">Привод</div>
                    <div class="col-md-4"><?php echo get_post_meta($post->ID, 'i_drive', 1) ?></div>
                </div>            
                <div class="row offer">
                    <div class="col-md-6"><a class="btn_spare_select" href="#selection_of_spare_parts">Узнать цену</a></div>
                    <div class="col-md-6"><p>Получите коммерческое предложение с расчетом индивидуальной скидки</p></div>
                </div>
                <hr>
                <div class="row action">
                    <div class="col-md-12">
                        <h2>Акция месяца</h2>
                        <p>Специальные цены на двигатели в декабре!</p>
                        <p>Подробности узнавайтеу менеджеров или на сайте</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section"> 
   <div class="container cart-product-tab">
       <div class="row">
        <hr>
            <ul class="nav nav-tabs" id="myTab">
              <li class="active"><a href="#tab-1" data-toggle="tab">Описания и преимущества модели</a></li>
              <li><a href="#tab-2" data-toggle="tab">Комплектация и тех.характеристики</a></li>
              <li><a href="#tab-3" data-toggle="tab">Доп.опции</a></li>
              <li><a href="#tab-4" data-toggle="tab">Гарантия и сервис</a></li>
              <li><a href="#tab-5" data-toggle="tab">Почему в "Уралкам"?</a></li>
            </ul>
        <hr>


            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    <div class="row">
                        <div class="col-md-12 cart-product-purpose">
                            <h2>Назначение модели</h2>
                            <?php echo get_post_meta($post->ID, 'i_purpose', 1) ?>
                        </div>
                        <div class="col-md-8 cart-product-content">
                            <?php 
                            if ( have_posts() ) :                    
                                while ( have_posts() ) : the_post();
                                     the_content();
                                endwhile;                            
                            //Pagination
                                yog_wp_paginate( array( 'before' => '<div class="col-md-12 text-center">', 'after' => '</div>', 'class' => 'pagination pagination-lg', 'title' => false, 'nextpage' => '<i class="fa fa-angle-right"></i>', 'previouspage' => '<i class="fa fa-angle-left"></i>' ) );
                            else :
                                get_template_part( 'templates/page/content', 'none' );                    
                            endif; ?>                            
                        </div>
                        <div class="col-md-4 cart-product-content">
                            <div class=""></div>
                            <div class="cart-product-video">
                                <?php echo get_post_meta($post->ID, 'i_video', 1) ?>                                
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="tab-pane" id="tab-2">2...</div>
                <div class="tab-pane" id="tab-3">3...</div>
                <div class="tab-pane" id="tab-4">4...</div>
                <div class="tab-pane" id="tab-5">5...</div>
            </div>
        </div>
    </div>
</div>

