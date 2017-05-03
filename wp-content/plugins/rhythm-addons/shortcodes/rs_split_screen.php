<?php
/**
 *
 * RS Split Screen
 * @version 1.0.0
 *
 *
 */
function rs_split_screen($atts, $content = '', $id = '') {

	extract(shortcode_atts(array(
		'id'               => '',
		'class'            => '',
		'image'            => '',
		'header'           => '',
		'align_content'    => 'align-left',
		'img_position'     => 'right'
	), $atts));

	$id                        = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class                     = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	
	ob_start();

	$image_url = '';
	if (is_numeric($image) && !empty($image)) {
		$image_src = wp_get_attachment_image_src($image, 'full');
		if (isset($image_src[0])) {
			$image_url = esc_url($image_src[0]);
		}
	}
	?>
	<section class="split-section bg-gray-lighter">
		<div class="clearfix relative">
			
			<!-- Section Headings -->
			<div class="split-section-headings <?php echo sanitize_html_class( $img_position ); ?>">
				<div class="ssh-table">
					<div class="ssh-cell page-section bg-scroll" data-background="<?php echo esc_url($image_url);?>"></div>
				</div>
			</div>
			<!-- End Section Headings -->
			
			<!-- Section Content -->
			<div class="split-section-content page-section">
				
				<div class="split-section-wrapper <?php echo ( $img_position == 'right' ? 'left' : 'right' ); ?>">
					
					<div class="text <?php echo sanitize_html_class( $align_content); ?>">
						<?php if( ! empty( $header ) ) { ?>
						<h2 class="font-alt mt-0 mb-50 mb-xxs-20"><?php echo esc_html($header); ?></h2>
						<?php } ?>
						<?php echo do_shortcode($content); ?>
					</div>

					
				</div>
				
			</div>
			<!-- End Section Content -->
	
		</div>
	</section>
	<?php

	$output = ob_get_clean();
	return $output;
}


add_shortcode('rs_split_screen', 'rs_split_screen');