<?php
/**
 * Template Name: FAQ
 * 
 * @package Rhythm
*/
get_header();
ts_get_title_wrapper_template_part();

//paging rules
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

//posts per page
$posts_per_page = ts_get_post_opt('faq-posts-per-page');
if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

$search_class = 'col-md-8 col-md-offset-2';
$items_class = 'col-md-8 col-md-offset-2';
if (in_array(ts_get_opt('main-layout'), array('left_sidebar','right_sidebar'))) {
	$search_class = 'col-md-12';
	$items_class = 'col-md-12';
}

//query
global $wp_query;

//search results
$search_faq = '';
$found = false;
if(isset($wp_query->query_vars['search-faq'])) {
	$search_faq = $wp_query->query_vars['search-faq'];
	
	$query = $wpdb -> prepare('
		SELECT 
			ID
		FROM
			'.$wpdb -> posts.'
		WHERE
			post_type="faq" AND
			post_status="publish" AND
			(post_title LIKE "%s" OR
			post_content LIKE "%s")
	','%'.$search_faq.'%','%'.$search_faq.'%');	
	
	$found = $wpdb->get_col( $query );
}

//query
$args = array(
	'numberposts' => '',
	'posts_per_page' => $posts_per_page,
	'orderby' => 'date',
	'order' => 'DESC',
	'post_type' => 'faq',
	'paged' => $paged,
	'post_status' => 'publish'
);

if (is_array($found) && count($found) > 0) {
	$args['post__in'] = $found;
} else if (!empty($search_faq)) {
	$args['post__in'] = array(-1); //force not to find anything
}

$the_query = new WP_Query($args);
$max_num_pages = $the_query -> max_num_pages;
?>

<!-- FAQ Section -->
<section class="main-section page-section">
	<div class="container relative">
		<?php get_template_part('templates/global/page-before-content'); ?>
		
		<?php 
		$faq_text = ts_get_post_opt('faq-text');
		if (ts_get_post_opt('faq-enable-search') == 1 || !empty($faq_text)): ?>
			<div class="row mb-80 mb-xs-40">
				<div class="<?php echo sanitize_html_classes($search_class);?>">
					<div class="section-text align-center">

						<?php if (ts_get_post_opt('faq-enable-search') == 1): ?>
							<!-- Search -->
							<form class="form-inline form mb-20" method="get" role="form" action="<?php echo esc_attr(get_permalink()); ?>">
								<div class="search-wrap">
									<button class="search-button animate" type="submit" title="<?php echo esc_attr(__('Start Search', 'rhythm'));?>">
										<i class="fa fa-search"></i>
									</button>
									<input type="text" name="search-faq" class="form-control search-field" placeholder="<?php echo esc_attr(__('Search...', 'rhythm'));?>" value="<?php echo esc_attr($search_faq);?>">
								</div>
							</form>
							<!-- End Search -->
						<?php endif; ?>

						<?php echo wp_kses_data(ts_get_post_opt('faq-text')); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ($the_query -> have_posts()) : ?>
			<!-- FAQ Items -->
			<div class="row section-text">
				<div class="<?php echo sanitize_html_classes($items_class);?>">
					<?php 
					//accordion style faq
					if (ts_get_post_opt('faq-style') == 'accordion'):  ?>
						<!-- Accordion -->
						<div class="dl faq-wrapper">
							<div class="accordion">
								<?php
								$i = 0;
								while ($the_query -> have_posts()) : 
									$the_query -> the_post(); $i++; ?>
									<!-- FAQ Item -->	
									<div class="dt">
										<a href="#"><?php the_title(); ?></a>
									</div>
									<div class="dd">
										<?php the_content(); ?>
									</div>
									<!-- End FAQ Item -->
								<?php endwhile; ?>
							</div>
						</div>
						<!-- End Accordion -->
					<?php 
					 //default list style
					else: ?>
						<?php
						while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
							<!-- FAQ Item -->
							<hr class="mb-30"/>
							<h4 class="font-alt"><?php the_title(); ?></h4>
							<?php the_content(); ?>
							<!-- End FAQ Item -->
						<?php endwhile; ?>
					<?php endif; ?>
				
				</div>
			</div>
			<div class="row section-text">
				<div class="<?php echo sanitize_html_classes($items_class);?>">
				<?php
				wp_reset_postdata();
			
				if (ts_get_post_opt('faq-enable-pagination') == 1):
					rhythm_paging_nav($max_num_pages); 
				endif; ?>
				</div>
			</div>
			<!-- End FAQ Items -->
			<?php
			
			
			?>
		<?php else : //No posts were found 
			wp_reset_postdata(); ?>
			<div>
				<div class="<?php echo sanitize_html_classes($search_class);?>">
					<div class="section-text align-center">
						<?php get_template_part('templates/content/content','none'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php 
		get_template_part('templates/global/inner-page');
		// If comments are open or we have at least one comment, load up the comment template
		if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
			comments_template();
		endif;
		get_template_part('templates/global/page-after-content'); ?>
	</div>
</section>
<!-- End FAQ Section -->
<?php get_footer();