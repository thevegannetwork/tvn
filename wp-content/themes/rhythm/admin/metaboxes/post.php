<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'=>'post-enable-media-local',
			'type' => 'button_set',
			'title' => __('Enable media', 'rhythm'),
			'subtitle'=> __('If on, featured image, gallery, video or audio will be displayed automatically on a single post page.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
	)
);