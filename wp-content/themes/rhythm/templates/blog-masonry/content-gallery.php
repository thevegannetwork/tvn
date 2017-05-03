<?php
/** 
 * The template for displaying gallery post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	$gallery = ts_get_post_opt('post-gallery');
	if (is_array($gallery)): ?>
		<!-- Gallery -->
		<div class="post-prev-img">
			<ul class="clearlist content-slider">
				<?php foreach ($gallery as $item): ?>
					<li>
						<?php if (isset($item['attachment_id'])):
							echo wp_get_attachment_image( $item['attachment_id'], 'ts-thumb', array('alt' => esc_attr($item['title'])) );
						endif; ?>
					</li>
				<?php endforeach; 
				wp_enqueue_script( 'owl-carousel' );
				?>
			</ul>
		</div>
	<?php else: ?>
		<?php get_template_part('templates/blog-masonry/parts/part', 'image'); ?>
	<?php endif; ?>
	
	<?php get_template_part('templates/blog-masonry/parts/part', 'header'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'footer'); ?>
</div>
<!-- End Post -->