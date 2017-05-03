<?php 
/* 
 * Magazine title bar layout
 */

if (ts_get_opt('title-wrapper-enable') == 1): 
	
	$style_class = '';
	
	$parallax_effect = ts_get_opt('title-wrapper-parallax-effect');
	if (!empty($parallax_effect)) {
		$style_class .= ' '.$parallax_effect;
	}
	
	$style_class = ts_get_opt('title-wrapper-style');
	if (empty($style_class)) {
		$style_class .= ' bg-gray-lighter';
	}
	
//	$subtitle_class = '';
//	if (in_array($style_class,array('bg-gray-lighter', 'bg-gray'))) {
//		$subtitle_class = 'dark-subtitle';
//	}
//	
	$background = ts_get_opt('title-wrapper-background');
	$background_data = '';
	$add_bg = false;
	if( is_array($background) && $background['url'] != '' ) {
		$add_bg = true;
	}
	?>
	<!-- Title Wrapper Section -->
	<section class="title-section small-section pb-30 <?php echo sanitize_html_classes($style_class);?>" <?php echo (true === $add_bg ? 'style="background-image: url('.esc_url($background['url']).');"' : ''); ?>>

		<div class="container align-center">
			<?php
			$image_url = ts_get_opt_media('title-wrapper-image');
			if (!empty($image_url)): ?>
				<div class="mb-10">
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
				</div>
			<?php endif; ?>
			<h1 class="magazine-logo-text font-alt"><?php echo rhythm_get_title(); ?></h1>
		</div>

	</section>
	<!-- End Title Wrapper Section -->
<?php endif; ?>
<?php get_template_part('templates/title/parts/search');