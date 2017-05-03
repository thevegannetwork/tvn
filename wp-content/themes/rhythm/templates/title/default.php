<?php 
/* 
 * Default title bar layout
 */

if (ts_get_opt('title-wrapper-enable') == 1): 
	
	$before_row = '';
	$after_row = '';
	$container_class = 'relative align-left ';
	switch (ts_get_opt('title-wrapper-size')) {
		case 'small':
			$size_class = 'small-section pt-30 pb-30';
			$title_class = 'mb-0';
			break;
		
		case 'medium':
			$size_class = 'page-section';
			$title_class = 'mb-20 mb-xs-0';
			break;
		
		case 'big':
			$size_class = 'home-section fixed-height-small';
			$title_class = 'mb-20 mb-xs-0';
			$container_class = 'js-height-parent';
			$before_row = '<div class="home-content"><div class="home-text">';
			$after_row = '</div></div>';
			break;
		
		default:
			$size_class = 'small-section';
			$title_class = 'mb-20 mb-xs-0';
	}
	
	$parallax_effect = ts_get_opt('title-wrapper-parallax-effect');
	if (!empty($parallax_effect)) {
		$size_class .= ' '.$parallax_effect;
	}
	
	$style_class = ts_get_opt('title-wrapper-style');
	if (empty($style_class)) {
		$style_class = 'bg-gray-lighter';
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
	<section class="title-section title-wrapper <?php echo sanitize_html_classes($size_class); ?> <?php echo sanitize_html_classes($style_class);?>" <?php echo (true === $add_bg ? 'style="background-image: url('.esc_url($background['url']).');"' : ''); ?>>
		<div class="<?php echo sanitize_html_classes($container_class); ?> container">
			<?php echo $before_row; ?>
			<div class="row">
				<div class="col-md-8 align-left">
					<h1 class="hs-line-11 font-alt <?php echo sanitize_html_classes($title_class); ?>"><?php echo rhythm_get_title(); ?></h1>
					<?php $subtitle = rhythm_get_subtitle();
					if (!empty($subtitle)): ?>
						<div class="hs-line-4 font-alt <?php echo sanitize_html_classes($subtitle_class);?>">
							<?php echo wp_kses_data($subtitle); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="col-md-4 mt-30">
					<?php rhythm_breadcrumbs(); ?>
				</div>
			</div>
			<?php echo $after_row; ?>
		</div>
	</section>
	<!-- End Title Wrapper Section -->
<?php endif; ?>
<?php get_template_part('templates/title/parts/search');