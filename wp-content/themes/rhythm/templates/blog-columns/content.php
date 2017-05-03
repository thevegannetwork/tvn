<?php
/** 
 * The template for displaying default post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<!-- Image -->
	<div class="post-prev-img">
		<a href="<?php echo esc_url(get_permalink());?>">
			<?php 
			if ( has_post_thumbnail() ):
				the_post_thumbnail('ts-thumb');
			endif;
			?>
		</a>
	</div>
	
	<?php get_template_part('templates/blog-columns/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-columns/parts/part', 'footer'); ?>
</div>
<!-- End Post -->