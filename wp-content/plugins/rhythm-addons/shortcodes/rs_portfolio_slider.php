<?php
/**
 *
 * RS Portoflio slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_portfolio_slider( $atts, $content = '') {

	ob_start();
	get_template_part('templates/portfolio/parts/slider');
	$html = ob_get_contents();
	ob_end_clean();	
	return $html;
}

add_shortcode('rs_portfolio_slider', 'rs_portfolio_slider');


