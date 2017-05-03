<?php
/** 
 * The template for displaying aside post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-masonry/parts/part', 'footer'); ?>
</div>
<!-- End Post -->