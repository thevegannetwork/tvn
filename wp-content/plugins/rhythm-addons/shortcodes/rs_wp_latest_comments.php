<?php

/**
 *
 * RS WP Rhythm Latest Comments
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_wp_latest_comments($atts, $content = '', $id = '') {

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'title' => '',
		'limit' => '',
	), $atts));

	
	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	$args = array(
		'before_title' => '<h5 class="widget-title font-alt">',
		'after_title' => '</h5>',
	);
	ob_start();
	the_widget( 'WP_Latest_Comments_Widget', $atts, $args );
	$output = ob_get_clean();
	
	return '<div ' . $id . ' class="shortcode-widget ' . sanitize_html_classes($class).'">' . $output . '</div>';
}

add_shortcode('rs_wp_latest_comments', 'rs_wp_latest_comments');
