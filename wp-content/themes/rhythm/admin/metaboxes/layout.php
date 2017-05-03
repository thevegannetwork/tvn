<?php
/*
 * Layout Section
*/

$sections[] = array(
	'title' => __('Layout Settings', 'rhythm'),
	'desc' => __('Change the main theme\'s layout and configure it.', 'rhythm'),
	'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		array(
			'id'        => 'main-layout-local',
			'type'      => 'select',
			'compiler'  => true,
			'title'     => __('Main Layout', 'rhythm'),
			'subtitle'  => __('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'rhythm'),
			'options'   => array(
				'default' => __('1 Column', 'rhythm'),
				'left_sidebar' => __('2 - Column Left', 'rhythm'),
				'right_sidebar' => __('2 - Column Right', 'rhythm'),
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'sidebar-local',
			'type'      => 'select',
			'title'     => __('Sidebar', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'right_sidebar')),
		),
		
		array(
			'id'		=> 'sidebar-size-local',
			'type'		=> 'select',
			'title'		=> __('Sidebar Size', 'rhythm'),
			'subtitle'	=> __('Choose size for the title wrapper', 'rhythm'),
			'options'	=> array(
				'3columns' => __('Normal', 'rhythm'),
				'4columns' => __('Wide', 'rhythm'),
			),
			'default'   => '',
			'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id' => 'header-fixed-sidebar-local',
			'type' => 'button_set', 
			'title' => __('Fixed Sidebar', 'rhythm'),
			'subtitle' => __('If on, siebar will be fixed when scrolling.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
	),
);