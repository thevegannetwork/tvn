<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-gallery',
			'type'      => 'slides',
			'title'     => __('Gallery Slider', 'rhythm'),
			'subtitle'  => __('Upload images or add from media library.', 'rhythm'),
			'placeholder'   => array(
				'title'         => __('Title', 'rhythm'),
			),
			'show' => array(
				'title' => true,
				'description' => false,
				'url' => false,
			)
		),
	)
);