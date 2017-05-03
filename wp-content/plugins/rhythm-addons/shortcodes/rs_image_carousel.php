<?php
/**
 *
 * RS Image Slider With Lightbox
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_image_carousel( $atts, $content = '', $id = '' ) {

	wp_enqueue_script('owl-carousel');
	wp_enqueue_script('jquery-magnific-popup');

	extract( shortcode_atts( array(
		'id'         => '',
		'class'      => '',
		'items'      => 'image-carousel',
		'image_list' =>  ''
	), $atts ) );

	$id    = ( $id ) ? ' id="'. esc_attr( $id ) .'"' : '';
	$class = ( $class ) ? '' . sanitize_html_classes( $class ) : '';

	$output  =  '<div class=" ' . $items . ' bg-dark ' . $class . '"  ' . $id . '>';
	if(!empty($image_list)) {
	$images = explode(',', $image_list);
		foreach ($images as $image) {
			$image_src = wp_get_attachment_image_src($image, 'full');
			$output .=  '<div>';
			$output .=  '<div class="post-prev-img mb-0">';
			$output .=  '<a href="'.esc_url($image_src[0]).'" class="lightbox-gallery-2 mfp-image"><img src="'.esc_url($image_src[0]).'" alt="" /></a>';
			$output .=  '</div>';
			$output .=  '</div>';
		}
	}
	$output .=  '</div>';

	return $output;
}

add_shortcode('rs_image_carousel', 'rs_image_carousel');
