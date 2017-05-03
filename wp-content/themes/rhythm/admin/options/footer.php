<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title' => __('Footer', 'rhythm'),
	'desc' => __('Change the footer section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(
		
		array(
 			'id'=>'footer-template',
 			'type' => 'select',
 			'title' => __('Template', 'rhythm'),
 			'subtitle'=> __('Choose template for header.', 'rhythm'),
 			'options' => array(
				'default' => __('Default','rhythm'),
				'alternative' => __('Alternative','rhythm'),
				'presto' => esc_html__( 'Presto', 'rhythm'),
			),
			'default' => 'default',
			'validate' => 'not_empty',
 		),
			
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer sidebar configuration', 'rhythm')
		),
			
		array(
			'id'=>'footer-widgets-enable',
			'type' => 'switch',
			'title' => __('Enable footer sidebar?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 0,
		),
		
		array(
			'id'        => 'footer-sidebar-1',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 1', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-2',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 2', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-3',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 3', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-4',
			'type'      => 'select',
			'title'     => __('Footer Sidebar 4', 'rhythm'),
			'subtitle'  => __('Select custom sidebar', 'rhythm'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Footer bar configuration', 'rhythm')
		),
		
		array(
			'id'=>'footer-enable',
			'type' => 'switch', 
			'title' => __('Enable footer?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
 			'id'=>'footer-paddings',
 			'type' => 'select',
 			'title' => __('Paddings', 'rhythm'),
 			'subtitle'=> __('Select footer paddings.', 'rhythm'),
 			'options' => array(
				'pb-60' => __('Default','rhythm'),
				'pt-60 pb-60' => __('Small','rhythm'),
			),
			'default' => 'pb-60',
			'validate' => '',
 		),

		array(
			'id'=>'footer-logo-enable',
			'type' => 'switch', 
			'title' => __('Enable logo?', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'footer-logo',
			'type' => 'media', 
			'url' => true,
			'title' => __('Footer Logo', 'rhythm'),
			'subtitle' => __('Upload the logo that will be displayed in the footer.', 'rhythm'),
		),

		array(
			'id'=>'footer-logo-retina',
			'type' => 'media', 
			'url' => true,
			'title' => __('Footer Logo Retina', 'rhythm'),
			'desc'=> __('The same footer logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrue requires the plugin <strong>WP Retina 2x</strong> to be activated.', 'rhythm'),
			'subtitle' => __('Optional retina version displayed in devices with retina display (high resolution display).', 'rhythm'),
		),
			
		array(
			'id'=>'footer-enable-social-icons',
			'type' => 'switch',
			'title' => __('Show social icons', 'rhythm'),
			'subtitle'=> __('If on, social icons will be displayed.', 'rhythm'),
			"default" => 0,
		),
		array(
			'id'        => 'footer-social-icons-category',
			'type'      => 'select',
			'title'     => __('Social Icons Category', 'rhythm'),
			'subtitle'  => __('Select desired category', 'rhythm'),
			'options'   => ts_get_terms_assoc('social-site-category'),
			'default' => '',
		),

		array(
 			'id'=>'footer-social-icons-margin',
 			'type' => 'select',
 			'title' => __('Social Icons Margin Bottom', 'rhythm'),
 			'subtitle'=> __('Select margin bottom.', 'rhythm'),
 			'options' => array(
				'mb-110 mb-xs-60' => __('Default (110px)','rhythm'),
				'mb-60 mb-xs-30' => __('Medium (60px)','rhythm'),
				'mb-30' => __('Small (30px)','rhythm'),
			),
			'default' => 'mb-110 mb-xs-60',
			'validate' => '',
 		),

		array(
			'id' => 'footer-text-content',
			'type' => 'textarea',
			'title' => __('Copyright Content', 'rhythm'),
			'subtitle' => __('Place any text to be displayed.', 'rhythm'),
			'default' => '',
		),
		array(
			'id' => 'footer-small-text-content',
			'type' => 'textarea',
			'title' => __('Copyright Small Content', 'rhythm'),
			'subtitle' => __('Place any text to be displayed.', 'rhythm'),
			'default' => '',
		),
	), // #fields
);