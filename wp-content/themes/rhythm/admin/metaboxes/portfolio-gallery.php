<?php
/*
 * Portfolio images Section
*/

$sections[] = array(
	'icon' => 'el-icon-picture',
	'title' => __('Gallery', 'rhythm'),
	'fields' => array(
		
		array(
			'id'=>'portfolio-enable-featured-image-local',
			'type' => 'button_set',
			'title' => __('Enable featured image section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-enable-gallery-local',
			'type' => 'button_set',
			'title' => __('Enable project gallery section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-gallery-type-local',
			'type' => 'select',
			'title' => __('Gallery Type', 'rhythm'),
			'subtitle' => __('Select the gallery template.', 'rhythm'),
			'options' => array(
				'classic' => __('Classic', 'rhythm'),
				'slider' => __('Slider', 'rhythm'),
				'fullwidth-slider' => __('Fullwidth Slider', 'rhythm'),
				'masonry' => esc_html__( 'Masonry', 'rhythm' ),
			),
			'default' => '',
		),
		
		array(
			'id'        => 'portfolio-gallery',
			'type'      => 'slides',
			'title'     => __('Gallery', 'rhythm'),
			'subtitle'  => __('Upload images or add from media library.', 'rhythm'),
			'placeholder'   => array(
				'title' => __('Title', 'rhythm'),
			),
			'show' => array(
				'title' => true,
				'description' => false,
				'url' => false,
			),
			'required'  => array('portfolio-gallery-type-local', '!=', 'video'),
		),
		
		array(
			'id'      => 'portfolio-slider-autoplay',
			'type'    => 'select',
			'title'   => esc_html__( 'autoPlay Slider', 'rhythm' ),
			'subtitle'  => esc_html__( 'Works for porftolio sliders', 'rhythm'),
			'desc'    => esc_html__( 'Select Yes if you want to enable autoplay', 'rhythm' ),
			'options' => array(
				'no'  => esc_html__( 'No', 'rhythm' ),
				'yes' => esc_html__( 'Yes', 'rhythm' ),
			),
		),
		
		array(
			'id'       => 'portfolio-slider-time',
			'type'     => 'text',
			'title'    => esc_html__( 'Slider Pause Time', 'rhythm' ),
			'subtitle'  => esc_html__( 'Works for porftolio sliders', 'rhythm'),
			'desc'     => esc_html__( 'Input any integer for example 5000 to play every 5 seconds. If you set autoPlay:yes and this field blank,  default pause time will be 5 seconds.', 'rhythm' ),
			'default'  => '',
			'required' => array('portfolio-slider-autoplay', 'equals', 'yes'),
		),
		
		array(
			'id'      => 'portfolio-slider-speed',
			'type'    => 'text',
			'title'   => esc_html__( 'Slide Speed', 'rhythm' ),
			'subtitle'  => esc_html__( 'Works for porftolio sliders', 'rhythm'),
			'desc'    => esc_html__( 'Input any integer for slide speed in milliseconds', 'rhythm' ),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-enable-video-local',
			'type' => 'button_set',
			'title' => __('Enable project video section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'        => 'portfolio-video-url',
			'type'      => 'text',
			'title'     => __('Video URL', 'rhythm'),
			'subtitle'  => __('YouTube or Vimeo video URL', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'portfolio-video-html',
			'type' => 'textarea',
			'title' => __('Embadded video', 'rhythm'),
			'subtitle' => __('Use this option when the video does not come from YouTube or Vimeo', 'rhythm'),
			'default' => '',
		),
	), // #fields
);