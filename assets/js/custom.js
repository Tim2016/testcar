/******************************************
    File Name: custom.js
    Theme Name: Engines - - Automotive, Motor Cars, Vehicle Dealership Responsive WordPress Theme
    Created By: SteelThemes
    Version: 1.0.0
/******************************************/

(function($) {
    "use strict";

    /* ==============================================
    STAT COUNT -->
    =============================================== */
    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 1; /* Where 50 is increment */
        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function() {
                count($this)
            }, 50);
        }
    }
    $(".stat_count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });


    /* ==============================================
      BACK TOP
      =============================================== */
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            $('.dmtop').css({
                bottom: "20px"
            });
        } else {
            $('.dmtop').css({
                bottom: "-100px"
            });
        }
    });
    $('.dmtop').on(function() {
        $('html, body').animate({
            scrollTop: '0px'
        }, 800);
        return false;
    });
    $('.dmtop').click(function(){
       $('html, body').animate({scrollTop: '0px'}, 800);
       return false;
    });

    /* ==============================================
      TOOLTIP
      =============================================== */
     $('[data-toggle="tooltip"]').tooltip()

    /* ==============================================
      SELECT
      =============================================== */
    $('.selectpicker').selectpicker({
        style: 'btn-default',
        size: false
    });

    /* ==============================================
      ACCORDION
      =============================================== */
    var iconOpen = 'fa fa-minus',
        iconClose = 'fa fa-plus';

    $(document).on('show.bs.collapse hide.bs.collapse', '.accordion', function(e) {
        var $target = $(e.target)
        $target.siblings('.accordion-heading')
            .find('em').toggleClass(iconOpen + ' ' + iconClose);
        if (e.type == 'show')
            $target.prev('.accordion-heading').find('.accordion-toggle').addClass('active');
        if (e.type == 'hide')
            $(this).find('.accordion-toggle').not($target).removeClass('active');
    });

        // bootstrap multipie
         // Instantiate the Bootstrap carousel
        $('.multi-item-carousel').carousel({
          interval: false
        });

        // for every slide in carousel, copy the next slide's item in the slide.
        // Do the same for the next, next item.
        
        var list_item = $('.multi-item-carousel .item').children();
            // console.log(list_item);
            // console.log(list_item['5']);


        function multipai(){
            $('.multi-item-carousel .item').each(function(){
                // для каждого item, получаем следующий
                var next = $(this).next();
                if (!next.length) {
                    // поиск элемента с общим родителем, взять первого
                    next = $(this).siblings(':first');
                }
                // ко всем this добавляем первого потомка их соседей с права (next())
                next.children(':first-child').clone().appendTo($(this));
                // clone() клонируем и добавляем
                
                if (next.next().length>0) {
                    // console.log(next.next());
                    next.next().children(':first-child').clone().appendTo($(this));
                } else {
                  $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
                }
            });
        };
        // исполняем первый раз для всего списка
        multipai();

// var indexOf = function (arr, id) {
//   for(var idx = 0, l = arr.length;arr[idx] && arr[idx].id !== id;idx++);
//   return idx === l ? -1 : idx;
// };

