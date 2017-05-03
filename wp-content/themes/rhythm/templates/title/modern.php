<?php 
/* 
 * Modern title bar layout
 */

if (ts_get_opt('title-wrapper-enable') == 1): 
	
	$style_class = ts_get_opt('title-wrapper-style');
	if (empty($style_class)) {
		$style_class .= 'bg-gray-lighter';
	}
	
	$parallax_effect = ts_get_opt('title-wrapper-parallax-effect');
	if (!empty($parallax_effect)) {
		$style_class .= ' '.$parallax_effect;
	}
	
	$subtitle_class = '';
	if (in_array($style_class,array('bg-gray-lighter', 'bg-gray'))) {
		$subtitle_class = 'dark-subtitle';
	}
	
	$background = ts_get_opt('title-wrapper-background');
	$background_data = '';
	$add_bg = false;
	if( is_array($background) && $background['url'] != '' ) {
		$add_bg = true;
	}
	?>
	<!-- Title Wrapper Section -->
	<section class="title-section page-section pt-sm-110 pb-sm-90 <?php echo sanitize_html_classes($style_class);?>" <?php echo (true === $add_bg ? 'style="background-image: url('.esc_url($background['url']).');"' : ''); ?>>
		<div class="relative container align-center">
			<?php rhythm_breadcrumbs('align-center'); ?>
			<?php $subtitle = rhythm_get_subtitle();
			if (!empty($subtitle)): ?>
				<h1 class="hs-line-11 font-alt mb-0 <?php echo sanitize_html_classes($subtitle_class); ?>">
					<?php echo wp_kses_data($subtitle); ?>
				</h1>
			<?php endif; ?>
		</div>
	</section>
	<!-- End Title Wrapper Section -->
<?php endif; ?>
<?php get_template_part('templates/title/parts/search');