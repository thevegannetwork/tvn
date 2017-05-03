<?php

/**
 *
 * RS Blog Magazine Alternative
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine_alt($atts, $content = '', $id = '') {

	global $post;

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'header' => '',
		'header_link' => '',
		'cats' => 0,
		'orderby' => 'ID',
		'length' => 20,
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
//		'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
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
	<div <?php echo ( $id ? ' id="' . esc_attr($id) . '"' : ''); ?> class="text-normal <?php echo sanitize_html_classes($class); ?>">

		<?php if (!empty($header)): ?>
			<h3 class="blog-item-title font-alt mb-10"><a href="<?php echo esc_url($link_href); ?>" target="<?php echo esc_attr($link_target);?>" title="<?php echo esc_attr($link_title); ?>"><?php echo esc_html($header); ?></a></h3>
		<?php endif; ?>
		<hr class="mt-0 mb-30" />

		<!-- Blog Posts -->
		<div class="row">
			<?php
			if ($query -> have_posts()) :

				$query -> the_post(); ?>

				<div class="col-md-6">

					<div class="blog-media">
						<?php 
						$add_thumb = true;
						
						switch (get_post_format()):
							case 'gallery': ?>
								<?php 
								$gallery = ts_get_post_opt('post-gallery');
								if (is_array($gallery)): 
									$add_thumb = false;
									?>
									<ul class="clearlist content-slider">
										<?php foreach ($gallery as $item): ?>
											<li>
												<?php if (isset($item['attachment_id'])):
													echo wp_get_attachment_image( $item['attachment_id'], 'ts-thumb', array('alt' => esc_attr($item['title'])) );
												endif; ?>
											</li>
										<?php endforeach; 
										wp_enqueue_script( 'owl-carousel' );
										?>
									</ul>
								<?php endif; ?>
								<?php break;

							case 'video': 
								wp_enqueue_script( 'jquery-fitvids' );
								$url = ts_get_post_opt('post-video-url');
								if (!empty($url)):
									$embadded_video = ts_get_embaded_video($url);
								elseif (empty($url)):
									$embadded_video = ts_get_post_opt('post-video-html');
								endif;

								if ($embadded_video != ''):
									$add_thumb = false;
									echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags());
								endif;
								?>
								<?php break;
						endswitch;

						if ($add_thumb === true):
							the_post_thumbnail('ts-thumb');
						endif;
						?>
					</div>


				</div>

				<div class="col-md-6 mb-30">

					<!-- Post Title -->
					<h2 class="post-prev-title font-alt mt-0"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>

					<!-- Author, Categories, Comments -->
					<div class="blog-item-data mb-20">
						<i class="fa fa-clock-o"></i> <?php the_time(get_option('date_format')); ?>
						<span class="separator">&nbsp;</span>
						<a href="<?php echo esc_url(get_comments_link()); ?>"><i class="fa fa-comments"></i> <?php comments_number(__('No Comments','rhythm'),__('1 Comment','rhythm'),__('% Comments','rhythm'))?></a>
					</div>

					<!-- Text Intro -->
					<div class="post-prev-text">
						<?php ts_the_excerpt_theme($length); ?>
					</div>

					<!-- Read More Link -->
					<div class="blog-item-foot">
						<a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-mod btn-round  btn-small"><?php _e('Read More', 'rhythm'); ?> <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
				<?php 
				wp_reset_postdata();
			endif; ?>
		</div>
		<!-- End Blog Posts -->

		<?php

		$small_previews_count = $query -> post_count - 1;


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

add_shortcode('rs_blog_magazine_alt', 'rs_blog_magazine_alt');
