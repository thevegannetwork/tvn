<?php
/**
 *
 * RS Message Box
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_blockquote( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'cite'       => '',

    //color
    'text_color' => '',
    'cite_color' => '',

    //size
    'text_size'  => '',
    'cite_size'  => '',

  ), $atts ) );


  $id            = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class         = ( $class ) ? ' '. sanitize_html_classes($class) : '';


  $text_size     = ( $text_size ) ? 'font-size:'.$text_size.';':'';
  $cite_size     = ( $text_size ) ? 'font-size:'.$cite_size.';':'';
  $text_color    = ( $text_color ) ? 'color:'.$text_color.';':'';
  $cite_color    = ( $text_color ) ? 'color:'.$cite_color.';':'';

  $el_text_style = ( $text_color || $text_size ) ? 'style="'.esc_attr($text_size.$text_color).'"':'';
  $el_cite_style = ( $cite_color || $cite_size ) ? 'style="'.esc_attr($cite_size.$cite_color).'"':'';

  $output  =  '<blockquote class="mb-0 '.$class.'" '.$id.'>';
  $output .=  '<div '.$el_text_style.'>'.rs_set_wpautop(wp_kses_post($content)).'</div>';
  $output .=  ( $cite ) ? '<footer '.$el_cite_style.'>'.esc_html($cite).'</footer>':'';
  $output .=  '</blockquote>';


  return $output;
}
add_shortcode('rs_blockquote', 'rs_blockquote');
