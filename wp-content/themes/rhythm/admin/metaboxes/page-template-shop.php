<?php
/**
 * Page Template Shop
 */

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'shop-columns-local',
			'type'      => 'select',
			'title'     => __('Columns', 'rhythm'),
			'subtitle'  => __('Select desired number of columns.', 'rhythm'),
			'options'   => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'validate' => 'not_empty',
		),
		array(
			'id'        => 'shop-posts-per-page',
			'type'      => 'text',
			'title'     => __('Posts per page', 'rhythm'),
			'subtitle'  => __('The number of items to show.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'shop-enable-pagination',
			'type' => 'switch', 
			'title' => __('Enable pagination', 'rhythm'),
			'subtitle' => __('If on pagination will be enabled.', 'rhythm'),
			'default' => 1,
		),
	)
);