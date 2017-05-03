<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => __(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-audio-url',
			'type'      => 'text',
			'title'     => __('Audio URL', 'rhythm'),
			'subtitle'  => __('Audio file URL in format: mp3, ogg, wav.', 'rhythm'),
			'default'   => '',
		),
	)
);