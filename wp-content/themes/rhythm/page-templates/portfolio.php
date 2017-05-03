<?php

/**
 * Template Name: Portfolio
 * 
 * @package Rhythm
*/


get_header();
ts_get_title_wrapper_template_part();

$allow_sidebars = true; //allow sidebars, can be disabled on some templates
$container_class = 'container'; //container class
$add_inner_page_container = false; //add container for inner page content when template is full width
$allow_vertical_images = false;
$section_class = ''; //whole section class

$grid_gut = ts_get_post_opt( 'large-gutter' ) == 1 ? 'work-grid-gut-30' : 'work-grid-gut';
$titlepos = ts_get_post_opt( 'title-middle-position' ) == 1 ? 'titles-middle' : '';

$filter_classes = 'font-alt';
if ( ts_get_post_opt( 'filter-style' ) == 'bordered' ) {
	$filter_classes = 'style-with-border';	
}

$filter_categories = ts_get_post_opt('filter-category');

switch (ts_get_post_opt('portfolio-style')) {
	
	case 'boxed_gutter_black':
		$portfolio_class = $grid_gut . ' hide-titles';
		break;
	
	case 'boxed_gutter_white':
		$portfolio_class = $grid_gut . ' hover-white hide-titles';
		break;
	
	case 'boxed_titles_black':
		$portfolio_class = $grid_gut;
		break;
	
	case 'boxed_titles_white':
		$portfolio_class = $grid_gut . ' hover-white';
		break;
	
	case 'boxed_black':
		$portfolio_class = 'hide-titles';
		break;
	
	case 'masonry_black':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = 'masonry hide-titles';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		$allow_vertical_images = ts_get_post_opt('portfolio-allow-vertical-images') == 1 ? true : false;
		break;
	
	case 'masonry_white':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = 'masonry hide-titles hover-white';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		$allow_vertical_images = ts_get_post_opt('portfolio-allow-vertical-images') == 1 ? true : false;
		break;
	
	case 'wide_black':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = 'hide-titles';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'wide_white':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = 'hide-titles hover-white';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'wide_gutter_black':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = 'work-grid-gut hide-titles';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'wide_gutter_white':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = $grid_gut . ' hide-titles hover-white';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'wide_titles_black':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = $grid_gut;
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'wide_titles_white':
		$container_class = '';
		$section_class = 'wide-section';
		$portfolio_class = $grid_gut . ' hover-white';
		$allow_sidebars = false;
		$add_inner_page_container = true;
		break;
	
	case 'boxed_white':
	default:
		$portfolio_class = 'hover-white hide-titles';
		
}

//set columns
$columns  = ts_get_post_opt('portfolio-columns');
switch ($columns) {
	case 3:
		$columns = 'work-grid-3';
		$image_size = 'ts-medium';
		break;
	
	case 4:
		$columns = 'work-grid-4';
		$image_size = 'ts-medium';
		break;
	
	case 5:
		$columns = 'work-grid-5';
		$image_size = 'ts-medium';
		break;
	
	case 2:
	default:
		$columns = 'work-grid-2';
		$image_size = 'ts-full-alt';
}

//paging rules
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

//posts per page
$posts_per_page = ts_get_post_opt('portfolio-posts-per-page');
if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

//use external url for a page if exists
$use_external_url = ts_get_post_opt('portfolio-use-external-url');
$portfolio_allow_lightbox = ts_get_post_opt('portfolio-allow-lightbox');


//query
global $query_string;
$args = array(
	'numberposts' => '',
	'posts_per_page' => $posts_per_page,
	'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
	'cat' => '',
	'orderby' => 'date',
	'order' => 'DESC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' => '',
	'post_type' => 'portfolio',
	'post_mime_type' => '',
	'post_parent' => '',
	'paged' => $paged,
	'post_status' => 'publish'
);

$categories = ts_get_post_opt('portfolio-category');
if (is_array($categories)) {
	
	$cats_tax = array_map('intval',$categories);

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio-category',
			'field'    => 'id',
			'terms'    => $cats_tax,
		),
	);
}

$exclude_posts = ts_get_post_opt('portfolio-exclude-posts');
if (!empty($exclude_posts)) {
	
	$exclude_posts_arr = explode(',',$exclude_posts);
	if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
		$args['post__not_in'] = array_map('intval',$exclude_posts_arr);
	}
}

