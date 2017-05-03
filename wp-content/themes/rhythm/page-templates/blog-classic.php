<?php
/**
 * Template Name: Blog Classic
 * 
 * @package Rhythm
*/
get_header();
ts_get_title_wrapper_template_part();

//adhere to paging rules
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

$posts_per_page = ts_get_post_opt('blog-posts-per-page');
if (!$posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
}

$oArgs = ThemeArguments::getInstance('page-templates/blog-classic');
$oArgs -> set('main-layout', rhythm_get_layout());

global $query_string;
$args = array(
    'numberposts' => '',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_mime_type' => '',
    'post_parent' => '',
    'paged' => $paged,
    'post_status' => 'publish'
);

$categories = ts_get_post_opt('blog-category');
if (is_array($categories)) {
	$args['category__in'] =  $categories;
}

$exclude_posts = ts_get_post_opt('blog-exclude-posts');
if (!empty($exclude_posts)) {
	
	$exclude_posts_arr = explode(',',$exclude_posts);
	if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
		$args['post__not_in'] = array_map('intval',$exclude_posts_arr);
	}
}

$the_query = new WP_Query($args);
$max_num_pages = $the_query -> max_num_pages;
?>
<!-- Page Section -->
<section class="main-section page-section <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
	<div class="container relative">
		<?php get_template_part('templates/global/blog-before-content'); ?>
		<?php if ($the_query -> have_posts()) : ?>
			<?php /* Start the Loop */
			while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<?php get_template_part('templates/blog-classic/content',get_post_format()); ?>
			<?php endwhile;
			wp_reset_postdata(); 
			if (ts_get_post_opt('blog-enable-pagination') == 1):
				rhythm_paging_nav($max_num_pages); 
			endif;
			?>
		<?php else : //No posts were found ?>
			<?php get_template_part('templates/content/content','none'); ?>
		<?php endif; ?>
		<?php get_template_part('templates/global/inner-page'); ?>
		<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
			comments_template();
		endif;
		?>	
		<?php get_template_part('templates/global/blog-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer();