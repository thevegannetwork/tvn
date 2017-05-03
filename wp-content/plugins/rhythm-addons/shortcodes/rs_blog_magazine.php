<?php

/**
 *
 * RS Blog Magazine
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine($atts, $content = '', $id = '') {

	global $post;

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'header' => '',
		'header_link' => '',
		'cats' => 0,
		'orderby' => 'ID',
		'length' => 19,
		'exclude_posts' => '',
		'limit' => ''
	), $atts));

	$class = ( $class ) ? ' ' . $class : '';

	$link_href = $link_title = $link_target = '';
	if ( function_exists( 'vc_parse_multi_attribute' ) ) {
		$parse_args = vc_parse_multi_attribute( $header_link );
		$link_href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
		$link_title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : '';
		$link_target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
	  }

	// Query args
	$args = array(
		'orderby' => $orderby,
		'posts_per_page' => $limit,
		//'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
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

	$row_started = false;
	$column_started = false;
	?>

	<!--Blog Magazine -->
	<div <?php echo ( $id ? ' id="' . esc_attr($id) . '"' : ''); ?> class="text-normal <?php echo sanitize_html_classes($class,true); ?>">

		<?php if (!empty($header)): ?>
			<h3 class="blog-item-title font-alt mb-10"><a href="<?php echo esc_url($link_href); ?>" target="<?php echo esc_attr($link_target);?>" title="<?php echo esc_attr($link_title); ?>"><?php echo esc_html($header); ?></a></h3>
		<?php endif; ?>
		<hr class="mt-0 mb-30" />

		<!-- Blog Posts -->
		<div class="row multi-columns-row">
			<?php
			if ($query -> have_posts()) :

				for ($i = 0; $i < 2; $i ++):
					$query -> the_post(); ?>
						<!-- Post Item -->
						<div class="col-md-6 col-lg-6 mb-30">

							<div class="post-prev-img">
								<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_post_thumbnail('ts-thumb'); ?></a>
							</div>

							<div class="post-prev-title font-alt">
								<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
							</div>

							<div class="post-prev-info font-alt">
								<?php the_author_posts_link(); ?> | <?php the_time('j F'); ?>
							</div>

							<div class="post-prev-text">
								<?php ts_the_excerpt_theme($length); ?>
							</div>

							<div class="post-prev-more">
								<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="btn btn-mod btn-gray btn-round"><?php _e('Read More', 'rhythm');?> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
						<!-- End Post Item -->
					<?php
					if (!$query -> have_posts()) :
						break;
					endif; ?>
				<?php endfor; ?>
			<?php endif; ?>
		</div>
		<!-- End Blog Posts -->

		<?php

		$small_previews_count = $query -> post_count - 2;


		if ($query -> have_posts() && $small_previews_count > 0):

			$posts_per_column = ceil($small_previews_count / 2);
			?>
			<!-- Post Small Previews -->
			<div class="row mb-70">
				<?php for ($k = 0; $k < 2; $k ++): ?>
					<div class="col-sm-6">

						<?php for ($i = 0; $i < $posts_per_column; $i++):

							if (!$query -> have_posts()) :
								break;
							endif;
							$query -> the_post();

							?>
							<div class="blog-post-prev-small clearfix">
								<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_post_thumbnail('ts-tiny', array('class' => 'widget-posts-img')); ?></a>
								<div class="widget-posts-descr">
									<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
									<div class="widget-posts-meta"><?php _e('Posted by', 'rhythm'); ?> <?php the_author_posts_link(); ?> <?php the_time('j M');?></div>
								</div>
							</div>
						<?php endfor; ?>
					</div>
				<?php endfor; ?>
			</div>
			<!-- End Post Small Previews -->
		<?php endif; ?>
	</div>
	<!-- End Blog Magazine -->

	<?php
	wp_reset_postdata();

	$output = ob_get_clean();
	return $output;
}

add_shortcode('rs_blog_magazine', 'rs_blog_magazine');
