<?php

/**
 *
 * RS Parallax
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_cta_2($atts, $content = '', $key = '') {
	$defaults = array(
		'id'         => '',
		'class'      => '',
		'btn_style'  => '',
		'btn_text'   => '',
		'link'       => '',
		'link_2'     => '',
		'btn_text_2' => '',
	);

	extract(shortcode_atts($defaults, $atts));

	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	$btn_style = ( $btn_style ) ? sanitize_html_classes($btn_style) : '';

	$href = $title = $target = '';
	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($link);
		$href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
	}

	$href_2 = $title_2 = $target_2 = '';
	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($link_2);
		$href_2 = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title_2 = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target_2 = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
	}

	$output = '<div class="section-text align-center">';
	$output .= '<blockquote class="cta2">';
	$output .= rs_set_wpautop(wp_kses_post($content));
	$output .= '</blockquote>';
	$output .= '<div class="local-scroll">';
	if (!empty($href)) {
		$output .= '<a href="'.esc_url($href).'" class="btn btn-mod btn-border btn-cta2 btn-medium btn-round hidden-xs" target="'.esc_attr($title).'" title="'.esc_attr($title).'">'.esc_html($btn_text).'</a>';
	}

	if (!empty($href) && !empty($href_2)) {
		$output .= ' <span class="hidden-xs">&nbsp;</span> ';
	}

	if (!empty($href_2)) {
		$output .= '<a href="'.esc_url($href_2).'" class="btn btn-mod btn-medium btn-cta2 btn-round hidden-xs" target="'.esc_attr($target_2).'" title="'.esc_attr($title_2).'">'.esc_html($btn_text_2).'</a>';
	}
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

add_shortcode('rs_cta_2', 'rs_cta_2');
