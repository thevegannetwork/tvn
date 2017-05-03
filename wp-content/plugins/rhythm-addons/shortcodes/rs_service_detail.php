<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_service_detail( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'       => '',
    'class'    => '',
    'price'    => '',
    'month'    => '',
    'btn_text' => '',
    'btn_link' => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $output  =  '<div '.$id.' class="work-detail'.$class.'">';
  $output .=  '<h5 class="font-alt mt-0 mb-20">Service Details</h5>';
  $output .=  '<div class="work-full-detail">';
  $output .=  '<p><strong>Price:</strong>from '.esc_html($price).'</p>';
  $output .=  '<p><strong>Time:</strong>from '.esc_html($month).'</p>';
  $output .=  '<p><strong>Order:</strong>';
  $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-round">'.esc_html($btn_text).'</a>';
  $output .=  '</p>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_service_detail', 'rs_service_detail');
