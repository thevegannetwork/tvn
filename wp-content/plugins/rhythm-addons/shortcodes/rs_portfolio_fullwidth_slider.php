<?php
/**
 *
 * RS Portoflio fullwidth slider
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_portfolio_fullwidth_slider( $atts, $content = '') {

	ob_start();
	get_template_part('templates/portfolio/parts/fullwidth-slider');
	$html = ob_get_contents();
	ob_end_clean();	
	return $html;
}

add_shortcode('rs_portfolio_fullwidth_slider', 'rs_portfolio_fullwidth_slider');


