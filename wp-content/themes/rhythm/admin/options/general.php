<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title' => __('General Settings', 'rhythm'),
	'desc' => __('Configure easily the basic theme\'s settings.', 'rhythm'),
	'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		
		array(
			'id'=>'enable-under-construction',
			'type' => 'switch', 
			'title' => __('Enable Under Construction', 'rhythm'),
			'subtitle'=> __('If on, the frontend shows under construction page only.', 'rhythm'),
			'desc' => __('Only administrator will be able to visit site. If you want to check under construction mode is enabled you have to logout.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id'=>'enable-preloader',
			'type' => 'switch', 
			'title' => __('Enable Loader Effect?', 'rhythm'),
			'subtitle'=> __('If on, a loader will appear before loading the page.', 'rhythm'),
			'default' => 0,
		),

		array(
			'id'      => 'preloader-style',
			'type'    => 'select', 
			'title'   => __('Loader style', 'rhythm'),
			'subtitle'=> __('Select style loader.', 'rhythm'),
			'options' => array(
				'default' => __( 'Default', 'rhythm' ),
				'presto' => __( 'Presto', 'rhythm' )
			),
			'required' => array( 'enable-preloader', '=', '1' )
		),
		
		array(
			'id'=>'preloader-custom-image',
			'type' => 'media', 
			'url' => true,
			'title' => __('Preloader custom image', 'rhythm'),
			'subtitle' => __('Upload the image that will be used for preloader.', 'rhythm'),
		),
		
		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => __( 'Custom Sidebars', 'rhythm' ),
			'subtitle' => __( 'Custom sidebars can be assigned to any page or post.', 'rhythm' ),
			'desc'     => __( 'You can add as many custom sidebars as you need.', 'rhythm' )
		),
		
		array(
			'id'       => 'google-api-key',
			'type'     => 'text',
			'title'    => __( 'Google map API key', 'rhythm' ),
			'subtitle' => '',
			'desc'     => __( 'Add your Google map API key here. <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">How to get API key</a>', 'rhythm' )
		),
				
		array(
			'id'       => 'link-publisher',
			'type'     => 'text',
			'title'    => __( 'Publisher', 'rhythm' ),
			'subtitle' => __( 'Purpose of the publisher is to link your website on google search to its social media brand page.', 'rhythm' ),
			'desc'     => __( 'Add our Google+ account URL here.', 'rhythm' )
		),
		array(
			'id'       =>'clear-static-files',
			'type'     => 'switch', 
			'title'    => __('Clear Static Files Query String', 'rhythm'),
			'subtitle' => __('If enabled qeury string variable "ver" will be removed from query string for JS and CSS files.', 'rhythm'),
			'default'  => 1,
		),
		array(
			'id'       => 'base-font',
			'type'     => 'select',
			'title'    => esc_html__( 'Main base font', 'rhythm' ),
			'subtitle' => esc_html__( 'Select a main base font', 'rhythm' ),
			'options'  => array(
				'default' => esc_html__( 'Default font', 'rhythm' ),
				'lato'    => esc_html__( 'Lato font', 'rhythm' )
			)
		),
		array(
 			'id'       => 'character-sets',
 			'type'     => 'checkbox',
 			'title'    => esc_html__( 'Additional Google Fonts character sets', 'rhythm' ),
 			'subtitle' => esc_html__( 'Choose the character sets you want to download from Google Fonts.', 'rhythm' ),
 			'options'  => array(
				'cyrillic'     => esc_html__( 'Cyrillic', 'rhythm' ),
				'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'rhythm' ),
				'greek'        => esc_html__( 'Greek', 'rhythm' ),
				'greek-ext'    => esc_html__( 'Greek Extended', 'rhythm' ),
				'latin-ext'    => esc_html__( 'Latin Extended', 'rhythm' ),
				'vietnamese'   => esc_html__( 'Vietnamese', 'rhythm' ),
			),
			'default' => '',
			'validate' => '',
 		),
	),
);