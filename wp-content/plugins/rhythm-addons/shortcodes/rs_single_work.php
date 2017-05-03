<?php
/**
 *
 * RS Single Work
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_sc_single_work( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(

		'id'      => '',
		'class'   => '',
		'image'   => '',
		'link'    => '',	
		'heading' => '',

	), $atts ) );

	$id    = ( $id ) ? ' id="'. esc_attr( $id ) .'"' : '';
	$class = ( $class ) ? ' '. sanitize_html_classes( $class ) : '';

	$href = $title = $target = '';

	if ( function_exists( 'vc_parse_multi_attribute' ) ) {
		$parse_args = vc_parse_multi_attribute( $link );
		$href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
		$title      = ( isset( $parse_args['title'] ) ) ? ' title="' . esc_attr( $parse_args['title'] ) . '"' : '';
		$target     = ( isset( $parse_args['target'] ) ) ? ' target="' . esc_attr( trim( $parse_args['target'] ) ) . '"' : '';
	}
	
	if ( is_numeric( $image ) && !empty( $image ) ) {
		$image_src = wp_get_attachment_image_src( $image, 'full' );
	}

	$output = '';

	$output .= '<div class="post-prev-img">';
	$output .= '	<a href="' . esc_url( $href ) . '" ' . $title . $target . '>';
	$output .= '		<img src="' . esc_url( $image_src[0] ) . '" alt="' . esc_attr( $heading ) . '">';
	$output .= '	</a>';
	$output .= '</div>';

	$output .= '<div class="post-prev-title font-alt">';
	$output .= '	<a href="' . esc_url( $href ) . '" ' . $title . $target . '>' . esc_html( $heading ) . '</a>';
	$output .= '</div>';

	return $output;

}

add_shortcode('rs_single_work', 'rs_sc_single_work');