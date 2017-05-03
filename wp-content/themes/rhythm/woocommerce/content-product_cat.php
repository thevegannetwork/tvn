<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;

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
		
	<div class="post-prev-img">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
			?>
		</a>
	</div>

	<div class="post-prev-title font-alt align-center">
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
			<?php
			echo $category->name;

			if ( $category->count > 0 )
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
			?>
		</a>
	</div>
	<?php
		/**
		 * woocommerce_after_subcategory_title hook
		 */
		do_action( 'woocommerce_after_subcategory_title', $category );
	?>
</div>
