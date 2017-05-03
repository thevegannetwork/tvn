<?php
/**
 *
 * RS Call To Action
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_cta( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                      => '',
    'class'                   => '',
    'heading'                 => '',
    'header_margin_bottom'    => '',
    'btn_text'                => '',
    'link'                    => '',

    // color attributes
    'heading_color'           => '',
    'button_text_color'       => '',
    'button_text_color_hover' => '',
    'button_bg_color'         => '',
    'button_bg_color_hover'   => '',
  ), $atts ) );

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args     = vc_parse_multi_attribute( $link );
    $href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $btn_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target         = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $customize    = ( $button_text_color || $button_bg_color || $button_bg_color_hover || $button_text_color_hover ) ? true:false;
  $uniqid_class = '';

  $heading_color_style  = ( $heading_color ) ? 'style="color:'.esc_attr($heading_color).';"':'';

  if( $customize ) {
    $uniqid        = uniqid();
    $custom_style  = '';

    if( $button_text_color || $button_bg_color ) {
      $custom_style .=  '.cta-btn-custom-'.$uniqid.'{';
      $custom_style .=  ( $button_text_color ) ? 'color:'.$button_text_color.' !important;':'';
      $custom_style .=  ( $button_bg_color ) ? 'background:'.$button_bg_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $button_text_color_hover || $button_bg_color_hover ) {
      $custom_style .=  '.cta-btn-custom-'.$uniqid.':hover {';
      $custom_style .=  ( $button_text_color_hover ) ? 'color:'.$button_text_color_hover.' !important;':'';
      $custom_style .=  ( $button_bg_color_hover) ? 'background:'.$button_bg_color_hover.' !important;':'';
      $custom_style .= '}';
    }


    ts_add_inline_style( $custom_style );

    $uniqid_class  = ' cta-btn-custom-'. $uniqid;

  }

  $output  =  '<div '.$id.' class="align-center'.$class.'">';
  $output .=  '<h3 class="banner-heading font-alt '.sanitize_html_classes($header_margin_bottom).'" '.$heading_color_style.'>'.esc_html($heading).'</h3>';
  $output .=  '<div>';
  $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($btn_title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-w btn-medium btn-round'.$uniqid_class.'">'.esc_html($btn_text).'</a>';
  $output .=  '</div>';
  $output .=  '</div> ';
  return $output;
}

add_shortcode('rs_cta', 'rs_cta');
