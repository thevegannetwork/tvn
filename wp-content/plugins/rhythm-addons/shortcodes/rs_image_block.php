<?php
/**
 *
 * RS Image Block
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_image_block( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                 => '',
    'class'              => '',
    'image'              => '',
    'link'               => '',
    'align'              => 'align-left',
    'width'              => '',
    'height'             => '',
    'min_height_div'     => '',
    'lightbox'           => 'no',
    'image_link'         => 'no',
    'background_block'   => 'no',
    'margin_top'         => '',
    'margin_bottom'      => '',
    'animation'          => '',
    'animation_delay'    => '',
    'animation_duration' => '',
  ), $atts ) );

  $id                 = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class              = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $lightbox_class     = ( $lightbox == 'yes' && $image_link == 'no') ? ' class="lightbox-gallery-2 mfp-image"':'';
  $hidden_class       = ( $background_block == 'yes' ) ? ' class="hidden"':'';
  

  $top                = ( $margin_top ) ? 'margin-top:'.$margin_top.';':'';
  $bottom             = ( $margin_bottom ) ? 'margin-bottom:'.$margin_bottom.';':'';
  $block_height       = ( $min_height_div ) ? 'min-height:'.$min_height_div.';':'';    
  
  $animation          = ( $animation ) ? ' wow '. $animation : '';
  $animation_duration = ( $animation_duration ) ? ' data-wow-duration="'.esc_attr($animation_duration).'s"':'';
  $animation_delay    = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';


  $href = $title = $target = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) && $image_link == 'yes' ) {
    $parse_args = vc_parse_multi_attribute( $link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? ' title="'.esc_attr($parse_args['title']).'"' : '';
    $target     = ( isset( $parse_args['target'] ) ) ? ' target="'.esc_attr(trim( $parse_args['target'] )).'"' : '';
  }

  $output = '';
  if ( is_numeric( $image ) && !empty( $image ) ) {
    $image_src = wp_get_attachment_image_src( $image, 'full' );
    if(isset($image_src[0])) {

      if (empty($width)) {
        $width = $image_src[1];
      }

      if (empty($height)) {
        $height = $image_src[2];
      }
      $width = ( $width ) ? ' width="'.esc_attr($width).'"':'';
      $height = ( $height ) ? ' height="'.esc_attr($height).'"':'';
      
      if($background_block == 'yes') {
	      $background_src = 'background-image:url('.esc_url($image_src[0]).');';
	  } else {
		  $background_src = '';
	  }
      
      $style = '';
	  if (!empty($top) || !empty($bottom) || !empty($block_height) || !empty($background_src)  ) {
		  $style = 'style="'.$top.$bottom.$block_height.$background_src.'"';
	  }

      

      $href = ( $lightbox == 'yes' && $image_link == 'no') ? $image_src[0]:$href;
      $output .=  '<div '.$id.' class="full-block'.$class.$animation.' '.sanitize_html_classes($align).'"'.$animation_delay.$animation_duration.' '.$style.'>';
      $output .=  ( $image_link == 'yes' && !empty($image_link) || $lightbox == 'yes' ) ? '<a href="'.esc_url($href).'"'.$title.$target.$lightbox_class.'>':'';
      $output .= '<img '.$hidden_class.' src="'.esc_url($image_src[0]).'" '.$width.$height.' alt="" title="" />';
      $output .=  ( $image_link == 'yes' && !empty($image_link) || $lightbox == 'yes' ) ? '</a>':'';
      $output .=  '</div>';
    }
  }
  wp_enqueue_script('jquery-magnific-popup');
  return $output;
}

add_shortcode('rs_image_block', 'rs_image_block');
