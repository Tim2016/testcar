<?php
/*
 * Testimonial Section
 *
 * Available options on $section array:
 * separate_box (boolean) - separate metabox is created if true
 * box_title - title for separate metabox
 * title - section title
 * desc - section description
 * icon - section icon
 * fields - fields, @see https://docs.reduxframework.com/ for details
*/

$sections[] = array(
	'post_types' => array('testimonial'),
	'title'      => esc_html__('Testimonial Information', 'engines'),
	'icon'       => 'el-icon-adjust-alt',
	'fields'     => array(

		array(
            'id'        => 'testimonial-star',
            'type'      => 'slider',
            'title'     => esc_html__('Rating', 'engines'),
            'subtitle'  => esc_html__('Choose Rating.', 'engines'),
            'desc'      => esc_html__('Slider description. Min: 1, max: 5, step: 1, default value: 5', 'engines'),
            "min"       => 1,
            "step"      => 1,
            "max"       => 5
        )
	)
);