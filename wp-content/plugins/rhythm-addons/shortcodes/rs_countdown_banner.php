<?php
/**
 *
 * RS Countdown Banner
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_countdown_banner( $atts, $content = '', $id = '' ) {

	wp_enqueue_script('jquery-timer');

	extract( shortcode_atts( array(
		'id'         => '',
		'class'      => '',
		'style'      => 'light',
		'background' => '',
		'utc'        => '',
		'year'       => '',
		'month'      => '',
		'days'       => '',
		'hours'      => '',
		'minutes'    => '00',
		'seconds'    => '00',
		'btn_text'   => '',
		'btn_link'   => '',
		'finish_msg' => '',
		'local_link' => '',
		
		//labels
		'd_label'    => '',
		'h_label'    => '',
		'm_label'    => '',
		's_label'    => '',
	
	), $atts ) );

	$id          = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
	$class       = ( $class ) ? ' '. sanitize_html_classes($class) : '';
	$btn_color   = ( $style == 'light' ) ? ' btn-w':'';
	$text_color  = ( $style == 'light' ) ? ' glass':'';
	
	$daysLabel = ( ! empty ( $d_label ) ) ?  $d_label : esc_html__( 'days', 'rhythm-addons' );
	$hourLabel = ( ! empty ( $h_label ) ) ?  $h_label : esc_html__( 'hours', 'rhythm-addons' );
	$minLabel  = ( ! empty ( $m_label ) ) ?  $m_label : esc_html__( 'minutes', 'rhythm-addons' );
	$secsLabel = ( ! empty ( $s_label ) ) ?  $s_label : esc_html__( 'seconds', 'rhythm-addons' );

	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($btn_link);
		$href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
		$title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
		$target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
	}

	if (function_exists('vc_parse_multi_attribute')) {
		$parse_args = vc_parse_multi_attribute($local_link);
		$href_local       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
	}

	$data_finish_msg = ( $finish_msg ) ? ' data-finish-message="'.esc_html($finish_msg).'"':'';

	$data_background = '';
	if (is_numeric($background) && !empty($background)) {
		$image_src = wp_get_attachment_image_src($background, 'full');
		if (isset($image_src[0])) {
			$data_background = ' data-background=' . esc_url($image_src[0]) . '';
		}
	}

	if($year && $month && $days && $hours && $minutes && $seconds) {
		$data_count_date = ' data-finish-date="'.esc_attr($month).'/'.esc_attr($days).'/'.esc_attr($year).' '.esc_attr($hours).':'.esc_attr($minutes).':'.esc_attr($seconds).'"';
	}

	$output  =  '<section class="home-section countdown-'.sanitize_html_classes($style).' bg-dark parallax-2'.$class.'" '.$data_background.' id="home">';
	$output .=  '<div class="js-height-full">';
	$output .=  '<div class="home-content">';
	$output .=  '<div class="home-text">';
	$output .=  '<div class="container align-center">';
	$output .=  '<div class="row">';
	$output .=  '<div class="col-sm-8 col-sm-offset-2">';
	$output .=  '<ul class="countdown '.sanitize_html_classes($style).' clearlist clearfix mb-80 mb-xs-20" '.$data_count_date.' data-UTC="2"'.$data_finish_msg.'>';
	$output .=  '<li>';
	$output .=  '<span class="countdown-number"><span class="days font-alt">00</span><b class="days_ref">' . esc_html( $daysLabel ) . '</b></span>';
	$output .=  '</li>';
	$output .=  '<li>';
	$output .=  '<span class="countdown-number"><span class="hours font-alt">00</span><b class="hours_ref">' . esc_html( $hourLabel ) . '</b></span>';
	$output .=  '</li>';
	$output .=  '<li>';
	$output .=  '<span class="countdown-number"><span class="minutes font-alt">00</span><b class="minutes_ref">' . esc_html( $minLabel ) . '</b></span>';
	$output .=  '</li>';
	$output .=  '<li>';
	$output .=  '<span class="countdown-number"><span class="seconds font-alt">00</span><b class="seconds_ref">' . esc_html( $secsLabel ) . '</b></span>';
	$output .=  '</li>';
	$output .=  '</ul>';
	$output .=  '<p class="lead '.$text_color.' text-mobile mt-0 mb-40 mb-xs-20">'.wp_kses_post($content).'</p>';
	if(!empty($btn_text)) {
		$output .=  '<div class="local-scroll">';
		$output .=  '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($title).'" class="btn btn-mod '.$btn_color.' btn-medium btn-round">'.esc_html($btn_text).'</a>';
		$output .=  '</div>';
	}
	$output .=  '</div>';
	$output .=  '</div>';
	$output .=  '</div>';
	$output .=  '</div>';
	$output .=  '</div>';
	if(!empty($local_link)) {
		$output .=  '<div class="local-scroll">';
		$output .=  '<a href="'.esc_url($href_local).'" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i></a>';
		$output .=  '</div>';
	}
	$output .=  '</div>';
	$output .=  '</section>';

	return $output;
}

add_shortcode('rs_countdown_banner', 'rs_countdown_banner');