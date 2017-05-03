<?php
/** 
 * Gallery part for portfolio single
 * 
 * @package Rhythm
 */
?>
<!-- Photo Grid -->
<div class="row multi-columns-row mb-30 mb-xs-10">
	<?php $gallery = ts_get_post_opt('portfolio-gallery');
	if (is_array($gallery)): ?>
		<?php foreach ($gallery as $item): ?>
			<?php if (isset($item['attachment_id'])): ?>
				<!-- Photo Item -->
				<div class="col-sm-6 col-md-4 col-lg-4 mb-md-10">
					<?php $image_src = wp_get_attachment_image_src($item['attachment_id'], 'ts-full');
					if (is_array($image_src) && isset($image_src[0])): ?>
						<div class="post-prev-img">
							<a href="<?php echo esc_url($image_src[0]); ?>" class="lightbox-gallery-2 mfp-image" title="<?php echo esc_attr($item['title']); ?>">
								<?php echo wp_get_attachment_image( $item['attachment_id'], 'ts-thumb', array('alt' => esc_attr($item['title'])) ); ?>
							</a>
						</div>
						<?php 
						wp_enqueue_script( 'jquery-magnific-popup' );
					endif; ?>
				</div>
				<!-- End Photo Item -->
			<?php endif; ?>
		<?php endforeach; ?>	
	<?php endif; ?>
</div>
<!-- End Photo Grid -->