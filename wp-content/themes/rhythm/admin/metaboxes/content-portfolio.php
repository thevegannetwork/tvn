<?php
/*
 * General Section
*/

$sections[] = array(
	'title' => __('Content', 'rhythm'),
	'desc' => __('Change the content section configuration.', 'rhythm'),
	'icon' => 'el-icon-lines',
	'fields' => array(
		array(
			'id'        => 'page-margin-local',
			'type'      => 'select',
			'title'     => __('Content Margin', 'rhythm'),
			'subtitle'  => __('Select desired margin for the content', 'rhythm'),
			'options'   => array(
				'default-margin' => __('Default', 'default'),
				'no-margin' => __('No margin', 'default'),
				'only-top-margin' => __('Only top margin', 'default'),
				'only-bottom-margin' => __('Only bottom margin', 'default'),
			),
			'default' => 'default-margin',
		),
	),
);