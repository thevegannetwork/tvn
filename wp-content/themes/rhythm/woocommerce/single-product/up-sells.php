<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$woocommerce_loop['columns'] = $columns;

if ( $upsells ) : ?>
	
	<!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->

	<!-- Up Sells Products -->
	<section class="page-section">
		<div class="container relative">

			<h2 class="section-title font-alt mb-70 mb-sm-40">
				<?php _e( 'You may also like&hellip;', 'woocommerce' ) ?>
			</h2>

			<!-- Products Grid -->
			<div class="row multi-columns-row">
				
				<?php woocommerce_product_loop_start(); ?>


					<?php foreach ( $upsells as $upsell ) : ?>
						
					<?php
					 	$post_object = get_post( $upsell->get_id() );
	
						setup_postdata( $GLOBALS['post'] =& $post_object );
	
						wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>
	
				<?php woocommerce_product_loop_end(); ?>			

			</div>
			<!-- End Products Grid -->

		</div>
	</section>
	<!-- End Up Sells Products -->

<?php endif;

wp_reset_postdata();
