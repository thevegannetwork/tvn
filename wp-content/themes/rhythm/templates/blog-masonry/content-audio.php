<?php
/** 
 * The template for displaying default audio format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$audio = ts_get_post_opt('post-audio-url');
	if (!empty($audio)):
		echo do_shortcode('[audio src="'.esc_url($audio).'"]');
	endif;
	?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'image'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'footer'); ?>
</div>
<!-- End Post -->