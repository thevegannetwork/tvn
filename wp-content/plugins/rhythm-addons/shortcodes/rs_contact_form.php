<?php
/**
 *
 * Contact Form
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_contact_form( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'form_id'      => '',
    'notification' => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output  =  '<div '.$id.' class="rs-contact-form'.$class.'">';
  $output .=  do_shortcode('[contact-form-7 id="'.$form_id.'"]');
  $output .=  ($notification) ? '<div class="form-tip pt-10"><i class="fa fa-info-circle"></i> '.esc_html($notification).'</div>':'';
  $output .=  '</div>';

  return $output;

}
add_shortcode( 'rs_contact_form', 'rs_contact_form' );

