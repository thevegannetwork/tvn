<?php
/**
 *
 * RS Service Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_client_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'title'         => '',
    'image'         => '',

    //colors
    'title_color'   => '',
    'content_color' => ''
  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $el_title_color   = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
  $el_content_color = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';

  $output  =  '<div '.$id.' class="alt-features-item align-left'.$class.'">';
  $output .=  '<div class="alt-features-icon">';
  if( is_numeric( $image ) && !empty( $image )) {
    $image  = wp_get_attachment_image_src( $image, 'full' );
    $image_src = $image[0];
    if(isset($image_src)) {
      $output .=  '<img src="'.esc_url($image_src).'" alt="" />';
    }

  }
  $output .=  '</div>';
  $output .=  '<h3 class="alt-features-title font-alt"'.$el_title_color.'>'.esc_html($title).'</h3>';
  $output .=  '<div class="alt-features-descr align-left"'.$el_content_color.'>';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .=  '</div>';
  $output .=  '</div>';


  return $output;
}

add_shortcode('rs_client_block', 'rs_client_block');
