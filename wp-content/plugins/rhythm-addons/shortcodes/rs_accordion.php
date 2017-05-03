<?php
/**
 *
 * RS Accordions
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_accordion( $atts, $content = '', $id = '' ) {

  global $rs_accordion_tabs;
  $rs_accordion_tabs = array();

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'active_tab' => 0,
    'style'      => 'standard',
	'variant'    => 'accordion',
  ), $atts ) );

  do_shortcode( wp_kses_data($content ));

  if( empty( $rs_accordion_tabs ) ) { return; }

  $id          = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class       = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  // begin output
  $output      = '<div'. $id .' class="accordion-wrapper '.($variant == 'toggle' ? 'toggle-wrapper' : '').' '. $class .'">';

  foreach ( $rs_accordion_tabs as $key => $tab ) {

    $active = ( ( $key + 1 ) == $active_tab ) ? ' active' : '';
    $opened = ( ( $key + 1 ) == $active_tab ) ? ' style="display: block;"' : '';
    $icon_html  = ( $style == 'with_icon' && !empty($tab['atts']['icon'])) ? '<i class="'.esc_attr($tab['atts']['icon']).'"></i> ':'';

    $output .= '<div class="accordion">';
    $output .= '<div class="dt">';
    $output .= '<a href="#" class="accordion-title '. sanitize_html_class($active) .'">'.$icon_html . esc_html($tab['atts']['title']) .'</a>';
    $output .= '</div>';
    $output .= '<div class="dd accordion-content"'.$opened.'>'. do_shortcode((wp_kses_data($tab['content'])) ) . '</div>';
    $output .= '</div>';

  }

  $output     .= '</div>';
  // end output

  return $output;
}

add_shortcode('vc_accordion', 'rs_accordion');


/**
 *
 * RS Accordion
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_accordion_tab( $atts, $content = '', $id = '' ) {
  global $rs_accordion_tabs;
  $rs_accordion_tabs[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}

add_shortcode('vc_accordion_tab', 'rs_accordion_tab');
