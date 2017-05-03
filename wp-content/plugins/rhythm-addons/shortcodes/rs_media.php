<?php
/**
 *
 * RS Media
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_media( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(
		'id'         => '',
		'class'      => '',
		'media_type' => 'vimeo',
		'v_id'       => '',
		'y_url'      => '',
		's_id'       => '',
		'width'      => '',
		'height'     => ''
	), $atts ) );
	
	$id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
	$class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

	$divstyle     = '';
	$height_style = ( $height ) ? 'height:' . esc_attr( $height ) . ';' : '';
	$width_style  = ( $width ) ?  'width:' . esc_attr( $width ) . ';' : '';
	if ( ! empty( $width ) || ! empty( $height ) ) {
		$divstyle = 'style="' . $height_style . $width_style . '"';
	}

	$width  = ( $width ) ? esc_attr( $width ) : '100%';
	$height = ( $height ) ? esc_attr( $height ) : '100%';
	
	

	$output = '';
	
	$uniqid = uniqid( 'rs-iframe-' );

	switch ( $media_type ) {

		case 'vimeo':
			$output .=  '<div class="mb-xs-40">';
			$output .=  '<div ' . $id . ' class="video' . $class . '" ' . $divstyle . '>';
			$output .=  '<iframe name="' . esc_attr( $uniqid ) . '" src="http://player.vimeo.com/video/'.esc_html($v_id).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="1170" height="658" allowfullscreen></iframe>';
			$output .=  '</div>';
			$output .=  '</div>';
		break;
	
		case 'youtube':
			$output .=  '<div class="mb-xs-40">';
			$output .=  '<div' . $id . ' class="video' . $class . '" ' . $divstyle . '>';
			$output .=  '<iframe id="' . esc_attr( $uniqid ) . '" width="' . $width . '" height="' . $height . '" src="' . esc_url( $y_url ) . '" allowfullscreen></iframe>';
			$output .=  '</div>';
			$output .=  '</div>';
		break;
	
		default:
			$output .=  '<iframe id="' . esc_attr( $uniqid ) . '" width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/'.esc_html($s_id).'&amp;color=111111&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>';
		break;
	}

	wp_enqueue_script( 'jquery-fitvids' );

	return $output;

	}

add_shortcode( 'rs_media', 'rs_media' );
