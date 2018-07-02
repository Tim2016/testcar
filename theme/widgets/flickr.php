<?php
/**
 * Theme Widget ( Filckr Feeds )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
class Yog_filckr_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'flickr', 'description' => esc_html__('Show Your Flickr Images.', 'engines' ) );

        $control_ops = array( 'id_base' => 'recent_flickr-widget' );

        parent::__construct( 'recent_flickr-widget', esc_html__( 'Engines: Flickr Feeds', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['yog_title']);
        $yog_user    = $instance['yog_user'];
        $yog_number  = $instance['yog_number'];
      
        echo $before_widget;
        
        //Widget Title.after
        if ($yog_title) {
            echo $before_title . esc_html( $yog_title ) . $after_title;
        }
        ?>
              <ul class="instawidget list-inline flickr-feeds"  data-user= "<?php echo esc_attr( $yog_user ); ?>" data-limit= "<?php echo esc_attr( $yog_number ); ?>" ></ul>
        <?php
            echo $after_widget;
        
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['yog_title']   = strip_tags( $new_instance['yog_title'] );
        $instance['yog_user']    = $new_instance['yog_user'];
        $instance['yog_number']  = $new_instance['yog_number'];
        

        return $instance;
    }

    function form($instance) {
        $defaults = array('yog_title' => esc_html__('Flickr Feed', 'engines'), 'yog_user' => '51035555243@N01',  'yog_number' => 9 );
        $instance = wp_parse_args((array) $instance, $defaults); 
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_title') ); ?>">
                <strong><?php esc_html_e('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_title') ); ?>" value="<?php if (isset($instance['yog_title'])) echo $instance['yog_title']; ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_user') ); ?>">
                <strong><?php esc_html_e('User Name', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_user') ); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_user') ); ?>" value="<?php if (isset($instance['yog_user'])) echo $instance['yog_user']; ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('yog_number') ); ?>">
                <strong><?php esc_html_e('Number of Images', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('yog_number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('yog_number') ); ?>" value="<?php if (isset($instance['yog_number'])) echo $instance['yog_number']; ?>" />
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_filckr_load_widget');

function yog_filckr_load_widget() {
    register_widget('Yog_filckr_Widget');
}
?>