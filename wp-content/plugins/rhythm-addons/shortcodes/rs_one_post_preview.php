<?php
/**
 *
 * RS One Post Preview
 * @version 1.0.0
 *
 *
 */
function rs_one_post_preview( $atts, $content = '', $id = '' ) {
	
	extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'title'				 => '',
    'image'              => '',
    'link'               => '',
  ), $atts ) );
  
  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $a_href = $a_title = $a_target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $a_href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $a_title      = ( isset( $parse_args['title'] ) ) ? ' title="'.esc_attr($parse_args['title']).'"' : '';
    $a_target     = ( isset( $parse_args['target'] ) ) ? ' target="'.esc_attr(trim( $parse_args['target'] )).'"' : '';
  }

  	$image_src = wp_get_attachment_image_src( $image, 'full' );
  	
  	// Preview Image
	$output = '<div class="post-prev-img">';
	if (!empty($a_href) && $a_href != '#') {
	    $output .=  '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" title="'.esc_attr($a_title).'"><img src="'.esc_url($image_src[0]).'" alt="'.esc_html($title).'"></a>';
    } else {
		$output .= '<img src="'.esc_url($image_src[0]).'" alt="'.esc_html($title).'">';
	}
	$output .= '</div>';
		
	// Title
	$output .= '<div class="post-prev-title font-alt">';
	if (!empty($a_href) && $a_href != '#') {
	    $output .=  '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" title="'.esc_attr($a_title).'">'.esc_html($title).'</a>';
    } else {
		$output .= esc_html($title);
	}
	$output .= '</div>';  
	
	// Text
	$output .= '<div class="post-prev-text">';
	$output .= do_shortcode(wp_kses_data($content));
	$output .= '</div>';

	return $output;
}

add_shortcode('rs_one_post_preview', 'rs_one_post_preview');