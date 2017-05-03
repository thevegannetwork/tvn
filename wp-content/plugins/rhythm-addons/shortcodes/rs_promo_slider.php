<?php
/**
 *
 * RS Promo Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_promo_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'    => '',
    'class' => '',
    'style' => 'fixed_height_slider',
    'background' => '',
  ), $atts ) );

  global $slider_type;
  $slider_type = $style;

  $data_background = '';
  if ( is_numeric( $background ) && !empty($background) ) {
    $image_src  = wp_get_attachment_image_src( $background, 'full' );
    $data_background = ' data-background='.esc_url($image_src[0]).'';
  }

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'home"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output =  '<div '.$id.' class="home-section fullwidth-slider promo-slider bg-dark' . $class . '" ' . $data_background .  '>';
  $output .=  do_shortcode( wp_kses_data($content ));
  $output .=  '</div>';

  wp_enqueue_script( 'owl-carousel' );

  return $output;
}
add_shortcode('rs_promo_slider', 'rs_promo_slider');

function rs_promo_slide( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'background'              => '',
    'alt'                     => '',
    'heading_image'           => '',
    'small_heading'           => '',
    'heading'                 => '',
    'small_heading_below'     => 'no',
    'btn'                     => 'no',
    'button_style'            => 'btn-round',
    'overlay_style'           => '',
    'button_size'             => 'btn-small',
    'btn_one_link'            => '',
    'btn_text'                => '',
    'btn_lightbox'            => '',
    'btn_text_two'            => '',
	'btn_lightbox_two'        => '',
    'btn_two_link'            => '',
	'add_player_icon'		  => 'no',
	'self_hosted_video'		  => '',
	'embedded_video'		  => '',

    // colors
    'small_heading_color'     => '',
    'heading_color'           => '',
    'button_border_color'     => '',
    'button_text_color'       => '',
    'button_text_color_hover' => '',
    'button_background_hover' => ''

  ), $atts ) );

  global $slider_type;

  $small_heading_color = ( $small_heading_color ) ? ' style="color:'.esc_attr($small_heading_color).';"':'';
  $heading_color       = ( $heading_color ) ? ' style="color:'.esc_attr($heading_color).';"':'';
  $uniqid_class = '';
  $customize    = ( $button_background_hover || $button_text_color || $button_text_color_hover || $button_border_color ) ? true:false;

  $data_background = '';
  if ( is_numeric( $background ) && !empty($background) ) {
    $image_src  = wp_get_attachment_image_src( $background, 'full' );
    $data_background = ' data-background='.esc_url($image_src[0]).'';
  }
  
  $alt_image = '';
  if ( is_numeric( $heading_image ) && ! empty( $heading_image ) ) {
    $alt_image  = wp_get_attachment_image_src( $heading_image, 'full' );
  }

  $lightbox = $lightbox_two = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_one_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox = ( $btn_lightbox == 1 ) ? 'lightbox mfp-iframe' : '';
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_two_link );
    $href_two   = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_two  = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_two = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	$lightbox_two = ( $btn_lightbox_two == 1 ) ? 'lightbox mfp-iframe' : '';
  }

  if (!empty($lightbox) || !empty($lightbox_two)) {
	  wp_enqueue_script('jquery-magnific-popup');
  }

  if( $customize ) {

    $uniqid       = uniqid();
    $custom_style = '';

    if( $button_border_color || $button_text_color ) {
      $custom_style .=  '.btn-promo-custom-'.$uniqid.'{';
      $custom_style .=  ( $button_text_color ) ? 'color:'.$button_text_color.'!important;':'';
      $custom_style .=  ( $button_border_color ) ? 'border-color:'.$button_border_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $button_background_hover || $button_text_color_hover ) {
      $custom_style .=  '.btn-promo-custom-'.$uniqid.':hover {';
      $custom_style .=  ( $button_text_color_hover ) ? 'color:'.$button_text_color_hover.'!important;':'';
      $custom_style .=  ( $button_background_hover ) ? 'background:'.$button_background_hover.'!important;':'';
      $custom_style .=  'border-color:transparent !important';
      $custom_style .= '}';
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class = ' btn-promo-custom-'. $uniqid;
  }

  switch( $slider_type ) {
	  
	case 'fixed_height_slider':
		$upper_class = 'fixed-height-small';  
		$lower_class = 'js-height-parent';
		$home_class = 'home-section';
	break;
	
	case 'full_height_slider':
		$upper_class  = '';  
		$lower_class  = 'js-height-full';
		$home_class = 'home-section';
	break;
	
	case 'auto_height_slider':
		$upper_class  = '';  
		$lower_class  = 'relative';
		$home_class = 'page-section';	
	break;
	
  }

  $output  = '<section class="' . $home_class . ' bg-scroll ' . $upper_class . ' ' . sanitize_html_classes( $overlay_style ) . '" ' . $data_background . '>';
  $output .=  '<div class="'.$lower_class.' container">';
  $output .=  '<div class="home-content">';
  $output .=  '<div class="home-text">';

  if ( $alt == 'yes' ) {
	  
	  $output .= '<div class="row">';
	  $output .= '<div class="col-md-8 col-md-offset-2">';
	  $output .= '<div class="row">';
	  $output .= '<div class="col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">';
	  $output .= '<a href="' . esc_url( $href ) . '"><img src="' . esc_url( $alt_image[0] ) . '" style="" alt="" /></a>';
	  $output .= '</div>';
	  $output .= '</div>';
	  if ( $btn == 'no' && ! empty( $small_heading ) ) {
	  	$output .= '<h1 class="hs-line-6 no-transp font-alt white">' . esc_html( $small_heading ) . '</h1>';
	  }
	  
	  if ( $btn != 'no' && ! empty( $btn_text ) ) {
	  	$output .= '<h1 class="hs-line-6 no-transp font-alt white">' . esc_html( $small_heading ) . ' <a href="' . esc_url( $href ) . '" class="btn btn-mod btn-w ' . sanitize_html_classes( $button_style ) . ' " style="margin-top:-3px;">' . esc_html( $btn_text ) . '</a></h1>';
	  }
	  
	  $output .='</div>';
	  $output .= '</div><!--//.row-->';
	  
  } else {
  
  if (in_array($add_player_icon, array('use_self_hosted_video', 'use_embedded_video'))) {

	  $output .= '<div>';

	  if ($add_player_icon == 'use_self_hosted_video') {
		  $video_url = $self_hosted_video;
		  $uid = uniqid();
		  $output .= '<a href="#modal-video" class="video-popup-modal big-icon-link"><span class="big-icon"><i class="fa fa-play"></i></span></a>';
		  $output .= '<div id="modal-video" class="mfp-hide video-popup-block">';
		  $output .= '<video width="640" height="360" src="' . esc_url( $video_url ) . '" controls autobuffer>';
		  $output .= '<div class="fallback"><p>'.__('You must have an HTML5 capable browser.', 'rhythm').'</p></div>';
		  $output .= '</video>';
		  $output .= '</div>';
	  } else {
		  $video_url = $embedded_video;
		  $output .= '<a href="'.esc_url($video_url).'" class="big-icon-link lightbox-gallery-1 mfp-iframe"><span class="big-icon"><i class="fa fa-play"></i></span></a>';
	  }


      $output .= '</div>';

	  wp_enqueue_script( 'jquery-magnific-popup' );
  }

  if ($small_heading_below == 'yes') {
	$output .=  '<div class="hs-line-14 font-alt mb-50 mb-xs-20"'.$heading_color.'>'.esc_html($heading).'</div>';
	$output .=  '<div class="hs-line-8 no-transp font-alt mb-40 mb-xs-10"'.$small_heading_color.'>'.esc_html($small_heading).'</div>';
  } else {
	$output .=  '<div class="hs-line-8 no-transp font-alt mb-40 mb-xs-10"'.$small_heading_color.'>'.esc_html($small_heading).'</div>';
	$output .=  '<div class="hs-line-14 font-alt mb-50 mb-xs-10"'.$heading_color.'>'.esc_html($heading).'</div>';
  }

  if($btn != 'no') {
    if( $btn == 'two_buttons') {
      $output .=  '<div class="local-scroll">';
      $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w '.sanitize_html_classes($button_style).' '.sanitize_html_classes($button_size).' '.sanitize_html_classes($uniqid_class).' '.  sanitize_html_classes($lightbox).'">'.esc_html($btn_text).'</a> ';
      $output .=  '<span class="hidden-xs">&nbsp;&nbsp;</span>';
      $output .=  '<a href="'.esc_url($href_two).'" title="'.esc_attr($title_two).'" target="'.esc_attr($target_two).'" class="btn btn-mod btn-border-w '.sanitize_html_classes($button_style).' '.sanitize_html_classes($button_size).' '.sanitize_html_classes($uniqid_class).' '.  sanitize_html_classes($lightbox_two).'">'.esc_html($btn_text_two).'</a>';
      $output .=  '</div>';
    } else {
      $output .=  '<div class="local-scroll">';
      $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border-w '.sanitize_html_classes($button_style).' '.sanitize_html_classes($button_size).' '.sanitize_html_classes($uniqid_class).' '.  sanitize_html_classes($lightbox).'">'.esc_html($btn_text).'</a> ';
      $output .=  '</div>';
    }

  }
 
 } //If  $alt = no

  $output .=  '</div></div></div>';
  $output .=  '</section>';

  return $output;


}
add_shortcode('rs_promo_slide', 'rs_promo_slide');
