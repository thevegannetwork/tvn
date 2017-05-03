<?php
/*
 * Title Wrapper Section
*/

$this->sections[] = array(
	'title' => __('Title Wrapper', 'rhythm'),
	'desc' => __('Change the title wrapper section configuration.', 'rhythm'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id'=>'title-wrapper-enable',
			'type' => 'switch', 
			'title' => __('Enable Title Wrapper', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'title-wrapper-template',
			'type' => 'select',
			'title' => __('Template', 'rhythm'),
			'subtitle' => __('Choose template for the title wrapper.', 'rhythm'),
			'options' => array(
				'normal' => __('Normal', 'rhythm'),
				'alternative' => __('Alternative', 'rhythm'),
				'magazine' => __('Magazine', 'rhythm'),
				'modern' => __('Modern', 'rhythm'),
				'breadcrumbs' => __('Breadcrumbs', 'rhythm'),
				'another-one' => __('Another One', 'rhythm'),
				'presto' => __( 'Presto', 'rhythm' ),
			),
			'default'   => 'normal',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'title-wrapper-margin-top',
			'type' => 'switch', 
			'title' => __('Enable Margin Top', 'rhythm'),
			'subtitle'=> __('If on, margin top will be added.', 'rhythm'),
			"default" => 0,
			'required'  => array('title-wrapper-template', '=', 'alternative'),
		),
			
		array(
			'id'=>'title-wrapper-style',
			'type' => 'select',
			'title' => __('Style', 'rhythm'),
			'subtitle' => __('Choose style for the title wrapper.', 'rhythm'),
			'options' => array(
				'bg-gray-lighter' => __('Light gray background, dark text', 'rhythm'),
				'bg-gray' => __('Gray background, text dark', 'rhythm'),
				'bg-dark-lighter' => __('Dark gray background,  light text', 'rhythm'),
				'bg-dark' => __('Black background, white text', 'rhythm'),
				'bg-white' => __('White background, dark text', 'rhythm'),
				'bg-dark-alfa-30' => __('Dark 30%', 'rhythm'),
				'bg-dark-alfa-50' => __('Dark 50%', 'rhythm'),
				'bg-dark-alfa-70' => __('Dark 70%', 'rhythm'),
				'bg-light-alfa-30' => __('Light 30%', 'rhythm'),
				'bg-light-alfa-50' => __('Light 50%', 'rhythm'),
				'bg-light-alfa-70' => __('Light 70%', 'rhythm'),
			),
			'default'   => 'bg-gray-lighter',
			'validate' => 'not_empty',
			'required'  => array('title-wrapper-template', '!=', 'breadcrumbs'),
		),
		
		array(
			'id'=>'title-wrapper-size',
			'type' => 'select',
			'title' => __('Size', 'rhythm'),
			'subtitle' => __('Choose size for the title wrapper.', 'rhythm'),
			'options' => array(
				'default' => __('Default', 'rhythm'),
				'small' => __('Small', 'rhythm'),
				'medium' => __('Medium', 'rhythm'),
				'big' => __('Big', 'rhythm'),
			),
			'default'   => 'default',
			'validate'   => 'not_empty',
			'required'  => array('title-wrapper-template', 'equals', 'normal'),
		),
		
		array(
			'id'        => 'title-wrapper-image-local',
			'type'      => 'media',
			'url'       => true,
			'title'     => __('Title Image', 'rhythm'),
			'compiler'  => 'false',
			'subtitle'  => __('Upload any media using the WordPress native uploader', 'rhythm'),
			'required'  => array('title-wrapper-template-local', 'equals', 'magazine'),
		),
		
		array(
			'id'        => 'title-wrapper-background',
			'type'      => 'media',
			'url'       => true,
			'title'     => __('Title Background', 'rhythm'),
			'compiler'  => 'true',
			'subtitle'  => __('Upload any media using the WordPress native uploader', 'rhythm'),
			'required'  => array('title-wrapper-template', '!=', 'breadcrumbs'),
		),

		array(
			'id'        => 'title-wrapper-background-settings',
			'type'      => 'background',
			'background-image' => false,
			'preview'   => false,
			'title'     => __('Title Background Settings', 'rhythm'),
			'compiler'  => 'true',
			'required'  => array('title-wrapper-template', '!=', 'breadcrumbs'),
			'output'    => array('section.title-section') 
		),
		
		array(
			'id'=>'title-wrapper-parallax-effect',
			'type' => 'select',
			'title' => __('Parallax effect', 'rhythm'),
			'subtitle' => __('Choose parallax effect for the background image.', 'rhythm'),
			'options' => array(
				'no-effect' => __('No effect', 'rhythm'),
				'parallax-1' => '0.1',
				'parallax-2' => '0.2',
				'parallax-3' => '0.3',
				'parallax-4' => '0.4',
				'parallax-5' => '0.5',
				'parallax-6' => '0.6',
				'parallax-7' => '0.7',
				'parallax-11' => '0.05',
			),
			'default'   => 'no-effect',
			'validate' => 'not_empty',
			'required'  => array('title-wrapper-template', '!=', 'breadcrumbs'),
		),
		
		array(
			'id'=>'title-wrapper-search',
			'type' => 'switch', 
			'title' => __('Enable searchs section below title wrapper', 'rhythm'),
			'subtitle'=> __('If on, this full width search secion will be displayed', 'rhythm'),
			"default" => 0,
		),
		
	), // #fields
);