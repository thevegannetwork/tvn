<?php
/**
 *
 * RS Link
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_link( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'               => '',
    'class'            => '',
    'link_text'        => '',
    'link'             => '',
    'align'            => 'left',

    //colors
    'link_color'       => '',
    'link_color_hover' => ''
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $uniqid_class = '';
  $customize    =  ( $link_color || $link_color_hover ) ? true:false;

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'link';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

if( $customize ) {

    $uniqid       = uniqid();
    $custom_style = '';

    if( $link_color ) {
      $custom_style .=  '.link-custom-'.$uniqid.'{';
      $custom_style .=  ( $link_color ) ? 'color:'.$link_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $link_color_hover ) {
      $custom_style .=  '.link-custom-'.$uniqid.':hover {';
      $custom_style .=  ( $link_color_hover ) ? 'color:'.$link_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class = ' link-custom-'. $uniqid;

  }

  $output  =  '<div '.$id.' class="align-'.esc_attr($align).$class.'">';
  $output .=  '<a href="'.esc_url($href).'" class="section-more font-alt'.sanitize_html_classes($uniqid_class).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'">'.esc_html($link_text).' <i class="fa fa-angle-right"></i></a>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_link', 'rs_link');
