<?php
/**
 *
 * RS Bar
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_bar( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                => '',
    'class'             => '',
    'title'             => '',
    'percentage_inside' => 'tpl-progress-alt',
    'percentage'        => '',
    'unit'              => '',
    'bar_color'         => '',
    'bg_color'          => '',
    'text_color'        => ''
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $bar_color  = ( $bar_color ) ? 'background-color:'.$bar_color.';':'';
  $bg_color   = ( $bg_color ) ? 'background-color:'.$bg_color.';':'';
  $text_color = ( $text_color ) ? 'color:'.$text_color.';':'';

  $style      = ( $bar_color || $text_color ) ? 'style="'.esc_attr($bar_color.$text_color).'"':'';
  $style_bg   = ( $bg_color ) ? 'style="'.esc_attr($bg_color).'"':'';

  $output  =  '<div class="progress '.sanitize_html_classes($percentage_inside).''.$class.'" '.$id.''.$style_bg.'>';
  $output .=  '<div class="progress-bar" role="progressbar" aria-valuenow="'.esc_attr($percentage).'" aria-valuemin="0" aria-valuemax="100" '.$style.'>';
  $output .=  ($percentage_inside == 'tpl-progress') ? esc_html($title).', '.esc_html($unit).'<span>'.esc_html($percentage).'</span>':esc_html($title).', <span>'.esc_html($percentage.$unit).'</span>';
              '</div>';
  $output .=  '</div>';
  $output .=  '</div>';


  return $output;
}

add_shortcode('rs_bar', 'rs_bar');
