<?php
/** 
 * The template for displaying gallery post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>

	<?php get_template_part('templates/blog-classic/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'meta'); ?>
	
	<!-- Gallery -->
	<div class="blog-media">
		<?php 
		$gallery = ts_get_post_opt('post-gallery');
		
		if (is_array($gallery)): ?>
			<ul class="clearlist content-slider">
				<?php foreach ($gallery as $item): ?>
					<li>
						<?php if (isset($item['attachment_id'])):
							echo wp_get_attachment_image( $item['attachment_id'], 'ts-full', array('alt' => esc_attr($item['title'])) );
						endif; ?>
					</li>
				<?php endforeach; 
				wp_enqueue_script( 'owl-carousel' );
				?>
			</ul>
		<?php else: ?>
			<a href="<?php echo esc_url(get_permalink());?>">
				<?php 
				if ( has_post_thumbnail() ):
					the_post_thumbnail('ts-full');
				endif; ?>
			</a>
		<?php endif; ?>
	</div>
	
	<?php get_template_part('templates/blog-classic/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'footer'); ?>
</div>
<!-- End Post -->