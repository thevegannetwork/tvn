<?php
/**
 *
 * RS Logo Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_logo_slider( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(
		'id'     => '',
		'class'  => '',
		'images' => '',
		'width'  => '67',
		'height' => '67',
		'items'  => 'small-item-carousel', 
		
	), $atts ) );

	$id    = ( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes( $class ) : '';

	$output  = '<div ' . $id . ' class="' . $items . ' black owl-carousel mb-0 animate-init" data-anim-type="fade-in-right-large' . $class . '" data-anim-delay="100">';

	$images = explode( ',', $images );
	if( ! empty( $images ) ) {
		foreach( $images as $image ) {
			$image_src = wp_get_attachment_image_src( $image, 'full' );
			if(isset($image_src[0])) {
				$output .=  '<div class="logo-item">';
					$output .=  '<img src="' . esc_url( $image_src[0] ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" alt="" />';
				$output .=  '</div>';
			}
		}
	}

	$output .=  '</div>';

	wp_enqueue_script( 'owl-carousel' );

	return $output;
}
add_shortcode('rs_logo_slider', 'rs_logo_slider');

