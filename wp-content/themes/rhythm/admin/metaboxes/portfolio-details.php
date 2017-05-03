<?php
/*
 * Portfolio details
*/

$sections[] = array(
	'icon' => 'el-icon-align-justify',
	'title' => __('Project details', 'rhythm'),
	'fields' => array(
		array(
			'id'=>'portfolio-enable-project-details-local',
			'type' => 'button_set',
			'title' => __('Enable project details section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id'        => 'portfolio-client',
			'type'      => 'text',
			'title'     => __('Client', 'rhythm'),
			'subtitle'  => __('Your client name.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id'        => 'portfolio-url',
			'type'      => 'text',
			'title'     => __('URL', 'rhythm'),
			'subtitle'  => __('The URL to the project.', 'rhythm'),
			'default'   => '',
			'validate'  => 'url',
		),
		array(
			'id'        => 'portfolio-content-1',
			'type'      => 'textarea',
			'title'     => __('Content 1', 'rhythm'),
			'subtitle'  => __('Short text displayed in the project details section.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id'        => 'portfolio-content-2',
			'type'      => 'textarea',
			'title'     => __('Content 2', 'rhythm'),
			'subtitle'  => __('Short text displayed in the project details section.', 'rhythm'),
			'default'   => '',
		),
		
	), // #fields
);