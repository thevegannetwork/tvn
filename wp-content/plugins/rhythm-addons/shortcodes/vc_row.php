<?php
/**
 *
 * VC Row
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_row( $atts, $content = '', $key = '' ){
  $defaults = array(
    'id'         => '',
    'class'      => '',

    'bgcolor'    => '',
    'overlay_style' => '',
    'background' => '',
    'attachment' =>  'scroll',
    'repeat'      => 'no-repeat',
    'cover'       => 'yes',

    'padding'    => 'rella-no-padding',
    'margin'     => 'rella-no-margin',

    // custom padding
    'top'        => '',
    'bottom'     => '',
    'm_top'      => '',
    'm_bottom'   => '',

    'fluid'      => 'no',
  );

  extract( shortcode_atts( $defaults, $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $padding      = ( $padding ) ? sanitize_html_classes($padding) : '';
  $margin       = ( $margin ) ? sanitize_html_classes($margin) : '';
  $overlay_style = ( $overlay_style ) ? sanitize_html_classes($overlay_style) : '';
  $is_fluid     = ( $fluid == 'yes') ? ' is-fluid':' with-col';
  $cover_html   = ( $cover == 'yes') ? ' cover':'';

  $customize    = ( $bgcolor || $overlay_style || $top || $bottom || $m_top || $m_bottom || $attachment || $repeat ) ? true:false;
  $custom_style = '';
  $uniqid_class = '';

  $data_background = '';
  if ( is_numeric( $background ) && !empty($background) ) {
    $image_src  = wp_get_attachment_image_src( $background, 'full' );
    if(isset($image_src[0])) {
      $data_background = ' data-background='.esc_url($image_src[0]).'';
    }
  }

  if( $customize ) {
    $uniqid       = uniqid();
    $custom_style = '';

    $custom_style .=  '.content-section-'.esc_attr($uniqid).'{';
    $custom_style .=  ( $bgcolor ) ? 'background-color:'.esc_attr($bgcolor).';':'';
    $custom_style .=  ( $top ) ? 'padding-top:'.esc_attr($top).';':'';
    $custom_style .=  ( $bottom ) ? 'padding-bottom:'.esc_attr($bottom).';':'';
    $custom_style .=  ( $m_top ) ? 'margin-top:'.esc_attr($m_top).';':'';
    $custom_style .=  ( $m_bottom ) ? 'margin-bottom:'.esc_attr($m_bottom).';':'';
    $custom_style .=  ( $attachment ) ? 'background-attachment:'.esc_attr($attachment).' !important;':'';
    $custom_style .=  ( $repeat && $cover == 'no' ) ? 'background-repeat:'.esc_attr($repeat).';':'';
    $custom_style .= '}';

    ts_add_inline_style( $custom_style );

    $uniqid_class  = ' content-section-'. esc_attr($uniqid);
  }

  $output  =  '<section '.$id.' class="content-section full-width'.$is_fluid.$cover_html.' '.$padding.' '.$margin.' '.$overlay_style.' '.$class.' '.sanitize_html_classes($uniqid_class).'"'.$data_background.'>';
  $output .=  '<div class="row vc_row-fluid">';
  $output .=  do_shortcode(wp_kses_post($content));
  $output .=  '</div>';
  $output .=  '</section>';

  return $output;
}
add_shortcode( 'vc_row', 'rs_row' );
add_shortcode( 'vc_row_inner', 'rs_row' );
add_shortcode( 'vc_section', 'rs_row' );
