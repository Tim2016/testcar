<?php
/**
 * Theme Widget ( Inventory Search Form )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
 
class Yog_Inventory_Search_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'inventory-search', 'description' => __('Inventory search form.', 'engines' ) );

        $control_ops = array( 'id_base' => 'inventory_search-widget' );

        parent::__construct( 'inventory_search-widget', __( 'Engines: Inventory Search', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['engines_title']);
        $yog_placeholder  = $instance['engines_placeholder'];
        $yog_color  = $instance['engines_color'];
        
        echo $before_widget;
            
            //Widget Title.
            if ($yog_title) {
                echo $before_title . esc_html( $yog_title ) . $after_title;
            }
        ?>  
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
                <div class="widget <?php echo esc_attr( $yog_color ); ?>-widget clearfix">
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-search"></i>
                        <input type="text" name="s"  class="form-control" placeholder="<?php echo esc_attr( $yog_placeholder ); ?>" />
                    </div>
                </div>
                <input type="hidden" name="post_type" value="inventory" />
            </form>
        <?php
        
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['engines_title']   = strip_tags( $new_instance['engines_title'] );
        $instance['engines_placeholder']  = $new_instance['engines_placeholder'];
        $instance['engines_color']  = $new_instance['engines_color'];

        return $instance;
    }

    function form($instance) {
        $defaults = array('engines_placeholder' => esc_html__( 'Search', 'engines' ), 'engines_color' => 'grey');
        $instance = wp_parse_args((array) $instance, $defaults); 
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>">
                <strong><?php echo esc_html__('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_title') ); ?>" value="<?php if (isset($instance['engines_title'])) echo esc_attr( $instance['engines_title'] ); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_placeholder') ); ?>">
                <strong><?php echo esc_html__('Search Placeholder', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_placeholder') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_placeholder') ); ?>" value="<?php if (isset($instance['engines_placeholder'])) echo esc_attr( $instance['engines_placeholder'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_color') ); ?>">
                <strong><?php echo esc_html__('Form Color', 'engines') ?>:</strong>
                <select id="<?php echo esc_attr( $this->get_field_id('engines_color') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_color') ); ?>" class="widefat" >
                    <option value="dark" <?php echo selected( 'dark', $instance['engines_color'], false ); ?>><?php echo esc_html__( 'Dark Color Style', 'engines' ); ?></option>
                    <option value="light" <?php echo selected( 'light', $instance['engines_color'], false ); ?>><?php echo esc_html__( 'Grey Color Style', 'engines' ); ?></option>
                </select>
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_inventory_load_widget');

function yog_inventory_load_widget() {
    register_widget('Yog_Inventory_Search_Widget');
}
?>