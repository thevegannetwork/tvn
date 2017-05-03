<?php
/** 
 * The template for displaying video post format content
 * 
 * @package Rhythm
 */

wp_enqueue_script( 'jquery-fitvids' );
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php
		$url = ts_get_post_opt('post-video-url');
		if (!empty($url)) {
			$embadded_video = ts_get_embaded_video($url);
		} else if (empty($url)) {
			$embadded_video = ts_get_post_opt('post-video-html');
		}
		
		if ($embadded_video != '') { ?>
			<div class="post-prev-img blog-media">
				<?php echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags()); ?>
			</div>
		<?php } else if (has_post_thumbnail()) { ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'image'); ?>
		<?php } ?>
	
	<?php get_template_part('templates/blog-masonry/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'footer'); ?>
</div>
<!-- End Post -->