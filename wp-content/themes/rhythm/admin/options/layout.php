<?php
/*
 * Layout Section
*/

$this->sections[] = array(
	'title' => __('Layout Settings', 'rhythm'),
	'desc' => __('Change the main theme\'s layout and configure it.', 'rhythm'),
	'icon' => 'el-icon-th-large',
	'fields' => array(
		
		array(
			'id'        => 'width-layout',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Layout width', 'rhythm' ),
			'subtitle'  => esc_html__( 'Controls the site layout width', 'rhythm' ),
			'options'   => array(
				'standart' => esc_html__( 'Default - 1170px', 'rhythm' ),
				'wide'     => esc_html__( 'Wide - 1400px', 'rhythm' ),
			),
			'default'   => 'standart'
		),
		
		array(
			'id'        => 'main-layout',
			'type'      => 'image_select',
			'compiler'  => true,
			'title'     => __('Main Layout', 'rhythm'),
			'subtitle'  => __('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'rhythm'),
			'options'   => array(
				'default' => array('alt' => __('1 Column', 'rhythm'),       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				'left_sidebar' => array('alt' => __('2 Column Left', 'rhythm'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
				'right_sidebar' => array('alt' => __('2 Column Right', 'rhythm'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
			),
			'default'   => 'default',
			'validate' => 'not_empty',
		),
		
		array(
			'id'        => 'sidebar',
			'type'      => 'select',
			'title'     => __('Sidebar', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id'        => 'sidebar-size',
			'type' => 'select',
			'title' => __('Sidebar Size', 'rhythm'),
			'subtitle' => __('Choose size for the title wrapper', 'rhythm'),
			'options' => array(
				'3columns' => __('Normal', 'rhythm'),
				'4columns' => __('Wide', 'rhythm'),
			),
			'default'   => '',
			'required'  => array('main-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id' => 'header-fixed-sidebar',
			'type' => 'switch', 
			'title' => __('Fixed Sidebar', 'rhythm'),
			'subtitle' => __('If on, siebar will be fixed when scrolling.', 'rhythm'),
			'default' => 0,
			'required'  => array('main-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		/**
		 * Single post sidebar settings
		 */
		
		array(
			'id' => 'info-single-post-layout',
			'type' => 'info',
			'title' => '<h2>'.__('Single post default layout settings', 'rhythm').'</h2>',
			'desc' => __('Overrides Main Layout settings', 'rhythm')
		),
		
		array(
			'id'        => 'single-post-layout',
			'type'      => 'select',
			'compiler'  => true,
			'title'     => __('Single Post Layout', 'rhythm'),
			'subtitle'  => __('Select sidebar alignment for single post. Choose between 1 or 2 column layout.', 'rhythm'),
			'options'   => array(
				'default' => __('1 Column', 'rhythm'),
				'left_sidebar' => __('2 - Column Left', 'rhythm'),
				'right_sidebar' => __('2 - Column Right', 'rhythm'),
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'single-post-sidebar',
			'type'      => 'select',
			'title'     => __('Sidebar', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('single-post-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id'        => 'single-post-sidebar-size',
			'type' => 'select',
			'title' => __('Sidebar Size', 'rhythm'),
			'subtitle' => __('Choose size for the title wrapper', 'rhythm'),
			'options' => array(
				'3columns' => __('Normal', 'rhythm'),
				'4columns' => __('Wide', 'rhythm'),
			),
			'default'   => '',
			'required'  => array('single-post-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id' => 'single-post-header-fixed-sidebar',
			'type' => 'button_set', 
			'title' => __('Fixed Sidebar', 'rhythm'),
			'subtitle' => __('If on, siebar will be fixed when scrolling.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required'  => array('single-post-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		/**
		 * Single post sidebar settings
		 */
		
		array(
			'id' => 'info-builtin-pages-layout',
			'type' => 'info',
			'title' => '<h2>'.__('Builtin pages layout settings', 'rhythm').'</h2>',
			'desc' => __('Overrides Main Layout settings', 'rhythm')
		),
		
		array(
			'id'        => 'builtin-pages-layout',
			'type'      => 'select',
			'compiler'  => true,
			'title'     => __('Builtin Pages Layout', 'rhythm'),
			'subtitle'  => __('Select sidebar alignment for pages like archive, search etc. Choose between 1 or 2 column layout.', 'rhythm'),
			'options'   => array(
				'default' => __('1 Column', 'rhythm'),
				'left_sidebar' => __('2 - Column Left', 'rhythm'),
				'right_sidebar' => __('2 - Column Right', 'rhythm'),
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'builtin-pages-sidebar',
			'type'      => 'select',
			'title'     => __('Sidebar', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('builtin-pages-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id'        => 'builtin-pages-sidebar-size',
			'type' => 'select',
			'title' => __('Sidebar Size', 'rhythm'),
			'subtitle' => __('Choose size for the title wrapper', 'rhythm'),
			'options' => array(
				'3columns' => __('Normal', 'rhythm'),
				'4columns' => __('Wide', 'rhythm'),
			),
			'default'   => '',
			'required'  => array('builtin-pages-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
		
		array(
			'id' => 'builtin-pages-header-fixed-sidebar',
			'type' => 'button_set', 
			'title' => __('Fixed Sidebar', 'rhythm'),
			'subtitle' => __('If on, siebar will be fixed when scrolling.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required'  => array('builtin-pages-layout', 'equals', array('left_sidebar', 'right_sidebar') ),
		),
	),
);