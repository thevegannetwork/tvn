<?php
/**
 *
 * RS Google Map
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_google_map( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'address'     => '',
    'long'        => '',
    'lat'         => '',
    'zoom'        => '',
    'open_text'   => '',
    'close_text'  => '',
    'show_text'   => 'yes',
    'greyscale'   => 'yes',
    'marker'      => '',

    //color
    'open_text_color'     => '',
    'close_text_color'    => '',

  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $el_open_text_style  =  ( $open_text_color ) ? 'style="color:'.esc_attr($open_text_color).';"':'';
  $el_close_text_style =  ( $close_text_color ) ? 'style="color:'.esc_attr($close_text_color).';"':'';
  $greyscale           =  ( $greyscale == 'yes' ) ? 'true':'false';
  
  $zoom = ! empty( $zoom ) ? absint( $zoom ) : 14;
  
	$data_marker = '';
	if (is_numeric($marker) && !empty($marker)) {
		$image_src = wp_get_attachment_image_src($marker, 'full');
		if (isset($image_src[0])) {
			$data_marker = ' data-marker=' . esc_url($image_src[0]) . '';
		}
	}

  $output  =  '<div '.$id.' class="google-map'.$class.'">';
  $output .=  '<div data-address="'.esc_attr($address).'" data-lat="'.esc_attr( $lat ).'" data-long="'.esc_attr( $long ).'" data-zoom="'.esc_attr( $zoom ).'" data-greyscale="'.esc_attr($greyscale).'" ' . $data_marker . ' class="map-canvas"></div>';

  if( $show_text == 'yes') {
    $output .=  '<div class="map-section">';
    $output .=  '<div class="map-toggle">';
    $output .=  '<div class="mt-icon"><i class="fa fa-map-marker"></i></div>';
    $output .=  '<div class="mt-text font-alt">';
    $output .=  '<div class="mt-open" '.$el_open_text_style.'>'.esc_html($open_text).' <i class="fa fa-angle-down"></i></div>';
    $output .=  '<div class="mt-close" '.$el_close_text_style.'>'.esc_html($close_text).' <i class="fa fa-angle-up"></i></div>';
    $output .=  '</div></div></div>';
  }

  $output .=  '</div>';

  wp_enqueue_script( 'gmap3' ); 
  wp_enqueue_script( 'gmapapis' );

  return $output;
}
add_shortcode('rs_google_map', 'rs_google_map');