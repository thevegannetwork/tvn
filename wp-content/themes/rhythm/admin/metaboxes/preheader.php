<?php
/*
 * Header Section
*/

$sections[] = array(
	'title' => __('Preheader', 'rhythm'),
	'desc' => __('Change the preheader section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'preheader-enable-switch-local',
			'type'	 => 'button_set',
			'title' => __('Enable Header', 'rhythm'),
			'subtitle' => __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id' => 'preheader-full-width-local',
			'type'	 => 'button_set',
			'title' => __('Full Width', 'rhythm'),
			'subtitle' => __('If on, this layout part will be full width.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
 			'id'=>'preheader-style-local',
 			'type' => 'select',
 			'title' => __('Style', 'rhythm'),
 			'subtitle'=> __('Select preheader style.', 'rhythm'),
 			'options' => array(
				'light' => __('Light','rhythm'),
				'dark' => __('Dark','rhythm'),
			),
			'default' => '',
 		),
	), // #fields
);