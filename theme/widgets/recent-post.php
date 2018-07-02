<?php
/**
 * Theme Widget ( Recent Posts )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
class Yog_Recent_Post_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'recent-post', 'description' => esc_html__('Your sites most recent Posts..', 'engines' ) );

        $control_ops = array( 'id_base' => 'recent_posts-widget' );

        parent::__construct( 'recent_posts-widget', esc_html__( 'Engines: Recent Post', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['engines_title']);
        $yog_number  = $instance['engines_number'];
        $yog_cat     = $instance['engines_cat'];
        
        //Default Post Arguments
        $yog_args = array(
            'post_type' => 'post',
            'posts_per_page' => $yog_number
        );
        
        //Category Filter.
        if ( ! empty( $yog_cat ) ) {

            $yog_args['tax_query']['relation'] = 'OR';
            $yog_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $yog_cat,
            );
        }
        //Query.
        $yog_posts = new WP_Query($yog_args);

        if ($yog_posts->have_posts()) :

            echo $before_widget;
            
            //Widget Title.
            if ($yog_title) {
                echo $before_title . $yog_title . $after_title;
            }
        ?>
            <ul class="related-post clearfix">
               <?php 
                    //Post Loop.
                    while ($yog_posts->have_posts()) {
                        $yog_posts->the_post();
                        ?>
                        <li>
    						<a href="<?php the_permalink(); ?>" <?php yog_helper()->attr( 'entry-title' ) ?>><?php the_title(); ?></a>
    						<small <?php yog_helper()->attr( 'entry-published' ); ?>><i class="fa fa-clock-o"></i> <?php echo  get_the_date('M d, Y'); ?></small>
    					</li>
                        <?php
                    }
                    
                    //Reset Post Date
                    wp_reset_postdata();
               ?>    
            </ul>
        <?php
            echo $after_widget;
        
        endif;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['engines_title']   = strip_tags( $new_instance['engines_title'] );
        $instance['engines_number']  = $new_instance['engines_number'];
        $instance['engines_cat']     = $new_instance['engines_cat'];

        return $instance;
    }

    function form($instance) {
        $defaults = array('engines_title' => esc_html__('Recent Posts', 'engines'), 'engines_number' => 3,  'engines_cat' => '');
        $instance = wp_parse_args((array) $instance, $defaults); 
        $taxonomies = get_terms( 'category' );
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>">
                <strong><?php echo esc_html__('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_title') ); ?>" value="<?php if (isset($instance['engines_title'])) echo esc_attr( $instance['engines_title'] ); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_number') ); ?>">
                <strong><?php echo esc_html__('Number of posts to show', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_number') ); ?>" value="<?php if (isset($instance['engines_number'])) echo esc_attr( $instance['engines_number'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_cat') ); ?>">
                <strong><?php echo esc_html__('Category', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('engines_cat') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_cat') ); ?>" class="widefat" >
                    <?php 
                        foreach ( $taxonomies as $taxonomy ) {
            				printf(
            					'<option value="%s"%s>%s</option>',
            					esc_attr( $taxonomy->slug ),
            					selected( $taxonomy->slug, $instance['engines_cat'], false ),
            					$taxonomy->name
            				);
            			}
                    ?>
                </select>
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_recent_post_load_widget');

function yog_recent_post_load_widget() {
    register_widget('Yog_Recent_Post_Widget');
}
?>