<?php
/**
 * Media for single post
 * 
 * @package Rhythm
 */
if (ts_get_opt('post-enable-media')):

	$format = get_post_format();

	switch ($format):
		case 'audio': ?>
			<!-- Media -->
			<div class="blog-media">
				<?php
				$audio = ts_get_post_opt('post-audio-url');
				if (!empty($audio)):
					echo do_shortcode('[audio src="'.esc_url($audio).'"]');
				endif;
				?>

				<a href="<?php echo esc_url(get_permalink());?>">
					<?php 
					if ( has_post_thumbnail() ):
						the_post_thumbnail('ts-full');
					endif;
					?>
				</a>
			</div>
			<?php break;

		case 'gallery': ?>
			<!-- Gallery -->
			<div class="blog-media">
				<?php 
				$gallery = ts_get_post_opt('post-gallery');

				if (is_array($gallery)): ?>
					<ul class="clearlist content-slider">
						<?php foreach ($gallery as $item): ?>
							<li>
								<?php if (isset($item['attachment_id'])):
									echo wp_get_attachment_image( $item['attachment_id'], 'ts-full', array('alt' => esc_attr($item['title'])) );
								endif; ?>
							</li>
						<?php endforeach; 
						wp_enqueue_script( 'owl-carousel' );
						?>
					</ul>
				<?php else: ?>
					<a href="<?php echo esc_url(get_permalink());?>">
						<?php 
						if ( has_post_thumbnail() ):
							the_post_thumbnail('ts-full');
						endif; ?>
					</a>
				<?php endif; ?>
			</div>
			<?php break;

		case 'video': 
			wp_enqueue_script( 'jquery-fitvids' );
			?>
			<!-- Media -->
			<div class="blog-media">
				<?php
				$url = ts_get_post_opt('post-video-url');
				if (!empty($url)) {
					$embadded_video = ts_get_embaded_video($url);
				} else if (empty($url)) {
					$embadded_video = ts_get_post_opt('post-video-html');
				}

				if ($embadded_video != '') {
					echo wp_kses($embadded_video,ts_add_iframe_to_allowed_tags());
				} else if (has_post_thumbnail()) { ?>
					<a href="<?php echo esc_url(get_permalink());?>">
						<?php 
						if ( has_post_thumbnail() ):
							the_post_thumbnail('ts-full');
						endif;
						?>
					</a>
				<?php } ?>
			</div>
			<?php break;

		default: ?>
			<!-- Image -->
			<div class="blog-media">
				<a href="<?php echo esc_url(get_permalink());?>">
					<?php 
					if ( has_post_thumbnail() ):
						the_post_thumbnail('ts-full');
					endif;
					?>
				</a>
			</div>
			<?php break;
	endswitch;
endif;