<?php
/**
 * The Engines Starter Theme
 *
 * Note: Do not add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * http://codex.wordpress.org/Child_Themes
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Text Domain: 'engines'
 * Domain Path: /languages/
 */

// Staring The Engines ---------------------------------------------
require_once( get_template_directory() . '/yog/yog-init.php');
remove_filter( 'the_content', 'wpautop' );


// метаданные - дополнительные поля 26.01.2018
// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);
function my_extra_fields() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'post', 'normal', 'high'  );
}

// объем двигателя
// грузоподьемность
// трансмиссия
// топливо
// объем кузова
// привод
// цена
// акция месяца на модель
// фаил презентации модели
// echo get_post_meta($post->ID, 'i_volume', 1);
// echo get_post_meta($post->ID, 'i_load', 1);
// echo get_post_meta($post->ID, 'i_transmission', 1);
// echo get_post_meta($post->ID, 'i_fuel', 1);
// echo get_post_meta($post->ID, 'i_body', 1);
// echo get_post_meta($post->ID, 'i_drive', 1);
// echo get_post_meta($post->ID, 'i_price', 1);
// echo get_post_meta($post->ID, 'i_action', 1);
// echo get_post_meta($post->ID, 'i_presentaton', 1);


// код блока
function extra_fields_box_func( $post ){	?>	
	<p><label><input type="text" name="extra[i_gallery]" value="<?php echo get_post_meta($post->ID, 'i_gallery', 1); ?>" style="width:100%"   placeholder = "галерея"  /></label></p>
	<p><label><input type="text" name="extra[i_volume]" value="<?php echo get_post_meta($post->ID, 'i_volume', 1); ?>" style="width:100%"   placeholder = "объем двигателя"  /></label></p>
	<p><label><input type="text" name="extra[i_load]" value="<?php echo get_post_meta($post->ID, 'i_load', 1); ?>" style="width:100%"   placeholder = "грузоподьемность"  /></label></p>
	<p><label><input type="text" name="extra[i_transmission]" value="<?php echo get_post_meta($post->ID, 'i_transmission', 1); ?>" style="width:100%"   placeholder = "трансмиссия"  /></label></p>
	<p><label><input type="text" name="extra[i_fuel]" value="<?php echo get_post_meta($post->ID, 'i_fuel', 1); ?>" style="width:100%"   placeholder = "топливо"  /></label></p>
	<p><label><input type="text" name="extra[i_body]" value="<?php echo get_post_meta($post->ID, 'i_body', 1); ?>" style="width:100%"   placeholder = "объем кузова"  /></label></p>
	<p><label><input type="text" name="extra[i_drive]" value="<?php echo get_post_meta($post->ID, 'i_drive', 1); ?>" style="width:50%"   placeholder = "привод"  /></label></p>
	<p><label><input type="text" name="extra[i_price]" value="<?php echo get_post_meta($post->ID, 'i_price', 1); ?>" style="width:50%"   placeholder = "цена"  /></label></p>
	<p><label><input type="text" name="extra[i_action]" value="<?php echo get_post_meta($post->ID, 'i_action', 1); ?>" style="width:50%"   placeholder = "акция"  /></label></p>
	<p><label><input type="text" name="extra[i_presentaton]" value="<?php echo get_post_meta($post->ID, 'i_presentaton', 1); ?>" style="width:50%"   placeholder = "фаил презентации модели"  /></label></p>
	<h2>Описание и преимущества модели</h2>
	<p><label><input type="text" name="extra[i_purpose]" value="<?php echo get_post_meta($post->ID, 'i_purpose', 1); ?>" style="width:50%"   placeholder = "Назначение модели"  /></label></p>
	<p><label><input type="text" name="extra[i_video]" value="<?php echo get_post_meta($post->ID, 'i_video', 1); ?>" style="width:50%"   placeholder = "Видео"  /></label></p>
	
	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}


// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update', 0);
/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
	if ( !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false; 

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}
		// var_dump($value);
		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}


// обрезаем текст
function cutStr($str, $length=300, $postfix='...'){
    if ( strlen($str) <= $length)
    return $str;
    $temp = substr($str, 0, $length);
    return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
}

