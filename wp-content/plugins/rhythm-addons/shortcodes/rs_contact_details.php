<?php
/**
 *
 * RS Contact Details
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_contact_details( $atts, $content = '', $id = '' ) {

  // ctrl+shift+a worked :)

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'icon'          => '',
    'title'         => '',

    //colors
    'icon_color'    => '',
    'icon_bg_color' => '',
    'title_color'   => '',
    'content_color' => '',

    //size
    'icon_size'     => '',
    'title_size'    => '',
    'content_size'  => ''

  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $uniqid_class     = '';
  $customize        = ( $icon_bg_color ) ? true:false;

  $icon_color       = ( $icon_color ) ? 'color:'.$icon_color.';':'';
  $title_color      = ( $title_color ) ? 'color:'.$title_color.';':'';
  $content_color    = ( $content_color ) ? 'color:'.$content_color.';':'';

  $title_size       = ( $title_size ) ? 'font-size:'.$title_size.';':'';
  $content_size     = ( $content_size ) ? 'font-size:'.$content_size.';':'';

  $el_title_style   = ( $title_color || $title_size ) ? 'style="'.esc_attr($title_color.$title_size).'"':'';
  $el_content_style = ( $content_color || $content_size ) ? 'style="'.esc_attr($content_color.$content_size).'"':'';
  $el_icon_style    = ( $icon_color ) ? 'style="'.esc_attr($icon_color).'"':'';


  if( $customize ) {

    if( $icon_bg_color ) {
      $uniqid        = uniqid();
      $custom_style  = '';
      $custom_style .=  '.icon-bg-custom-'.$uniqid.':before,.icon-bg-custom-'.$uniqid.' {';
      $custom_style .=  ( $icon_bg_color ) ? 'background-color:'.$icon_bg_color.' !important;':'';
      $custom_style .= '}';
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class  = 'icon-bg-custom-'. $uniqid;
  }

  $output  =  '<div class="pt-20 pb-20 pb-xs-0'.$class.'" '.$id.'>';
  $output .=  '<div class="contact-item">';
  $output .=  '<div class="ci-icon '.sanitize_html_classes($uniqid_class).'" '.$el_icon_style.'>';
  $output .=  '<i class="'.sanitize_html_classes($icon).'"></i>';
  $output .=  '</div>';
  $output .=  '<div class="ci-title font-alt" '.$el_title_style.'>'.esc_html($title).'</div>';
  $output .=  '<div class="ci-text" '.$el_content_style.'>'.do_shortcode(wp_kses_post(force_balance_tags($content))).'</div>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_contact_details', 'rs_contact_details');
