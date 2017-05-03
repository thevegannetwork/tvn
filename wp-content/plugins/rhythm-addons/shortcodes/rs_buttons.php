<?php
/**
 *
 * RS Buttons
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_buttons( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(
		'id'                     => '',
		'class'                  => '',
		'btn_shape'              => 'btn-round',
		'btn_style'              => 'btn-solid',
		'icon'                   => '',
		'btn_link'               => '',
		'btn_text'               => '',
		'btn_size'               => 'btn-small',
		'btn_icon'               => 'no',
		'icon_pos'               => 'left',
		
		//color
		'border_color'           => '',
		'background_color'       => '',
		'text_color'             => '',
		'icon_color'           => '',
		
		//btn hover color
		'border_color_hover'     => '',
		'background_color_hover' => '',
		'text_color_hover'       => '',
		
	), $atts ) );

	$id = ( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes( $class ) : '';

	$btn_icon_right = '';
	$btn_icon_left = '';
	
	if ( $btn_icon == 'yes' ) {
		switch ( $icon_pos ) {
			case 'left':
				$btn_icon_left = '<i class="' . sanitize_html_classes( $icon ) . '"></i>';
			break;
			
			case 'right':
				$btn_icon_right = '<i class="' . sanitize_html_classes( $icon ) . '"></i>';
				$btn_icon_left = '';
			break;
			
			case 'center':
				$btn_icon_left = '<span><i class="' . sanitize_html_classes( $icon ) . '"></i></span>';
			break;
		}
	}

	$ex_class     = ( $icon_pos == 'center') ? 'btn-icon':'';
	$customize    = ( $background_color || $border_color || $text_color || $icon_color || $border_color_hover || $background_color_hover || $text_color_hover ) ? true:false;
	$uniqid_class = '';

	if ( function_exists( 'vc_parse_multi_attribute' ) ) {
		$parse_args = vc_parse_multi_attribute( $btn_link );
		$href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
		$title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
		$target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	}

	if( $customize ) {

		$uniqid       = uniqid();
		$custom_style = '';

		if($background_color || $text_color || $border_color ) {
			$custom_style .=  '.btn-custom-'.$uniqid.'{';
			$custom_style .=  ( $background_color ) ? 'background:'.$background_color.' !important;':'';
			$custom_style .=  ( $border_color ) ? 'border-color:'.$border_color.' !important;':'';
			$custom_style .=  ( $text_color ) ? 'color:'.$text_color.' !important;':'';
			$custom_style .= '}';
		}

		if ($icon_color) {
			$custom_style .=  '.btn-custom-'.$uniqid.' span i, .btn-custom-'.$uniqid.' i {';
			$custom_style .=  'color:'.$icon_color.' !important;';
			$custom_style .= '}';
		}

		if($background_color_hover || $text_color_hover || $border_color_hover ) {
			$custom_style .=  '.btn-custom-'.$uniqid.':hover {';
			$custom_style .=  ( $background_color_hover ) ? 'background:'.$background_color_hover.' !important;':'';
			$custom_style .=  ( $text_color_hover ) ? 'color:'.$text_color_hover.' !important;':'';
			$custom_style .=  ( $border_color_hover ) ? 'border-color:'.$border_color_hover.' !important;':'';
			$custom_style .= '}';
		}

		ts_add_inline_style( $custom_style );

		$uniqid_class = 'btn-custom-'. $uniqid;

	}

	$output = '<div ' . $id . ' class="mb-10' . $class . '"><a href="' . esc_url( $href ) . '" title="' . esc_attr( $title ) . '" target="' . esc_attr( $target ) . '" class="btn ' . sanitize_html_classes( $uniqid_class ) . ' btn-mod ' . sanitize_html_classes( $ex_class ) . ' ' . sanitize_html_classes( $btn_size ) . ' ' . sanitize_html_classes( $btn_style) . ' ' . sanitize_html_classes( $btn_shape ) . '">' . $btn_icon_left . ' ' . esc_html( $btn_text ) . ' ' . $btn_icon_right . '</a></div>';

	return $output;
}

add_shortcode( 'rs_buttons', 'rs_buttons' );
