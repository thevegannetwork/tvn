<?php
/** 
 * Meta part for blog classic
 * 
 * @package Rhythm
 */
?>
<!-- Text Intro -->
<div class="blog-item-body">
	<?php echo wpautop(ts_get_the_excerpt_theme(30)); ?>
</div>