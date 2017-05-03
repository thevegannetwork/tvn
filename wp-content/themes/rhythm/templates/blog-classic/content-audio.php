<?php
/** 
 * The template for displaying default audio format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>

	<?php get_template_part('templates/blog-classic/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'meta'); ?>
	
	<!-- Media -->
	<div class="blog-media">
		<?php
		$audio = ts_get_post_opt('post-audio-url');
		if (!empty($audio)):
			echo do_shortcode('[audio src="'.esc_url($audio).'"]');
		endif;
		?>
		
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