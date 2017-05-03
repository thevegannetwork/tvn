<?php
/*
 * Portfolio genearal
*/

$sections[] = array(
	'icon' => 'el-icon-adjust-alt',
	'title' => __('General settings', 'rhythm'),
	'fields' => array(

		array(
			'id'=>'page-vertical-image',
			'type' => 'switch', 
			'title' => __('Vertical image on portfolio template page', 'rhythm'),
			'subtitle'=> __('If on, the featured image will be vertical on portfolio template page.', 'rhythm'),
			'default' => 0,
		),

		array(
			'id'=>'page-open-lightbox',
			'type' => 'switch', 
			'title' => __('Open lightbox on portfolio template page', 'rhythm'),
			'subtitle'=> __('If on, image will be opened in lightbox on portfolio template page.', 'rhythm'),
			'default' => 0,
		),

		array(
			'id'=>'page-show-video',
			'type' => 'switch', 
			'title' => __('Show Youtube/Vimeo video in lightbox', 'rhythm'),
			'subtitle'=> __('If on, video will be opened in lightbox on portfolio template page.', 'rhythm'),
			'default' => 0,
			'required' => array( 'page-open-lightbox', 'equals', '1' )
		),

		array(
			'id'=>'page-video-src',
			'type' => 'text', 
			'title' => __('Video URL', 'rhythm'),
			'subtitle'=> __('Please, input Youtube or Vimeo video URL', 'rhythm'),
			'required' => array( 'page-show-video', 'equals', '1' ),
			'validate'  => 'url',
		),

		array(
			'id'=>'portfolio-content-bottom-local',
			'type' => 'button_set',
			'title' => __('Content At The Bottom', 'rhythm'),
			'subtitle'=> __('If on, shows content below all portfolio items.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-enable-related-projects-local',
			'type' => 'button_set',
			'title' => __('Related projects', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-related-projects-local',
			'type' => 'select',
			'title' => __('Show Related Or Latest Projects', 'rhythm'),
			'options' => array(
				'dont_show' => __('Don\'t show', 'rhythm'),
				'related_projects' => __('Related Projects', 'rhythm'),
				'latest_projects' => __('Latest Projects', 'rhythm'),
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-enable-navigation-local',
			'type' => 'button_set',
			'title' => __('Navigation', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'        => 'portfolio-page-local',
			'type'      => 'select',
			'data'      => 'pages',
			'title'     => __('Portfolio Page', 'rhythm'),
			'subtitle'  => __('Page to return from single items.', 'rhythm'),
		),
	
	), // #fields
);