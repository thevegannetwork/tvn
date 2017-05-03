<?php
/**
 *
 * RS Tabs
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_tabs( $atts, $content = '', $id = '' ) {

  global $rs_tabs;
  $rs_tabs = array();

  extract( shortcode_atts( array(
    'id'        => '',
    'class'     => '',
    'style'     => 'standard',
    'active'    => 1,
  ), $atts ) );

  do_shortcode( $content );

  if( empty( $rs_tabs ) ) { return; }


  $output       = '';
  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $uniqtab      = time().'-'.mt_rand();
  $nav_class = '';
  $content_class = '';
  $align_class = '';
  $align_class_end = '';
  switch ($style) {
    case 'standard':
      $nav_class     = 'tpl-tabs';
      $content_class = 'tpl-tabs-cont';
      $tab_id        =  'st';
      break;

    case 'minimal':
      $nav_class       = 'tpl-minimal-tabs';
      $content_class   = 'tpl-minimal-tabs-cont';
      $align_class     = '<div class="align-center mb-40 mb-xs-30">';
      $tab_id          =  'mim';
      $align_class_end = '</div>';
    break;

    case 'with_icon':
      $nav_class     = 'tpl-alt-tabs font-alt pt-30 pt-sm-0 pb-30 pb-sm-0';
      $content_class = 'tpl-tabs-cont';
      $tab_id        =  'ico';
    break;

    default:
      # code...
      break;
  }

  $output .=  '<div class="tpl-tabs-wrapper ts-tabs">';
  $output .=  $align_class;
  $output .=  '<ul class="nav nav-tabs '.$nav_class.' animate '.$class.'" '.$id.'>';
  foreach( $rs_tabs as $key => $tab) {
    $title      =  $tab['atts']['title'];
    $tab_icon   = (isset($tab['atts']['icon'])) ? $tab['atts']['icon']:'icon-strategy';
    $active_nav = ( ( $key + 1 ) == $active ) ? ' class="active"' : '';
    $icon       = ( $style == 'with_icon' && $tab_icon) ? '<div class="alt-tabs-icon"><span class="'.sanitize_html_classes($tab_icon).'"></span></div>':'';
    $output     .=  '<li '.$active_nav.'><a href="#'.$tab_id.esc_attr($uniqtab).'-'.$key.'" data-toggle="tab">'.$icon.' '.esc_html($title).'</a></li>';
  }

  $output .= '</ul>';
  $output .=  $align_class_end;

  // tabs pane
  $output .= '<div class="tab-content '.$content_class.' section-text">';
  foreach ($rs_tabs as $key => $tab) {
    $active_content = ( ( $key + 1 ) == $active ) ? ' in active' : '';
    $title  = $tab['atts']['title'];
    $output .= '<div class="tab-pane fade'.$active_content.'" id="'.$tab_id.esc_attr($uniqtab).'-'.$key.'">';
    $output .=  do_shortcode(wp_kses_data($tab['content']));
    $output .=  '</div>';
  }

  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode('vc_tabs', 'rs_tabs');


/**
 *
 * RS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function rs_tab( $atts, $content = '', $id = '' ) {
  global $rs_tabs;
  $rs_tabs[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('vc_tab', 'rs_tab');
