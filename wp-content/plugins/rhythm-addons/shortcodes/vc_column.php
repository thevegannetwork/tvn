<?php
/**
 *
 * VC COLUMN and VC COLUMN INNER
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_column( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                  => '',
    'class'               => '',
    'match_height'        => 'no',
    'width'               => '1/1',
    'offset'              => '',
    'align'               => '',
    'class_type'          => 'md',
    'animation'           => '',
    'animation_delay'     => '',
    'animation_duration'  => '',

  ), $atts ) );

	$match_class = ' matchHeight-element ';
	if ( $match_height == 'yes' ) {
		$class .= $match_class;
		wp_enqueue_script( 'jquery-match-height' );
	}

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $align              = ( $align ) ? ' align-'.$align:'';
  $offset             = ( $offset ) ? ' '. str_replace( 'vc_', '', $offset ) : '';

  $animation          = ( $animation ) ? ' wow '. $animation : '';
  $animation_duration = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay    = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';
  
  
  return '<div'. $id .' class="wpb_column col-'.sanitize_html_class($class_type).'-'. rs_get_bootstrap_col( $width ) . sanitize_html_classes($offset . $class .$align. $animation).'"'.$animation_delay.$animation_duration.'>'.do_shortcode( wp_kses_post($content)).'</div>';
}
add_shortcode( 'vc_column', 'rs_column' );
add_shortcode( 'vc_column_inner', 'rs_column' );
