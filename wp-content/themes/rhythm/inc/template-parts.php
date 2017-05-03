<?php
/**
 * Template parts functions
 *
 * @package Rhythm
 */

function ts_get_header_template_part() {
	
	$template = ts_get_opt('header-template');
	
	switch ($template) {
		
		case 'alternative':
			get_template_part('templates/header/alternative');
			break;
		
		case 'alternative-centered':
			get_template_part('templates/header/alternative-centered');
			break;
		
		case 'modern':
			get_template_part('templates/header/modern');
			break;

		case 'side':
			get_template_part('templates/header/side');
			break;
			
		case 'presto':
			get_template_part('templates/header/presto');
			break;					
		
		default:
			get_template_part('templates/header/default');
	}
}

/**
 * Title wrapper template
 */
function ts_get_title_wrapper_template_part() {
	
	$template = ts_get_opt('title-wrapper-template');
	
	switch ($template) {
		
		case 'alternative':
			get_template_part('templates/title/alternative');
			break;

		case 'another-one':
			get_template_part('templates/title/another-one');
			break;
		
		case 'magazine':
			get_template_part('templates/title/magazine');
			break;
		
		case 'modern':
			get_template_part('templates/title/modern');
			break;
		
		case 'breadcrumbs':
			get_template_part('templates/title/breadcrumbs');
			break;
		
		case 'presto':
			get_template_part('templates/title/presto');
			break;		
		
		default:
			get_template_part('templates/title/default');
	}
}


/**
 * Footer template
 */
function ts_get_footer_template_part() {
	
	$template = ts_get_opt('footer-template');
	
	switch ($template) {
		
		case 'alternative':
			get_template_part('templates/footer/alternative');
			break;

		case 'presto':
			get_template_part('templates/footer/presto');
			break;		
		
		default:
			get_template_part('templates/footer/default');
	}
}