<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_space( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'height' => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $height = ( $height ) ? ' style="height:'.esc_attr($height).';"':'';

  return '<div '.$id.' class="clear rs-space'.$class.'"'.$height.'></div>';
}

add_shortcode('rs_space', 'rs_space');
