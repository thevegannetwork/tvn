<?php
/**
 *
 * RS Portfolio Promo
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_portfolio_promo($atts, $content = '', $id = '') {

	global $wp_query, $post;

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'category_id' => '',
		'limit' => '',
		'use_external_url' => 'no',
		'animation' => '',
		'animation_delay' => '',
		'animation_duration' => '',
					), $atts));

	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

	ob_start();

	$args = array(
		'numberposts' => '',
		'posts_per_page' => $limit,
		'offset' => 0,
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
		'paged' => 1,
		'post_status' => 'publish'
	);

	if( $category_id ) {
		
		$cats_tax = array_map('intval',explode( ',', $category_id ));
	  
		if (is_array($cats_tax) && count($cats_tax) == 1) {
			$cats_tax = array_shift($cats_tax);
		}
		
		$args['tax_query'] = array(
			array(
				'taxonomy'  => 'portfolio-category',
				'field'    => 'ids',
				'terms'    => $cats_tax
			)
		);
	}

	$the_query = new WP_Query($args);

	if ($the_query -> have_posts()) : ?>

		<?php /* Start the Loop */
		$i = 0;
		while ($the_query -> have_posts()) :
			$the_query -> the_post();
			$i++;

			if ($i > 1): ?>
				<!-- Divider -->
				<hr class="mt-0 mb-140 "/>
				<!-- End Divider -->
			<?php endif; ?>
			<!-- Work Item -->
			<section class="content-section mb-140 clearfix">
				<div class="container relative">
					<div class="row">
						<?php $gallery = ts_get_post_opt('portfolio-gallery');
						$gallery_html = '';
						if (is_array($gallery)):

							$gallery_html = '<div class="work-full-media mt-0 white-shadow">';
								$gallery_html .= '<ul class="clearlist work-full-slider owl-carousel">';
								foreach ($gallery as $item):
									if (isset($item['attachment_id'])):
										$image_src = wp_get_attachment_image_src($item['attachment_id'], 'ts-full');
										if (is_array($image_src) && isset($image_src[0])):
											$gallery_html .= '<li>';
												$gallery_html .= wp_get_attachment_image( $item['attachment_id'], 'ts-full', array('alt' => esc_attr($item['title'])) );
											$gallery_html .= '</li>';;
										endif;
									endif;
								endforeach;
								$gallery_html .= '</ul>';
							$gallery_html .= '</div>';

						endif;

						$url = null;
						if ($use_external_url == 'yes'):
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

						$content_html = '<div class="text">';
						$content_html .= '<h3 class="font-alt mb-30 mb-xxs-10">'.get_the_title().'</h3>';
						$content_html .= '<p>';
						$content_html .= wp_kses_data(ts_get_post_opt('portfolio-content-1'));
						$content_html .= '</p>';
						$content_html .= '<div class="mt-40">';
						$content_html .= '<a href="'.esc_url($url).'" target="'.esc_attr($target).'" class="btn btn-mod btn-border btn-round btn-medium" target="_blank">'.__('View online', 'rhythm').'</a>';
						$content_html .= '</div>';
						$content_html .= '</div>';

						if ($i % 2 == 1): ?>
							<div class="col-md-7 mb-sm-40">
								<?php echo $gallery_html; ?>
							</div>

							<div class="col-md-5 col-lg-4 col-lg-offset-1">
								<?php echo $content_html; ?>
							</div>
						<?php else: ?>
							<div class="col-md-5 col-lg-4 mb-sm-40">
								<?php echo $content_html; ?>
							</div>
							<div class="col-md-7 col-lg-offset-1">
								<?php echo $gallery_html; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
			<!-- End Work Item -->
		<?php endwhile; ?>

		<?php
		wp_reset_postdata();

		?>
	<?php endif;

	wp_reset_postdata();

	$output = ob_get_clean();

	wp_enqueue_script( 'owl-carousel' );

	return $output;
}

add_shortcode('rs_portfolio_promo', 'rs_portfolio_promo');
