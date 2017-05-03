<?php

/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_el_icon($atts, $content = '', $id = '') {

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'selected_icon' => '',
		'icon_size' => '',
		'icon_color' => '',
		'align' => '',
		'show' => 'single',
		'icon' => '',
		'result_text' => ''
	), $atts));

	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	
	$output = '<div ' . $id . 'class="et-icon-container '.$class.'">';
	
	if ($show == 'single') {
		
		$style = array();
		if ($icon_size) {
			$style[] = 'font-size: '.esc_attr($icon_size);
		}
		if ($icon_color) {
			$style[] = 'color: '.esc_attr($icon_color);
		}
		
		if (count($style) > 0) {
			$style_tag = 'style="'.implode(';', $style).'"';
		}
		
		if ($align == 'aligncenter') {
			$align .= ' align-center';
		}
		
		$output .= '<div class="' . esc_attr($selected_icon) . ' '.sanitize_html_classes($align).'" '.$style_tag.'></div>';
	}
	
	else if ($show == 'list') {

		$et_icons = rs_el_icons();
		$output = '<div ' . $id . ' class="col-md-8 col-md-offset-2 mb-30' . $class . '">';
		$output .= '<div class="section-text align-center">';
		$output .= '<p>' . do_shortcode(wp_kses_data($content)) . '</p>';
		$output .= '<div class="row">';
		$output .= '<div class="col-md-8 col-md-offset-2">';
		$output .= '<div class="highlight">';
		$output .= '<pre><code class="html">&lt;span class=&quot;' . esc_html($icon) . '&quot;&gt;&lt;/span&gt; icon-heart</code></pre>';
		$output .= '</div>';
		$output .= '<p><strong class="small">' . esc_html($result_text) . '</strong>&nbsp;<span class="' . esc_attr($icon) . '"></span> ' . esc_html($icon) . '</p>';
		$output .= '</div></div></div></div>';

		$output .= '<div class="et-examples">';
		foreach ($et_icons as $icon) {
			$output .= '<span class="box1"><span aria-hidden="true" class="' . esc_attr($icon) . '"></span>&nbsp;' . esc_html($icon) . '</span>';
		}
		$output .= '</div>';
	}
	
	$output .= '</div>';

	return $output;
}

add_shortcode('rs_el_icon', 'rs_el_icon');
