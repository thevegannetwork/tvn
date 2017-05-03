<?php
/**
 *
 * RS Group Buttons
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_group_button( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                     => '',
    'class'                  => '',
    'icon_one'               => '',
    'icon_two'               => '',
    'btn_link_one'           => '',
    'btn_text_one'           => '',
    'btn_small_text_one'     => '',
    'btn_link_two'           => '',
    'btn_text_two'           => '',
    'btn_small_text_two'     => '',
    'animation'              => '',
    'animation_delay'        => '',
    'animation_duration'     => '',
    'animation_two'          => '',
    'animation_delay_two'    => '',
    'animation_duration_two' => '',

  ), $atts ) );

  $id                     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                  = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $animation              = ( $animation ) ? ' wow '. $animation : '';
  $animation_duration     = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay        = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';
  $animation_two          = ( $animation_two ) ? ' wow '. $animation_two : '';
  $animation_duration_two = ( $animation_duration_two ) ? ' data-wow-duration="'.esc_attr($animation_duration_two).'s"':'';
  $animation_delay_two    = ( $animation_delay_two ) ? ' data-wow-delay="'.esc_attr($animation_delay_two).'s"':'';

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_link_one );
    $href_one       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_one      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_one     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_link_two );
    $href_two       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_two      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_two     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }


  $output  = '<div '.$id.' class="align-center"'.$class.'>';
  $output .=  '<a href="'.esc_url($href_one).'" title="'.esc_attr($title_one).'" target="'.esc_attr($target_one).'" class="download-button round mb-xs-10'.$animation.'"'.$animation_delay.$animation_duration.'>';
  $output .=  '<span class="db-icon">';
  $output .=  '<i class="'.sanitize_html_classes($icon_one).'"></i>';
  $output .=  '</span>';
  $output .=  '<span class="db-title">';
  $output .=  esc_html($btn_text_one);
  $output .=  '</span>';
  $output .=  '<span class="db-descr">';
  $output .=  esc_html($btn_small_text_one);
  $output .=  '</span>';
  $output .=  '</a>';
  $output .=  '<span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>';
  $output .=  '<a href="'.esc_url($href_two).'" title="'.esc_attr($title_two).'" target="'.esc_attr($target_two).'" class="download-button round'.$animation_two.'"'.$animation_delay_two.$animation_duration_two.'>';
  $output .=  '<span class="db-icon">';
  $output .=  '<i class="'.sanitize_html_classes($icon_two).'"></i>';
  $output .=  '</span>';
  $output .=  '<span class="db-title">';
  $output .=  esc_html($btn_text_two);
  $output .=  '</span>';
  $output .=  '<span class="db-descr">';
  $output .=  esc_html($btn_small_text_two);
  $output .=  '</span>';
  $output .=  '</a>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_group_button', 'rs_group_button');
