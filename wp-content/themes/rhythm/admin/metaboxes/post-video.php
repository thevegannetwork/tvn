<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-video-url',
			'type'      => 'text',
			'title'     => __('Video URL', 'rhythm'),
			'subtitle'  => __('YouTube or Vimeo video URL', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'post-video-html',
			'type' => 'textarea',
			'title' => __('Embadded video', 'rhythm'),
			'subtitle' => __('Use this option when the video does not come from YouTube or Vimeo', 'rhythm'),
			'default' => '',
		),
	)
);