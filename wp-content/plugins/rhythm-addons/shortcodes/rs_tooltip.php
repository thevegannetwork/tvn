<?php
/**
 *
 * RS ToolTip
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_tooltip( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                  => '',
    'class'               => '',
    'tool_tip_text_hover' => '',
    'position'            => 'top'
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  return '<a href="#" '.$id.' title="'.esc_attr($tool_tip_text_hover).'" class="tooltip-'.sanitize_html_classes($position).' '.$class.'">'.do_shortcode(wp_kses_data($content)).'</a>';
}

add_shortcode('rs_tooltip', 'rs_tooltip');
