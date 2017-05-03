<?php
/**
 *
 * RS Feature Box
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_feature_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'title'         => '',
    'icon'          => '',
    'sel_icon'      => '',
    'box_style'     => 'style1',
    'content_align' => 'left',
    'button_text'   => '',
    'button_link'   => '',
    'style4_image'  => '',
    'count_no'      => '',

    //color
    'icon_color'    => '',
    'title_color'   => '',
    'text_color'    => '',

    //size attribute
    'title_size'    => '',
    'icon_size'     => '',
    'content_size'  => '',

    //spacing
    'title_top'     => '',
    'title_bottom'  => '',
  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $icon_color   = ( $icon_color ) ? 'color:'.$icon_color.';':'';
  $title_color  = ( $title_color ) ? 'color:'.$title_color.';':'';
  $text_color   = ( $text_color ) ? 'color:'.$text_color.';':'';
  $title_size   = ( $title_size ) ? 'font-size:'.$title_size.';':'';
  $icon_size    = ( $icon_size ) ? 'font-size:'.$icon_size.';':'';
  $content_size = ( $content_size ) ? 'font-size:'.$content_size.';':'';
  $top          = ( $title_top ) ? 'margin-top:'.$title_top.';':'';
  $bottom       = ( $title_bottom ) ? 'margin-bottom:'.$title_bottom.';':'';


  $el_icon_style  = ( $icon_color || $icon_size ) ? 'style="'.esc_attr($icon_color.$icon_size).'"':'';
  $el_title_style = ( $title_color || $title_bottom || $title_size || $title_top ) ? 'style="'.esc_attr($top.$bottom.$title_size.$title_color).'"':'';
  $el_content_style = ( $content_size || $text_color ) ? 'style="'.esc_attr($content_size.$text_color).'"':'';

  $output = '';
  
  $href = $b_title = $target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
  $parse_args = vc_parse_multi_attribute( $button_link );
  $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
  $b_title    = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : '';
  $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }
  
  switch ($box_style) {
    case 'style1':
    
  if (!empty($href) && $href != '#') {
    $output .=  '<a class="alt-features-link" href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($b_title).'">';
    }
    
  $output .=  '<div '.$id.' class="alt-features-item align-center'.$class.'">';
    $output .=  '<div class="alt-features-icon" '.$el_icon_style.'>';
    $output .=  '<span class="'.sanitize_html_classes($sel_icon).'"></span>';
    $output .=  '</div>';
    $output .=  '<h3 class="alt-features-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
  
  
    if( !empty($content)) {
      $output .=  '<div class="alt-features-descr align-'.sanitize_html_classes($content_align).'" '.$el_content_style.'>';
      $output .=  do_shortcode(wp_kses_data($content));
      $output .=  '</div>';
    }

    $output .=  '</div>';
  if (!empty($href) && $href != '#') {
    $output .=  '</a>';
    }
    break;

    case 'style2':
    
    if (!empty($href) && $href != '#') {
      $output .=  '<a class="benefit-item-link" href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($b_title).'">';
    }
    
    $output .=  '<div '.$id.' class="benefit-item text-center'.$class.'">';
    $output .=  '<div class="benefit-icon" '.$el_icon_style.'>';
    $output .=  '<i class="'.sanitize_html_classes($icon).'"></i>';
    $output .=  '</div>';
    $output .=  '<h3 class="benefit-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
    $output .=  '<div class="benefits-descr" '.$el_content_style.'>';
    $output .=  do_shortcode(($content));
    $output .=  '</div>';
    $output .=  '</div>';
  
    if (!empty($href) && $href != '#') {
      $output .=  '</a>';
    }
  
    break;

    case 'style3':
  
    if (!empty($href) && $href != '#') {
      $output .=  '<a class="alt-service-link" href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($b_title).'">';
      }
    
    $output .=  '<div '.$id.' class="alt-service-item'.$class.'" '.$el_content_style.'>';
    $output .=  '<div class="alt-service-icon" '.$el_icon_style.'>';
    $output .=  '<i class="'.sanitize_html_classes($icon).'"></i>';
    $output .=  '</div>';
    $output .=  '<h3 class="alt-services-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
    $output .=  do_shortcode(($content));
    $output .=  '</div>';
  
    if (!empty($href) && $href != '#') {
      $output .=  '</a>';
      }
  
    break;

    case 'style5':
      if (!empty($href) && $href != '#') {
        $output .=  '<a class="benefit-item-link" href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($b_title).'">';
      }
    
      $output .=  '<div '.$id.' class="benefit-item text-center'.$class.'">';
      if(is_numeric($style4_image) && !empty($style4_image)) {
        $image_src = wp_get_attachment_image_src( $style4_image, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<div class="benefit-icon mb-20"><img src="'.esc_url($image_src[0]).'" width="64" height="64" alt="" /></div>';
        }
      }
      $output .=  '<h3 class="benefit-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
      $output .=  '<div class="benefits-descr" '.$el_content_style.'>';
      $output .=  do_shortcode(($content));
      $output .=  '</div>';
      $output .=  '</div>';
    
      if (!empty($href) && $href != '#') {
        $output .=  '</a>';
      }

      break;
    
    case 'style6':    
    
	$output .=  '<div '.$id.' class="features-item align-center'.$class.'">';
	$output .= 	'<div class="count-number" '.$el_title_style.'>'.esc_html($count_no).'</div>';
    $output .=  '<h3 class="alt-features-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
    $output .=  '</div>';

    break;
    
    case 'style7':    
    
	$output .=  '<div '.$id.' class="alt-features-item align-center'.$class.'">';	
	if(is_numeric($style4_image) && !empty($style4_image)) {
	    $image_src = wp_get_attachment_image_src( $style4_image, 'full' );
		if(isset($image_src[0])) {
			$output .=  '<div class="benefit-icon mb-20"><img src="'.esc_url($image_src[0]).'" width="64" height="64" alt="" /></div>';
    	}
  	}
    $output .=  '<h3 class="alt-features-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
    $output .=  '<div class="alt-features-descr" '.$el_content_style.'>';
    $output .=  do_shortcode(($content));
    $output .=  '</div>';
    $output .=  '</div>';

    break;
    
    case 'style8':
    	$output .= '<div ' . $id . ' class="alt-features-item alt-features-item-style2 align-center' . $class . '">';
    	$output .= '<a href="' . esc_url( $href ) . '">';
    	$output .= '<div class="alt-features-icon">';
		$output .= '<span class="icon-elegant '.sanitize_html_classes($sel_icon).'"></span>';
		$output .= '</div>';
		$output .= '<h3 class="alt-features-title" '.$el_title_style.'>'.esc_html($title).'</h3>';		
		$output .= '</a>';
		if (! empty ( $content ) ) {
			$output .= '<div class="alt-features-descr">' . wp_kses_post( $content ) . '</div>';
		}
		if ( ! empty( $button_text ) ) {
			$output .= '<a href="' . esc_url( $href ) . '" class="more"><i class="fa fa-plus-circle"></i> ' . esc_html( $button_text ) . '</a>';
		}
    	$output .= '</div>';
    break;

    default:
    case 'style4':

    $output .=  '<div class="alt-features-item align-center'.$class.'">';
    if(is_numeric($style4_image) && !empty($style4_image)) {
      $image_src = wp_get_attachment_image_src( $style4_image, 'full' );
      if(isset($image_src[0])) {
        $output .=  '<div class="mb-10">';
        $output .=  '<img src="'.esc_url($image_src[0]).'" width="217" height="163" alt="" />';
        $output .=  '</div>';
      }
    }
    $output .=  '<h3 class="alt-features-title font-alt" '.$el_title_style.'>'.esc_html($title).'</h3>';
    $output .=  '<div class="alt-features-descr mb-30" '.$el_content_style.'>';
    $output .=  do_shortcode(wp_kses_data($content));
    $output .=  '</div>';
    $output .=  '<div>';
    $output .=  ($button_text) ? '<a href="'.esc_url($href).'" title="'.esc_attr($b_title).'" target="'.esc_attr($target).'" class="btn btn-mod btn-gray btn-circle">'.esc_html($button_text).' <i class="fa fa-angle-right"></i></a>':'';
    $output .=  '</div>';
    $output .=  '</div>';
      break;
  }
  
  wp_enqueue_script( 'jquery-countTo' );
  wp_enqueue_script( 'jquery-appear' );
  
  return $output;
}

add_shortcode('rs_feature_box', 'rs_feature_box');
