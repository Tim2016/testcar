<?php
/**
 * Theme Widget ( Schedule )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
class Yog_Schedule_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'schedule', 'description' => esc_html__('Add working hours time information.', 'engines' ) );

        $control_ops = array( 'id_base' => 'schedule-widget' );

        parent::__construct( 'schedule-widget', esc_html__( 'Engines: Working Schedule', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['engines_title']);
        $yog_heading = $instance['engines_heading'];
        $yog_description = $instance['engines_description'];
        $yog_heading_two   = $instance['engines_heading_two'];
        $yog_description_two   = $instance['engines_description_two'];

        echo $before_widget;
        
            // Title
            if ( $yog_title ) {
                echo $before_title . esc_html( $yog_title ) . $after_title;
            }
        ?>    
            <ul class="related-post working-hours clearfix">
                <li>
                    <?php
                        // Heading 
                        if( $yog_heading ){
                            echo '<h5>'. esc_html( $yog_heading ) .'</h5>';
                        }
                        
                        // Description 
                        if( $yog_description ){
                            echo $yog_description;
                        }
                    ?>
                </li>
                <li>
                    <?php
                        // Heading 
                        if( $yog_heading_two ){
                            echo '<h5>'. esc_html( $yog_heading_two ) .'</h5>';
                        }
                        
                        // Description 
                        if( $yog_description_two ){
                            echo $yog_description_two;
                        }
                    ?>
                </li>
             </ul>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['engines_title']   = strip_tags( $new_instance['engines_title'] );
        $instance['engines_heading'] = $new_instance['engines_heading'];
        $instance['engines_description'] = $new_instance['engines_description'];
        $instance['engines_heading_two'] = $new_instance['engines_heading_two'];
        $instance['engines_description_two']   = $new_instance['engines_description_two'];

        return $instance;
    }

    function form($instance) {
        $defaults = array( 'engines_title' => esc_html__('Working Hours', 'engines') );
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>">
                <strong><?php echo esc_html__('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_title') ); ?>" value="<?php if (isset($instance['engines_title'])) echo esc_attr( $instance['engines_title'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_heading') ); ?>">
                <strong><?php echo esc_html__('Heading', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_heading') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_heading') ); ?>" value="<?php if (isset($instance['engines_heading'])) echo esc_attr( $instance['engines_heading'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_description') ); ?>">
                <strong><?php echo esc_html__('Description', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_description') ); ?>" value="<?php if (isset($instance['engines_description'])) echo esc_attr( $instance['engines_description'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_heading_two') ); ?>">
                <strong><?php echo esc_html__('Heading', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_heading_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_heading_two') ); ?>" value="<?php if (isset($instance['engines_heading_two'])) echo esc_attr( $instance['engines_heading_two'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_description_two') ); ?>">
                <strong><?php echo esc_html__('Description', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_description_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_description_two') ); ?>" value="<?php if (isset($instance['engines_description_two'])) echo esc_attr( $instance['engines_description_two'] ); ?>" />
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_contact_schedule_widget');

function yog_contact_schedule_widget() {
    register_widget('Yog_Schedule_Widget');
}