<?php
/** 
 * Related part for portfolio single
 * 
 * @package Rhythm
 */

$related_projects = ts_get_opt('portfolio-related-projects');

if (in_array($related_projects, array('related_projects', 'latest_projects'))):
	
	$args = array(
		'posts_per_page'  => 4,
		'offset'          => 0,
		'meta_query'	  => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
		'cat'        	  =>  '',
		'orderby'         => 'date',
		'order'           => 'DESC',
		'include'         => '',
		'exclude'         => get_the_ID(),
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'portfolio',
		'post_mime_type'  => '',
		'post_parent'     => '',
		'paged'				=> 1,
		'post_status'     => 'publish',
		'post__not_in'         => array(get_the_ID()),
	);
	$show_related = false;
	if ($related_projects == 'related_projects'):
		$parent_categories = wp_get_object_terms( get_the_ID(), 'portfolio-category', array('fields' => 'ids') );

		if (is_array($parent_categories) && count($parent_categories) > 0):
			$args['tax_query'][] = array (
				'taxonomy' => 'portfolio-category',
				'field' => 'term_id',
				'terms' => $parent_categories);
		
			$show_related = true;
		endif;
		
		$header = __('Related Projects', 'rhythm');
		
	else:
		$header = __('Latest Projects', 'rhythm');
		$show_related = true;
	endif;
	
	if ($show_related):
		$the_query = new WP_Query($args); ?>
	
		<?php if ($the_query -> have_posts()) : ?>

			<!-- Divider -->
			<hr class="mt-0 mb-0 "/>
			<!-- End Divider -->

			<!-- Related Projects -->
			<section class="page-section">
				<div class="container relative">

					<h2 class="section-title font-alt mb-70 mb-sm-40">
						<?php echo esc_html($header); ?>
					</h2>

					<!-- Works Grid -->
					<ul class="works-grid work-grid-gut clearfix font-alt hover-white" id="work-grid">
						<?php /* Start the Loop */
						while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
							<!-- Work Item -->
							<li class="work-item">
								<a href="<?php echo esc_url(get_permalink()); ?>" class="work-ext-link">
									<div class="work-img">
										<?php the_post_thumbnail('ts-thumb'); ?>
									</div>
									<div class="work-intro">
										<h3 class="work-title"><?php the_title(); ?></h3>
										<div class="work-descr">
											<?php $categories = wp_get_object_terms(get_the_ID(), 'portfolio-category', array('fields' => 'names')); 
											if (is_array($categories)):
												echo implode(', ',$categories);
											endif;

											?>
										</div>
									</div>
								</a>
							</li>
							<!-- End Work Item -->
						<?php endwhile; 
						wp_reset_postdata(); ?>
					</ul>
					<!-- End Works Grid -->
				</div>
			</section>
			<!-- End Related Projects -->

			<?php 
		endif; //if ($the_query -> have_posts())
	endif; //if ($show_related)
endif;