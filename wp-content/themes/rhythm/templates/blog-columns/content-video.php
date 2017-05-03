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
	
	<!-- Image -->
	<div class="post-prev-img blog-media">
		<?php
		$url = ts_get_post_opt('post-video-url');
		if (!empty($url)) {
			$embadded_video = ts_get_embaded_video($url);
		} else if (empty($url)) {
			$embadded_video = ts_get_post_opt('post-video-html');
		}
		
		if ($embadded_video != '') {
			echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags());
		} else if (has_post_thumbnail()) { ?>
			<a href="<?php echo esc_url(get_permalink());?>">
				<?php 
				if ( has_post_thumbnail() ):
					the_post_thumbnail('ts-thumb');
				endif;
				?>
			</a>
		<?php } ?>
	</div>
	
	<?php get_template_part('templates/blog-columns/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'footer'); ?>
</div>
<!-- End Post -->