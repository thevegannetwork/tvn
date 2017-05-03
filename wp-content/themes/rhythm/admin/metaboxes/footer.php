<?php
/*
 * Footer Section
*/

$sections[] = array(
	'title' => __('Footer', 'rhythm'),
	'desc' => __('Change the footer section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(
		
		array(
 			'id'=>'footer-template-local',
 			'type' => 'select',
 			'title' => __('Template', 'rhythm'),
 			'subtitle'=> __('Choose template for header.', 'rhythm'),
 			'options' => array(
				'default' => __('Default','rhythm'),
				'alternative' => __('Alternative','rhythm'),
			),
			'default' => '',
 		),
			
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer sidebar configuration', 'rhythm')
		),
			
		array(
			'id'=>'footer-widgets-enable-local',
			'type' => 'button_set',
			'title' => __('Enable footer sidebar?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'        => 'footer-sidebar-1-local',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 1', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('footer-widgets-enable-local', 'equals', '1'),
		),
		
		array(
			'id'        => 'footer-sidebar-2-local',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 2', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('footer-widgets-enable-local', 'equals', '1'),
		),
		
		array(
			'id'        => 'footer-sidebar-3-local',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 3', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('footer-widgets-enable-local', 'equals', '1'),
		),
		
		array(
			'id'        => 'footer-sidebar-4-local',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 4', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('footer-widgets-enable-local', 'equals', '1'),
		),
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer bar configuration', 'rhythm')
		),
		
		array(
			'id'=>'footer-enable-local',
			'type' => 'button_set', 
			'title' => __('Enable footer?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
 			'id'=>'footer-paddings-local',
 			'type' => 'select',
 			'title' => __('Paddings', 'rhythm'),
 			'subtitle'=> __('Select footer paddings.', 'rhythm'),
 			'options' => array(
				'pb-60' => __('Default','rhythm'),
				'pt-60 pb-60' => __('Small','rhythm'),
			),
			'default' => '',
			'validate' => '',
 		),
		
		array(
			'id'=>'footer-logo-enable-local',
			'type' => 'button_set', 
			'title' => __('Enable logo?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'footer-logo-local',
			'type' => 'media', 
			'url' => true,
			'title' => __('Footer Logo', 'rhythm'),
			'subtitle' => __('Upload the logo that will be displayed in the footer.', 'rhythm'),
		),
			
		array(
			'id'=>'footer-enable-social-icons-local',
			'type' => 'button_set',
			'title' => __('Show social icons', 'rhythm'),
			'subtitle'=> __('If on, social icons will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'        => 'footer-social-icons-category-local',
			'type'      => 'select',
			'title'     => __('Social Icons Category', 'rhythm'),
			'subtitle'  => __('Select desired category', 'rhythm'),
			'options'   => ts_get_terms_assoc('social-site-category'),
			'default' => '',
		),
		
		array(
 			'id'=>'footer-social-icons-margin-local',
 			'type' => 'select',
 			'title' => __('Social Icons Margin Bottom', 'rhythm'),
 			'subtitle'=> __('Select margin bottom.', 'rhythm'),
 			'options' => array(
				'mb-110 mb-xs-60' => __('Default (110px)','rhythm'),
				'mb-60 mb-xs-30' => __('Medium (60px)','rhythm'),
				'mb-30' => __('Small (30px)','rhythm'),
			),
			'default' => '',
			'validate' => '',
 		),

		array(
			'id' => 'footer-text-content-local',
			'type' => 'textarea',
			'title' => __('Copyright Content', 'rhythm'),
			'subtitle' => __('Place any text to be displayed. Leave empty to use default one from theme options.', 'rhythm'),
			'default' => '',
		),
		array(
			'id' => 'footer-small-text-content-local',
			'type' => 'textarea',
			'title' => __('Copyright Small Content', 'rhythm'),
			'subtitle' => __('Place any text to be displayed. Leave empty to use default one from theme options.', 'rhythm'),
			'default' => '',
		),
	), // #fields
);