<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;

$woocommerce_loop['columns'] = 4;

if ( $related_products ) : ?>
	
	<!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->

	<!-- Related Products -->
	<section class="page-section">
		<div class="container relative">

			<h2 class="section-title font-alt mb-70 mb-sm-40">
				<?php _e( 'Related Products', 'woocommerce' ); ?>
			</h2>

			<!-- Products Grid -->
			<div class="row multi-columns-row">
				
				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $related_products as $related_product ) : ?>
						
					<?php
					 	$post_object = get_post( $related_product->get_id() );
	
						setup_postdata( $GLOBALS['post'] =& $post_object );
	
						wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>
			</div>
			<!-- End Products Grid -->

		</div>
	</section>
	<!-- End Related Products -->
<?php endif;

wp_reset_postdata();
