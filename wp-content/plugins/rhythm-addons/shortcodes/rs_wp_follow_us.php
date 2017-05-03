<?php

/**
 *
 * RS Follow Us Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_wp_follow_us($atts, $content = '', $id = '') {

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'facebook' => '',
		'twitter' => '',
		'googleplus' => '',
		'pinterest' => '',
		'youtube' => '',
		'linkedin' => '',
		'rss' => '',
	), $atts));
	
	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	$args = array(
		'before_title' => '<h5 class="widget-title font-alt">',
		'after_title' => '</h5>',
	);
	ob_start();
	the_widget( 'WP_Follow_Us_Widget', $atts, $args );
	$output = ob_get_clean();
	
	return '<div ' . $id . ' class="shortcode-widget ' . sanitize_html_classes($class).'">' . $output . '</div>';
}

add_shortcode('rs_wp_follow_us', 'rs_wp_follow_us');