// list_item список DOM элементов со всеми товарами что есть в слайдере
// циклически проверяем соответсвует ли элемент категории, т.е содержит ли класс category_XX
// функция get_categoty принимает параметр с искомой категорией 
        // console.log(list_item[4].classList.contains('category_29'));
        function get_category(list, cat){
            var firsBox = $(".multi-item-carousel .carousel-inner");
            // очишаем слайдер
            firsBox.html("");
            var ItemBox = $('<div class="item item-three"></div>');                   

            for(var idx = 0; idx !== list.length; idx++){
                if(list[idx].classList.contains(cat)){
                    // заполняем item совпавшей категорией
                    var newItemContent = ItemBox.html(list[idx]);
                    // клонируем item и добавляем в слайдер
                    var newBlock = newItemContent.clone().appendTo(firsBox);
                }
            }
            return newBlock;
        };

        var progress='<img style="margin:auto; display:block;"src="/wp-content/themes/engines/img/catalog/progress.gif">';            

        $('.box-sales-leader-nav a').click(function(e){
            e.preventDefault();
            // получаем выбранную категорию
            var category_class = $(this).attr('id');
            // функция проверки на соответсвие еатегории и замены слайдера
            var rez = get_category(list_item, category_class);            
            // добавляем класс active в динамически добавленный элемент
            $('.multi-item-carousel').find(".item:first").toggleClass('active');
            multipai();
        });

        // catalog - > ajax item + loading
        jQuery(document).ready(function($){ 
            var name_cat = jQuery('.header_catalog').html();
            ajaxLoading(0,name_cat);        
        });
        
        
        // страница машин
        // вывод элементов из списка категорий
        jQuery(".category_list ul li").click(function(){            
            var id = jQuery(this).attr("id");
            ajaxLoading(id, 0);
        });
        function ajaxLoading(id, name_cat){
            var data={
                action:"cat",
                id:id,
                name:name_cat
            };
            jQuery(".box-catalog-list").html(progress);
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                // alert(responce+"OFF");
                var data_catalog = jQuery.parseJSON(responce);
                jQuery(".box-catalog-list").html(data_catalog.a);
                jQuery(".breadcrump").html("Каталог > " + data_catalog.b);

            }); 
        }

        // страница запчастей 
        // выбор категорий для заявки, верхний блок
        jQuery(".spare_element").click(function(){
            var ch_element = jQuery(this).find('span');
            var ch_element_alt = jQuery(this).find('span').attr("alt");     
            jQuery(this).hasClass("choise") ? jQuery(this).removeClass("choise") : jQuery(this).addClass("choise");
        });
       
        
        // страница запчастей блок по моделям
        // вывод узлов моделей
        jQuery(".model-spare").click(function(e){
            e.preventDefault();
            var id_model_spare = jQuery(this).attr("id");            
            var name_spare = jQuery(this).text();            
            var data={
                action:"getmodelsparenodes",
                id:id_model_spare,
                level:"nodes"
            };            
            jQuery(".model-spare-nodes").html(progress).show();
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                var data_spare_nodes = jQuery.parseJSON(responce);
                jQuery(".model-spare-nodes").html('<h4>'+name_spare+'</h4>'+data_spare_nodes);
            }); 
        });
        // страница запчастей блок по моделям
        // вывод списка запчастей
        jQuery(".model-spare-link").live('click',function(e){
            e.preventDefault();
            var id_model_spare = jQuery(this).attr("id");            
            var name_spare = jQuery(this).text();          
            var data={
                action:"getmodelsparenodes",
                id:id_model_spare,
                level:"spare"
            };            
            jQuery(".model-spare-nodes").html(progress).show();
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                var data_spare_nodes = jQuery.parseJSON(responce);
                jQuery(".model-spare-nodes").html('<h4>'+name_spare+'</h4>'+data_spare_nodes);
            }); 
        });
        jQuery('span').live('click', function() {      
            // e.preventDefault();
            var id_model_spare = jQuery(this).attr("id"); 
            jQuery(this).next().toggle(100);
            console.log('добавить яндекс цели');
        });


        // запчасти из прайса
        // страница запчастей
        // вывод табов шорткодом на стр. шаблона запчастей
        // страница запчастей
        // вывод списока запчастей из выбранной категории
        jQuery(".spare_item").click(function(e){
            e.preventDefault();
            var id_spare = jQuery(this).attr("id");            
            var name_spare = jQuery(this).text();            
            var data={
                action:"spare",
                id:id_spare
            };            
            jQuery("#listsparexls").html(progress);
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                var data_spare = jQuery.parseJSON(responce);
                jQuery("#listsparexls").html('<h4 style="font-size:16px">'+name_spare+'</h4>'+data_spare);
            }); 
        });

        // страница запчастей
        // список категорий запчастей 
        $('#spare-tab a').click(function (e) {
          e.preventDefault();
          $(this).tab('show');
        });
        // страница запчастей
        // список позиций в корзине, выпадающий список под кнопкой
        // jQuery(".navbar-cart").hover(function() { jQuery(".cart_vis").stop(true).toggle(400); });
        jQuery('.navbar-cart').mouseover(function(e){ jQuery('.cart_vis').toggle(); });
        // страница запчастей
        // добавление позиции в корзину
        // список позиций в корзине, выпадающий список под кнопкой        
        jQuery('.cell-three').live('click', function(e){
            e.preventDefault();
            var id_spare = jQuery(this).parent().attr("id");
            var num_spare = jQuery('#'+id_spare).find('.spare_article').html();
            var text_spare = jQuery('#'+id_spare).find('.cell-two').html();             
            var data={
                action:"add_spare",
                id:id_spare,
                num:num_spare,
                text:text_spare
            };
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                // модальное окно
                // template/part-spare-modal.php
                jQuery('#modal-spare-order').modal('show');
                jQuery('#modal-spare-order .modal-body').html( '<div class="col-md-12"><i class="flaticon-mark"></i><b> '+num_spare+' - '+text_spare+'</b></div>' );
                // меню корзина выпадающее окно
                jQuery(".cart_vis").html(responce);                
                var count_spare = jQuery('.cart_vis>p').html().replace(/\D+/g,"");
                jQuery('.navbar-cart small').html(count_spare);
                // var leftid = jQuery("#"+id_spare).offset().left;
                // анимация корзины
                var topid = jQuery("#"+id_spare).offset().top;
                jQuery("#"+id_spare+" .glyphicon")
                .clone()
                .css({'position' : 'absolute', 'z-index' : '11100', 'font-size' : '30px', top: topid, right:324})
                .appendTo("body")
                .animate({opacity: 0.5,
                    left: jQuery(".navbar-cart").offset()['left'],
                    top: jQuery(".navbar-cart").offset()['top'],
                    width: 20}, 3000, function() {
                    jQuery(this).remove();
                });
            }); 
        });
        // страница корзины
        // удаление товара
        jQuery('.spare-del').live('click', function(e){
            e.preventDefault();
            var id_spare_del = jQuery(this).attr('data-del-id');
            var data={
                action:"del_spare",
                id:id_spare_del
            };
            // console.log(data);
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                console.log(responce);                
                var data_del = jQuery.parseJSON(responce);
                var spare_count = jQuery(".spar_count").html();
                jQuery(".spar_count").html(spare_count-1);
                console.log(data_del);
                jQuery('.tbstr'+id_spare_del).remove();
            }); 
        });

        // страница корзины
        // изменение количество позиций в элементе      
        jQuery('.spinner .btn:first-of-type').on('click', function() {
            var id_btn = jQuery(this).attr('data-up-id');
            var input = jQuery('[data-count-id='+id_btn+']');  
            // jQuery('.in'+id_btn).val( parseInt(jQuery('.in'+id_btn).val(), 10) + 1);
            input.val( parseInt(input.val(), 10) + 1);
            var count_spare = parseInt( input.val(), 10);
            session_count(id_btn,count_spare);
        });
        jQuery('.spinner .btn:last-of-type').on('click', function() {
            var id_btn = jQuery(this).attr('data-down-id');            
            var input = jQuery('[data-count-id='+id_btn+']');  
            // jQuery('.in'+id_btn).val( parseInt(jQuery('.in'+id_btn).val(), 10) - 1);
            input.val( parseInt(jQuery('[data-count-id='+id_btn+']').val(), 10) - 1);
            if( parseInt(input.val(), 10 ) <= -1){
                input.val('0')
            }
            var count_spare = parseInt( input.val(), 10);
            session_count(id_btn,count_spare);
        });

        // сохранение числа одной позиции в сессию
        function session_count(id,count_spare){
            var data={
                action:"count_spare",
                count:count_spare,
                id:id
            };
            // console.log(data);
            jQuery.post(yogTheme["links"]["ajax"],data, function(responce){
                console.log(responce);                
                var data_del = jQuery.parseJSON(responce);
                console.log(data_del);
            }); 
        };


        // вывод на всплывалку оформление заказа
        // btn_spare_list
        // jQuery(".btn-cart-order").click(function(e){
        //     e.preventDefault();            
        //     jQuery('#spare-order').modal('show');
        // });

        // jQuery(".btn_arr").click(function(e){
        //     jQuery(".item-three.active").hide();
        // });
        


})(jQuery);