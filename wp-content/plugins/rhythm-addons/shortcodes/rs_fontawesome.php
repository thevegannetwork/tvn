<?php
/**
 *
 * RS Fontawesome
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_fontawesome( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'icon'        => '',
    'result_text' => ''
  ), $atts ) );

  $id       = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class    = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $font_icons = rs_fontawesome_icons();

  $output  =  '<div '.$id.' class="col-md-8 col-md-offset-2 mb-30'.$class.'">';
  $output .=  '<div class="section-text align-center">';
  $output .=  '<p>'.do_shortcode(wp_kses_data($content)).'</p>';
  $output .=  '<div class="row">';
  $output .=  '<div class="col-md-8 col-md-offset-2">';
  $output .=  '<div class="highlight">';
  $output .=  '<pre><code class="html">&lt;i class=&quot;'.esc_html($icon).'&quot;&gt;&lt;/i&gt; '.esc_html($icon).'</code></pre>';
  $output .=  '</div>';
  $output .=  '<p><strong class="small">'.esc_html($result_text).'</strong>&nbsp;<span class="'.sanitize_html_classes($icon).'"></span> '.esc_html($icon).'</p>';
  $output .=  '</div></div></div></div>';

  $output .=  '<div class="fa-examples">';
  foreach( $font_icons as $icon ) {
    $output .= '<div class="col-md-4 col-sm-6 col-lg-3"><i class="'.sanitize_html_classes($icon).'"></i>'.esc_html($icon).'</div>';
  }
  $output .=  '</div>';


  return $output;
}

add_shortcode('rs_fontawesome', 'rs_fontawesome');
