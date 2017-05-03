<?php
/*
 * Favicon Section
*/

$this->sections[] = array(
	'title' => __('Favicon Settings', 'rhythm'),
	'desc' => __('Configure the favicon in a lot of plataforms. Generate and download your package at http://realfavicongenerator.net/', 'rhythm'),
	'icon' => 'el-icon-wrench',
	'fields' => array(

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => __('Generate and download your image package at http://realfavicongenerator.net/', 'rhythm')
		),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => __('Default Favicons', 'rhythm')
		),

		array(
			'title' => __('Favicon 16x16', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (16x16)', 'rhythm'),
			'id' => 'favicon-16',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 32x32', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (32x32)', 'rhythm'),
			'id' => 'favicon-32',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 96x96', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (96x96)', 'rhythm'),
			'id' => 'favicon-96',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 160x160', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (160x160)', 'rhythm'),
			'id' => 'favicon-160',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 192x192', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (192x192)', 'rhythm'),
			'id' => 'favicon-192',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => __('Apple Favicons', 'rhythm')
		),

		array(
			'title' => __('Favicon 57x57', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (57x57)', 'rhythm'),
			'id' => 'favicon-a-57',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 114x114', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (114x114)', 'rhythm'),
			'id' => 'favicon-a-114',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 72x72', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (72x72)', 'rhythm'),
			'id' => 'favicon-a-72',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 144x144', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (144x144)', 'rhythm'),
			'id' => 'favicon-a-144',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 60x60', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (60x60)', 'rhythm'),
			'id' => 'favicon-a-60',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 120x120', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (120x120)', 'rhythm'),
			'id' => 'favicon-a-120',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 76x76', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (76x76)', 'rhythm'),
			'id' => 'favicon-a-76',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 152x152', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (152x152)', 'rhythm'),
			'id' => 'favicon-a-152',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Favicon 180x180', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions (180x180)', 'rhythm'),
			'id' => 'favicon-a-180',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => __('Windows Metro', 'rhythm')
		),

		array(
		    'id'       => 'favicon-win-color',
		    'type'     => 'color',
		    'title'    => __('Custom Tile Background Color', 'rhythm'), 
		    'subtitle' => __('Pick a background color for the tile.', 'rhythm'),
		    'validate' => 'color',
		    'transparent' => false,
		    'description' => 'You can see a few recommended tile colors at "Favicon for Windows 8 - Tile" section at http://realfavicongenerator.net/',
		),

		array(
			'title' => __('Tile Image 70x70', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions. Minimum image size: 70x70. Recommended: 128x128.', 'rhythm'),
			'id' => 'favicon-win-70',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Tile Image 150x150', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions. Minimum image size: 150x150. Recommended: 270x270.', 'rhythm'),
			'id' => 'favicon-win-150',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Tile Image 310x150', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions. Minimum image size: 310x150. Recommended: 558x270.', 'rhythm'),
			'id' => 'favicon-win-310',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => __('Tile Image 310x310', 'rhythm'),
			'desc' => __('Upload favicon image in the following dimensions. Minimum image size: 310x310. Recommended: 558x558.', 'rhythm'),
			'id' => 'favicon-win-310-quad',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

	),
);