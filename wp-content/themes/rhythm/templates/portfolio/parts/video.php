<?php
/** 
 * Video part for portfolio single
 * 
 * @package Rhythm
 */

$url = ts_get_post_opt('portfolio-video-url');

if (!empty($url)) {
	$embadded_video = ts_get_embaded_video($url);
} else if (empty($url)) {
	$embadded_video = ts_get_post_opt('portfolio-video-html');
}

if ($embadded_video != ''):
	wp_enqueue_script( 'jquery-fitvids' );
	?>
	<div class="post-prev-img mb-30">
		<!-- Media -->
		<div class="video">
			<?php echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags()); ?>
		</div>
	</div>
<?php endif; ?>