// топовый слайдер на главной странице
// вызвается шорткодом echo do_shortcode('[get_top_slider id_carousel="mytopslider" speed_carousel="12000" category="32" per_page="10"]');
// выводит изображения записей содержащихся в заданной категории
// настройки id_слайдера любой, скорость 3000-12000, категория записей, количество выводимых записей
function top_slider( $atts ){
	extract( shortcode_atts( array(
		'id_carousel'=> '',
		'speed_carousel'=> '',
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	$args = array( 'posts_per_page' => $per_page, 'category' => $category);
	$myposts = get_posts( $args );
	$i=0;	
	$text = '<div id="'.$id_carousel.'" class="carousel slide top-slider" data-wrap="flase" data-interval="'.$speed_carousel.'" >';
	$text .= '<div class="carousel-inner">';
	foreach( $myposts as $post ){ 
		setup_postdata($post);	
		// убираем лишние параметры
		// получаем строку адреса
		$top_slider_img = get_the_post_thumbnail($post->ID, full);
		$str_out_html =	strtolower(strip_tags($top_slider_img, '<img>'));
		preg_match_all("/<img[^>]*?src=\"(.*)\"/iU", $str_out_html, $out_link_img);
		$active = ($i == 0) ? "active" : "";
		$text .='
			<div class="'.$active.' item">				
					<img class="top-slider-img" src="'. $out_link_img[1][0] .'">                    
					<div class="top-info">					
						<div class="top-bg"></div>
						<div class="top-content">							
							'.$post->post_content.'
						</div>
					</div>			
			</div>';
		$list_slider .= '<li data-target="#'.$id_carousel.'" data-slide-to="'.$i.'" class="'. $active .'">'.$post->post_title.'</li>';
		$i++;
	}
	$text .='</div>
		<a class="top_arr top_leftarrow top_indent_l" href="#'.$id_carousel.'" data-slide="prev"></a>
		<a class="top_arr top_rightarrow top_indent_r" href="#'.$id_carousel.'" data-slide="next"></a>
		<div class="top-slider-btn">
		<ul>'.$list_slider.'</ul>
		</div></div>';
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_top_slider', 'top_slider' );


// вывод слайдера с тремя позициями в ряд
// get_category_name выводит имена категории и их номера
// item-three содержит три блока
function three_sitebar( $atts ){
	extract( shortcode_atts( array(
		'id_carousel'=> '',
		'speed_carousel'=> '',
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	$args = array( 'posts_per_page' => $per_page, 'category' => $category);
	$myposts = get_posts( $args );
	$i=0;
	$text = '<div class="box-sales-leader-nav text-center">';
	$text .= '<p style="font-size: 20px;">Фильтр по типу продукции: '. get_category_name( $category ) .'</p>';
    $text .= '</div>';
	$text .= '<div id="'.$id_carousel.'" class="carousel slide multi-item-carousel" data-wrap="flase" data-interval="'.$speed_carousel.'" >';
	$text .= '<div class="carousel-inner">';
	foreach( $myposts as $post ){ 
		setup_postdata($post);	
		$cat_data = get_the_category( $post -> ID );
		$cat_id = $cat_data['0'] -> cat_ID;
		$page_link = get_the_permalink();	
		$active = ($i == 0) ? "active" : "";		
		$text .='
		<div class="'.$active.' item item-three">
			<div class="col-md-4 col-sm-4 category_'.$cat_id.'">
				<div class="three-img entry">			
					'. get_the_post_thumbnail($post->ID, medium, array( 'class' => 'img-responsive')) .'
					<div class="magnifier"><a href="">Узнать больше</a></div>
					<ul class="list-inline">
                    <li class="car-km"><p><i class="fa fa-road"></i> 10</p></li><li class="car-oil"><p><i class="fa fa-car"></i> Diesel</p></li><li class="car-date"><p><i class="fa fa-clock-o"></i> 2017</p></li></ul>
				</div>
				<div class="three-info">					
					<h3><a href="'. $page_link .'">'. $post->post_title .'</a></h3>	
				</div>
			</div>
		</div>';							
		$i++;
	}
	$text .='</div>
		<a class="btn_arr leftarrow indent_l" href="#'.$id_carousel.'" data-slide="prev"></a>
		<a class="btn_arr rightarrow indent_r" href="#'.$id_carousel.'" data-slide="next"></a>
		</div>';	
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_sitebar_three', 'three_sitebar' );

// страница главная - о нашей компании
// страница запчасти - топ
// страница карточка товара
// ! вывод слайдера из категории с шорткодом галереии
// ! вывод слайдера из доп.поля с шорткодом галереии
function gallery_sitebar( $atts ){
	extract( shortcode_atts( array(
		'id_carousel'=> '',
		'speed_carousel'=> '',
        'category' => '',
        'id_img' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;

	// выводим отдельные изображения из поля i_gallery
		// echo "<pre>";
		// var_dump($id_img);
		// var_dump(!empty($id_img));

		// var_dump($category);
		// var_dump(!empty($category));

		// echo "</pre>";
	if( !empty($id_img) ){
		$slider_html = do_shortcode('[gallery size="large" ids="'.$id_img.'"]');
	}elseif( !empty($category) ){				
		$args = array( 'posts_per_page' => $per_page, 'category' => $category);
		$myposts = get_posts( $args );	

		// echo "<pre>";
		// var_dump($myposts);
		// echo "</pre>";

		// из записи под категорией $category
		// получаем галерею wp вида [gallery ids="42,108,41,40,39"]
		foreach( $myposts as $post )$slider_html = do_shortcode($post->post_content);
	}else{
		$text = "Ошибка. Фаил изображения не найдены или не установлены.";
		return $text;
		wp_reset_postdata();
	}
	
	// убираем лишние теги получаем изображения 
	// $strimg_out = strip_tags($slider_html, '<img>');
	$str_out_html =	strtolower(strip_tags($slider_html, '<img>'));

	// получаем строку адреса
	preg_match_all("/<img[^>]*?src=\"(.*)\"/iU", $str_out_html, $out_link_img);
	// $domen_url = CYBER_DC_LOBSTER_URL;

	$text = '<div id="'.$id_carousel.'" class="carousel slide" data-interval="'.$speed_carousel.'" data-ride="carousel">';
	$text .= '<ol class="carousel-indicators">';
	for($i=0; $i<count($out_link_img[1]); $i++){
		$active = ($i == 0) ? "active" : "";
		$text .= '<li data-target="#'.$id_carousel.'" data-slide-to="'.$i.'" class="'. $active .'"></li>';
	}
	$text .= '</ol>';
	$text .= '<div class="carousel-inner">';

	for($i=0; $i<count($out_link_img[1]); $i++){
		$active = ($i == 0) ? "active" : "";
		$text .='
			<div class="'. $active .' item item-gallery">
					<img src="'.($out_link_img[1][$i]).'" class="">
			</div>';
	}
	// setup_postdata($post);
	// $post_category = get_the_category();
	// $page_link = get_the_permalink();	

	$text .='</div>
		<a class="indent_l btn_arr leftarrow" href="#'.$id_carousel.'" data-slide="prev"></a>
		<a class="indent_r btn_arr rightarrow" href="#'.$id_carousel.'" data-slide="next"></a>
		</div>';
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_sitebar_gallery', 'gallery_sitebar' );

// testimonials
function right_sitebar( $atts ){
	extract( shortcode_atts( array(
		'id_carousel'=> '',
		'speed_carousel'=> '',
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	// обрезаем текст


	$args = array( 'posts_per_page' => $per_page, 'category' => $category);
	$myposts = get_posts( $args );
	$text = '<div id="'.$id_carousel.'" class="carousel slide" data-interval="'.$speed_carousel.'" data-ride="carousel">';
	$text .= '<ol class="carousel-indicators">';
	for($i=0; $i<count($myposts); $i++){
		$active = ($i == 0) ? "active" : "";
		$text .= '<li data-target="#'.$id_carousel.'" data-slide-to="'.$i.'" class="'. $active .'"></li>';
	}
	$i=0;
	$text .= '</ol>';	
	$text .= '<div class="carousel-inner">';
	foreach( $myposts as $post ){ 
		setup_postdata($post);
		$post_category = get_the_category();
		$page_link = get_the_permalink();	
		$active = ($i == 0) ? "active" : "";
		if($id == k96){$fnmena ='<span>Новости компании</span>';}
		$text .='
		<div class="'. $active .' item item-partners">
			<div class="carousel-caption">
				'. get_the_post_thumbnail($post->ID, medium, array( 'class' => 'img-responsive')) .'
				'. $fnmena .'
				<div class="pn-info">					
					<h3>'. $post->post_title .'</h3>					
					<p>'. cutStr($post->post_content) .'</p>
					<p><a href="'. get_the_permalink() .'">Посмотреть отзыв на фирменном бланке</a></p>
				</div>
			</div>
		</div>';
		$i++;
	}	
	$text .='</div></div>';
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_sitebar_right', 'right_sitebar' );


// из строки с номерами категорий получаем их названия
function get_category_name( $category ){
	$category_m = explode(",", $category);
	foreach( $category_m as $key => $cat_name ){ 
		$links_cat .= ' <a href="#myThree" id="category_'.$cat_name.'">'.get_cat_name( $cat_name ).'</a> ';
		$links_cat .= (end($category_m) == $cat_name)?"":"|";
	}
	return $links_cat;
}

// news 
function box_news( $atts ){
	extract( shortcode_atts( array(
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	$args = array( 'posts_per_page' => $per_page, 'category' => $category);
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){
		setup_postdata($post);
		$post_category = get_the_category();
		$page_link = get_the_permalink();
		$text .= '
			<div class="blog-grid col-md-4 col-sm-4">
	            <div class="blog-wrapper post-30 post type-post status-publish format-image has-post-thumbnail hentry category-automotive tag-automotive post_format-post-format-image" id="post-30" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	                <div class="post-media entry">
	                	<div class="news_img">
						'. get_the_post_thumbnail($post->ID, medium, array( 'class' => 'img-responsive wp-post-image')) .'
						</div>
	                    <div class="magnifier colorized">
	                        <a href=""><i class="flaticon-link"></i></a>
	                    </div>
	                </div>
	                <div class="blog-details">
	                    <h4 class="entry-title entry-title" itemprop="headline"><a href="'.$page_link.'">'. $post->post_title .'</a></h4>
	                    <ul class="list-inline">
	                        <li class="entry-published updated entry-published" datetime="2016-12-09T05:35:44+00:00" itemprop="datePublished" title="'.get_the_date().'"><i class="fa fa-clock-o"></i> '.get_the_date().'</li>
	                    </ul>
	                    <div class="entry-summary entry-summary" itemprop="description">
	                        <p><strong>'. strip_tags(cutStr($post->post_content)) .'</strong></p>
	                    </div>
	                </div><!-- end details -->
	                <div class="blog-meta">
	                    <a href="'.get_permalink().'">Читать далее</a>
	                    <!-- <ul class="list-inline">
	                        <li class="entry-author entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="http://localhost/wordpress/wp-content/themes/engines/author/admin/"><i class="fa fa-user"></i> admin</a></li>
	                        <li class="entry-published updated entry-published" datetime="2016-12-09T05:35:44+00:00" itemprop="datePublished" title="Friday, December 9, 2016, 5:35 am"><a href="" class="entry-published updated entry-published" datetime="2016-12-09T05:35:44+00:00" itemprop="datePublished" title="Friday, December 9, 2016, 5:35 am"><i class="fa fa-clock-o"></i> 09 Dec, 2016</a></li>
	                    </ul> -->
	                </div><!-- end meta -->
	            </div><!-- end blog-wrapper -->
	        </div>';
	}	
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_box_news', 'box_news' );


function category_list( $atts ){
	extract( shortcode_atts( array(
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	// $args = array( 'posts_per_page' => $per_page, 'category' => $category);
	// $myposts = get_posts( $args );
	$child_category = get_categories('child_of='.$category);
	$child_category = get_categories('parent='.$category);
	// echo "<pre>";
	// 	var_dump($child_category);
	// echo "</pre>";
	$text .='<ul>';
	foreach( $child_category as $element ){
		// setup_postdata($element);
		// получить дочерние категории
		// $post_category = get_the_category();
		// $page_link = get_the_permalink();
		// $text .= '<li>'.get_category_name($post_category).'</li>';		
		$text .= '<li id="'.$element->term_id.'">'.$element->name.'</li>';
		// echo "<pre>";
		// var_dump($element);
		// echo "</pre>";

	}	
	$text .='</ul>';
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_category_list', 'category_list' );

function box_catalog( $atts ){
	extract( shortcode_atts( array(
        'category' => '',
        'per_page' => ''
    ), $atts ) );
	global $post;
	$args = array( 'posts_per_page' => $per_page, 'category' => $category);
	$myposts = get_posts( $args );
	foreach( $myposts as $post ){
		setup_postdata($post);
		$post_category = get_the_category();
		$page_link = get_the_permalink();
		$text .= '
			<div class="col-md-4">
	            <div class="box-item-catalog">
	                <div class="post-media entry text-center">
	                	<div class="box-catalog-img">
						'. get_the_post_thumbnail($post->ID, medium, array( 'class' => 'img-responsive wp-post-image')) .'
						</div>
	                    <div class="magnifier colorized">
	                        <a href="'.$page_link.'">узнать подробнее</a>
	                    </div>
	                </div>
	                <div class="blog-details">
	                    <h4 class="entry-title entry-title" itemprop="headline"><a href="'.$page_link.'">'. $post->post_title .'</a></h4>
	                </div>
	            </div>
	        </div>';
	        // <a href=""><i class="flaticon-link"></i></a>
	        // <p>'. cutStr($post->post_content) .'</p>
	}	
	return $text;
	wp_reset_postdata();
}
add_shortcode('get_box_catalog', 'box_catalog' );


// 11.03.18
// запчасти с моделями
// вывод из бд section, parentID запчасти  = 21
// 15.03.18
// spare parts page, model nodes output
function box_spare_nodes($atts){
	extract( shortcode_atts( array(
        'id' => '',
        'level' => 'nodes'        
    ), $atts ) );
    global $wpdb;
    // (level = 0) первый вызов из шаблона страницы page_spare - echo do_shortcode('[get_box_spare level="0"]');
    // выводятся ссылки на табы и их содержимое с рекурсивным вызовом
    // (элементы level = 1) при выборе узла spare_item происходит вызов ajax - wp_ajax_spare. см ajax-catalog.php
    // (элементы level = 2) далее вызов элементов с выбранным parent  get_box_spare parent="'.$spare_id.'" level="2"
    // получаем дочерние элементы по id родителя
	$sql_two = "SELECT * FROM wp_kmz_section WHERE parentID = %d;";
	$sql_two = $wpdb->prepare($sql_two, $id);
	$date = $wpdb->get_results($sql_two);
	if ($level == 'models') {
		foreach ($date as $key ){
			if ( $key->enable == 1) {
	 			$sparecat .= "<div class='col-md-4' class='".$active."'><a href='#' id='".$key->unicID."'' class='model-spare'>".trim( $key->name )."</a></div>";		
			}	   
			$modelspare = "<div class='row row-flex'>".$sparecat."</div>";
			$modelspare .="<div class='row model-spare-nodes'></div>";
		}
	}
	if ($level == 'nodes') {
		foreach ($date as $key ){
			$param = array('id' => $key->unicID, 'level' => 'nodes' );
			if ( $key->enable == 1) {
				if ( $key->level == 6) {
	 				$sparecat .= "<li><span id='".$key->unicID."' class='model-spare-link'>".trim( $key->name )."</span></li>";		
	 			}else{
	 				$sparecat .= "<li><span id='".$key->unicID."'>".trim( $key->name )."</span>".box_spare_nodes($param)."</li>";		
	 			}
			}	   
		}
		$modelspare = "<ul>".$sparecat."</ul>";
	}
	if ($level == 'spare') {
		$sql_three = "SELECT * FROM moduleItems10 WHERE sectionID = %d;";								  
		$sql_three = $wpdb->prepare($sql_three, $id);
		$date = $wpdb->get_results($sql_three);
		// $modelspare .= $date;

		foreach ($date as $key ){
			if ( $key->enable == 1) {				
	 			$sparecat .= "<tr id='".$key->unicID."'><td class='cell-spare-num spare_article'>".trim( $key->detailNumber )."</td><td class='cell-two'>".trim( $key->detailName )."</td><td class='cell-three'><span class='glyphicon glyphicon-shopping-cart'></span> в корзину</td></tr>";
			}	   
		}
		$modelspare .= "<table id='listsparemodel' class='table table-striped list-spare'>".$sparecat."</table>";
	}
	return $modelspare;
	wp_reset_postdata();
}
add_shortcode('get_box_spare_nodes', 'box_spare_nodes' );


// страница запчастей
// вызывается в ajax
// вывод списка запчастей
function box_spare( $atts ) {
	extract( shortcode_atts( array(
        'id' => '',
        'parent' => '',
        'level' => ''
    ), $atts ) );
    global $wpdb;
    // (level = 0) первый вызов из шаблона страницы page_spare - echo do_shortcode('[get_box_spare level="0"]');
    // выводятся ссылки на табы и их содержимое с рекурсивным вызовом
    // (элементы level = 1) при выборе узла spare_item происходит вызов ajax - wp_ajax_spare. см ajax-catalog.php
    // (элементы level = 2) далее вызов элементов с выбранным parent  get_box_spare parent="'.$spare_id.'" level="2"
    // получаем дочерние элементы по id родителя
	function get_parent_spare($id, $level){
    	global $wpdb;
		$sql_two = "SELECT * FROM wp_kmz_spare WHERE parent = %d;";
		$sql_two = $wpdb->prepare($sql_two, $id);
		$date = $wpdb->get_results($sql_two);
		// выводим два уровня
		if($level == 0){
			$parent = 0;
			$i=1;
			foreach ($date as $key ){				
				$active= ($i==1)?'active':'';
				$sparetab .= "<li class='".$active."'><a href='#tab-".$key->id."' data-toggle='tab'>".trim( preg_replace('/\d\../', '', $key->keyspare) )."</a></li>";			
				$sparecat .= "<div class='row tab-pane ".$active."' style='background-color:#eee' id='tab-".$key->id."'>".get_parent_spare($key->id, 1)."</div>";
				$list_zero = ["sparetab" => $sparetab,"sparecat" => $sparecat];
				$i++;
			}return $list_zero;
		}
		if($level == 1){
			foreach ( $date as $key ){
				$width = ($key->level==2)?'col-md-6':'col-md-4';
				$list_parent .= "<div class='".$width."'><a class='spare_item' id='".$key->id."'>".trim( preg_replace('/\d\.\d\d?\.?/', '', $key->keyspare) )."</a> ".$key->namespare."</div>";
			}
		}
		if($level == 2){
			foreach ( $date as $key ){
				$list_parent .= "<tr  id='".$key->id."'><td class='cell-one'><a class='spare_article'>".trim( $key->keyspare )."</a></td><td class='cell-two'>".$key->namespare."</td><td class='cell-three'><span class='glyphicon glyphicon-shopping-cart'></span> в корзину</td></tr>";
			}
		}
		
		return $list_parent;
	}
	// первый запрос получаем 0 и их дочерние элементы
	if ($level == 0) {
		$list_zero = get_parent_spare(0, $level);
		$list = "<ul class='nav nav-tabs' id='spare-tab' style='margin-top:18px'>".$list_zero['sparetab']."</ul>";
		$list .="<div class='tab-content'>".$list_zero['sparecat']."</div>";
		$list .="<table id='listsparexls' class='table table-striped list-spare'></table>";
		return $list;	
	}
	if ($level == 1) {echo "Категории запчастей";}
	if ($level == 2) {return get_parent_spare($parent, $level);}
}
add_shortcode('get_box_spare', 'box_spare' );


session_start();
// страница корзины
// вывод содержимого сессии на страницу корзины с шорткодом [get_cart_spare]
// всплывающее модальное окно part-spare-modal.php подключено в page.php
function cart_spare(){
	if (!isset($_SESSION['mycart']) ){ return 'Добавьте товары из каталога'; }
	foreach ( $_SESSION['mycart'] as $key => $value ){
		// количество позиций одного наименования
		$input_spinner = '<div class="input-group spinner">
		    <input type="text" class="form-control" data-count-id="'.$key.'" value="'.$value["count"].'">
		    <div class="input-group-btn-vertical">
		    <button class="btn btn-default" data-up-id="'.$key.'" type="button"><i class="fa fa-caret-up"></i></button>
		    <button class="btn btn-default" data-down-id="'.$key.'" type="button"><i class="fa fa-caret-down"></i></button></div></div>';
		$cart_element.= '<tr class="tbstr'.$key.'" ><td>'.$value["name"].'</td><td>'.$input_spinner.'</td>
		 	<td class="text-right"><button type="button" class="btn btn-default spare-del" data-del-id="'.$key.'">
		 	<span class="glyphicon glyphicon-trash"></span></button></td></tr>';		
	}	
	$cart_element = '<table class="table table-hover cart-table">'.$cart_element.'</table>';
	$cart_element.= '<table class="table cart-table"><tr><td><p>Количество позиций <span class="spar_count">'.count($_SESSION['mycart']).'</span></p></td>
		<td class="text-right"><button type="button" data-toggle="modal" data-target="#spare-order" class="btn btn-default">Оформить заказ</button></td></tr></table>';
	// $cart_element. = get_template_part( 'templates/part/part', 'spare-modal' );
	return $cart_element;
}
add_shortcode('get_cart_spare', 'cart_spare' );

// ordering page
function ordering_page(){
	$cart_element = 'gggh';	
	return $cart_element;	
}
add_shortcode('get_ordering_page', 'ordering_page' );






// 
// <!-- Таблица стилей CSS -->
// <style type="text/css">
// h2{
//     margin: 0;     
//     color: #666;
//     padding-top: 90px;
//     font-size: 52px;
//     font-family: "trebuchet ms", sans-serif;    
// }
// .item{
//     background: #333;    
//     text-align: center;
//     height: 300px !important;
// }
// .carousel{
//     margin-top: 20px;
// }
// </style>

// <!-- Карусель -->
// <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
//   <!-- Индикаторы для карусели -->
//   <ol class="carousel-indicators">
//     <!-- Перейти к 0 слайду карусели с помощью соответствующего индекса data-slide-to="0" -->
//     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
//     <!-- Перейти к 1 слайду карусели с помощью соответствующего индекса data-slide-to="1" -->
//     <li data-target="#myCarousel" data-slide-to="1"></li>
//     <!-- Перейти к 2 слайду карусели с помощью соответствующего индекса data-slide-to="2" -->
//     <li data-target="#myCarousel" data-slide-to="2"></li>
//   </ol>   
//   <!-- Слайды карусели -->

  // <div class="carousel-inner">
  //   <!-- Слайды создаются с помощью контейнера с классом item, внутри которого помещается содержимое слайда -->
  //   <div class="active item">
  //     <h2>Слайд №1</h2>
  //     <div class="carousel-caption">
  //       <h3>Заголовок 1 слайда</h3>
  //       <p>Текст (описание) 1 слайда...</p>
  //     </div>
  //   </div>
  //   <!-- Слайд №2 -->
  //   <div class="item">
  //     <h2>Slide 2</h2>
  //     <div class="carousel-caption">
  //       <h3>Second slide label</h3>
  //       <p>Aliquam sit amet gravida nibh, facilisis gravida odio.</p>
  //     </div>
  //   </div>
  //   <!-- Слайд №3 -->
  //   <div class="item">
  //     <h2>Slide 3</h2>
  //     <div class="carousel-caption">
  //       <h3>Third slide label</h3>
  //       <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
  //     </div>
  //   </div>
  // </div>
//   <!-- Навигация для карусели -->
//   <!-- Кнопка, осуществляющая переход на предыдущий слайд с помощью атрибута data-slide="prev" -->
//   <a class="carousel-control left" href="#myCarousel" data-slide="prev">
//     <span class="glyphicon glyphicon-chevron-left"></span>
//   </a>
//   <!-- Кнопка, осуществляющая переход на следующий слайд с помощью атрибута data-slide="next" -->
//   <a class="carousel-control right" href="#myCarousel" data-slide="next">
//     <span class="glyphicon glyphicon-chevron-right"></span>
//   </a>
// </div>