<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_tilt_image( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'image' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $output  =  '<div '.$id.' class="tilt-wrap mb-80 mb-xs-50'.$class.'">';
      $output .=  '<img src="'.esc_url($image_src[0]).'" alt="" />';
      $output .=  '<img src="'.esc_url($image_src[0]).'" alt="" class="tilt-effect" />';
      $output .=  '</div>';
    }
  }
  wp_enqueue_script('jquery-tilt');
  return $output;
}

add_shortcode('rs_tilt_image', 'rs_tilt_image');
