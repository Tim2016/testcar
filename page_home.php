<?php
 /*
    Template Name: Home
    ID news-kamaz 32
    ID news-uralkam 33
*/

get_header(); 

    // var
    $site_host ="http://hyip-info.ru";
    $my_cat_id = [
        'mytopslider'=>'20',
        'myThree'=>'18,25,26',
        'myGallery'=>'17',
        'news_kamaz'=>'32',
        'news_uralkam'=>'33',
    ];
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    
    //Blog Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-enable-global', 'raw', false, 'options' ); 
    $yog_layout   = yog_helper()->get_option( 'blog-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

?>
<!-- категория слайдера 20 -->
<?php echo do_shortcode('[get_top_slider id_carousel="mytopslider" speed_carousel="12000" category="'.$my_cat_id['mytopslider'].'" per_page="10"]'); ?>        
<div class="top-slider-indent"></div>


<div class="container">
    <div class="row">
        <div class="tmp-fluid-statistic" style="height: 370px; width: 100%;"></div>        
        <div class="col-md-12">    
            <div class="row box-indicators-two">
                <div class="section-title clearfix text-center lightcolor">
                    <h4>УРАЛКАМ в цифрах</h4>
                    <hr class="custom">
                </div>

                <div class="col-md-2 one-bar">
                    <p><span>17 лет</span> успешной работы</p>
                </div>
                <div class="col-md-2">
                    <p><span>4677</span> единиц техники продано</p>
                </div>
                <div class="col-md-2">
                    <p><span>1140</span> довольных клиентов</p>
                </div>
                
                <div class="col-md-2">
                    <p><span>4000</span> позиций оригинальных запчастей в наличии</p>            
                </div>

                <div class="col-md-2">
                    <p><span>16</span> ремпостов в нашем сервисном центре</p>
                </div>

                <div class="col-md-2">
                    <p><span>65000</span> километров пробега гарантия на технику</p>
                </div>
            </div>
        </div>
        <!-- <div class="tmp-fluid-statistic" style="height: 500px; width: 100%;"></div> -->
    </div>
</div>


<div class="container box-product">
    <div class="section-title clearfix text-center lightcolor">
        <h4>Наша техника и услуги</h4>
        <hr class="custom">
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a1.jpg" alt="" class="img-responsive"><div><span>Бортовые автомобили</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a2.jpg" alt="" class="img-responsive"><div><span>Самосвалы</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a3.jpg" alt="" class="img-responsive"><div><span>Седельные тягачи</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a4.jpg" alt="" class="img-responsive"><div><span>Спецтехника</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a5.jpg" alt="" class="img-responsive"><div><span>Шасси</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a6.jpg" alt="" class="img-responsive"><div><span>Прицепная техника</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a7.jpg" alt="" class="img-responsive"><div><span>Автобусы</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a8.jpg" alt="" class="img-responsive"><div><span>Автомобили с пробегом</span></div></a></div>
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a9.jpg" alt="" class="img-responsive"><div><span>Опции</span></div></a></div>  
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a10.jpg" alt="" class="img-responsive"><div><span>Сервисный центр</span></div></a></div>  
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a11.jpg" alt="" class="img-responsive"><div><span>Оригинальные запчасти</span></div></a></div>  
        <div class="col-md-4 col-sm-6"><a href=""><img src="<?php echo $site_host ?>/wp-content/themes/engines/img/box-product/a10.jpg" alt="" class="img-responsive"><div><span>Сервисный центр</span></div></a></div>  
    </div>
</div>


<div class="container box-loading-catalog">
    <div class="row">
        <div class="col-md-offset-1 col-md-2 text-center">
            <i class="fa fa-file-text"></i>            
        </div>
        <div class="col-md-6">            
            <span>Скачайте каталог-презентацию для ознакомления с ассортиментом и характеристиками</span>
        </div>
        <div class="col-md-3 text-center"> 
            <span>                
                <a href="">Скачать каталог продукции</a>
                <a href="">Скачать каталог запчастей</a>
            </span>     
        </div>
    </div>
</div>


<div class="container box-sales-leader">    
    <div class="row">
        <div class="col-md-12 tmp-fluid"></div>
        <div class="col-md-12">
            <div class="section-title clearfix text-center lightcolor">
                <h4>Новинки и лидеры продаж</h4>
                <hr class="custom">
            </div>
            <!-- 25,28,29,30 -->
            <!-- 18 на хостинге -->
            <?php echo do_shortcode('[get_sitebar_three id_carousel="myThree" speed_carousel="1000" category="'.$my_cat_id['myThree'].'" per_page="20"]'); ?>
        </div>
        <!-- <div style="height: 400px; width: 100%;"></div> -->
    </div>
</div>


<div class="container box-about">
    <div class="section-title clearfix text-center lightcolor">
        <h4>О нашей компании</h4>
        <hr class="custom">
    </div>
    <div class="row">
        <div class="col-md-6">  
            <p>ООО "Компания УРАЛКАМ﻿" начала свою работу в  2000 году и с этого времени является официальным дилером ПАО "КАМАЗ" в Челябинской области, а так же Ямало-Ненецком автономном округе.</p>
            <p>ООО "Компания УРАЛКАМ" осуществляет свою деятельность на Уральском рынке тяжелых грузовых автомобилей класса "КАМАЗ", путем реализации и сервисного обслуживания техники Камского автомобильного завода.</p>
            <p>ООО "Компания УРАЛКАМ" поставляет на рынок автомобили "КАМАЗ" любой модификации и комплектации, а также реализует прицепную технику, номерные агрегаты, узлы, ремонтные комплекты и сертифицированные оригинальные детали завода.</p>                     
        </div>
        <div class="col-md-6">            
            <!-- 26 -->
            <p><?php echo do_shortcode('[get_sitebar_gallery id_carousel="myGallery" speed_carousel="9000" category="'.$my_cat_id['myGallery'].'" per_page="10"]'); ?></p>
        </div>
    </div>
</div>

<?php get_template_part( 'templates/part/part', 'offer' ); ?>
<?php get_template_part( 'templates/part/part', 'partners' ); ?>

<div class="section">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <div class="section-title clearfix text-center">
            <h4>Преимущества работы с УРАЛКАМ</h4>
            <hr class="custom">
        </div>
        <div class="services">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn">                    
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-truck-wheel"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a>                     -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="100" style="animation-delay: 100ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-painting-paint-roller"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a>                     -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="200" style="animation-delay: 200ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-technology-1"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a>                     -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="200" style="animation-delay: 200ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-hose"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a>                     -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
            </div>
            <hr class="invis">
            <div class="row">
                 <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="300" style="animation-delay: 300ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-malfunction-indicador"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a> -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="400" style="animation-delay: 400ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg" style="background-image: none;">
                    <i class="flaticon-oil"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a> -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="500" style="animation-delay: 500ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg">
                    <i class="flaticon-disc-brake"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a> -->
                </div><!-- end service-hover -->
                </div><Praising pain was bon and give you a complete account of the uts system expound the actual.!-- end col -->
                <div class="col-md-3 col-sm-6 col-xs-12 animation fadeIn animation-visible" data-animation="fadeIn" data-animation-delay="600" style="animation-delay: 600ms;">
                    <div class="service-hover text-center hover" data-bg="<?php echo $site_host ?>/wp-content/themes/engines/assets/images/hoverbg.jpg">
                    <i class="flaticon-timing-belt"></i>
                    <h4>Преимущество #</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium recusandae </p>
                    <!-- <a href="#" title="Read More" target="_self" class="showhover">Read More</a> -->
                </div><!-- end service-hover -->
                </div><!-- end col -->
            </div>
            <hr class="invis">
        </div>
    </div> 
</div></div></div>



<div class="container">
    <div class="section-title clearfix text-center lightcolor">
        <h4>Почему именно КАМАЗ</h4>
        <hr class="custom">
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>Создание конкурентоспособной по показателям качества продукции, удовлетворяющей требованиям и ожиданиям потребителей является Главной целью ПАО «КАМАЗ» в области качества и основой финансового благополучия компании и ее сотрудников.</p>
            <p>Эта цель сформулирована в Политике ПАО «КАМАЗ» в области качества, определяющей основные принципы, на которых строится деятельность компании в области качества.</p>
            <a href="" class="box-button-two">Узнать больше о преимущетвах КАМАЗ</a>
        </div>
        <div class="col-md-6 page_video">
            <!-- <video tabindex="-1" class="video-stream html5-main-video" controlslist="nodownload" style="width: 400px; height: 300px; left: 25px; top: 0px;" src="blob:https://www.youtube.com/12b1951a-6809-4130-b072-57902793655c"></video> -->
            <!-- http://img.youtube.com/vi/0wj_MTgQ0OY/0.jpg -->
            <iframe width="450" height="300" src="//www.youtube.com/embed/0wj_MTgQ0OY" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>


<div class="container box-news">
    <div class="row">
            <div class="col-md-12">
                <div class="section-title clearfix text-center">
                    <h4>Новости ПАО "Камаз"</h4>
                    <hr class="custom">
                </div>
            </div>
    </div>
    <div class="row box-news-flex">
        <?php echo do_shortcode('[get_box_news category="'.$my_cat_id['news_kamaz'].'" per_page="3"]'); ?>        
        <div class="col-md-12 text-center">
            <p><a href="">Смотреть все новости ПАО "Камаз"</a></p>
        </div>           
    </div>     
</div>

<div class="container box-news">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title clearfix text-center">
                <h4>Новости компании "УРАЛКАМ"</h4>
                <hr class="custom">
            </div>
        </div>
    </div>
    <div class="row">    
        <?php echo do_shortcode('[get_box_news category="'.$my_cat_id['news_uralkam'].'" per_page="3"]'); ?>
        <div class="col-md-12 text-center">                
            <p style="padding:0 0 40px 0"><a href="">Смотреть все новости компании «УРАЛКАМ»</a></p>
        </div>
    </div>     
</div>

<?php get_template_part( 'templates/part/part', 'contacts' ); ?>

<div class="container-fluid box-map">
    <div class="row">
        <div class="col-md-12 tmp-fluid">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7ce64c6aeef5f5e95f86564ede72634cf5d18d5d3a6acf789c6534053dd68dca&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false;"></script>
        </div>
        <div style="height: 400px; width: 100%;"></div>
    </div>
</div>

<?php get_template_part( 'templates/part/part', 'home-modal' ); ?>

<?php 
$wp_my_cat = get_categories();
foreach ($wp_my_cat as $key => $value) {
    echo $value->name.' => '.$value->cat_ID.'<br>';
}

// var_dump(wp_list_categories()); 
?>

<?php get_footer(); 