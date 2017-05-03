<?php
/**
 *
 * RS Banner Rotator
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_banner_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'          => '',
    'class'       => '',
    'style'       => 'home_slider',

    //slider opts
    'autoplay'       => '',    
    'time'           => '',
    'speed'          => '',    
    
  ), $atts ) );

  global $rs_style;
  $rs_style = $style;

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
 
	$speed = ( $speed ) ? $speed: '';
  
	if ( $autoplay ) {
	  $autoplay  = ! empty( $time ) ? intval( $time ) : 'true';
	} else {
	  $autoplay = 'false';
	}

  switch ($style) {
    case 'construction_slider':
      $output  =  '<div class="fullwidth-slider slider-construction bg-dark" data-speed="' . esc_attr( $speed ) . '" data-autoplay="' . esc_attr( $autoplay ) . '">';
      $output .=  do_shortcode(wp_kses_data($content));
      $output .=  '</div>';
      break;
	case 'presto_slider':
      $output  =  '<div class="home-section fullwidth-slider slider-navigation-style2 slider-pagination-off navigation-transparent" id="home" data-speed="' . esc_attr( $speed ) . '" data-autoplay="'.  esc_attr( $autoplay ). '">';
      $output .=  do_shortcode(wp_kses_data($content));
      $output .=  '</div>';	
	  break;
    case 'home_slider':
    default:
      $output = '<div ' . $id . ' class="home-section fullwidth-slider-fade bg-dark' . sanitize_html_classes( $class ) . '" data-speed="' . esc_attr( $speed ) . '" data-autoplay="' . esc_attr( $autoplay ) . '" id="home">';
      $output .=  do_shortcode(wp_kses_data($content));
      $output .= '</div>';
      break;
  }
  
  wp_enqueue_script( 'owl-carousel' );

  return $output;
}

add_shortcode('rs_banner_slider', 'rs_banner_slider');

function rs_banner_slide($atts, $content = '') {
    extract( shortcode_atts( array(
    'background'    => '',
    'small_heading' => '',
    'no_buttons'    => 'one',
    'big_heading'   => '',
    'btn_one_link'  => '',
    'btn_two_link'  => '',
    'btn_one_text'  => '',
    'btn_two_text'  => '',
    'btn_one_lightbox'  => '',
    'btn_two_lightbox'  => '',
    's_link'            => '',

    'big_heading_color'       => '',
    'small_heading_color'     => '',
    'small_heading_font_size' => '',
    'big_heading_font_size'   => ''

  ), $atts ) );

  global $rs_style;

  $big_heading_color       = ( $big_heading_color ) ? 'color:'.$big_heading_color.';':'';
  $small_heading_color     = ( $small_heading_color ) ? 'color:'.$small_heading_color.';':'';
  $small_heading_font_size = ( $small_heading_font_size ) ? 'font-size:'.$small_heading_font_size.';':'';
  $big_heading_font_size   = ( $big_heading_font_size ) ? 'font-size:'.$big_heading_font_size.';':'';

  $el_small_heading = ( $small_heading_font_size || $small_heading_color ) ? ' style="'.esc_attr($small_heading_font_size.$small_heading_color).'"':'';
  $el_big_heading   = ( $big_heading_font_size || $big_heading_color ) ? ' style="'.esc_attr($big_heading_font_size.$big_heading_color).'"':'';

  $data_background = '';
  if ( is_numeric( $background ) && !empty($background) ) {
    $image_src  = wp_get_attachment_image_src( $background, 'full' );
    if(isset($image_src[0])) {
      $data_background = ' data-background='.esc_url($image_src[0]).'';
    }

  }
  $lightbox = $lightbox_2 = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_one_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox = ( $btn_one_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_two_link );
    $href_2     = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_2    = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_2   = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox_2 = ( $btn_two_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
  }

	if ( function_exists( 'vc_parse_multi_attribute' ) ) {
		$parse_args = vc_parse_multi_attribute( $s_link );
		$s_href     = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
	}  
  
  if (!empty($lightbox) || !empty($lightbox_2)) {
	  wp_enqueue_script('jquery-magnific-popup');
  }

  switch ($rs_style) {
    case 'construction_slider':
      $output  = '<div class="page-section bg-scroll bg-dark-alfa-30" '.$data_background.'>';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-1 col-md-5 col-md-offset-1">';
      $output .=  '<div class="hs-line-8 no-transp font-alt mb-30 mb-xs-10"'.$el_small_heading.'>'.esc_html($small_heading).'</div>';
      $output .=  '<h3 class="mb-40 mb-xs-30"'.$el_big_heading.'>'.esc_html($big_heading).'</h3>';
      $output .=  '<div class="local-scroll">';
      if($no_buttons == 'one') {
      $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-circle btn-small">'.esc_html($btn_one_text).'</a>';
      } else {
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-circle btn-small">'.esc_html($btn_one_text).'</a>';
        $output .=  '<span class="hidden-xs">&nbsp;</span><span class="hidden-xs">&nbsp;</span>';
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="btn btn-mod btn-border-w btn-circle btn-small">'.esc_html($btn_two_text).'</a>';
      }
      
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
	  
	case 'presto_slider':	
		$output = '<section class="home-section bg-scroll bg-dark" '.$data_background.'>';
		$output .= '<div class="js-height-full container">';	
		$output .= '<div class="home-content">';
		$output .= '<div class="home-text">';	
		$output .= '<h1 class="hs-line-18">'.esc_html($small_heading).'</h1>';
		$output .= '<h2 class="hs-line-19">'.esc_html($big_heading).'</h2>';
		$output .= '<div class="local-scroll"><a href="'.esc_url($href).'" target="'.esc_attr($target).'" class="btn btn-mod btn-w btn-round btn-large btn-large-alt">'.esc_html($btn_one_text).'</a></div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="local-scroll"><a href="' . esc_url( $s_href ) . '" class="scroll-down scroll-down-style2"><i class="fa fa-angle-down scroll-down-icon"></i></a></div>';
		$output .= '</div>';
		$output .= '</section>';
	break;  

    case 'home_slider':
    default:
      $output  = '<section class="home-section bg-scroll bg-dark-alfa-50" '.$data_background.'>';
      $output .=  '<div class="js-height-full container">';
      $output .=  '<div class="home-content">';
      $output .=  '<div class="home-text">';
      $output .=  '<h1 class="hs-line-8 no-transp font-alt mb-50 mb-xs-30"'.$el_small_heading.'>'.esc_html($small_heading).'</h1>';
      $output .=  '<h2 class="hs-line-14 font-alt mb-50 mb-xs-30"'.$el_big_heading.'>'.esc_html($big_heading).'</h2>';
      $output .=  '<div class="local-scroll">';
      if($no_buttons == 'one') {
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs '.sanitize_html_classes($lightbox).'">'.esc_html($btn_one_text).'</a> ';
      } else {
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs '.sanitize_html_classes($lightbox_2).'">'.esc_html($btn_one_text).'</a> ';
        $output .=  '<span class="hidden-xs">&nbsp;&nbsp;</span>';
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="btn btn-mod btn-border-w btn-medium btn-round '.sanitize_html_classes($lightbox).'">'.esc_html($btn_two_text).'</a>';
      }

      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</section>';
      wp_enqueue_script( 'jquery-magnific-popup' );
      break;
  }

  return $output;
}

add_shortcode('rs_banner_slide', 'rs_banner_slide');