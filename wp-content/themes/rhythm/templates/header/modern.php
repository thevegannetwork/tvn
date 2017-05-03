<?php
/* 
 * Modern header layout
 */
?>

<?php if (ts_get_opt('header-enable-switch') == 1): ?>
	<!-- Logo -->
	<div class="fm-logo-wrap local-scroll">
		<?php rhythm_logo('logo', get_template_directory_uri().'/images/fm-logo.png'); ?>
	</div>
	<!-- End Logo -->

	<!-- Menu Button -->
	<a href="#" class="fm-button"><span></span><?php _e('Menu', 'rhythm');?></a>
	<!-- End Menu Button -->

	<!-- Menu Overlay -->
	<div class="fm-wrapper" id="fullscreen-menu">
		<div class="fm-wrapper-sub">
			<div class="fm-wrapper-sub-sub">

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
						'menu_class'		=> 'fm-menu-links local-scroll',
						'depth'				=> 2,
						'walker'			=> new rhythm_modern_menu_widget_walker_nav_menu,
					));
				endif;
				?>

				<?php if (ts_get_opt('header-enable-search')): ?>
					<ul class="fm-menu-links local-scroll fm-menu-search">	
						<li>
							<!-- Search -->
							<a href="#" class="fm-has-sub"><?php _e('Search','rhythm');?> <i class="fa fa-angle-down"></i></a>
							<ul class="fm-sub">
								<li>
									<div class="mn-wrap">
										<form method="get" class="form align-center" action="<?php echo esc_url(ts_get_home_url()); ?>">
											<div class="search-wrap inline-block fm-search">
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
	
				<?php if (ts_get_opt('header-enable-social-icons')): ?>
					<!-- Social Links -->
					<div class="fm-social-links">
						<?php rhythm_social_links('%s',ts_get_opt('header-social-icons-category')); ?>
					</div>
					<!-- End Social Links -->
				<?php endif; ?>

			</div>
		</div>

	</div>
	<!-- End Menu Overlay  -->
<?php endif; ?>