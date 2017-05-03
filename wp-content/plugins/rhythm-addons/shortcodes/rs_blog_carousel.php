<?php

/**
 *
 * RS Blog Carousel
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_carousel($atts, $content = '', $id = '') {

	global $post;

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'cats' => 0,
		'orderby' => 'ID',
		'include_posts' => '',
		'exclude_posts' => '',
		'limit' => ''
	), $atts));
	
	wp_enqueue_script('owl-carousel');
	
	$class = ( $class ) ? ' ' . $class : '';

	// Query args
	$args = array(
		'orderby' => $orderby,
		'posts_per_page' => $limit,
		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
	);

	if ($cats) {
		
		$cats_arr = explode( ',', $cats );
		$slugs = array();
		if (is_array($cats_arr)) {
			foreach ($cats_arr as $cat_id) {
				$cat_obj = get_category($cat_id);
				if ($cat_obj -> slug) {
					$slugs[] = $cat_obj -> slug;
				}
			}
		}

		$args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $slugs
			)
		);
	}

	if (!empty($include_posts)) {

		$include_posts_arr = explode(',', $include_posts);
		if (is_array($include_posts_arr) && count($include_posts_arr) > 0) {
			$args['post__in'] = array_map('intval', $include_posts_arr);
		}
	}
	
	if (!empty($exclude_posts)) {

		$exclude_posts_arr = explode(',', $exclude_posts);
		if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
			$args['post__not_in'] = array_map('intval', $exclude_posts_arr);
		}
	}
	
	$query = new WP_Query($args);

	ob_start();
	?>

	<!-- Post Slider -->
	<div <?php echo ( $id ? ' id="' . esc_attr($id) . '"' : ''); ?> class="mb-70 mb-xs-50 text-normal <?php echo sanitize_html_classes($class); ?>">
		<div class="blog-posts-carousel">
			<?php while ($query -> have_posts()) : $query -> the_post(); ?>
				<!-- Post Item -->
				<div class="blog-posts-carousel-item align-center">
					<div class="post-prev-img">
						<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_post_thumbnail('ts-magazine'); ?></a>
					</div>
					<div class="post-prev-title font-alt">
						<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a>
					</div>
					<div class="post-prev-info font-alt">
						<?php the_author_posts_link(); ?> | <?php the_time('j F'); ?>
					</div>

				</div>
				<!-- End Post Item -->
			<?php endwhile; ?>
		</div>
		<!-- Divider -->
		<hr class="mt-0 mb-0 "/>
		<!-- End Divider -->
	</div>
	<!-- End Post Slider -->
	<?php
	wp_reset_postdata();

	$output = ob_get_clean();
	return $output;
}

add_shortcode('rs_blog_carousel', 'rs_blog_carousel');
