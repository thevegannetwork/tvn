<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title' => __('Header', 'rhythm'),
	'desc' => __('Change the header section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'header-enable-switch',
			'type' => 'switch', 
			'title' => __('Enable Header', 'rhythm'),
			'subtitle' => __('If on, this layout part will be displayed.', 'rhythm'),
			'default' => 1,
		),
		
		array(
 			'id'=>'header-template',
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
			'default' => 'default',
			'validate' => 'not_empty',
 		),
		
		array(
			'id' => 'header-full-width',
			'type' => 'switch', 
			'title' => __('Full Width Header', 'rhythm'),
			'subtitle' => __('If on, this layout part will be full width.', 'rhythm'),
			'default' => 1,
			'required' => array('header-template' ,'=', array('default','presto')),
		),
		
 		array(
 			'id'=>'header-fixed-switch',
 			'type' => 'select',
 			'title' => __('Sticky or Dynamic Header', 'rhythm'),
 			'subtitle'=> __('Select if menu is sticky or dynamic.', 'rhythm'),
 			'options' => array(
				'default' => __('Default','rhythm'),
				'sticky' => __('Dynamic','rhythm'),
				'fixed' => __('Sticky','rhythm'),
			),
			'default' => 'default',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'=', array('default','presto')),
 		),
		
		array(
			'id'=>'header-style',
			'type' => 'select',
			'title' => __('Header Style', 'rhythm'),
			'subtitle' => __('Select the header style.', 'rhythm'),
			'options' => array(
				'light' => __('Light background, dark text','rhythm'),
				'dark' => __('Dark background, light text','rhythm'),
			),
			'default' => 'light',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'=', array('default','side','presto')),
		),

 		array(
 			'id'=>'header-bg-type',
 			'type' => 'select',
 			'title' => __('Header Background Type', 'rhythm'), 
 			'subtitle' => __('Select the type of background to be applied in header.', 'rhythm'),
 			'options' => array( 
 				'solid' => __('Solid', 'rhythm'),
				'transparent' => __('Transparent', 'rhythm'),
 			),
 			'default' => 'solid',
 			'validate' => 'not_empty',
			'required' => array('header-template' ,'=', array('default','presto')),
 		),

		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Logo Module Configuration.', 'rhythm')
		),

		array(
			'id'=>'logo',
			'type' => 'media', 
			'url' => true,
			'title' => __('Logo', 'rhythm'),
			'subtitle' => __('Upload the logo that will be displayed in the header.', 'rhythm'),
		),

		array(
			'id'=>'logo-retina',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Logo Retina', 'rhythm'),
			'desc'=> __('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrue requires the plugin <strong>WP Retina 2x</strong> to be activated.', 'rhythm'),
			'subtitle' => __('Optional retina version displayed in devices with retina display (high resolution display).', 'rhythm'),
		),

		array(
			'id'=>'logo-light',
			'type' => 'media', 
			'url' => true,
			'title' => __('Logo (light)', 'rhythm'),
			'subtitle' => __('Upload a light version of logo used in dark backgrounds', 'rhythm'),
		),

		array(
			'id'=>'logo-retina-light',
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
			'id'            => 'header-modules-spacing',
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
			'required' => array('header-template' ,'=', array('default','presto')),
		),
		
		array(
			'id'=>'header-enable-search',
			'type' => 'switch', 
			'title' => __('Search', 'rhythm'),
			'subtitle'=> __('If on, a search module will be displayed.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id'=>'header-enable-phone',
			'type' => 'switch', 
			'title' => __('Phone', 'rhythm'),
			'subtitle'=> __('If on, a phone module will be displayed.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id'=>'header-phone-number',
			'type' => 'text', 
			'title' => __('Phone Number', 'rhythm'),
			'subtitle'=> __('Phone number to be disaplayed.', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-phone' ,'=', '1')
		),
		
		array(
			'id'=>'header-enable-text',
			'type' => 'switch', 
			'title' => __('Text', 'rhythm'),
			'subtitle'=> __('If on, a text module will be displayed.', 'rhythm'),
			'default' => 0,
			'required' => array('header-template' ,'=', array('alternative', 'alternative-centered') ),
		),
		
		array(
			'id'=>'header-text-content',
			'type' => 'textarea', 
			'title' => __('Text Content', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-text' ,'=', 1 ),
		),
		
		array(
			'id'=>'header-enable-cart',
			'type' => 'switch', 
			'title' => __('Cart', 'rhythm'),
			'subtitle'=> __('If on, a cart module will be displayed. Works only when Woocommerce plugin is installed', 'rhythm'),
			'default' => 0,
			'required' => array('header-template' ,'=', array('default', 'alternative', 'alternative-centered', 'presto') ),
		),
		
		array(
			'id'=>'header-enable-languages',
			'type' => 'switch', 
			'title' => __('Languages', 'rhythm'),
			'subtitle'=> __('If on, a cart module will be displayed. Works only when WPML plugin is installed', 'rhythm'),
			'default' => 0,
			'required' => array('header-template' ,'=', array('default', 'alternative', 'alternative-centered', 'presto') ),
		),
		
		array(
			'id'=>'header-enable-social-icons',
			'type' => 'switch', 
			'title' => __('Social Icons', 'rhythm'),
			'subtitle'=> __('If on, a social icons module will be displayed', 'rhythm'),
			'default' => 0,
			'required' => array('header-template' ,'=', array('default', 'alternative', 'alternative-centered', 'modern', 'side', 'presto') ),
		),
		
		array(
			'id'        => 'header-social-icons-category',
			'type'      => 'select',
			'title'     => __('Social Icons Category', 'rhythm'),
			'subtitle'  => __('Select desired category', 'rhythm'),
			'options'   => ts_get_terms_assoc('social-site-category'),
			'default' => '',
			'required' => array('header-template' ,'=', array('default', 'alternative', 'alternative-centered', 'modern', 'side', 'presto') ),
		),
		
		array(
			'id'=>'header-enable-button',
			'type' => 'switch', 
			'title' => __('Button', 'rhythm'),
			'subtitle'=> __('If on, a button module will be displayed.', 'rhythm'),
			'default' => 0,
			'required' => array('header-template' ,'=', 'default'),
		),
		array(
			'id'=>'header-button-text',
			'type' => 'text', 
			'title' => __('Button Text', 'rhythm'),
			'subtitle'=> __('Button label to be disaplayed.', 'rhythm'),
			'default' => '',
			'required' => array('header-enable-button' ,'=', '1')
		),
		array(
			'id'        => 'header-button-link',
			'type'      => 'text',
			'title'     => __('Button Link', 'rhythm'),
			'required' => array('header-enable-button' ,'=', '1'),
			'validate'  => 'url',
		),
		
		array(
			'id'        => 'header-button-icon',
			'type'		=> 'select',
 			'title'		=> __('Button Icon', 'rhythm'), 
			'class'		=> 'font-icons',
 			'options'	=> array_flip(ts_get_icons_array()),
 			'default' => '',
			'required' => array('header-enable-button' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-style',
			'type'		=> 'select',
 			'title'		=> __('Button Style', 'rhythm'), 
 			'options'	=> array( 
 				'outline'	=> __('Outline', 'rhythm'),
				'filled'	=> __('Filled', 'rhythm'),
				'filled_alt'	=> __('Filled Alt.', 'rhythm'),
				'filled_dark'	=> __('Filled Dark', 'rhythm'),
 			),
 			'default' => '',
			'required' => array('header-enable-button' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-target',
			'type'		=> 'select',
 			'title'		=> __('Button Target', 'rhythm'), 
 			'options'	=> array( 
 				'_blank'	=> __('Blank', 'rhythm'),
				'_self'		=> __('Self', 'rhythm'),
 			),
 			'default' => '_blank',
			'required' => array('header-enable-button' ,'=', '1')
		),
		
	), // #fields
);