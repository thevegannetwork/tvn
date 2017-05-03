<?php
/*
 * Blog Section
*/

$this->sections[] = array(
	'title' => __('Pages/Templates', 'rhythm'),
	'desc' => __('Change templates and pages templates.', 'rhythm'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		
		/**
		 * 404
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('404 page', 'rhythm')
		),
		
		array(
			'id'=>'404-background',
			'type' => 'media', 
			'url' => true,
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Upload the background that will be displayed in the 404 page.', 'rhythm'),
		),
		
		
		/**
		 * Archive
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Archive', 'rhythm')
		),
		
		array(
			'id'=>'archive-template',
			'type' => 'select',
			'title' => __('Archive Template', 'rhythm'),
			'subtitle' => __('Select the archive default template.', 'rhythm'),
			'options' => array(
				'classic' => __('Classic', 'rhythm'),
				'columns' => __('Columns', 'rhythm'),
				'masonry' => __('Masonry', 'rhythm'),
			),
			'default' => 'classic',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'archive-columns',
			'type' => 'select',
			'title' => __('Archive Columns', 'rhythm'),
			'subtitle' => __('Select desired number of columns.', 'rhythm'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'required' => array( 'archive-template', '=', array('columns','masonry')),
		),
		
		/**
		 * Blog
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Blog', 'rhythm')
		),
		
		array(
			'id'=>'blog-template',
			'type' => 'select',
			'title' => __('Blog Template', 'rhythm'),
			'subtitle' => __('Select the blog default template.', 'rhythm'),
			'options' => array(
				'classic' => __('Classic', 'rhythm'),
				'columns' => __('Columns', 'rhythm'),
				'masonry' => __('Masonry', 'rhythm'),
			),
			'default' => 'classic',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'blog-columns',
			'type' => 'select',
			'title' => __('Blog Columns', 'rhythm'),
			'subtitle' => __('Select desired number of columns.', 'rhythm'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'required' => array( 'blog-template', '=', array('columns','masonry')),
		),
		
		/**
		 * Pages
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Pages', 'rhythm')
		),
		
		array(
			'id'=>'page-comments-enable',
			'type' => 'switch', 
			'title' => __('Enable Comments in Pages?', 'rhythm'),
			'subtitle'=> __('If on, the comment form will be avaliable in all pages.', 'rhythm'),
			'default' => 0,
		),
		
		/**
		 * Portfolio
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Portfolio Single', 'rhythm')
		),
		
		array(
			'id'=>'portfolio-content-bottom',
			'type' => 'switch',
			'title' => __('Content At The Bottom', 'rhythm'),
			'subtitle'=> __('If on, shows content below all portfolio items.', 'rhythm'),
			"default" => 0,
		),
		
		array(
			'id'=>'portfolio-enable-featured-image',
			'type' => 'switch',
			'title' => __('Enable featured image section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'portfolio-enable-gallery',
			'type' => 'switch',
			'title' => __('Enable gallery section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'portfolio-enable-video',
			'type' => 'switch',
			'title' => __('Enable video section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'portfolio-gallery-type',
			'type' => 'select',
			'title' => __('Gallery Type', 'rhythm'),
			'subtitle' => __('Select the gallery template.', 'rhythm'),
			'options' => array(
				'classic' => __('Classic', 'rhythm'),
				'slider' => __('Slider', 'rhythm'),
				'fullwidth-slider' => __('Fullwidth Slider', 'rhythm'),
			),
			'default' => 'classic',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'portfolio-enable-project-details',
			'type' => 'switch',
			'title' => __('Enable project details section', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'=>'portfolio-related-projects',
			'type' => 'select',
			'title' => __('Related/Latest Projects', 'rhythm'),
			'subtitle'=> __('If activated related or latest projects will be displayed.', 'rhythm'),
			'options' => array(
				'dont_show' => __('Don\'t show', 'rhythm'),
				'related_projects' => __('Related Projects', 'rhythm'),
				'latest_projects' => __('Latest Projects', 'rhythm'),
			),
			'default' => 'dont_show',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'portfolio-enable-navigation',
			'type' => 'switch',
			'title' => __('Navigation', 'rhythm'),
			'subtitle'=> __('If on, this layout part will be displayed.', 'rhythm'),
			"default" => 1,
		),
		
		array(
			'id'        => 'portfolio-page',
			'type'      => 'select',
			'data'      => 'pages',
			'title'     => __('Portfolio Page', 'rhythm'),
			'subtitle'  => __('Page to return from single items.', 'rhythm'),
		),
		
		/**
		 * Post
		 */
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Post', 'rhythm')
		),
		
		array(
			'id'=>'post-enable-media',
			'type' => 'switch',
			'title' => __('Enable media', 'rhythm'),
			'subtitle'=> __('If on, featured image, gallery, video or audio will be displayed automatically on a single post page.', 'rhythm'),
			'default' => 1,
		),
		
		array(
			'id'=>'post-enable-meta',
			'type' => 'checkbox',
			'title' => __('Meta', 'rhythm'),
			'subtitle'=> __('Disable or enable meta options.', 'rhythm'),
			'options' => array(
				'date' => esc_html__('Date', 'rhythm'),
				'author' => esc_html__('Author', 'rhythm'),
				'categories' => esc_html__('Categories', 'rhythm'),
				'tags' => esc_html__('Tags', 'rhythm'),
				'comments' => esc_html__('Comments', 'rhythm'),
			),
			'default' => array(
				'date' => 1,
				'author' => 1,
				'categories' => 1,
				'tags' => 1,
				'comments' => 1,
			),
		),
		
		/**
		 * Search
		 */
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Search Results', 'rhythm')
		),
		
		array(
			'id'=>'search-template',
			'type' => 'select',
			'title' => __('Search Results Template', 'rhythm'),
			'subtitle' => __('Select the search results default template.', 'rhythm'),
			'options' => array(
				'classic' => __('Classic', 'rhythm'),
				'columns' => __('Columns', 'rhythm'),
				'masonry' => __('Masonry', 'rhythm'),
			),
			'default' => 'classic',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'search-columns',
			'type' => 'select',
			'title' => __('Search Results Columns', 'rhythm'),
			'subtitle' => __('Select desired number of columns.', 'rhythm'),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'required' => array( 'search-template', '=', array('columns','masonry')),
		),
		
		/**
		 * Shop
		 */
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Shop', 'rhythm')
		),
		
		array(
			'id'        => 'shop-columns',
			'type'      => 'select',
			'title'     => __('Columns', 'rhythm'),
			'subtitle'  => __('Select desired number of columns.', 'rhythm'),
			'options'   => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
			),
			'default' => '2',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'shop-single-disable-sidebar',
			'type' => 'switch',
			'title' => __('Disable single product sidebar', 'rhythm'),
			'subtitle'=> __('If on, sidebar will not be displayed on a single product page.', 'rhythm'),
			'default' => 0,
		),
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => __('Under Construction', 'rhythm')
		),
		
		array(
			'id'=>'under-construction-background',
			'type' => 'media', 
			'url' => true,
			'title' => __('Background', 'rhythm'),
			'subtitle' => __('Upload the background that will be displayed in the under construction page.', 'rhythm'),
		),
		
		array(
			'id'        => 'under-construction-header1',
			'type'      => 'text',
			'title'     => __('Header area 1', 'rhythm'),
			'subtitle'  => __('The header area 1 displayed in the header of the under construciton page.', 'rhythm'),
			'default'   => '',
		),
		
		array(
			'id'        => 'under-construction-header2',
			'type'      => 'text',
			'title'     => __('Header area 2', 'rhythm'),
			'subtitle'  => __('The header area 2 displayed in the header of the under construciton page.', 'rhythm'),
			'default'   => '',
		),
		
		array(
			'id'        => 'under-construction-title',
			'type'      => 'text',
			'title'     => __('Title', 'rhythm'),
			'subtitle'  => __('Title of the under construciton page.', 'rhythm'),
			'default'   => '',
		),
		
		array(
			'id'        => 'under-construction-subtitle',
			'type'      => 'text',
			'title'     => __('Subtitle', 'rhythm'),
			'subtitle'  => __('Subtitle of the under construciton page.', 'rhythm'),
			'default'   => '',
		),
		
		array(
			'id'        => 'under-construction-text',
			'type'      => 'textarea',
			'title'     => __('Text', 'rhythm'),
			'subtitle'  => __('Text displayed on the under construction page.', 'rhythm'),
			'default'   => '',
		),
		
	), // #fields
);