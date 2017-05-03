<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	$loop = 0;

	foreach ( $attachment_ids as $attachment_id ) {
		$classes = array( 'zoom' );
	
		$props = wc_get_product_attachment_props( $attachment_id, $post );

		if ( ! $props['url'] ) {
			continue;
		}
		
		$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props );
		$image_class = esc_attr( implode( ' ', $classes ) );
		$image_title = esc_attr( get_the_title( $attachment_id ) );
		echo '<div class="col-xs-3 post-prev-img">';
		echo apply_filters( 
			'woocommerce_single_product_image_thumbnail_html', 
			sprintf( 
				'<a href="%s" class="lightbox-gallery-3 mfp-image %s" title="%s">%s</a>', 
				esc_url($props['url']), 
				$image_class, 
				esc_attr( $props['caption'] ), 
				$image 
			), 
			$attachment_id, 
			$post->ID, 
			$image_class 
		);
		echo '</div>';
		$loop++;
	}
	
	wp_enqueue_script( 'jquery-magnific-popup' );
}
