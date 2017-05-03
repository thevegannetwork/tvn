<?php
/**
 *
 * RS Newsletter
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_newsletter( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'style'       => '',
    'subtitle'    => '',
    'title'       => '',
    'subtitle'    => '',
    'note'        => '',
    'title_color' => '',
    'note_color'  => '',
    'btn_color'   => 'btn-nws-dark'
  ), $atts ) );


  $id             = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class          = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $el_title_color = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
  $el_note_color  = ( $note_color ) ? ' style="color:'.esc_attr($note_color).';"':'';

switch( $style ) {
	
	default:
	case 'style1':
		
		$output  =  '<div '.$id.' class="newsletter-wrapper'.$class.' '.sanitize_html_classes($btn_color).'">';
		$output .=  '<div class="newsletter-label font-alt"'.$el_title_color.'>'.esc_html($title).'</div>';
		$output .=  '<div class="mb-20">';
		$output .=  do_shortcode(wp_kses_data($content));
		$output .=  '</div>';
		$output .=  '<div class="form-tip"'.$el_note_color.'>';
		$output .=  '<i class="fa fa-info-circle"></i> '.esc_html($note);
		$output .=  '</div>';
		$output .=  '</div>';

	break;
	
	case 'style2':
		
		$output  = '<div '.$id.' class="newsletter-wrapper elegant-newsletter'.$class.'">';
		$output .= '<div class="row">';
		
		$output .= '<div class="col-md-4">';
		$output .= '<div class="newsletter-label newsletter-label-style2">';
		$output .= '<h5>' . wp_kses_post( $title ) . '</h5>';
		if ( ! empty ( $subtitle ) ) {
			$output .= '<h6>' . esc_html( $subtitle ) . '</h6>';
		}
		$output .= '</div>';
		$output .= '</div><!-- /.col-md-4 -->';
		
		$output .= '<div class="col-md-6 pb-50 right sm-float-none">';

		$output .= '<div class=" mt-70 mt-xs-0 mb-10">';
		$output .=  do_shortcode( wp_kses_data ( $content ) );
		$output .= '</div>';

		$output .= '<div class="form-tip"><i class="fa fa-info-circle"></i>' . esc_html( $note ) . '</div>';
		$output .= '</div><!-- /.col-md-6 -->';
		
		$output .= '</div>';
		$output .= '</div>';		
	
	break;

}

  return $output;
}
add_shortcode('rs_newsletter', 'rs_newsletter');
