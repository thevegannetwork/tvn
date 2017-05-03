<?php
/**
 *
 * RS Gallery
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_gallery( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'column' => '1',
    'images' => '',
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $col_sm = '';
  if( $column == '2') {
    $col_no = '6';
  } elseif ( $column == '3') {
    $col_no = '4';
    $col_sm = 'col-sm-6';
  } elseif ( $column == '4') {
    $col_no = '3';
    $col_sm = 'col-sm-6';
  } elseif ( $column == '6') {
    $col_no = '2';
    $col_sm = 'col-sm-4';
  } else {
    $col_no = '';
  }

  $thumb_size = ($column != '1') ? 'ts-big':'ts-full';

  $output        = '';
  $output        .=  '<div class="row multi-columns-row">';
  $col_class     = ( $column != '1' ) ? '<div '.$id.' class="col-md-'.sanitize_html_classes($col_no).' col-lg-'.sanitize_html_classes($col_no).' '.sanitize_html_classes($col_sm).' mb-md-10'.$class.'">':'';
  $col_class_end = ( $column != '1') ? '</div>':'';

  if( !empty( $images )) {
    $images = explode(',', $images);
    foreach($images as $image) {
      $image_src_lightbox = wp_get_attachment_image_src( $image, 'full' );
      $image_src_thumb    = wp_get_attachment_image_src( $image, $thumb_size );
      $attachment = get_post( $image );                 
      $caption = $attachment->post_excerpt;
      $alt = $attachment->post_title; 
      if(isset($image_src_thumb[0])) {
        $output .=  $col_class;
        $output .=  '<div class="post-prev-img">';
        $output .=  '<a href="'.esc_url($image_src_lightbox[0]).'" class="lightbox-gallery-2 mfp-image"><img src="'.esc_url($image_src_thumb[0]).'" alt=" ' . esc_attr( $alt ) . ' " /></a>';
        $output .=  (!empty($caption)) ? '<span>'.esc_html($caption).'</span>':'';
        $output .=  '</div>';
        $output .= $col_class_end;
		
		wp_enqueue_script( 'jquery-magnific-popup' );
      }
    }
  }

  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_gallery', 'rs_gallery');
