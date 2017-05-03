<?php

/**
 *
 * RS Blog Slider
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_slider($atts, $content = '', $id = '') {

	global $post;

	extract(shortcode_atts(array(
		'id'            => '',
		'class'         => '',
		'cats'          => 0,
		'orderby'       => 'ID',
		'exclude_posts' => '',
		'limit'         => ''
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
	<div <?php echo ( $id ? ' id="' . esc_attr($id) . '"' : ''); ?> class="blog-media mb-70 mb-xs-50 <?php echo sanitize_html_classes($class); ?>">
		<ul class="clearlist blog-posts-carousel-alt">
			<?php while ($query -> have_posts()) : $query -> the_post(); ?>
				<li>

					<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('ts-full'); ?></a>

					<!-- Slide Info -->
					<div class="blog-slide-info">

						<h2 class="blog-slide-title font-alt mt-0"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>

						<div class="blog-slide-data">
							<a href="#"><i class="fa fa-clock-o"></i> <?php the_time('j M Y'); ?></a>
							<span class="separator">&nbsp;</span>
							<a href="<?php echo get_comments_link(); ?>"><i class="fa fa-comments"></i> <?php echo get_comments_number(); ?></a>
							<span class="separator">&nbsp;</span>
							<?php _e('in', 'rhythm'); ?> <?php echo get_the_category_list( ', ' ); ?>
						</div>
					</div>
					<!-- End Slide Info -->

				</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<!-- End Post Slider -->

	<?php
	wp_reset_postdata();

	$output = ob_get_clean();
	return $output;
}

add_shortcode('rs_blog_slider', 'rs_blog_slider');
