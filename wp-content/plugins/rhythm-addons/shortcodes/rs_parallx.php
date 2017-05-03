<?php
/**
 *
 * RS Parallax
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_parallax( $atts, $content = '', $key = '' ){
  $defaults = array(
    'id'                      => '',
    'class'                   => '',
    'background'              => '',
    'heading'                 => '',
    'btn_text'                => '',
    'link'                    => '',
    'style'                   => 'light',

    //color
    'heading_color'           => '',
    'button_border_color'     => '',
    'button_text_color'       => '',
    'button_text_color_hover' => '',
    'button_background_hover' => ''

  );

  extract( shortcode_atts( $defaults, $atts ) );

  $id            = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class         = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $heading_color = ( $heading_color ) ? ' style="color:'.esc_attr($heading_color).';"':'';

  switch ($style) {
    case 'dark':
      $style_class = 'bg-light-alfa-30';
		$header_style = '';
		$button_class = 'btn-border';

      break;
	case 'light':
	default:
      $style_class = 'bg-dark-alfa-30';
		$header_style = 'white';
		$button_class = 'btn-border-w';
      break;
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $customize    = ( $button_background_hover || $button_text_color || $button_text_color_hover || $button_border_color ) ? true:false;
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

    if( $button_border_color || $button_text_color ) {
      $custom_style .=  '.btn-prallax-custom-'.$uniqid.'{';
      $custom_style .=  ( $button_text_color ) ? 'color:'.$button_text_color.'!important;':'';
      $custom_style .=  ( $button_border_color ) ? 'border-color:'.$button_border_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $button_background_hover || $button_text_color_hover ) {
      $custom_style .=  '.btn-prallax-custom-'.$uniqid.':hover {';
      $custom_style .=  ( $button_text_color_hover ) ? 'color:'.$button_text_color_hover.'!important;':'';
      $custom_style .=  ( $button_background_hover ) ? 'background:'.$button_background_hover.'!important;':'';
      $custom_style .=  'border-color:transparent !important';
      $custom_style .= '}';
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class = ' btn-prallax-custom-'. $uniqid;
  }

  $output  = '<section '.$id.' class="content-section fixed-height-small pt-0 pb-0 '.$style_class.$class.'" '.$data_background.'>';
  $output .=  '<div class="js-height-parent container relative">';
  $output .=  '<div class="home-content">';
  $output .=  '<div class="home-text">';
  $output .=  '<h2 class="hs-line-14 font-alt mb-50 mb-xs-30 '.$header_style.'"'.$heading_color.'>'.esc_html($heading).'</h2>';
  $output .=  '<div>';
  $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod '.$button_class.' btn-medium btn-round'.sanitize_html_classes($uniqid_class).'">'.esc_html($btn_text).'</a>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</div>';
  $output .=  '</section>';

  return $output;
}
add_shortcode( 'rs_parallax', 'rs_parallax' );
