<?php
/**
 *
 * RS Toggle
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_toggle( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'title'         => '',
    'open'          => '',
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $open         = ( $open ) ? ' active' : '';
  $display      = ( $open ) ? ' style="display:block;"' : '';

  // begin output
  $output   = '<div'. $id .' class="dl toggle"'. $class .'>';
  $output  .= '<div class="dt">';
  $output  .= '<a href="#" class="toggle-title'. sanitize_html_classes($open) .'">'. esc_html($title) .'</a>';
  $output  .= '</div>';
  $output  .= '<div class="dd toggle-content"'. $display .'>';
  $output  .= rs_set_wpautop( wp_kses_data($content));
  $output  .= '</div>';
  $output  .= '</div>';
  // end output

  return $output;
}

add_shortcode('vc_toggle', 'rs_toggle');
