<?php
/**
 * The template used for displaying page content in single-portfolio.php
 *
 * @package Rhythm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="text">
		<?php if (ts_get_opt('portfolio-content-bottom') != 1): ?>
			<?php get_template_part('templates/portfolio/parts/editor-content'); ?>
		<?php endif; ?>

		<?php if (ts_get_opt('portfolio-enable-featured-image') == 1): ?>
			<?php get_template_part('templates/portfolio/parts/featured-image'); ?>
		<?php endif; ?>

		<?php if (ts_get_opt('portfolio-enable-gallery') == 1): ?>
			<?php switch (ts_get_opt('portfolio-gallery-type')):
				case 'slider':
					get_template_part('templates/portfolio/parts/slider');
					break;
				case 'fullwidth-slider':
					get_template_part('templates/portfolio/parts/fullwidth-slider');
					break;
				case 'masonry':
					get_template_part('templates/portfolio/parts/masonry');
					break;
				case 'classic':
				default:
					get_template_part('templates/portfolio/parts/gallery');

			endswitch; ?>
		<?php endif; ?>
		
		<?php if (ts_get_opt('portfolio-enable-video') == 1): ?>
			<?php get_template_part('templates/portfolio/parts/video'); ?>
		<?php endif; ?>

		<?php if (ts_get_opt('portfolio-enable-project-details') == 1): ?>
			<?php get_template_part('templates/portfolio/parts/project-details'); ?>
		<?php endif; ?>

		<?php if (ts_get_opt('portfolio-content-bottom') == 1): ?>
			<?php get_template_part('templates/portfolio/parts/editor-content'); ?>
		<?php endif; ?>
	</div>
</article><!-- #post-## -->
