<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$prev_icon = 'fa-angle-left';
$next_icon = 'fa-angle-right';

if( true == is_rtl() ) {
	$prev_icon = 'fa-angle-right';
	$next_icon = 'fa-angle-left';
}

?>
<div class="pagination">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'			=> esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'		=> '?paged=%#%',
			'current'		=> max( 1, get_query_var('paged') ),
			'add_args'		=> '',
			'total'			=> $wp_query->max_num_pages,
			'prev_text' 	=> '<i class="fa '.$prev_icon.'"></i>',
			'next_text' 	=> '<i class="fa '.$next_icon.'"></i>',
			'type'			=> 'plain',
			'end_size'		=> 1,
			'mid_size'		=> 2
		) ) );
	?>
</div>
