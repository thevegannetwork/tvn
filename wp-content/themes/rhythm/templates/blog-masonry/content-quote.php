<?php
/** 
 * The template for displaying quote post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php get_template_part('templates/blog-masonry/parts/part', 'image'); ?>
	<blockquote class="blog-item-q"><p><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></p></blockquote>
	<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'footer'); ?>
</div>
<!-- End Post -->
