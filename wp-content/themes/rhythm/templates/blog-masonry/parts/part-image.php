<?php
/** 
 * Header part for blog classic
 * 
 * @package Rhythm
 */
?>
<!-- Image -->
<div class="post-prev-img">

	<a href="<?php echo esc_url(get_permalink());?>">
		<?php 
		if ( has_post_thumbnail() ):
			the_post_thumbnail('ts-thumb-no-crop');
		endif;
		?>
	</a>
</div>