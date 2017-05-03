<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 
ts_get_title_wrapper_template_part();

//set columns
global $woocommerce_loop;

$woocommerce_loop['columns'] = ts_get_opt('shop-columns');

?>
<!-- Page Section -->
<section class="main-section page-section">
	<div class="container relative">
		<?php get_template_part('templates/global/page-before-content'); ?>
		
		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>
			
			<?php if ( woocommerce_products_will_display() ): ?>
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
			<?php endif; ?>
			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories( ); ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<!-- Shop Item -->
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<!-- End Shop Item -->
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
		
		<?php get_template_part('templates/global/page-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer( 'shop' );
