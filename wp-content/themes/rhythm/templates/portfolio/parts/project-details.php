<?php
/** 
 * Project details part for portfolio single
 * 
 * @package Rhythm
 */
?>
<!-- Project Details -->
<div class="section-text">
	<div class="row">
		
		<div class="col-md-4 mb-sm-50 mb-xs-30">
			<div class="work-detail">
				<h5 class="font-alt mt-0 mb-20"><?php _e('Project Details', 'rhythm'); ?></h5>
				<div class="work-full-detail">
					<?php if (ts_get_post_opt('portfolio-client')): ?>
						<p>
							<strong><?php _e('Client:', 'rhythm'); ?></strong>
							<?php echo esc_html(ts_get_post_opt('portfolio-client')); ?>
						</p>
					<?php endif; ?>
					<p>
						<strong><?php _e('Date:', 'rhythm'); ?></strong>
						<?php the_date(get_option('date_format')); ?>
					</p>
					<?php if (ts_get_post_opt('portfolio-url')): ?>
						<p>
							<strong><?php _e('Online:', 'rhythm'); ?></strong>
							<a href="<?php echo esc_url(ts_get_post_opt('portfolio-url')); ?>" target="_blank"><?php echo preg_replace("(^https?://)", "", esc_url(ts_get_post_opt('portfolio-url')) ); ?></a>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
			<?php echo wp_kses_data(ts_get_post_opt('portfolio-content-1')); ?>
		</div>

		<div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
			<?php echo wp_kses_data(ts_get_post_opt('portfolio-content-2')); ?>
		</div>

	</div>
</div>
<!-- End Project Details -->