$the_query = new WP_Query($args);
$max_num_pages = $the_query -> max_num_pages;
?>
<!-- Portfolio Section -->
<section class="main-section page-section works-section <?php echo sanitize_html_classes($section_class); ?> <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
	<div class="<?php echo sanitize_html_classes($container_class); ?> relative">
		<?php if ($allow_sidebars):
			get_template_part('templates/global/page-before-content');
		endif; ?>
		<?php 
		if (ts_get_post_opt('portfolio-enable-filter')):
			$terms = get_terms('portfolio-category', array('orderby' => 'name', 'include' => $filter_categories)); ?>
			<?php if (count($terms) > 0): ?>
				<!-- Works Filter -->
				<div class="works-filter align-center <?php echo sanitize_html_classes( $filter_classes ); ?>">
					<a href="#" class="filter active" data-filter="*"><?php _e('All works', 'rhythm'); ?></a>
					<?php foreach ($terms as $term): ?>
						<a href="#" class="filter" data-filter=".portfolio_cat-<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></a>
					<?php endforeach; ?>
				</div>
				<!-- End Works Filter -->
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($the_query -> have_posts()) : ?>
			<!-- Works Grid -->
			<ul class="works-grid <?php echo sanitize_html_classes($columns); ?> clearfix font-alt <?php echo sanitize_html_classes($portfolio_class); ?> <?php echo sanitize_html_classes( $titlepos ); ?>" id="work-grid">
				<?php /* Start the Loop */
				while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					<?php
					$terms = wp_get_post_terms(get_the_ID(), 'portfolio-category');
					$term_slugs = array();
					$term_names = array();
					if (count($terms) > 0):
						foreach ($terms as $term):
							$term_slugs[] = 'portfolio_cat-' . $term->term_id;
							$term_names[] = $term->name;
						endforeach;
					endif;
					?>
					<!-- Work Item -->
					<li class="work-item mix <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
						<?php
						$url = null;
						if ($use_external_url == 1):
							$url = ts_get_opt('portfolio-external-url');
							if (!esc_url($url)) {
								$url = null;
							} else {
								$target = '_blank';
							}
						endif;
						
						if (!$url):
							$url = get_permalink();
							$target = '_self';
						endif;
						
						if ($allow_vertical_images && ts_get_post_opt('page-vertical-image') == 1):
							$current_image_size = 'ts-vertical-alt';
						else:
							$current_image_size = $image_size;
						endif;
						
						$current_url = '';
						$current_class = 'work-ext-link';
						if ($portfolio_allow_lightbox == 1 && ts_get_post_opt('page-open-lightbox') == 1):
							
							$video_src = ts_get_post_opt( 'page-video-src' );
							if ( ts_get_post_opt( 'page-show-video' ) == 1 && ! empty( $video_src ) ) {
							
								$current_url = $video_src;
								$current_class = 'work-lightbox-link mfp-iframe';
								$target = '_self';
							
							} else {						
							
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );
								if (is_array($thumb) && isset($thumb)):
									$current_url = $thumb[0];
									$current_class = 'work-lightbox-link mfp-image';
									$target = '_self';
								endif;
							}
							
						endif;
						
						if (empty($current_url)):
							$current_url = $url;
						endif;
						
						?>
						
						<a href="<?php echo esc_url($current_url); ?>" target="<?php echo esc_attr($target); ?>" class="<?php echo sanitize_html_classes($current_class); ?>">
							<div class="work-img">
								<?php 
								if ( has_post_thumbnail() ):
									the_post_thumbnail($current_image_size);
								endif;
								?>
							</div>
							<div class="work-intro">
								<h3 class="work-title"><?php the_title(); ?></h3>
								<div class="work-descr">
									<?php echo implode(', ', $term_names);?>
								</div>
							</div>
						</a>
					</li>
					<!-- End Work Item -->
				<?php endwhile; ?>
			</ul>
			<?php
			wp_reset_postdata();
			
			if (ts_get_post_opt('portfolio-enable-pagination') == 1):
				rhythm_paging_nav($max_num_pages); 
			endif;
			
			?>
		<?php else : //No posts were found ?>
			<?php get_template_part('templates/content/content','none'); ?>
		<?php endif; ?>
		
		
		<?php 
		$oArgs = ThemeArguments::getInstance('templates/global/inner-page');
		$oArgs -> set('add_inner_page_container',$add_inner_page_container);
		get_template_part('templates/global/inner-page'); ?>
		
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
				comments_template();
			endif;
		?>			
		<?php if ($allow_sidebars):
			get_template_part('templates/global/page-after-content');
		endif; ?>
	</div>
</section>
<!-- End Portfolio Section -->
<?php 
wp_enqueue_script( 'imagesloaded-pkgd' );
wp_enqueue_script( 'masonry-pkgd' );
wp_enqueue_script( 'isotope-pkgd' );
wp_enqueue_script( 'isotope-packery' );
wp_enqueue_script( 'jquery-magnific-popup' );

get_footer();