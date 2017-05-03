<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title' => __('Preheader', 'rhythm'),
	'desc' => __('Change the preheader section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'preheader-enable-switch',
			'type' => 'switch', 
			'title' => __('Enable Header', 'rhythm'),
			'subtitle' => __('If on, this layout part will be displayed.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id' => 'preheader-full-width',
			'type' => 'switch', 
			'title' => __('Full Width', 'rhythm'),
			'subtitle' => __('If on, this layout part will be full width.', 'rhythm'),
			'default' => 0,
		),

 		array(
 			'id'=>'preheader-style',
 			'type' => 'select',
 			'title' => __('Style', 'rhythm'),
 			'subtitle'=> __('Select preheader style.', 'rhythm'),
 			'options' => array(
				'light' => __('Light','rhythm'),
				'dark' => __('Dark','rhythm'),
			),
			'default' => 'light',
			'validate' => 'not_empty',
 		),
		
	), // #fields
);