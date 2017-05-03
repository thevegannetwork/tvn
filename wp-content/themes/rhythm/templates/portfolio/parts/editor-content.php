<?php
/** 
 * Content part for portfolio single
 * 
 * @package Rhythm
 */
?>
<?php the_content(); ?>
<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . __( 'Pages:', 'rhythm' ),
		'after'  => '</div>',
	) );