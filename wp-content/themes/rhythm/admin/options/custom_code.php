<?php
/*
 * Custom Code
*/

$this->sections[] = array(
	'title' => __('Custom CSS', 'rhythm'),
	'desc' => __('Easily add custom CSS to your website.', 'rhythm'),
	'icon' => 'el-icon-wrench',
	'fields' => array(

		array(
		    'id'       => 'css_editor',
		    'type'     => 'ace_editor',
		    'title'    => __('CSS Code', 'rhythm'),
		    'subtitle' => __('Insert your custom CSS code right here. It will be displayed globally in the website.', 'rhythm'),
		    'mode'     => 'css',
		    'theme'    => 'monokai',
		    'desc'     => '',
		    'default'  => ""
		)
	),
);