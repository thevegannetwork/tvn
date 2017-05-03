<?php
/**
 *
 * RS Section Title
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_section_title( $atts, $content = '', $id = '' ) {

	extract( shortcode_atts( array(
		'id'                => '',
		'class'             => '',
		'title_style'       => '',
		'title'             => '',
		'subtitle'          => '',
		'align'             => 'left',
		'show_right'        => 'no',
		'right_title'       => '',
		'link'              => '',
		
		//colors
		'title_color'       => '',
		'right_title_color' => '',
		'right_title_hover' => '',
		
		//size
		'title_size'        => '',
		'right_title_size'  => '',
		
		
		// spacing
		'top'               => '',
		'bottom'            => '',

	), $atts ) );

	$id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
	$class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';

	$uniqid_class = '';
	$customize    = ( $right_title || $right_title_color || $right_title_hover ) ? true:false;
	$align        = ( $align ) ? ' align-'.$align:'';

	if ( function_exists( 'vc_parse_multi_attribute' ) ) {
		$parse_args     = vc_parse_multi_attribute( $link );
		$href           = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
		$btn_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
		$target         = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	}

	$title_color    = ( $title_color ) ? 'color:'.$title_color.';':'';

	$title_size     = ( $title_size ) ? 'font-size:'.$title_size.';':'';
	$top            = ( $top ) ? 'margin-top:'.$top.';':'';
	$bottom         = ( $bottom ) ? 'margin-bottom:'.$bottom.';':'';

	$el_title_style = ( $title_size || $title_color || $top || $bottom ) ? 'style="'.esc_attr($title_color.$title_size.$top.$bottom).'"':'';

	if( $customize ) {
		$uniqid       = uniqid();
		$custom_style = '';

		$custom_style .=  '.right-title-custom-'.$uniqid.'{';
		$custom_style .=  ( $right_title_color ) ? 'color:'.$right_title_color.';':'';
		$custom_style .=  ( $right_title_size ) ? 'font-size:'.$right_title_size.';':'';
		$custom_style .=  ( $right_title_hover ) ? 'color:'.$right_title_hover.';':'';
		$custom_style .= '}';
		
		ts_add_inline_style( $custom_style );
		
		$uniqid_class  = 'right-title-custom-'. $uniqid;
	
	}
	
	switch( $title_style ) {
		
		case 'with_subtitle':
			$output = '<h2 '.$id.' class="section-title with-blue-underline mb-50 mb-sm-30' . $class . '" '.$el_title_style.'>';
			$output .= esc_html( $title ) . ' <span class="dot"></span>';
			if ( ! empty( $subtitle ) ) {
				$output .= '<small>' . esc_html( $subtitle ) . '</small>';
			}
			$output .= '</h2>';
			break;
		
		default:
			$output = '<h2 '.$id.' class="section-title  mb-70 mb-sm-40 font-alt'.$class.sanitize_html_classes($align).'" '.$el_title_style.'>'.esc_html($title);
			$output .=  ( $show_right == 'yes' ) ? '<a href="'.esc_url($href).'" title="'.esc_attr($btn_title).'" target="'.esc_attr($target).'" class="section-more right '.esc_attr($uniqid_class).'">'.esc_html($right_title).'<i class="fa fa-angle-right"></i></a>':'';
			$output .= '</h2>';

	}

  return $output;
}

add_shortcode('rs_section_title', 'rs_section_title');
