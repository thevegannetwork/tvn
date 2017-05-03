<?php
/**
 *
 * RS Pricing Table
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_pricing_table( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'btn_class'   => '',
    'title'       => '',
    'feature'     => '',
    'is_feature'  => 'no',
    'icon'        => 'fa fa-paper-plane-o',
    'price'       => '',
    'currency'    => '',
    'alt_text'    => '',
    'link'        => '',
    'btn_text'    => '',

  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $is_feature = ( $is_feature == 'yes' ) ? ' main':'';

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args     = vc_parse_multi_attribute( $link );
    $href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $btn_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target         = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $output  =  '<div '.$id.' class="pricing-item '.$class.sanitize_html_classes($is_feature).'">';
  $output .=  '<div class="pricing-item-inner">';
  $output .=  '<div class="pricing-wrap">';
  $output .=  '<div class="pricing-icon">';
  $output .=  '<i class="'.sanitize_html_classes($icon).'"></i>';
  $output .=  '</div>';
  $output .=  '<div class="pricing-title">'.esc_html($title).'</div>';
  $output .=  '<div class="pricing-features font-alt">';
  $output .=  '<ul class="sf-list pr-list">';

  $feature_list = explode('|', $feature);
  for($i = 0; $i < count($feature_list); $i++) {
    $output .=  '<li>'.esc_html($feature_list[$i]).'</li>';
  }

  $output .=  '</ul>';
  $output .=  '</div>';
  $output .=  '<div class="pricing-num"><sup>'.esc_html($currency).'</sup>'.esc_html($price).'</div>';
  $output .=  '<div class="pr-per">'.esc_html($alt_text).'</div>';
  $output .=  '<div class="pr-button">';
  $output .=  '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($btn_title).'" class="btn btn-mod ' . sanitize_html_classes( $btn_class ) . '">'.esc_html($btn_text).'</a>';
  $output .=  '</div></div></div></div>';


  return $output;
}

add_shortcode('rs_pricing_table', 'rs_pricing_table');
