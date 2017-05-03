<?php
/** 
 * The template for displaying quote post format content
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
	
	<blockquote class="blog-item-q"><p><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></p></blockquote>
	<?php get_template_part('templates/blog-columns/parts/part', 'meta'); ?>
	<!-- Text Intro -->
	<?php get_template_part('templates/blog-columns/parts/part', 'footer'); ?>
</div>
<!-- End Post -->
