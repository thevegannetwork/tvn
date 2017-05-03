<?php
/** 
 * The template for displaying status post format content
 * 
 * @package Rhythm
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-item'); ?>>

	<?php get_template_part('templates/blog-classic/parts/part', 'header-no-title'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'meta'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'content'); ?>
	<?php get_template_part('templates/blog-classic/parts/part', 'footer'); ?>
</div>
<!-- End Post -->

