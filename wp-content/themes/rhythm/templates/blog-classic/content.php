<?php
/** 
 * The template for displaying default post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>

	<?php get_template_part('templates/blog-classic/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'meta'); ?>
	
	<!-- Image -->
	<div class="blog-media">
		<a href="<?php echo esc_url(get_permalink());?>">
			<?php 
			if ( has_post_thumbnail() ):
				the_post_thumbnail('ts-full');
			endif;
			?>
		</a>
	</div>
	
	<?php get_template_part('templates/blog-classic/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'footer'); ?>
</div>
<!-- End Post -->