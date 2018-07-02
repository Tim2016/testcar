<?php
 /*
    Template Name: Spare
*/
get_header(); 
    
    //Breadcrumb
    get_template_part('templates/page/breadcrumb');
    
    //Blog Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-enable-global', 'raw', false, 'options' ); 
    $yog_layout   = yog_helper()->get_option( 'blog-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';

    ?>
<div class="container box_spare">
    <div class="section-title clearfix text-center">
        <!-- h4 заменить h1 -->
        <h1>Оригинальные запасные части для автомобилей и спецтехники КАМАЗ<br>по выгодным ценам в фирменном магазине "Уралкам"</h1>
        <hr class="custom">
    </div>

    <div class="row text-center">
        <div class="col-md-8 box_spare_slider">
            <!--?php echo do_shortcode('[get_sitebar_gallery id_carousel="myGallery" speed_carousel="3000" category="31" per_page="10"]'); ?-->
            <?php echo do_shortcode('[get_sitebar_gallery id_carousel="myGallery" speed_carousel="3000" category="19" per_page="10"]'); ?>
            <div class="file">
                <i class="fa fa-file-text"></i>
                <a href="download/advantages_of_micromorphic_technology.pdf" target="_blank">Скачать каталог автозапчастей для подробного ознакомления</a>
            </div>
        </div>
        <div class="col-md-4 box_spare_offers">
            <h2>Почему наши запчасти в 2017 году выбрали 8550 клиентов</h2>
            <div class="row">
                <div class="col-md-12"><i class="fa fa-truck"></i> <span>преимущество №1</span></div>
                <div class="col-md-12"><i class="fa fa-shopping-cart"></i> <span>преимущество №1</span></div>
                <div class="col-md-12"><i class="fa fa-history"></i> <span>преимущество №1</span></div>
            </div>            
            <div class="row">
                <div class="col-md-6"><a class="btn_spare_select" href="#selection_of_spare_parts">Подбор запчастей</a></div>
                <div class="col-md-6"><a class="btn_spare_catalog" href="#catalog_of_spare_parts">Каталог запчастей</a></div>
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
<hr class="hr">
<!-- ОСТАВИТЬ ЗАЯВКУ -->
<div class="container" id="selection_of_spare_parts">
    <div class="row text-center">



        <div class="col-md-9 box_spare_list" style="display:none">
            <h2>Создать заявку на подбор автозапчастей "Камаз" по выгодным ценам за 15 минут</h2>
            <p>Выберите, какие запчасти вам необходимы (можно несколько групп)</p>
            <div class="row text-center">
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><i class="flaticon-disc-brake"></i><span alt="Ходовая">Ходовая</span></div></div>
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><i class="flaticon-malfunction-indicador"></i><span alt="Двигатель">Двигатель</span></div></div>
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><i class="flaticon-tool-2"></i><span alt="Коробка передач">Коробка передач</span></div></div>
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><strong><i class="flaticon-technology-2"></i></strong><span alt="Электрика">Электрика</span></div></div>
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><strong><i class="flaticon-transport-5 fa-boldd"></i></strong><span alt="Кузовные элементы">Кузовные элементы</span></div></div>
                <div class="col-xs-6 col-sm-2"><div class="spare_element"><i class="flaticon-technology-1"></i><span alt="Обогрев, вентиляция">Обогрев, вентиляция</span></div></div>
                       
                <div class="col-md-12">
                    <a class="btn_spare_list" href="">Оставить заявку</a>
                    <p>В течении 15 минут вам перезвонит менеджер отдела запасных частей и поможет выбрать подходящие запчасти с персональной скидкой</p>
                    <hr>            
                </div>                
                <div class="col-md-12 spare_element_two">
                    <i class="fa fa-phone"></i><span>Также вы можете получить цены по телефону <a href="tel:+73517354071">(351) 735-40-71</a></span>
                </div>
            </div>
        </div>





        <div class="col-md-3 box_spare_step">
            <i class="fa fa-check"></i><p>Добавьте заявку, это бесплатно и займет небольше 5 минут</p>
        </div>            
        <div class="col-md-3 box_spare_step">
            <i class="fa fa-file-text"></i><p>Наш менеджер предложит вам подходящие варианты и выгодные цены</p>
        </div>            
        <div class="col-md-3 box_spare_step">
            <i class="fa fa-shopping-cart"></i><p>Получите нужные запчасти с нашего склада (доставка в любую точку России и СНГ или самомывоз на ваш выбор)</p>
        </div>                    
        <div class="col-md-3 box_spare_step">
            <i class="fa fa-smile-o"></i><p>Особые условия для крупных заказов и постоянных клиентов</p>
        </div>
    </div>
</div>
<hr class="hr">

<div class="container" id="catalog_of_spare_parts">
    <!-- <div class="tmp-fluid-statistic" style="height: 380px; width: 100%;"></div> -->
    <div class="section-title clearfix text-center lightcolor ">
        <h4>Основные позиции каталога запчастей по категориям</h4>          
        <hr class="custom">
    </div>
    <div class="row">
        <div class="col-md-12" style="background: #d9d9d9; padding: 15px;">            
            <?php echo do_shortcode('[get_box_spare_nodes id="21" level="models"]'); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12" style="background: #d9d9d9;">            
            <?php echo do_shortcode('[get_box_spare level="0"]'); ?>
        </div>
    </div>
</div>

<hr class="hr_dotted">
<!-- текст о магазине зп -->
<!-- box-indicators-one -->
<div class="container">
    <div class="row box_spare_about">
        <div class="col-md-8"><p>О магазине запчастей. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum assumenda ducimus laboriosam iure sint quasi, sunt fuga, ipsam debitis officia eos sed. Reprehenderit nobis fugit eligendi illo, delectus. Aliquam, quia.</p></div>
        <div class="col-md-4 box_spare_stat">
            <span>8550</span><p>клиентов закупили запчасти в "Уралкам" в 2017 году</p>
            <span>14900</span><p>позиций в нашем каталоге запчастей "Камаз"</p>
            <span>5 лет</span><p>гарантия на запчасти приобретенные у нас</p>
        </div>
    </div>
</div>
    <hr class="hr_dotted">
<div class="container">
    <div class="row box_spare_counterfeit">
        <div class="col-sm-2 text-center"><i class="fa fa-exclamation-triangle"></i></div>
        <div class="col-sm-10">
            <p><b>Почему нужно покупать оригинальные запчасти и как определить подлинность? Чем опасен контрафакт?</b></p>
            <p>Текст о оригинальных запчастях Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit aliquam laboriosam quos, quasi minus eius facere at. Inventore cum nulla quibusdam ex beatae! Eveniet ipsum culpa reiciendis possimus odio voluptatum! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit aliquam laboriosam quos, quasi minus eius facere at. Inventore cum nulla quibusdam ex beatae! Eveniet ipsum culpa reiciendis possimus odio voluptatum!</p>
        </div>
        <div class="col-md-12 text-center">
            <!-- <img src="http://localhost/wordpress/wp-content/themes/engines/img/contra.png" alt="упаковка оригинальных запчастей камаз" class="img-responsive"> -->
            <img src="http://hyip-info.ru/wp-content/themes/engines/img/contra.png" alt="упаковка оригинальных запчастей камаз" class="img-responsive">
        </div>
    </div>
</div>

<hr>

<!-- осн позиции -->
<div class="container" id="cart_spare">
    
</div>

<?php get_template_part( 'templates/part/part', 'partners' ); ?>
<?php get_template_part( 'templates/part/part', 'contacts' ); ?>
<?php get_template_part( 'templates/part/part', 'map' ); ?>
<?php get_template_part( 'templates/part/part', 'spare-modal' ); ?>

<?php get_footer(); 