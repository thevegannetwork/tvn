<?php
/**
 *
 * RS Divider
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_divider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'margin_top'    => '',
    'margin_bottom' => ''
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $margin_top      = ( $margin_top ) ? 'margin-top:'.$margin_top.';':'';
  $margin_bottom   = ( $margin_bottom ) ? 'margin-bottom:'.$margin_bottom.';':'';
  $el_margin_style = ( $margin_bottom || $margin_top ) ? ' style="'.$margin_top.$margin_bottom.'"':'';



  return '<hr '.$id.' class="ts-divider'.$class.'"'.$el_margin_style.'>';
}

add_shortcode('rs_divider', 'rs_divider');
