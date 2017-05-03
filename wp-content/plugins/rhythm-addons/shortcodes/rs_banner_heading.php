<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_banner_heading( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'      => '',
    'class'   => '',
    'heading' => '',
    'top'     => '',
    'bottom'  =>'',
    'weight'  => '300',
    'spacing' => '',
    'size'    => '',
    'color'   => ''
  ), $atts ) );

  $id        = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class     = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $top       = ( $top ) ? 'margin-top:'.$top.';':'';
  $bottom    = ( $bottom ) ? 'margin-bottom:'.$bottom.';':'';
  $color     = ( $color ) ? 'color:'.$color.';':'';
  $font_size =  ( $size ) ? 'font-size:'.$size.';':'';
  $spacing   = ( $spacing ) ? 'letter-spacing:'.$spacing.';':'';
  $weight    = ( $weight != '300' ) ? 'font-weight:'.$weight.';':'';

  $el_style = ( $top || $bottom || $size || $weight || $color || $spacing ) ? ' style="'.esc_attr($top.$bottom.$color.$font_size.$weight.$spacing).'"':'';


  return '<h3 '.$id.' class="banner-heading font-alt mb-30 mb-xxs-10'.$class.'" '.$el_style.'>'.esc_html($heading).'</h3>';
}

add_shortcode('rs_banner_heading', 'rs_banner_heading');
