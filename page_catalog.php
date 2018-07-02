<?php
 /*
    Template Name: Catalog
    скрипт загрузки каталога assets\js\custom.js
*/

get_header(); 
    
    //Breadcrumb
    // get_template_part('templates/page/breadcrumb');
    
    //Blog Layout.  
    $yog_sidebar  = yog_helper()->get_option( 'blog-enable-global', 'raw', false, 'options' ); 
    $yog_layout   = yog_helper()->get_option( 'blog-sidebar-position', 'raw', 'right', 'options' );
    $yog_class    = array( 'left' => 'col-md-9 col-sm-12', 'right' => 'col-md-9 col-sm-12' );
    $yog_class    = ( isset( $yog_sidebar ) && !empty( $yog_sidebar ) )? $yog_class[$yog_layout] : 'col-md-12 no-padding';


    ?>

<div class="header_catalog" style="display: none"><?php echo get_the_title(); ?></div>

<div class="section page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-3 category_list">
                <!-- 27 -->
                <?php echo do_shortcode('[get_category_list category="18" per_page="20"]'); ?>
                <div class="filter">
                    <span>Фильтр</span><br>
                    <span>------</span><br>
                    <span>------</span><br>
                    <span>------</span><br>
                </div>
            </div>
            <div class="col-md-9 box-catalog">
                <!-- добавляем скрипт обработчика в конец -->
                <?php do_action('add_ajax_script'); ?>
                <div class="row">
                    <div class="col-md-6"><span class="breadcrump"></span></div>
                    <div class="col-md-6 file"><i class="fa fa-file-text"></i><a>Скачать презентацию категории</a></div>
                    <div class="col-md-12 box-top-offer"><span>Самосвалы Камаз по ценам производителя, в наличии и под заказ у официального дилера по УрФО</span></div>
                    <div class="col-md-12 box-filter-list">
                        <ul>
                            <li>условия фильтра <i class="fa fa-close"></i></li>
                            <li>условия фильтра <i class="fa fa-close"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="row box-catalog-list">                    
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="hr">
<div class="container box-category-about">
    <div class="row">
        <!-- пост который получает данные о категории из поста с этой -->
        <!-- засовывай в подкатегорию - описание категории -->
        <div class="col-md-8 box-cat-text">
            <p>Описание категории. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum assumenda ducimus laboriosam iure sint quasi, sunt fuga, ipsam debitis officia eos sed. Reprehenderit nobis fugit eligendi illo, delectus. Aliquam, quia.</p>
        </div>
        <div class="col-md-4 box-cat-stat">
            <span>ХХХ</span><p>клиентов закупили запчасти в "Уралкам" в 2017 году</p>
            <span>ХХХ</span><p>позиций в нашем каталоге запчастей "Камаз"</p>
            <span>ХХХ</span><p>гарантия на запчасти приобретенные у нас</p>
        </div>
    </div>
</div>

<?php get_template_part( 'templates/part/part', 'offer' ); ?>
<?php get_template_part( 'templates/part/part', 'partners' ); ?>
<?php get_template_part( 'templates/part/part', 'contacts' ); ?>

<div class="container-fluid box-map">
    <div class="row">
        <div class="col-md-12 tmp-fluid">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A7ce64c6aeef5f5e95f86564ede72634cf5d18d5d3a6acf789c6534053dd68dca&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false;"></script>
        </div>
        <div style="height: 400px; width: 100%;"></div>
    </div>
</div>

<?php get_footer(); 