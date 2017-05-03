<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.

// The metabox opt name should be the same as our main theme options
// name to allow it overwrite the values.
$redux_opt_name = REDUX_OPT_NAME;

function ts_redux_add_metaboxes($metaboxes) {
	
	// Variable used to store the configuration array of metaboxes
	$metaboxes = array();
	
	$metaboxes[] = ts_redux_get_portfolio_metaboxes();
	$metaboxes[] = ts_redux_get_team_metaboxes();
	$metaboxes[] = ts_redux_get_testimonial_metaboxes();
	$metaboxes[] = ts_redux_get_page_template_blog_metaboxes();
	$metaboxes[] = ts_redux_get_page_template_portfolio_metaboxes();
	$metaboxes[] = ts_redux_get_page_template_faq_metaboxes();
	$metaboxes[] = ts_redux_get_page_template_shop_metaboxes();
	$metaboxes[] = ts_redux_get_page_metaboxes();
	$metaboxes[] = ts_redux_get_page_portfolio_metaboxes();
	$metaboxes[] = ts_redux_get_social_site_metaboxes();
	$metaboxes[] = ts_redux_get_video_post_metaboxes();
	$metaboxes[] = ts_redux_get_gallery_post_metaboxes();
	$metaboxes[] = ts_redux_get_audio_post_metaboxes();
	$metaboxes[] = ts_redux_get_post_metaboxes();
	$metaboxes[] = ts_redux_get_post_adv_metaboxes();
	
	return $metaboxes;
}
add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'ts_redux_add_metaboxes');

/**
 * Get configuration array for portfolio single post
 * @return type
 */
function ts_redux_get_portfolio_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/portfolio-general.php';
	require get_template_directory() . '/admin/metaboxes/portfolio-gallery.php';
	require get_template_directory() . '/admin/metaboxes/portfolio-details.php';
	require get_template_directory() . '/admin/metaboxes/portfolio-external-url.php';
	
	return array(
		'id' => 'ts-portfolio-options',
		'title' => __('Portfolio Options', 'rhythm'),
		'post_types' => array('portfolio'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for team single post
 * @return type
 */
function ts_redux_get_team_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/team.php';
	
	return array(
		'id' => 'ts-portfolio-options',
		'title' => __('Team Member Options', 'rhythm'),
		'post_types' => array('team'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for testimonial single post
 * @return type
 */
function ts_redux_get_testimonial_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/testimonial.php';
	
	return array(
		'id' => 'ts-portfolio-options',
		'title' => __('Testimonial Options', 'rhythm'),
		'post_types' => array('testimonial'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for blog template
 * @return type
 */
function ts_redux_get_page_template_blog_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/page-template-blog.php';
	
	return array(
		'id' => 'ts-template-blog-options',
		'title' => __('Blog Options', 'rhythm'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'page_template' => array(
			'page-templates/blog-classic.php',
			'page-templates/blog-columns.php',
			'page-templates/blog-masonry.php',
		)
	);
}

/**
 * Get configuration array for portfolio template
 * @return type
 */
function ts_redux_get_page_template_portfolio_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/page-template-portfolio.php';
	
	return array(
		'id' => 'ts-template-portfolio-options',
		'title' => __('Portfolio Options', 'rhythm'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'page_template' => array(
			'page-templates/portfolio.php',
		)
	);
}

/**
 * Get configuration array for faq template
 * @return type
 */
function ts_redux_get_page_template_faq_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/page-template-faq.php';
	
	return array(
		'id' => 'ts-template-faq-options',
		'title' => __('FAQ Options', 'rhythm'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'page_template' => array(
			'page-templates/faq.php',
		)
	);
}

/**
 * Get configuration array for faq template
 * @return type
 */
function ts_redux_get_page_template_shop_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/page-template-shop.php';
	
	return array(
		'id' => 'ts-template-shop-options',
		'title' => __('Shop Options', 'rhythm'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'page_template' => array(
			'page-templates/shop.php',
		)
	);
}


/**
 * Get configuration array for page metaboxes
 * @return type
 */
function ts_redux_get_page_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();

	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/layout.php';
 	require get_template_directory() . '/admin/metaboxes/preheader.php';
 	require get_template_directory() . '/admin/metaboxes/header.php';
	require get_template_directory() . '/admin/metaboxes/title-wrapper.php';
 	require get_template_directory() . '/admin/metaboxes/content.php';
	require get_template_directory() . '/admin/metaboxes/footer.php';
	
	return array(
		'id' => 'ts-page-options',
		'title' => __('Options', 'rhythm'),
		'post_types' => array('page'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for page metaboxes
 * @return type
 */
function ts_redux_get_page_portfolio_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();

	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/layout.php';
 	require get_template_directory() . '/admin/metaboxes/preheader.php';
 	require get_template_directory() . '/admin/metaboxes/header.php';
	require get_template_directory() . '/admin/metaboxes/title-wrapper.php';
	require get_template_directory() . '/admin/metaboxes/content-portfolio.php';
 	require get_template_directory() . '/admin/metaboxes/footer.php';
// 	require get_template_directory() . '/admin/metaboxes/custom_code.php';
	
	return array(
		'id' => 'ts-page-options',
		'title' => __('Options', 'rhythm'),
		'post_types' => array('portfolio'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for social-site custom post type metaboxes
 * @return type
 */
function ts_redux_get_social_site_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/social_site.php';
	
	return array(
		'id' => 'ts-social-site-options',
		'title' => __('Post Options', 'rhythm'),
		'post_types' => array('social-site'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}

/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function ts_redux_get_video_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-video.php';
	
	return array(
		'id' => 'ts-video-post-options',
		'title' => __('Video Post Options', 'rhythm'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('video')
	);
}

/**
 * Get configuration array for gallery post metaboxes
 * @return type
 */
function ts_redux_get_gallery_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-gallery.php';
	
	return array(
		'id' => 'ts-gallery-post-options',
		'title' => __('Gallery Post Options', 'rhythm'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('gallery')
	);
}

/**
 * Get configuration array for audio post metaboxes
 * @return type
 */
function ts_redux_get_audio_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post-audio.php';
	
	return array(
		'id' => 'ts-audio-post-options',
		'title' => __('Audio Post Options', 'rhythm'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
		'post_format' => array('audio')
	);
}

/**
 * Get configuration array for post metaboxes
 * @return type
 */
function ts_redux_get_post_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();
	
	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/post.php';
	
	return array(
		'id' => 'ts-post-options',
		'title' => __('Post Options', 'rhythm'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections,
	);
}

/**
 * Get configuration array for page metaboxes
 * @return type
 */
function ts_redux_get_post_adv_metaboxes() {
	
	// Variable used to store the configuration array of sections
	$sections = array();

	// Metabox used to overwrite theme options by page
	require get_template_directory() . '/admin/metaboxes/layout.php';
 	require get_template_directory() . '/admin/metaboxes/preheader.php';
 	require get_template_directory() . '/admin/metaboxes/header.php';
	require get_template_directory() . '/admin/metaboxes/title-wrapper.php';
 	require get_template_directory() . '/admin/metaboxes/footer.php';
	
	return array(
		'id' => 'ts-post-adv-options',
		'title' => __('Options', 'rhythm'),
		'post_types' => array('post'),
		'position' => 'normal', // normal, advanced, side
		'priority' => 'high', // high, core, default, low
		'sections' => $sections
	);
}