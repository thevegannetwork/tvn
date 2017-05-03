<?php
/**
 *
 * RS Service Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_service_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'title'         => '',
    'image'         => '',
    'action'        => 'lightbox_image',
    'btn_text'      => '',
    'btn_link'      => '',
    'video'         => '',

    //colors
    'title_color'   => '',
    'content_color' => ''
  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $el_title_color   = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
  $el_content_color = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $btn_title  = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $output  =  '<div '.$id.' class="post-prev-img'.$class.'">';
  if(is_numeric($image) && !empty($image)) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {
      $image_tag =  '<img src="'.esc_url($image_src[0]).'" alt="" />';
	  
	  switch ($action) {
		  case 'lightbox_image':
			  $output .= '<a href="'.esc_url($image_src[0]).'" class="work-lightbox-link mfp-image">'.$image_tag.'</a>';
			  break;
		  
		   case 'lightbox_video':
			  $output .= '<a href="'.esc_url($video).'" class="popup-video-box">'.$image_tag.'</a>';
			  break;
		  
		  default:
			  $output .= $image_tag;
	  }
	  
    }
  }
  $output .=  '</div>';
  $output .=  '<div class="post-prev-title font-alt"'.$el_title_color.'>'.esc_html($title).'</div>';
  $output .=  '<div class="post-prev-text"'.$el_content_color.'>';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .=  '</div>';
  if(!empty($btn_link) && !empty($btn_text)) {
    $output .=  '<div class="post-prev-more">';
    $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($btn_title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-gray btn-round">'.esc_html($btn_text).' <i class="fa fa-angle-right"></i></a>';
    $output .=  '</div>';
  }

  wp_enqueue_script( 'jquery-magnific-popup' );
  
  return $output;
}

add_shortcode('rs_service_box', 'rs_service_box');
