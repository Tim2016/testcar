<?php
/**
 * Theme Widget ( Contact Info Information )
 *
 * @package WordPress
 * @subpackage Engines
 * @since Engines 1.0
 */
class Yog_Contact_Info_Widget extends WP_Widget {

    function __construct() {

        $widget_ops = array( 'classname' => 'contact-infos', 'description' => esc_html__('Add contact information.', 'engines' ) );

        $control_ops = array( 'id_base' => 'contact-info-widget' );

        parent::__construct( 'contact-info-widget', esc_html__( 'Engines: Contact Info', 'engines' ), $widget_ops, $control_ops );
    }

    function widget( $args, $instance ) {
        extract( $args );
        $yog_title   = apply_filters('widget_title', $instance['engines_title']);
        $yog_address = $instance['engines_address'];
        $yog_email   = $instance['engines_email'];
        $yog_phone   = $instance['engines_phone'];
        $yog_fax        = $instance['engines_fax'];
        $yog_link_txt   = $instance['engines_link_txt'];
        $yog_link       = $instance['engines_link'];

        echo $before_widget;

        if ( $yog_title ) {
            echo $before_title . esc_html( $yog_title ) . $after_title;
        }
        ?>
            <ul class="contact-widget clearfix">
                <?php if ( $yog_address ) : ?>
    			     <li><i class="fa fa-map-marker"></i> <?php echo wp_kses( $yog_address, array( 'br' => array() ) ); ?></li>
                <?php  
                    endif; 
                    if ( $yog_phone ) :   
                ?>
    			     <li><i class="fa fa-phone"></i> <?php echo esc_html( $yog_phone ); ?></li>
                <?php  
                    endif; 
                    if ( $yog_email ) :    
                ?>
    			     <li><i class="fa fa-envelope-o"></i> <?php echo esc_html( $yog_email ); ?></li>
                <?php  
                    endif; 
                    if ( $yog_fax ) :    
                ?>
    			     <li><i class="fa fa-fax"></i> <?php echo esc_html( $yog_fax ); ?></li>
                <?php  
                    endif; 
                    if ( $yog_link ) :    
                ?>
                    <li><a href="<?php echo esc_url( $yog_link ); ?>"><?php echo esc_html( $yog_link_txt ); ?></a></li>     
                <?php endif; ?>    
             </ul>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['engines_title']   = strip_tags( $new_instance['engines_title'] );
        $instance['engines_address'] = $new_instance['engines_address'];
        $instance['engines_email']   = $new_instance['engines_email'];
        $instance['engines_phone']   = $new_instance['engines_phone'];
        $instance['engines_fax']        = $new_instance['engines_fax'];
        $instance['engines_link_txt']   = $new_instance['engines_link_txt'];
        $instance['engines_link']       = $new_instance['engines_link'];

        return $instance;
    }

    function form($instance) {
        $defaults = array( 'engines_title' => esc_html__('Get In Contact', 'engines') );
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>">
                <strong><?php echo esc_html__('Title', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_title') ); ?>" value="<?php if (isset($instance['engines_title'])) echo esc_attr( $instance['engines_title'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_address') ); ?>">
                <strong><?php echo esc_html__('Address', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_address') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_address') ); ?>" value="<?php if (isset($instance['engines_address'])) echo esc_attr( $instance['engines_address'] ); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_email') ); ?>">
                <strong><?php echo esc_html__('Email', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_email') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_email') ); ?>" value="<?php if (isset($instance['engines_email'])) echo esc_attr( $instance['engines_email'] ); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_phone') ); ?>">
                <strong><?php echo esc_html__('Phone', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_phone') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_phone') ); ?>" value="<?php if (isset($instance['engines_phone'])) echo esc_attr( $instance['engines_phone'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_fax') ); ?>">
                <strong><?php echo esc_html__('Fax', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_fax') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_fax') ); ?>" value="<?php if (isset($instance['engines_fax'])) echo esc_attr( $instance['engines_fax'] ); ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_link_txt') ); ?>">
                <strong><?php echo esc_html__('Link Text', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_link_txt') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_link_txt') ); ?>" value="<?php if (isset($instance['engines_link_txt'])) echo $instance['engines_link_txt']; ?>" />
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('engines_link') ); ?>">
                <strong><?php echo esc_html__('Link', 'engines') ?>:</strong>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('engines_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('engines_link') ); ?>" value="<?php if (isset($instance['engines_link'])) echo $instance['engines_link']; ?>" />
            </label>
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'yog_contact_info_load_widget');

function yog_contact_info_load_widget() {
    register_widget('Yog_Contact_Info_Widget');
}
?>