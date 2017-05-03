<?php
/**
 * Page Template Blog
 */

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'blog-columns-local',
			'type'      => 'select',
			'title'     => __('Columns', 'rhythm'),
			'subtitle'  => __('Select desired number of columns. Works for blog columns and blog masonry template only.', 'rhythm'),
			'options'   => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'validate' => 'not_empty',
		),
		array(
			'id'        => 'blog-posts-per-page',
			'type'      => 'text',
			'title'     => __('Posts per page', 'rhythm'),
			'subtitle'  => __('The number of items to show.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'blog-enable-pagination',
			'type' => 'switch', 
			'title' => __('Enable pagination', 'rhythm'),
			'subtitle' => __('If on pagination will be enabled.', 'rhythm'),
			'default' => 1,
		),
		array(
			'id'        => 'blog-category',
			'type'      => 'select',
			'title'     => __('Categories', 'rhythm'),
			'subtitle'  => __('Select desired categories', 'rhythm'),
			'options'   => ts_get_terms_assoc('category'),
			'multi'     => true,
			'default' => '',
		),
		array(
			'id'        => 'blog-exclude-posts',
			'type'      => 'text',
			'title'     => __('Excluded blog items', 'rhythm'),
			'subtitle'  => __('Post IDs you want to exclude, separated by commas eg. 120,123,1005', 'rhythm'),
			'default'   => '',
		),
	)
);