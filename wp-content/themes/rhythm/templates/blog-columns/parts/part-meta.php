<?php
/** 
 * Header part for blog classic
 * 
 * @package Rhythm
 */

$meta = ts_get_opt('post-enable-meta');
?>
<div class="post-prev-info font-alt">
	<?php if (rhythm_check_if_meta_enabled('author',$meta)): ?>
		<?php the_author(); ?>
		<?php if (rhythm_check_if_meta_enabled('date',$meta)): ?>
			|
		<?php endif; ?>
	<?php endif; ?>
	<?php if (rhythm_check_if_meta_enabled('date',$meta)): ?>
		<?php the_time('j F'); ?>
	<?php endif; ?>
</div>