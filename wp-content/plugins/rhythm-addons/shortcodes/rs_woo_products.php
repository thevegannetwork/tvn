<?php

/**
 *
 * Woo Products
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_woo_products($atts, $content = '', $id = '') {

	global $wpdb, $product;

	if (!function_exists('ts_woocommerce_enabled') || ts_woocommerce_enabled() !== true) {
		return false;
	}

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'category_id' => '',
		'columns' => '2',
		'orderby' => 'rand',
		'order' => 'asc',
		'show' => '',
		'addcart_btn' => '',
		'limit' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_duration' => '',
					), $atts));

	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

	$animation = ( $animation ) ? ' wow ' . sanitize_html_classes($animation) : '';
	$animation_duration = ( $animation_duration ) ? ' data-wow-duration="' . esc_attr($animation_duration) . 's"' : '';
	$animation_delay = ( $animation_delay ) ? ' data-wow-delay="' . esc_attr($animation_delay) . 's"' : '';

	//query args
	$args = array(
		'posts_per_page' => intval($id) ? intval($id) : 4,
		'offset' => 0,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'product',
		'post_mime_type' => '',
		'post_parent' => '',
		'paged' => 1,
		'post_status' => 'publish',
	);

	$args['meta_query'] = array();
	$args['meta_query'][] = WC()->query->stock_status_meta_query();
	$args['meta_query'] = array_filter($args['meta_query']);

	// default - menu_order
	$args['orderby'] = 'menu_order title';
	$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
	$args['meta_key'] = '';

	switch ($orderby) {
		case 'rand' :
			$args['orderby'] = 'rand';
			break;
		case 'date' :
			$args['orderby'] = 'date';
			$args['order'] = $order == 'ASC' ? 'ASC' : 'DESC';
			break;
		case 'price' :
			$args['orderby'] = "meta_value_num {$wpdb->posts}.ID";
			$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
			$args['meta_key'] = '_price';
			break;
		case 'popularity' :
			$args['meta_key'] = 'total_sales';

			// Sorting handled later though a hook
			add_filter('posts_clauses', 'ts_woocommerce_order_by_popularity_post_clauses');
			break;
		case 'rating' :
			// Sorting handled later though a hook
			add_filter('posts_clauses', 'ts_woocommerce_order_by_rating_post_clauses');
			break;
		case 'title' :
			$args['orderby'] = 'title';
			$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
			break;
	}

	switch ($show) {
		case 'featured' :
			$args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
			break;
		case 'onsale' :
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$args['post__in'] = $product_ids_on_sale;
			break;
	}
	$shop = new WP_Query($args);

	ob_start();

	global $woocommerce_loop;

	if (!isset($woocommerce_loop)) {
		$woocommerce_loop = array();
	}
	$woocommerce_loop['columns'] = $columns;
	
	if ($shop->have_posts()) :
		?>
		<div class="woocommerce <?php echo $hide_button = ( $addcart_btn == 'hide' ) ? 'hide-add-buttons' : ''; ?>">
			<?php woocommerce_product_loop_start(); ?>

			<?php
			while ($shop->have_posts()) :
				$shop->the_post();
				$product = new WC_Product(get_the_ID());
				?>
				<!-- Shop Item -->
				<?php
				$oArgs = ThemeArguments::getInstance('rs_woo_products');
				$oArgs->set('disable_rating', true);

				if (function_exists('wc_get_template_part')):
					wc_get_template_part('content', 'product');
				endif;

				$oArgs->reset();
				?>
				<!-- End Shop Item -->
		<?php
		endwhile; // end of the loop.
		wp_reset_postdata();
		woocommerce_product_loop_end();
		?>
		</div>
	<?php
	endif;

	remove_filter('posts_clauses', 'ts_woocommerce_order_by_popularity_post_clauses');
	remove_filter('posts_clauses', 'ts_woocommerce_order_by_rating_post_clauses');

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode('rs_woo_products', 'rs_woo_products');
