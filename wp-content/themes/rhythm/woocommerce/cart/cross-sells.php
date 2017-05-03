<?php
/**
 * Cross-sells
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

if ( $cross_sells ) : ?>

	<!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->

	<!-- Cross Sells Products -->
	<section class="page-section only-top-margin">
		<div class="container relative">

			<h2 class="section-title font-alt mb-70 mb-sm-40">
				<?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?>
			</h2>

			<!-- Products Grid -->
			<div class="row multi-columns-row">
				
				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $cross_sells as $cross_sell ) : ?>

						<?php
						 	$post_object = get_post( $cross_sell->get_id() );
		
							setup_postdata( $GLOBALS['post'] =& $post_object );
		
							wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>
			</div>
			<!-- End Products Grid -->

		</div>
	</section>
	<!-- End Cross Sells Products -->
<?php endif;

wp_reset_query();
