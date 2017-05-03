<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>


	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<div><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span>.</div>
	
	<?php endif; ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>

	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>	

	<?php do_action( 'woocommerce_product_meta_end' ); ?>