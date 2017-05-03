<?php

/**
 *
 * RS Promo Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_gallery_2($atts, $content = '', $id = '') {

	extract(shortcode_atts(array(
		'class'            => '',
		'background_color' => '',
		'column'           => '2',
		'hover_overlay'    => ''
	), $atts));

	$class  = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	$column = ( $column == '2' ) ? 'work-grid-2':'work-grid-3';
  
	$output = '<ul class="works-grid ' . $column . ' work-grid-gut clearfix font-alt hide-titles ' . sanitize_html_classes( $hover_overlay ) . ' ' . $class . '" id="work-grid">';
	$output .= do_shortcode(wp_kses_data($content));
	$output .= '</ul>';
  
	wp_enqueue_script('isotope-pkgd');
	wp_enqueue_script( 'isotope-packery' );
	
    return $output;
}

add_shortcode('rs_gallery_2', 'rs_gallery_2');

function rs_gallery_2_item($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'image' => '',
    'small_heading' => '',
    'heading' => '',
    'link' => '',
    
  ), $atts));
  
  $image_src = '';
  if (is_numeric($image) && !empty($image)) {
    $image_tmp = wp_get_attachment_image_src($image, 'full');
    if (isset($image_tmp[0])) {
      $image_src = $image_tmp[0];
    }
  }
  
  if (!esc_url($image_src)) {
    return '';
  }

  $href = $title = $target = '';
  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($link);
    $href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $title = ( isset($parse_args['title']) ) ? $parse_args['title'] : '';
    $target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  $output = '';
  $output .= '<!-- Work Item -->';
  $output .= '<li class="work-item mix photography">';
  $output .= '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($title).'">';
  $output .= '<div class="work-img">';
  $output .= '<img src="'.esc_url($image_src).'" alt="'.esc_attr($heading).'" />';
  $output .= '</div>';
  $output .= '<div class="work-intro">';
  $output .= '<h3 class="work-title">'.esc_html($heading).'</h3>';
  $output .= '<div class="work-descr">';
  $output .= esc_html($small_heading);
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</a>';
  $output .= '</li>';
  $output .= '<!-- End Work Item -->';

  return $output;
}

add_shortcode('rs_gallery_2_item', 'rs_gallery_2_item');
