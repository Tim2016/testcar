<?php
/**
 * Theme Widget ( Recent Testimonials )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
class Yog_Recent_Testimonial_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'recent-testimonial', 'description' => esc_html__('Your sites most recent testimonial..', 'engines' ) );

        $control_ops = array( 'id_base' => 'recent_testimonial-widget' );

        parent::__construct( 'recent_testimonial-widget', esc_html__( 'Engines: Recent Testimonial', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['engines_title']);
        $yog_number  = $instance['engines_number'];
        $yog_cat     = $instance['engines_cat'];
        
        //Default Post Arguments
        $yog_args = array(
            'post_type' => 'testimonial',
            'posts_per_page' => $yog_number
        );
        
        //Category Filter.
        if ( ! empty( $yog_cat ) ) {

            $yog_args['tax_query']['relation'] = 'OR';
            $yog_args['tax_query'][] = array(
                'taxonomy' => 'testimonial_category',
                'field' => 'slug',
                'terms' => $yog_cat,
            );
        }
        //Query.
        $yog_posts = new WP_Query($yog_args);

        if ($yog_posts->have_posts()) :

            echo $before_widget;
            
            echo '<div class="widget custom-widget clearfix">';
            
            //Widget Title.
            if ($yog_title) {
                echo $before_title . esc_html( $yog_title ) . $after_title;
            }
            
        ?>  
               <?php 
                    //Post Loop.
                    while ($yog_posts->have_posts()) {
                        $yog_posts->the_post();
                        
                        ?>
                        <div class="sidebar-testimonial">
                            <div class="testimonial clearfix">
                                <?php the_content(); ?>
                                <div class="testi-meta">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'img-responsive alignleft' ) ); ?>  
                                    <h4><?php the_title(); ?> <?php the_terms( get_the_ID(), 'designation', '<small>- ', ', ', '</small>' ); ?></h4>
                                    <?php 
                                        //Rating
                                        $rating = yog_helper()->get_option( 'testimonial-star', 'raw', false, 'post' ) ; 
                                        if( $rating ){
                                            echo '<div class="rating">';
                                        
                                            for( $x = 1; $x <= $rating; $x++ ){
                                                echo '<i class="fa fa-star"></i>';
                                            }
                                            
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    
                    //Reset Post Date
                    wp_reset_postdata();
               ?> 
        <?php
        
            echo '</div>';
            
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
        $defaults = array('engines_title' => esc_html__('Customers Reviews', 'engines'), 'engines_number' => 1,  'engines_cat' => '');
        $instance = wp_parse_args((array) $instance, $defaults); 
        $taxonomies = get_terms( 'testimonial_category' );
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

add_action('widgets_init', 'yog_recent_testimonial_load_widget');

function yog_recent_testimonial_load_widget() {
    register_widget('Yog_Recent_Testimonial_Widget');
}
?>