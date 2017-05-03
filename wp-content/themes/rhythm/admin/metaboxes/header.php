<?php
/*
 * Header Section
*/

$sections[] = array(
	'title' => __('Header', 'rhythm'),
	'desc' => __('Change the header section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'header-enable-switch-local',
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
 			'id'=>'header-template-local',
 			'type' => 'select',
 			'title' => __('Template', 'rhythm'),
 			'subtitle'=> __('Choose template for header.', 'rhythm'),
 			'options' => array(
				'default' => __('Default','rhythm'),
				'alternative' => __('Alternative','rhythm'),
				'alternative-centered' => __('Alternative Centered','rhythm'),
				'modern' => __('Modern','rhythm'),
				'side' => __('Side','rhythm'),
				'presto' => __('Presto', 'rhythm'),
			),
			'default' => '',
			'validate' => '',
 		),
		
		array(
			'id' => 'header-full-width-local',
			'type' => 'button_set', 
			'title' => __('Full Width Header', 'rhythm'),
			'subtitle' => __('If on, this layout part will be full width.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'presto')),
		),
		
		array(
			'id'=>'header-primary-menu',
			'type' => 'select',
			'title' => __('Primary Menu', 'rhythm'),
			'subtitle' => __('Select a menu to overwrite the header menu location.', 'rhythm'),
			'data' => 'menus',
			'default' => '',
		),
		
 		array(
 			'id'=>'header-fixed-switch-local',
 			'type' => 'select',
 			'title' => __('Sticky or Dynamic Header', 'rhythm'),
 			'subtitle'=> __('Select if menu is sticky or dynamic.', 'rhythm'),
 			'options' => array(
				'default' => __('Default','rhythm'),
				'sticky' => __('Dynamic','rhythm'),
				'fixed' => __('Sticky','rhythm'),
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'presto')),
 		),
		
		array(
			'id'=>'header-style-local',
			'type' => 'select',
			'title' => __('Header Style', 'rhythm'),
			'subtitle' => __('Select the header style.', 'rhythm'),
			'options' => array(
				'light' => __('Light background, dark text','rhythm'),
				'dark' => __('Dark background, light text','rhythm'),
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'side','presto')),
		),

 		array(
 			'id'=>'header-bg-type-local',
 			'type' => 'select',
 			'title' => __('Header Background Type', 'rhythm'), 
 			'subtitle' => __('Select the type of background to be applied in header.', 'rhythm'),
 			'options' => array( 
 				'solid' => __('Solid', 'rhythm'),
				'transparent' => __('Transparent', 'rhythm'),
 			),
 			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'presto')),
 		),

		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Logo Module Configuration.', 'rhythm')
		),

		array(
			'id'=>'logo-local',
			'type' => 'media', 
			'url' => true,
			'title' => __('Logo', 'rhythm'),
			'subtitle' => __('Upload the logo that will be displayed in the header.', 'rhythm'),
		),

		array(
			'id'=>'logo-retina-local',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Logo Retina', 'rhythm'),
			'desc'=> __('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrues require the plugin <strong>WP Retina 2x</strong> to be activated.', 'rhythm'),
			'subtitle' => __('Optional retina version displayed in devices with retina display (high resolution display).', 'rhythm'),
		),

		array(
			'id'=>'logo-light-local',
			'type' => 'media', 
			'url' => true,
			'title' => __('Logo (light)', 'rhythm'),
			'subtitle' => __('Upload a light version of logo used in dark backgrounds', 'rhythm'),
		),

		array(
			'id'=>'logo-retina-light-local',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Logo Retina (light)', 'rhythm'),
			'desc'=> __('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrues require the plugin <strong>WP Retina 2x</strong> to be activated.', 'rhythm'),
			'subtitle' => __('Optional retina version displayed in devices with retina display (high resolution display).', 'rhythm'),
		),
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Modules Configuration.', 'rhythm')
		),
		
		array(
			'id'            => 'header-modules-spacing-local',
			'type'          => 'spacing',
			'output'        => array('.inner-nav ul.modules li:first-child'), // An array of CSS selectors to apply this font style to
			'mode'          => 'margin',    // absolute, padding, margin, defaults to padding
//			'all'           => true,        // Have one field that applies to all
			'top'           => false,     // Disable the top
			'right'         => false,     // Disable the right
			'bottom'        => false,     // Disable the bottom
			//'left'          => false,     // Disable the left
			'units'         => 'px',      // You can specify a unit value. Possible: px, em, %
//			'units_extended'=> 'true',    // Allow users to select any type of unit
			'display_units' => 'true',   // Set to false to hide the units if the units are specified
			'title'         => __('Modules Left Margin (px)', 'redux-framework-demo'),
			'subtitle'      => __('Allow your users to choose the spacing between menu and modules.', 'rhythm'),
			'default'       => array(
//				'margin-top'    => '1px', 
//				'margin-right'  => '2px', 
//				'margin-bottom' => '3px', 
				'margin-left'   => ''
			),
			'required' => array('header-template-local' ,'=', array('default', 'presto')),
		),
		
		array(
			'id'=>'header-enable-search-local',
			'type' => 'button_set', 
			'title' => __('Search', 'rhythm'),
			'subtitle'=> __('If on, a search module will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id'=>'header-enable-phone-local',
			'type' => 'button_set', 
			'title' => __('Phone', 'rhythm'),
			'subtitle'=> __('If on, a phone module will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'header-phone-number-local',
			'type' => 'text', 
			'title' => __('Phone Number', 'rhythm'),
			'subtitle'=> __('Phone number to be displayed.', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-phone-local' ,'=', '1')
		),
		
		array(
			'id'=>'header-enable-text-local',
			'type' => 'button_set', 
			'title' => __('Text', 'rhythm'),
			'subtitle'=> __('If on, a text module will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('alternative', 'alternative-centered') ),
		),
		
		array(
			'id'=>'header-text-content-local',
			'type' => 'textarea', 
			'title' => __('Text Content', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-text-local' ,'=', '1' ),
		),
		
		array(
			'id'=>'header-enable-cart-local',
			'type' => 'button_set', 
			'title' => __('Cart', 'rhythm'),
			'subtitle'=> __('If on, a cart module will be displayed. Works only when Woocommerce plugin is installed', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'alternative', 'alternative-centered', 'presto') ),
		),
		
		array(
			'id'=>'header-enable-languages-local',
			'type' => 'button_set', 
			'title' => __('Languages', 'rhythm'),
			'subtitle'=> __('If on, a cart module will be displayed. Works only when WPML plugin is installed', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'alternative', 'alternative-centered', 'presto') ),
		),
		
		array(
			'id'=>'header-enable-social-icons-local',
			'type' => 'button_set', 
			'title' => __('Social Icons', 'rhythm'),
			'subtitle'=> __('If on, a social icons module will be displayed', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'alternative', 'alternative-centered', 'modern', 'side', 'presto') ),
		),
		
		array(
			'id'        => 'header-social-icons-category-local',
			'type'      => 'select',
			'title'     => __('Social Icons Category', 'rhythm'),
			'subtitle'  => __('Select desired category', 'rhythm'),
			'options'   => ts_get_terms_assoc('social-site-category'),
			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'alternative', 'alternative-centered', 'modern', 'side', 'presto') ),
		),

		array(
			'id'=>'header-enable-button-local',
			'type' => 'button_set', 
			'title' => __('Button', 'rhythm'),
			'subtitle'=> __('If on, a button module will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'=', 'default'),
		),
		
		array(
			'id'=>'header-button-text-local',
			'type' => 'text', 
			'title' => __('Button Text', 'rhythm'),
			'subtitle'=> __('Button label to be disaplayed.', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-link-local',
			'type'      => 'text',
			'title'     => __('Button Link', 'rhythm'),
			'validate'  => 'url', 
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-icon-local',
			'type'		=> 'select',
 			'title'		=> __('Button Icon', 'rhythm'), 
 			'class'		=> 'font-icons',
 			'options'	=> array_flip(ts_get_icons_array()),
 			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-style-local',
			'type'		=> 'select',
 			'title'		=> __('Button Style', 'rhythm'), 
 			'options'	=> array( 
 				'outline'	=> __('Outline', 'rhythm'),
				'filled'	=> __('Filled', 'rhythm'),
				'filled_alt'	=> __('Filled Alt.', 'rhythm'),
				'filled_dark'	=> __('Filled Dark', 'rhythm'),
 			),
 			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-target-local',
			'type'		=> 'select',
 			'title'		=> __('Button Target', 'rhythm'), 
 			'options'	=> array( 
 				'_blank'	=> __('New window', 'rhythm'),
				'_self'		=> __('Same window', 'rhythm'),
 			),
 			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),

	), // #fields
);