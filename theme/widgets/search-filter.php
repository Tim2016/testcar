<?php
/**
 * Theme Widget ( Inventory Search Filter )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
class Yog_Search_Filter_Widget extends WP_Widget {

    function __construct() {

        $yog_widget_ops  = array( 'classname' => 'advance-filter', 'description' => esc_html__('Add inventory advance search filter.', 'engines' ) );

        $yog_control_ops = array( 'id_base' => 'advance-filter-widget' );

        parent::__construct( 'advance-filter-widget', esc_html__( 'Engines: Advance Filter', 'engines' ), $yog_widget_ops, $yog_control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title        = apply_filters('widget_title', $instance['yog_title']);
        $yog_filter_style = $instance['yog_filter_style'];
        $yog_filter       = $instance['yog_filter'];
        $yog_result_style = $instance['yog_result_style'];
        $yog_columns      = $instance['yog_columns'];
        $yog_tab_one      = $instance['yog_tab_one'];
        $yog_tab_two      = $instance['yog_tab_two'];
        $yog_cat_excluded = $instance['yog_cat_excluded'];
        
        $current_post_type = 'inventory';
        
    	//Get the post type object
		$post_type_object = get_post_type_object($current_post_type);
        
		//Return the rewrite slug which is the one we actually want!
		$current_post_type_rewrite = $post_type_object->rewrite['slug'];
       
        //Get the taxonomies of the current post type and the excluded taxonomies
		if( isset( $yog_cat_excluded ) && !empty( $yog_cat_excluded ) ){
            $excluded_taxonomies = explode( ',', $yog_cat_excluded );
        }
        
		//Also make sure we don't try to output the builtin taxonomies since they cannot be supported
		if(is_array($excluded_taxonomies)){
			array_push($excluded_taxonomies, 'category', 'post_tag', 'post_format');
		}else{
			$excluded_taxonomies = array(
				'category',
				'post_tag',
				'post_format'
			);
		}
        
        $current_taxonomies = get_object_taxonomies($current_post_type, 'objects');
        
        //If we both have taxonomies on the post type AND we've set som excluded taxonomies in the plugins settings. Loop through them and unset those we don't want!
		if($current_taxonomies && $excluded_taxonomies){
			foreach($current_taxonomies as $key => $value){
				if(in_array($key, $excluded_taxonomies)){
					unset($current_taxonomies[$key]);
				}
			}
		}

        echo $before_widget;
        
            // Title
            if ( $yog_title ) {
                echo $before_title . esc_html( $yog_title ) . $after_title;
            }
            
            $tab_class = ( $yog_filter_style == 'grey' )? ' light-tab' : ''; 
        ?>    
            <div class="widget clearfix">
                <div class="search-tab<?php echo esc_attr( $tab_class ); ?> clearfix">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs search-tab-nav" role="tablist">
                        <?php if( $yog_filter == 'new' || $yog_filter == 'both' ): ?>
                            <li role="presentation" class="active"><a href="#tab01" role="tab" data-toggle="tab"><?php echo esc_html( $yog_tab_one ); ?></a></li>
                        <?php endif; if( $yog_filter == 'old' || $yog_filter == 'both' ): ?>
                            <li role="presentation"><a href="#tab02" role="tab" data-toggle="tab"><?php echo esc_html( $yog_tab_two ); ?></a></li>
                        <?php  endif; ?>    
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <?php if( $yog_filter == 'new' || $yog_filter == 'both' ): ?>
                            <div role="tabpanel" class="tab-pane in active" id="tab01">
                                <div class="search-wrapper">
                                    <form method="POST" class="row" id="taxonomy-filters-form">
                        				<input type="hidden" name="site-url" value="<?php echo esc_url( home_url('/') ); ?>" />
                        				<input type="hidden" name="post_type_rewrite" value="<?php echo esc_attr( $current_post_type_rewrite ); ?>" />
                        				<input type="hidden" name="post_type" value="<?php echo esc_attr( $current_post_type ); ?>" />
                                        <input type="hidden" name="condition" value="new" />
                        				<?php wp_nonce_field( 'taxonomy-filters-do-filter', 'do_filtering_nonce' ); ?>
                        				<?php
                        				//Loop through the taxonomies and output their terms in a select dropdown
                        				$count = count($current_taxonomies);
                        				$taxonomies_ordered = apply_filters('filters_taxonomy_order', array_keys($current_taxonomies), $current_post_type);
                        				?>
                        				<div class="taxonomy-filters-select-wrap col-md-12 col-sm-12 col-xs-12">
                        					<?php foreach($taxonomies_ordered as $key): ?>
                        						<?php
                        						$taxonomy = $current_taxonomies[$key];
                        						$terms = get_terms($key);
                        						?>
                        						<?php if(!empty($terms) && !is_wp_error($terms)): ?>
                        							<div class="form-input taxonomy-filters-tax filter-count-<?php echo $count; if($count > 5){ echo ' filter-count-many'; } ?>" id="taxonomy-filters-tax-<?php echo $key; ?>">
                                                        <label for="select-<?php echo $key; ?>" class="taxonomy-filters-label"><?php echo apply_filters( 'beautiful_filters_taxonomy_label', $taxonomy->labels->name, $taxonomy->name); ?></label>
                        								<?php
                            								$dropdown_args = array(
                            									'show_option_all' => __('All ', 'engines') . $taxonomy->labels->name,
                            									'taxonomy'        => $key,
                            									'name'            => 'select-'.$key, //BUG?? For some reason we can't use the actual taxonomy slugs. If we do wordpress automatically fetches the correct posts without us even changing the URL HOWEVER it all breaks when the term has a non standard latin character in its name (not even in the slug which is what we actually use) such as едц
                            									'orderby'         => apply_filters( 'filters_dropdown_orderby', 'name', $key ),
                            									'order' 	 	  => apply_filters( 'filters_dropdown_order', 'ASC', $key ),
                            									'hierarchical'    => true,
                            									'class'			  => 'selectpicker',
                            									'walker'          => new Yog_Walker_Slug_Value_Category_Dropdown()
                            								);
                                                            
                            								//create the dropdown
                            								wp_dropdown_categories( $dropdown_args );
                        								?>
                        							</div>
                        						<?php endif; ?>
                        					<?php endforeach; ?>
                        				</div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-input">
                                                <label><?php echo yog_get_translation( 'tr-inv-search-min-price' ); ?></label>
                                                <input type="number" class="widefat form-control" id="<?php echo esc_attr( $this->get_field_id('price_min') ); ?>" name="price_min" value="<?php if (isset($instance['price_min'])) echo esc_attr( $instance['price_min'] ); ?>" />
                                            </div>
                                        </div>
                
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-input">
                                                <label><?php echo yog_get_translation( 'tr-inv-search-max-price' ); ?></label>
                                                <input type="number" class="widefat form-control" id="<?php echo esc_attr( $this->get_field_id('price_max') ); ?>" name="price_max" value="<?php if (isset($instance['price_max'])) echo esc_attr( $instance['price_max'] ); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                        				    <button type="submit" class="btn btn-primary btn-block"><?php echo apply_filters( 'filters_apply_button', __('Apply filter', 'engines') ); ?></button>
                        				    <a href="<?php echo get_post_type_archive_link($current_post_type); ?>" class="taxonomy-filters-clear-all customa" title="<?php _e('Click to clear all active filters', 'engines'); ?>"><i class="fa fa-refresh"></i> <?php echo apply_filters( 'filters_clear_button', esc_html__('Clear all', 'engines') ); ?></a>
                        			    </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; if( $yog_filter == 'old' || $yog_filter == 'both' ):  $class_active = ( $yog_filter == 'old' )? ' in active' : ''; ?>
                            <div role="tabpanel" class="tab-pane<?php echo esc_attr( $class_active ); ?>" id="tab02">
                                <div class="search-wrapper">
                                    <form method="POST" class="row" id="taxonomy-filters-form">
                        				<input type="hidden" name="site-url" value="<?php echo esc_url( home_url('/') ); ?>" />
                        				<input type="hidden" name="post_type_rewrite" value="<?php echo esc_attr( $current_post_type_rewrite ); ?>" />
                        				<input type="hidden" name="post_type" value="<?php echo esc_attr( $current_post_type ); ?>" />
                                        <input type="hidden" name="condition" value="used" />
                        				<?php wp_nonce_field( 'taxonomy-filters-do-filter', 'do_filtering_nonce' ); ?>
                        				<?php
                        				//Loop through the taxonomies and output their terms in a select dropdown
                        				$count = count($current_taxonomies);
                        				$taxonomies_ordered = apply_filters('filters_taxonomy_order', array_keys($current_taxonomies), $current_post_type);
                        				?>
                    				  <div class="taxonomy-filters-select-wrap col-md-12 col-sm-12 col-xs-12">
                    					<?php foreach($taxonomies_ordered as $key): ?>
                    						<?php
                    						$taxonomy = $current_taxonomies[$key];
                    						$terms = get_terms($key);
                    						?>
                    						<?php if(!empty($terms) && !is_wp_error($terms)): ?>
                    							<div class="form-input taxonomy-filters-tax filter-count-<?php echo $count; if($count > 5){ echo ' filter-count-many'; } ?>" id="taxonomy-filters-tax-<?php echo $key; ?>">
                                                    <label for="select-<?php echo $key; ?>" class="taxonomy-filters-label"><?php echo apply_filters( 'beautiful_filters_taxonomy_label', $taxonomy->labels->name, $taxonomy->name); ?></label>
                    								<?php
                        								$dropdown_args = array(
                        									'show_option_all' => __('All ', 'engines') . $taxonomy->labels->name,
                        									'taxonomy'      => $key,
                        									'name'          => 'select-'.$key, //BUG?? For some reason we can't use the actual taxonomy slugs. If we do wordpress automatically fetches the correct posts without us even changing the URL HOWEVER it all breaks when the term has a non standard latin character in its name (not even in the slug which is what we actually use) such as едц
                        									'orderby'       => apply_filters( 'filters_dropdown_orderby', 'name', $key ),
                        									'order' 		=> apply_filters( 'filters_dropdown_order', 'ASC', $key ),
                        									'hierarchical'  => true,
                        									'class'			=> 'selectpicker',
                        									'walker'        => new Yog_Walker_Slug_Value_Category_Dropdown()
                        								);
                                                        
                        								//create the dropdown
                        								wp_dropdown_categories( $dropdown_args );
                    								?>
                    							</div>
                    						<?php endif; ?>
                    					<?php endforeach; ?>
                    				</div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-input">
                                            <label><?php echo yog_get_translation( 'tr-inv-search-min-price' ); ?></label>
                                            <input type="number" class="widefat form-control" id="<?php echo esc_attr( $this->get_field_id('price_min') ); ?>" name="price_min" value="<?php if (isset($instance['price_min'])) echo esc_attr( $instance['price_min'] ); ?>" />
                                        </div>
                                    </div>
            
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-input">
                                            <label><?php echo yog_get_translation( 'tr-inv-search-max-price' ); ?></label>
                                            <input type="number" class="widefat form-control" id="<?php echo esc_attr( $this->get_field_id('price_max') ); ?>" name="price_max" value="<?php if (isset($instance['price_max'])) echo esc_attr( $instance['price_max'] ); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                    				    <button type="submit" class="btn btn-primary btn-block"><?php echo apply_filters( 'filters_apply_button', __('Apply filter', 'engines') ); ?></button>
                    				    <a href="<?php echo get_post_type_archive_link($current_post_type); ?>" class="taxonomy-filters-clear-all customa" title="<?php _e('Click to clear all active filters', 'engines'); ?>"><i class="fa fa-refresh"></i> <?php echo apply_filters( 'filters_clear_button', esc_html__('Clear all', 'engines') ); ?></a>
                    			    </div> 
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>  
                </div>
            </div>
        </div>    
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['yog_title']          = strip_tags( $new_instance['yog_title'] );
        $instance['yog_filter_style']   = $new_instance['yog_filter_style'];
        $instance['yog_filter']         = $new_instance['yog_filter'];
        $instance['yog_result_style']   = $new_instance['yog_result_style'];
        $instance['yog_columns']        = $new_instance['yog_columns'];
        $instance['yog_tab_one']        = $new_instance['yog_tab_one'];
        $instance['yog_tab_two']        = $new_instance['yog_tab_two'];
        $instance['yog_cat_excluded']   = $new_instance['yog_cat_excluded'];
        
        return $instance;
    }

    function form($instance) {
        $defaults = array( 'yog_tab_one' => esc_html__('New Cars', 'engines'), 'yog_tab_two' => esc_html__( 'Used Cars', 'engines' ) );
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_title')); ?>">
                <strong><?php echo esc_html__('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_title')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_title') ); ?>" value="<?php if (isset($instance['yog_title'])) echo esc_attr( $instance['yog_title'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_filter_style')); ?>">
                <strong><?php echo esc_html__('Filter Style', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('yog_filter_style')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_filter_style') ); ?>" class="widefat" >
                    <option value="dark" <?php echo selected( 'dark', $instance['yog_filter_style'], false ); ?>><?php echo esc_html__( 'Dark Color Style', 'engines' ); ?></option>
                    <option value="grey" <?php echo selected( 'grey', $instance['yog_filter_style'], false ); ?>><?php echo esc_html__( 'Grey Color Style', 'engines' ); ?></option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_result_style')); ?>">
                <strong><?php echo esc_html__('Filter Result Style', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('yog_result_style')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_result_style') ); ?>" class="widefat" >
                    <option value="grid" <?php echo selected( 'grid', $instance['yog_result_style'], false ); ?>><?php echo esc_html__( 'Grid Style', 'engines' ); ?></option>
                    <option value="list" <?php echo selected( 'list', $instance['yog_result_style'], false ); ?>><?php echo esc_html__( 'List Style', 'engines' ); ?></option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_columns')); ?>">
                <strong><?php echo esc_html__('Grid Column', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('yog_columns')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_columns') ); ?>" class="widefat" >
                    <option value="2" <?php echo selected( '2', $instance['yog_columns'], false ); ?>><?php echo esc_html__( 'Two Column', 'engines' ); ?></option>
                    <option value="3" <?php echo selected( '3', $instance['yog_columns'], false ); ?>><?php echo esc_html__( 'Three Column', 'engines' ); ?></option>
                    <option value="4" <?php echo selected( '4', $instance['yog_columns'], false ); ?>><?php echo esc_html__( 'Four Column', 'engines' ); ?></option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_filter')); ?>">
                <strong><?php echo esc_html__('Filter', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('yog_filter')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_filter') ); ?>" class="widefat" >
                    <option value="new" <?php echo selected( 'new', $instance['yog_filter'], false ); ?>><?php echo esc_html__( 'New Car', 'engines' ); ?></option>
                    <option value="old" <?php echo selected( 'old', $instance['yog_filter'], false ); ?>><?php echo esc_html__( 'Old Car', 'engines' ); ?></option>
                    <option value="both" <?php echo selected( 'both', $instance['yog_filter'], false ); ?>><?php echo esc_html__( 'Both ( New Car & old Car )', 'engines' ); ?></option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_tab_one')); ?>">
                <strong><?php echo esc_html__('Tab One Heading', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_tab_one')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_tab_one') ); ?>" value="<?php if (isset($instance['yog_tab_one'])) echo esc_attr( $instance['yog_tab_one'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_tab_two')); ?>">
                <strong><?php echo esc_html__('Tab Two Heading', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_tab_two')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_tab_two') ); ?>" value="<?php if (isset($instance['yog_tab_two'])) echo esc_attr( $instance['yog_tab_two'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_cat_excluded') ); ?>">
                <strong><?php echo esc_html__('Categies excluded', 'engines') ?>:</strong>
                <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_cat_excluded')); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_cat_excluded') ); ?>" ><?php if (isset($instance['yog_cat_excluded']))echo esc_textarea( $instance['yog_cat_excluded'] ); ?></textarea>
                <br /><?php echo __('Please insert category which you want to excluded from filder separate each category with commas categories are: <br /><strong>(body,make,model,fuel_type,engine,registration_year,<br/>fuel_consumption,transmission,fuel_economy,<br/>exterior_color,interior_color)</strong> <br /> Note: Please choose categories from description list and do not leave any space between categories', 'engines') ?>
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_search_filter_widget');

function yog_search_filter_widget() {
    register_widget('Yog_Search_Filter_Widget');
}