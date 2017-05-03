<?php
/**
 * Page Template Portfolio
 */

$sections[] = array(
	//'title' => esc_html__(' Settings', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'portfolio-style',
			'type'      => 'select',
			'title'     => esc_html__('Style', 'rhythm'),
			'subtitle'  => esc_html__('Select desired style for portfolio template. ', 'rhythm'),
			'options'   => array(
				'boxed_black'        => esc_html__('Boxed black', 'rhythm'),
				'boxed_white'        => esc_html__('Boxed white', 'rhythm'),
				'boxed_gutter_black' => esc_html__('Boxed gutter black', 'rhythm'),
				'boxed_gutter_white' => esc_html__('Boxed gutter white', 'rhythm'),
				'boxed_titles_black' => esc_html__('Boxed titles black', 'rhythm'),
				'boxed_titles_white' => esc_html__('Boxed titles white', 'rhythm'),
				'masonry_black'      => esc_html__('Masonry black', 'rhythm'),
				'masonry_white'      => esc_html__('Masonry white', 'rhythm'),
				'wide_black'         => esc_html__('Wide black', 'rhythm'),
				'wide_white'         => esc_html__('Wide white', 'rhythm'),
				'wide_gutter_black'  => esc_html__('Wide gutter black', 'rhythm'),
				'wide_gutter_white'  => esc_html__('Wide gutter white', 'rhythm'),
				'wide_titles_black'  => esc_html__('Wide titles black', 'rhythm'),
				'wide_titles_white'  => esc_html__('Wide titles white', 'rhythm'),
			),
			'default'  => 'boxed_black',
			'validate' => 'not_empty',
		),
		array(
			'id'       => 'title-middle-position',
			'type'     => 'switch', 
			'title'    => esc_html__('Show Titles on middle', 'rhythm'),
			'default'  => 0,
			'required' => array('portfolio-style', '!=', array('boxed_titles_black', 'boxed_titles_white', 'wide_titles_black', 'wide_titles_white'))
		),
		array(
			'id'       => 'large-gutter',
			'type'     => 'switch', 
			'title'    => esc_html__('Large Gutter?', 'rhythm'),
			'default'  => 0,
		),
		array(
			'id'       => 'portfolio-allow-vertical-images',
			'type'     => 'switch', 
			'title'    => esc_html__('Allow vertical images', 'rhythm'),
			'default'  => 0,
			'required' => array('portfolio-style', '=', array('masonry_black', 'masonry_white'))
		),
		array(
			'id'        => 'portfolio-columns',
			'type'      => 'select',
			'title'     => esc_html__('Columns', 'rhythm'),
			'subtitle'  => esc_html__('Select desired number of columns', 'rhythm'),
			'options'   => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'default'  => '2',
			'validate' => 'not_empty',
		),
		array(
			'id'        => 'portfolio-posts-per-page',
			'type'      => 'text',
			'title'     => esc_html__('Posts per page', 'rhythm'),
			'subtitle'  => esc_html__('The number of items to show.', 'rhythm'),
			'default'   => '',
		),
		array(
			'id' => 'portfolio-enable-pagination',
			'type' => 'switch', 
			'title' => esc_html__('Enable pagination', 'rhythm'),
			'subtitle' => esc_html__('If on pagination will be enabled.', 'rhythm'),
			'default' => 1,
		),
		
		array(
			'id' => 'portfolio-enable-filter',
			'type' => 'switch', 
			'title' => esc_html__('Enable filter', 'rhythm'),
			'subtitle' => esc_html__('If on filters will be enabled.', 'rhythm'),
			'default' => 1,
		),

		array(
			'id'        => 'filter-category',
			'type'      => 'select',
			'title'     => esc_html__('Filter Categories', 'rhythm'),
			'subtitle'  => esc_html__('Select filter categories', 'rhythm'),
			'options'   => ts_get_terms_assoc('portfolio-category'),
			'multi'     => true,
			'default' => '',
		),		

		array(
			'id'      => 'filter-style',
			'type'    => 'select',
			'title'   => esc_html__( 'Filter Style', 'rhythm' ),
			'options' => array(
				'default'  => 'Default',
				'bordered' => 'Bordered'
			),
			'required' => array('portfolio-enable-filter' ,'=', '1'),
		),
		
		array(
			'id' => 'portfolio-use-external-url',
			'type' => 'switch', 
			'title' => esc_html__('Use external URL if exists', 'rhythm'),
			'subtitle' => esc_html__('If on external URL is used instead of single post.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id' => 'portfolio-allow-lightbox',
			'type' => 'switch', 
			'title' => esc_html__('Allow lightbox', 'rhythm'),
			'subtitle' => esc_html__('Lightbox will be used if portfolio item lightbox effect is enabled. Lightbox effect must be enabled on portfolio item edit form.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id'        => 'portfolio-category',
			'type'      => 'select',
			'title'     => esc_html__('Categories', 'rhythm'),
			'subtitle'  => esc_html__('Select desired categories', 'rhythm'),
			'options'   => ts_get_terms_assoc('portfolio-category'),
			'multi'     => true,
			'default' => '',
		),
		
		array(
			'id'        => 'portfolio-exclude-posts',
			'type'      => 'text',
			'title'     => esc_html__('Excluded portfolio items', 'rhythm'),
			'subtitle'  => esc_html__('Post IDs you want to exclude, separated by commas eg. 120,123,1005', 'rhythm'),
			'default'   => '',
		),
	)
);