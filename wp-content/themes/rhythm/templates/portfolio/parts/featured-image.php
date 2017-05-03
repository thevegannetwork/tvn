<?php
/** 
 * Featured Image part for portfolio single
 * 
 * @package Rhythm
 */
if (has_post_thumbnail()): ?>
	<!-- Main Image -->
	<div class="post-prev-img mb-30">
		<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="lightbox-gallery-2 mfp-image"><?php the_post_thumbnail('ts-full'); ?></a>
	</div>
	<!-- End Main Image -->
	<?php 
	wp_enqueue_script( 'jquery-magnific-popup' );
endif;