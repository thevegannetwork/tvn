<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Rhythm
 */

get_header();
ts_get_title_wrapper_template_part();

?>

<!-- Page Section -->
<section class="main-section page-section <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
	<div class="container relative">
		<?php get_template_part('templates/global/page-before-content'); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'templates/content/content','page' ); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
					comments_template();
				endif;
			?>
		<?php endwhile; // end of the loop ?>
		<?php get_template_part('templates/global/page-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->
<?php get_footer();
