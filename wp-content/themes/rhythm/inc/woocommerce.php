<?php
/**
 * WooCommerce integration
 * 
 * @package Rhythm
 */

//content-product.php
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 10 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 20 );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'ts_header_add_to_cart_fragment' );

function ts_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <?php echo sprintf(__('Cart(%d)','rhythm'),WC()->cart->cart_contents_count); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

/**
* WP Core doens't let us change the sort direction for invidual orderby params - http://core.trac.wordpress.org/ticket/17065
*
* This lets us sort by meta value desc, and have a second orderby param.
*
* @param array $args
* @return array
*/
function ts_woocommerce_order_by_popularity_post_clauses( $args ) {
	global $wpdb;

	$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

	return $args;
}

/**
* order_by_rating_post_clauses function.
*
* @param array $args
* @return array
*/
function ts_woocommerce_order_by_rating_post_clauses( $args ) {
   global $wpdb;

   $args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

   $args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

   $args['join'] .= "
	   LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
	   LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
   ";

   $args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";

   $args['groupby'] = "$wpdb->posts.ID";

   return $args;
}
