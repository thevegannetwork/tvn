<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Rhythm
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'rhythm' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-## -->
