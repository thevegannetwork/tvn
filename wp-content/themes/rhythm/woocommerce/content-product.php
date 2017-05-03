<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

switch ($woocommerce_loop['columns']) {
	case 2:
		$column_class = 'col-md-6 col-lg-6';
		break;
	
	case 3:
		$column_class = 'col-md-4 col-lg-4';
		break;
	
	case 4:
	default:
		$column_class = 'col-md-3 col-lg-3';
		break;
}
?>
<div class="<?php echo sanitize_html_classes($column_class); ?> mb-60 mb-xs-40">


	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<div class="post-prev-img">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
		<?php woocommerce_show_product_loop_sale_flash(); ?>
	</div>

	<div class="post-prev-title font-alt align-center">
		<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
	</div>

	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>

	<div class="post-prev-more align-center">
		<?php
			/**
			 * woocommerce_after_shop_loop_item hook
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' ); 
		?>
	</div>
	
</div>