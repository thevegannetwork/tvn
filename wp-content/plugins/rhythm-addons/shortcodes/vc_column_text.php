<?php
/**
 *
 * VC Column Text
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function vc_column_text( $atts, $content = '', $id = '' ){

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'align'      => '',
    'text_size'  => '',
    'text_color' => '',
    'line_height' => '',
    'letter_spacing'  => '',
  ), $atts ) );

  $id         = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class      = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $align      = ( $align ) ? ' align-'.$align:'';

  $text_size      = ( $text_size )? 'font-size:'.$text_size.';':'';
  $text_color     = ( $text_color )? 'color:'.$text_color.';':'';
  $line_height    = ( $line_height )? 'line-height:'.$line_height.';':'';
  $letter_spacing = ( $letter_spacing )? 'letter-spacing:'.$letter_spacing.';':'';
  $el_style       = ( $text_size || $text_color ) ? 'style="'.esc_attr($text_color.$text_size.$line_height.$letter_spacing).'"':'';

  return '<div class="section-text text-block'.$class.' '.sanitize_html_class($align).'" '.$id.''.$el_style.'>'.rs_set_wpautop($content).'</div>';
}
add_shortcode( 'vc_column_text', 'vc_column_text');
