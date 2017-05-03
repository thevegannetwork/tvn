<?php
/** 
 * Meta part for blog classic
 * 
 * @package Rhythm
 */
?>
<!-- Read More Link -->
<div class="post-prev-more">
	<a href="<?php echo esc_url(get_permalink());?>" title="<?php echo esc_attr(get_the_title());?>" class="btn btn-mod btn-gray btn-round"><?php _e('Read More', 'rhythm');?> <i class="fa fa-angle-right"></i></a>
</div>
