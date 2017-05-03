<?php
/**
 *
 * RS Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'slider_type'      => 'fullwidth-slider',
    'inside_container' => 'no',

  ), $atts ) );

  global $is_container;
  $is_container = $inside_container;

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $output = '<div '.$id.' class="'.sanitize_html_classes($slider_type).$class.' owl-carousel">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .= '</div>';

  wp_enqueue_script( 'owl-carousel' );

  return $output;
}

add_shortcode('rs_slider', 'rs_slider');

function rs_slider_item($atts, $content = '') {
  global $is_container;

  $output  = ( $is_container == 'yes' ) ? '<div class="container relative">':'';
  $output .=  do_shortcode($content);
  $output .=  ( $is_container == 'yes' ) ? '</div>':'';

  return $output;
}
add_shortcode('rs_slider_item', 'rs_slider_item');
