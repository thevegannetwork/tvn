<?php
/*
 * Portfolio details
*/

$sections[] = array(
	'icon' => 'el-icon-link',
	'title' => __('External URL', 'rhythm'),
	'fields' => array(
		array(
			'id'        => 'portfolio-external-url',
			'type'      => 'text',
			'title'     => __('URL', 'rhythm'),
			'desc'  => __('URL used to open external page instead of portfolio single.', 'rhythm'),
			'default'   => '',
			'validate'  => 'url',
		),
	), // #fields
);