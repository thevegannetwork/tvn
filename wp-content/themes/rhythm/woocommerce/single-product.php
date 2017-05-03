<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 
ts_get_title_wrapper_template_part(); ?>
		
<?php while ( have_posts() ) : the_post(); ?>

	<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>
	
<!-- End Page Section -->
<?php get_footer( 'shop' );
