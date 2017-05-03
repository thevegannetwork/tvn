<?php 
/* 
 * Alternative title bar layout
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
	
	$background = ts_get_opt('title-wrapper-background');
	$background_data = '';
	$add_bg = false;
	if( is_array($background) && $background['url'] != '' ) {
		$add_bg = true;
	}
	?>
	<!-- Title Wrapper Section -->
	<div class="container <?php echo (ts_get_opt('title-wrapper-margin-top') ? 'mt-80 mt-lg-60 mt-xs-40' : ''); ?>">
		<section class="title-section page-section bg-scroll <?php echo sanitize_html_classes($style_class);?>" <?php echo (true === $add_bg ? 'style="background-image: url('.esc_url($background['url']).');"' : ''); ?>>
			<div class="relative align-center">
				<h1 class="hs-line-11 font-alt mb-0"><?php echo rhythm_get_title(); ?></h1>
				<?php rhythm_breadcrumbs('align-center'); ?>
			</div>
		</section>
	</div>
	<!-- End Title Wrapper Section -->
<?php endif; ?>
<?php get_template_part('templates/title/parts/search');