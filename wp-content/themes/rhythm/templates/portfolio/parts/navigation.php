<?php
/** 
 * Navigation part for portfolio single
 * 
 * @package Rhythm
 */
if (ts_get_opt('portfolio-enable-navigation')): ?>
	<!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->

	<!-- Work Navigation -->
	<div class="work-navigation clearfix">
		<?php 
		$prev_post = get_previous_post();
		if ($prev_post && !is_wp_error($prev_post)): ?>
			<a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="work-prev"><span><i class="fa fa-chevron-left"></i>&nbsp;<?php _e('Previous', 'rhythm'); ?></span></a>
		<?php else: ?>
			<a nohref class="work-prev inactive"><span><i class="fa fa-chevron-left"></i>&nbsp;<?php _e('Previous', 'rhythm'); ?></span></a>
		<?php endif; ?>
		
		<!---->
		
		<?php $page = ts_get_opt('portfolio-page'); 
		
		if (function_exists('icl_object_id')) {
			$page = icl_object_id($page,'page',false,ICL_LANGUAGE_CODE);
		}
		
		if ($page): ?>
			<a href="<?php echo esc_url(get_permalink($page));  ?>" class="work-all"><span><i class="fa fa-times"></i>&nbsp;<?php _e('All works', 'rhythm');?></span></a>
		<?php endif; ?>
		
		
		<?php 
		$next_post = get_next_post();
		if ($next_post && !is_wp_error($next_post)): ?>
			<a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="work-next"><span><?php _e('Next', 'rhythm'); ?>&nbsp;<i class="fa fa-chevron-right"></i></span></a>
		<?php else: ?>
			<a nohref class="work-next inactive"><span><?php _e('Next', 'rhythm'); ?>&nbsp;<i class="fa fa-chevron-right"></i></span></a>
		<?php endif; ?>
		
	</div>
	<!-- End Work Navigation -->

	<!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->
<?php endif;