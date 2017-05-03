<?php
/**
 * Template Name: Shop
 * 
 * @package Rhythm
*/

global $wpdb;

get_header();
ts_get_title_wrapper_template_part();

//set columns

global $woocommerce_loop;

if (!isset($woocommerce_loop)) {
	$woocommerce_loop = array();
}
$woocommerce_loop['columns'] = ts_get_opt('shop-columns');

//paging rules
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

//posts per page
$posts_per_page = ts_get_post_opt('shop-posts-per-page');
if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

//query args
$args = array(
	'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'product',
    'post_mime_type' => '',
    'post_parent' => '',
    'paged' => $paged,
    'post_status' => 'publish',
);

$args['meta_query'] = array();
$args['meta_query'][] = WC()->query->stock_status_meta_query();
$args['meta_query'] = array_filter($args['meta_query']);

//from class-wc-query.php
$orderby_value = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

// Get order + orderby args from string
$orderby_value = explode( '-', $orderby_value );
$orderby       = esc_attr( $orderby_value[0] );
$order         = ! empty( $orderby_value[1] ) ? $orderby_value[1] : $order;

$orderby = strtolower( $orderby );
$order   = strtoupper( $order );

// default - menu_order
$args['orderby']  = 'menu_order title';
$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
$args['meta_key'] = '';

switch ( $orderby ) {
	case 'rand' :
		$args['orderby']  = 'rand';
	break;
	case 'date' :
		$args['orderby']  = 'date';
		$args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
	break;
	case 'price' :
		$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
		$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
		$args['meta_key'] = '_price';
	break;
	case 'popularity' :
		$args['meta_key'] = 'total_sales';

		// Sorting handled later though a hook
		add_filter( 'posts_clauses', 'ts_woocommerce_order_by_popularity_post_clauses'  );
	break;
	case 'rating' :
		// Sorting handled later though a hook
		add_filter( 'posts_clauses', 'ts_woocommerce_order_by_rating_post_clauses'  );
	break;
	case 'title' :
		$args['orderby']  = 'title';
		$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
	break;
}

switch ($orderby_value) {
	case 'price' :
		$args['meta_key'] = '_price';
		$args['orderby'] = 'meta_value_num';
		break;
	case 'rand' :
		$args['orderby'] = 'rand';
		break;
	case 'sales' :
		$args['meta_key'] = 'total_sales';
		$args['orderby'] = 'meta_value_num';
		break;
	default :
		$args['orderby'] = 'date';
}
?>
<!-- Page Section -->
<section class="main-section page-section">
	<div class="container relative">
		<?php get_template_part('templates/global/page-before-content'); ?>
		
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php 
		query_posts($args);
		if ( have_posts() ) : ?>
			<!-- Shop options -->
			<div class="clearfix mb-40">
				<?php
					/**
					 * woocommerce_before_shop_loop hook
					 *
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
				?>
			</div>
			<!-- End Shop options -->
		
			<?php woocommerce_product_loop_start(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<!-- Shop Item -->
				<?php wc_get_template_part( 'content', 'product' ); ?>
				<!-- End Shop Item -->
			<?php endwhile; // end of the loop. ?>

			<?php 
			wp_reset_postdata();
			
			//get pagination here before query is reset
			ob_start();
			woocommerce_pagination();
			$pagination = ob_get_contents();
			ob_end_clean();
			
			wp_reset_query();
			woocommerce_product_loop_end(); 
			
			if (ts_get_post_opt('shop-enable-pagination') == 1):
				echo $pagination;
			endif;
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
			<?php 
			wp_reset_query();
			wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		<?php 
		get_template_part('templates/global/inner-page');
		// If comments are open or we have at least one comment, load up the comment template
		if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
			comments_template();
		endif;
		get_template_part('templates/global/page-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer( 'shop' );