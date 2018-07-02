<?php 
    /**
 * The Custom Walker class being used by our wp_dropdown_categories to render the filter dropdowns
 *
 * 
 * @category VC extend
 * @author YOGThemes
 * @since  1.0
 * @package yog-addons
 * @subpackage yog-addons/includes/libs/js_composer
 *
 */
class Yog_Filter_Slug_Value_Category_Dropdown extends Walker_CategoryDropdown {

	private $post_type;

    function __construct() {
        
        $this->post_type = 'inventory';
    
    }
    
	/**
     * Start the element output.
     *
     * @see Walker::start_el()
     * @since 1.0.0
     *
     * @param string $output   Passed by reference. Used to append additional content.
     * @param object $category Category data object.
     * @param int    $depth    Depth of category. Used for padding.
     * @param array  $args     Uses 'selected', 'show_count', and 'value_field' keys, if they exist.
     *                         See {@see wp_dropdown_categories()}.
     */
    function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {

    	global $wp_query;
		$queryvars = $wp_query->query_vars;
        $cat_name = apply_filters('list_cats', $category->name, $category);
        $output .= "\t" . '<option class="' . $category->slug . '" value="' . $category->term_id . '"';
        if(isset($_GET)){
        	foreach($_GET as $get_variable){
	        	if(strpos($get_variable,',') !== false){
		        	$get_array = explode(',', $get_variable);
	        	}else{
		        	$get_array[] = $get_variable;
	        	}
	        	foreach($get_array as $get_single){
		        	if ( $category->term_id == $args['selected'] || $get_single == $category->slug ){
						$output .= ' selected="selected" ';
					}
	        	}
        	}
		}
		if ( in_array($category->slug, $queryvars, true)  ) {
			$output .= ' selected="selected" ';
		}
        $output .= '>';

        //run our custom filter
        $output .= apply_filters( 'beautiful_filters_term_name', $cat_name, $category, $depth );
        
        $output .= "</option>\n";

	}
}
?>
<!-- start sidebar tools -->
<form class="searchy-search-form" method="post">
   
  <div class="form-group" id="searchy-by-name">
	<label for="SearchybyName"><span class="glyphicon glyphicon-pencil"></span> <?php esc_html_e( 'Search by Name', 'yog-filter' ); ?></label>
	<input type="text" class="form-control" id="SearchybyName" name="SearchybyName" placeholder="<?php esc_attr_e( 'Enter Title...', 'yog-filter' ); ?>">
  </div>
  
  <div class="form-group" id="searchy-by-cat">
       
       <?php 
           //Get Filter Option Values
           $yog_categories  = yog_helper()->get_option( 'cat-checkbox', 'raw', false, 'options' );
           $yog_cat_exclude = yog_helper()->get_option( 'cat-exclude', 'raw', false, 'options' );
           
           //Get all categories               
	       $current_taxonomies = get_object_taxonomies('inventory', 'objects');
           
           //If we both have taxonomies on the post type AND we've set som excluded taxonomies in the plugins settings. Loop through them and unset those we don't want!
           if($current_taxonomies && $yog_cat_exclude){
    			foreach($current_taxonomies as $key => $value){
    				if(in_array($key, $yog_cat_exclude)){
    					unset($current_taxonomies[$key]);
    				}
    			}
    	   }
           
           //Filter Order
           $taxonomies_ordered = apply_filters('filters_taxonomy_order', array_keys($current_taxonomies), 'inventory');
           
           //Loop All Caategories
           if ($taxonomies_ordered) foreach ( $taxonomies_ordered as $key ){
	           
               $taxonomy = $current_taxonomies[$key];
               
	           $terms = get_terms($key);
               if(!empty($terms) && !is_wp_error($terms) ):
               
                  echo '<label for="SearchybyCat"><span class="glyphicon glyphicon-globe"></span> '. $taxonomy->label .'</label>';
                  
                  if( $taxonomy->name == 'registration_year' ){
                    
                    ?>
                    <div class="row form-input">
                        <div class="col-md-6"><input type="text" id="year-to" name="year-to" class="form-control date-picker-to" placeholder="Date To"/></div>
                        <div class="col-md-6"><input type="text" id="year-from" name="year-from" class="form-control date-picker-from" placeholder="Date From"/></div>
                    </div>
                    <?php
                    
                  }elseif(  isset( $yog_categories ) && !empty( $yog_categories ) && in_array( $taxonomy->name, $yog_categories ) ){

                    $counter = 1; $length = count( $terms );
                    
                     echo '<div class="block showmore_one form-input">';
                     
                         foreach( $terms as $term ):
                            
                            //$class = ( $counter >= 5 )? 'hide-content' : '';
                    	  ?>
                            <div class="checkbox">
                    	       <input type="checkbox" name="<?php echo $taxonomy->name; ?>[]" value="<?php echo $term->term_id ?>" /> <label>Truck <?php echo $term->name ?></label>
                            </div>
                          <?php 
                             //Display More Link
                             if( $counter > 5 && $length == $counter ){
                                //echo '<a href="#" class="show-more" ><i class="glyphicon glyphicon-expand"></i> Show More</a>';
                             }    
                             
                             //Increments
                             $counter++;
                               
                          endforeach;
                      
                      echo '</div><div class="clearfix"></div>';
                    
                  }else{  
                  
                     ?>
    				<div class="form-input taxonomy-filters-tax filter-count-<?php echo $count; if($count > 5){ echo ' filter-count-many'; } ?>">
                        <div class="bootstrap-select">
                            <?php
    						$dropdown_args = array(
    							'show_option_all' => esc_html__('All ', 'yog') . $taxonomy->labels->name,
                                'hide_empty'    => '0',
    							'taxonomy'      => $key,
    							'name'          => $key.'[]', 
    							'orderby'       => apply_filters( 'filters_dropdown_orderby', 'name', $key ),
    							'order' 		=> apply_filters( 'filters_dropdown_order', 'ASC', $key ),
    							'hierarchical'  => true,
                                'id'            => 'select-'.$key. '-' . $cat_counter,
    							'class'			=> 'selectpicker',
    							'walker'        => new Yog_Filter_Slug_Value_Category_Dropdown()
    						);
                            
    						//create the dropdown
    						wp_dropdown_categories( $dropdown_args );
                            
                            $cat_counter++;
    						?>
                        </div>
    				</div>
    				<?php
                }
                
              endif;
         } 
      ?>
  </div>  
  
  <div class="form-group" id="searchy-by-meta">
  
     <label for="SearchybyName"><span class="glyphicon glyphicon-pencil"></span> <?php esc_html_e( 'Stock Number', 'yog-filter' ); ?></label>
     <div class="form-input">
        <input type="text" name="stock-number" class="form-control" placeholder="Stock Number"/>
     </div>
     
     <label for="SearchybyName"><span class="glyphicon glyphicon-credit-card"></span> <?php esc_html_e( 'Price', 'yog-filter' ); ?></label>
     <div class="row price_slider_wrapper">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-input">
                <input type="text" id="price_min" name="price_min" class="filter-field" readonly />
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-input">
                <input type="text" id="price_max" name="price_max" class="filter-field" readonly />
            </div>
        </div>
    </div>
    <div id="price-slider-range" ></div>
    
    <label for="SearchybyName"><span class="glyphicon glyphicon-globe"></span> <?php esc_html_e( 'Mileage', 'yog-filter' ); ?></label>
    <div class="row price_slider_wrapper">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-input">
                <input type="text" id="mileage_min" name="mileage_min" class="filter-field" readonly />
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-input">
                <input type="text" id="mileage_max" name="mileage_max" class="filter-field" readonly />
            </div>
        </div>
    </div>
    <div id="mileage-slider-range" data-min="1" data-max="10000"></div>
    
  </div>
  
  <input type="submit" class="btn btn-primary searchy-trigger-search" /></button>
 	  
</form>