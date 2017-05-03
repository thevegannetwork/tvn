<?php
/* 
 * Modern header layout
 */
$class = '';
if (ts_get_opt('header-style') == 'dark') {
	$logo_field = 'logo-light';
	$logo_file = 'sp-logo.png';
} else {
	$logo_field = 'logo';
	$class = 'white';
	$logo_file = 'sp-logo-dark.png';
}
?>

<?php if (ts_get_opt('header-enable-switch') == 1): ?>
	<!-- Menu Button -->
	<a href="#" class="sp-button"><span></span><?php _e('Menu', 'rhythm');?></a>
	<!-- End Menu Button -->

	<!-- Side Panel -->
	<div class="sp-overlay"></div>
	<div class="side-panel <?php echo sanitize_html_class($class); ?>"">

		<!-- Close Button -->
		<a href="#" class="sp-close-button"></a>
		<!-- End Close Button -->

		<!-- Logo -->
		<!-- Your text or image into link tag -->
		<div class="sp-logo-wrap local-scroll mb-40 mb-md-10 mb-xs-0">
			<?php rhythm_logo($logo_field, get_template_directory_uri().'/images/'.$logo_file); ?>
		</div>
		<!-- End Logo -->

		<!-- Menu -->
		<div class="sp-wrapper" id="side-panel-menu">
			
			<?php 
			$menu = '';
			if( is_singular() ) {
				$menu = ts_get_post_opt('header-primary-menu');
			}

			if (has_nav_menu('primary')):
				wp_nav_menu(array(
					'theme_location'	=> 'primary',
					'menu'				=> $menu,
					'container'			=> false,
					'menu_id'			=> 'primary-nav',
					'menu_class'		=> 'sp-menu-links local-scroll',
					'depth'				=> 2,
					'walker'			=> new rhythm_side_menu_widget_walker_nav_menu,
				));
			endif;
			?>
			<?php if (ts_get_opt('header-enable-search')): ?>
				<ul class="sp-menu-links local-scroll sp-menu-search">
					<li>
						<a href="#" class="sp-has-sub"><?php _e('Search', 'rhythm');?> <i class="fa fa-angle-down"></i></a>

						<ul class="sp-sub">
							<li>
								<div class="mn-wrap">
									<form method="get" class="form align-center" action="<?php echo esc_url(ts_get_home_url()); ?>">
										<div class="search-wrap inline-block sp-search">
											<button class="search-button animate" type="submit" title="<?php echo esc_attr(__('Start Search', 'rhythm'));?>">
												<i class="fa fa-search"></i>
											</button>
											<input type="text" name="s" class="form-control search-field round" placeholder="<?php echo esc_attr(__('Search...', 'rhythm'));?>">
										</div>
									</form>
								</div>
							</li>
						</ul>

					</li>

				</ul>
			<?php endif; ?>
		</div>
		<!-- End Menu -->

		<?php if (ts_get_opt('header-enable-social-icons')): ?>
			<!-- Social Links -->
			<div class="sp-social-links">
				<?php rhythm_social_links('%s',ts_get_opt('header-social-icons-category')); ?>
			</div>
			<!-- End Social Links -->
		<?php endif; ?>
	</div>
	<!-- End Side Panel -->
<?php endif; ?>