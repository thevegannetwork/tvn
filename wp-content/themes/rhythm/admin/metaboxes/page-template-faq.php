<?php
/**
 * Page Template FAQ
 */

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'faq-style',
			'type'      => 'select',
			'title'     => __('Style', 'rhythm'),
			'subtitle'  => __('Select desired style for faq template. ', 'rhythm'),
			'options'   => array(
				'list' => __('List', 'rhythm'),
				'accordion' => __('Accordion', 'rhythm'),
			),
			'default' => 'list',
			'validate' => 'not_empty',
		),
		
		array(
			'id' => 'faq-enable-search',
			'type' => 'switch', 
			'title' => __('Enable search form', 'rhythm'),
			'subtitle' => __('If on search form will be enabled.', 'rhythm'),
			'default' => 1,
		),
		
		array(
			'id'        => 'faq-posts-per-page',
			'type'      => 'text',
			'title'     => __('Posts per page', 'rhythm'),
			'subtitle'  => __('The number of items to show.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'faq-enable-pagination',
			'type' => 'switch', 
			'title' => __('Enable pagination', 'rhythm'),
			'subtitle' => __('If on pagination will be enabled.', 'rhythm'),
			'default' => 1,
		),
		
		array(
			'id'        => 'faq-text',
			'type'      => 'textarea',
			'title'     => __('Text', 'rhythm'),
			'subtitle'  => __('Text displayed below the form.', 'rhythm'),
			'default'   => '',
		),
		
	)
);