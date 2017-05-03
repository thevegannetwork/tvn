<?php
/**
 *
 * RS Portoflio featured image
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_portfolio_featured_image( $atts, $content = '') {

	ob_start();
	get_template_part('templates/portfolio/parts/featured-image');
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}

add_shortcode('rs_portfolio_featured_image', 'rs_portfolio_featured_image');


