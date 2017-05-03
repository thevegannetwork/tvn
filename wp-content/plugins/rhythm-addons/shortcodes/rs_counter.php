<?php
/**
 *
 * RS Counter
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_counters( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',

  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';


  $output  =  '<div '.$id.' class="count-wrapper'.$class.'">';
  $output .=  do_shortcode( wp_kses_data($content ));
  $output .=  '</div>';


  return $output;
}
add_shortcode('rs_counters', 'rs_counters');

function rs_count( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'count_no'        => '',
    'icon'            => '',
    'count_no_color'  => '',
    'icon_color'      => '',
    'content_color'   => '',

  ), $atts ) );

  $count_no_color = ( $count_no_color ) ? 'style="color:'.esc_attr($count_no_color).';"':'';
  $icon_color     = ( $icon_color ) ? 'style="color:'.esc_attr($icon_color).';"':'';
  $content_color  = ( $content_color ) ? 'style="color:'.esc_attr($content_color).';"':'';

  $output  =  '<div class="col-xs-6 col-sm-3">';
  $output .=  '<div class="count-number" '.$count_no_color.'>'.esc_html($count_no).'</div>';
  $output .=  '<div class="count-descr font-alt">';
  $output .=  '<i class="'.sanitize_html_classes($icon).'" '.$icon_color.'></i>';
  $output .=  '<span class="count-title" '.$content_color.'> '.do_shortcode(wp_kses_data($content)).'</span>';
  $output .=  '</div>';
  $output .=  '</div>';
  
  wp_enqueue_script( 'jquery-countTo' );
  wp_enqueue_script( 'jquery-appear' );
  
  return $output;


}
add_shortcode('rs_count', 'rs_count');


function rs_presto_counter( $atts, $content = '', $id = '' ) {
	
	extract( shortcode_atts( array(
	
		'count_no'        => '',
	
	), $atts ) );	

	$output .=  '<div class="count-number count-number-style2">' . esc_html( $count_no ) . '</div>';
	$output .=  '<div class="count-descr count-descr-style2">' . do_shortcode( wp_kses_post( $content ) ) . '</div>';

	wp_enqueue_script( 'jquery-countTo' );
	wp_enqueue_script( 'jquery-appear' );  

	return $output;

}
add_shortcode('rs_presto_counter', 'rs_presto_counter');

