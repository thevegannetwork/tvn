<?php
/**
 *
 * RS Portoflio project details
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_portfolio_project_details( $atts, $content = '') {

	ob_start();
	get_template_part('templates/portfolio/parts/project-details');
	$html = ob_get_contents();
	ob_end_clean();	
	return $html;
}

add_shortcode('rs_portfolio_project_details', 'rs_portfolio_project_details');


