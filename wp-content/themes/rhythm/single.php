<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rhythm
 */

get_header();
ts_get_title_wrapper_template_part();
?>

<!-- Page Section -->
<section class="main-section page-section">
	<div class="container relative">
		<?php get_template_part('templates/global/blog-before-content'); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/content/content', 'single' ); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			<?php rhythm_post_navigation(); ?>

		<?php endwhile; // end of the loop. ?>
			
		<?php get_template_part('templates/global/blog-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer(); ?>