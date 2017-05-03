<?php
/* 
 * Alternative header layout
 */
?>

<?php if (ts_get_opt('header-enable-switch') == 1): ?>
	
	<!-- Logo Section -->
	<section class="small-section pt-30 pt-xs-20 pb-30 pb-xs-20">

		<div class="container align-center">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
					<?php rhythm_logo('logo', get_template_directory_uri().'/images/logo-dark.png'); ?>
				</div>
			</div>
		</div>

	</section>
	<!-- End Logo Section -->

	
	<!-- Menu Wrapper -->
	<div class="container">

		<!-- Divider -->
		<hr class="mt-0 mb-0 "/>
		<!-- End Divider -->

		<!-- Navigation panel -->
		<nav class="main-nav mn-centered not-top mb-30">
			<div class="relative clearfix">

				<div class="mobile-nav">
					<i class="fa fa-bars"></i>
				</div>

				<!-- Main Menu -->
				<div class="inner-nav desktop-nav">
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
							'menu_class'		=> 'clearlist',
							'depth'				=> 3,
							'walker'			=> new rhythm_menu_widget_walker_nav_menu,
						));
					endif;
					?>

					<ul class="clearlist modules">
						
						<?php if (ts_get_opt('header-enable-search')): ?>
							<!-- Search -->
							<li>
								<a href="#" class="mn-has-sub"><i class="fa fa-search"></i> <?php _e('Search','rhythm');?></a>
								<ul class="mn-sub">
									<li>
										<div class="mn-wrap">
											<form method="get" class="form" action="<?php echo esc_url(ts_get_home_url()); ?>">
												<div class="search-wrap">
													<button class="search-button animate" type="submit" title="<?php echo esc_attr(__('Start Search', 'rhythm'));?>">
														<i class="fa fa-search"></i>
													</button>
													<input type="text" name="s" class="form-control search-field" placeholder="<?php echo esc_attr(__('Search...', 'rhythm'));?>">
												</div>
											</form>
										</div>
									</li>
								</ul>
							</li>
							 <!-- End Search -->
						<?php endif; ?>
						
						<?php if (ts_get_opt('header-enable-cart') && class_exists( 'WooCommerce' )): ?>
							<!-- Cart -->
							<li>
								<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <?php echo sprintf(__('Cart(%d)','rhythm'),WC()->cart->cart_contents_count); ?></a>
							</li>
							<!-- End Cart -->
						<?php endif; ?>
							
					<?php
						//WPML Language selector
					?>	
					<?php if ( ts_get_opt('header-enable-languages') && function_exists('icl_get_languages' ) && class_exists( 'SitePress' ) ): ?>
						<?php
							
						global $sitepress_settings;
			
						$languages = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');
						$active_language = null;
						if (is_array($languages) && count($languages) > 0):
							foreach ($languages as $language):
								if ($language['active'] == 1):
									if (isset($sitepress_settings['icl_lso_native_lang']) && $sitepress_settings['icl_lso_native_lang'] == 1):
										$active_language = $language['native_name'];
									elseif (isset($sitepress_settings['icl_lso_display_lang']) && $sitepress_settings['icl_lso_display_lang'] == 1):
										$active_language = $language['translated_name'];
									endif;

									break;
								endif;
							endforeach; ?>
						
							<!-- Languages -->
							<li class="icl-language-selector">
								<a href="#" class="mn-has-sub"><?php echo esc_html($active_language); ?> <i class="fa fa-angle-down"></i></a>

								<ul class="mn-sub">
									<?php
									foreach ($languages as $language): 
										$flag = '';
										if (isset($sitepress_settings['icl_lso_flags']) && $sitepress_settings['icl_lso_flags'] == 1):
											$flag = '<img src="'.esc_url($language['country_flag_url']).'" /> ';
										endif;

										$language_name = '';
										if (isset($sitepress_settings['icl_lso_native_lang']) && $sitepress_settings['icl_lso_native_lang'] == 1):
											$language_name = $language['native_name'];
										endif;

										if (isset($sitepress_settings['icl_lso_display_lang']) && $sitepress_settings['icl_lso_display_lang'] == 1):
											if (!empty($language_name)):
												$language_name .= ' ('.$language['translated_name'].')';
											else:
												$language_name = $language['translated_name'];
											endif;
										endif;

										?>
										<li <?php echo ($language['active'] == 1 ? 'class="active"' : ''); ?>><a href="<?php echo ($language['url'] == 'str' ? '#' : esc_url($language['url']) ); ?>" title="<?php echo esc_attr($language['native_name']); ?>"><?php echo $flag; ?><?php echo esc_html($language_name); ?></a></li>
									<?php endforeach; ?>
								</ul>
							</li>
							<!-- End Languages -->
						
						<?php endif; ?>
					<?php endif; ?>
					
					
					<?php
						//Qtranslate-x language selector
					?>
					<?php
					if ( ts_get_opt( 'header-enable-languages' ) && function_exists( 'qtranxf_init_language' ) ): ?>
						<?php
						global $q_config;
						$languages = qtranxf_getSortedLanguages();
						$active_language = null;
					
						if (is_array($languages) && count($languages) > 0):
						
								if(is_404()) $url = get_option('home'); else $url = '';
								$flag_location = qtranxf_flag_location();
								foreach( $languages as $language ) {
									if( $language == $q_config['language'] ) {
										$active_language = $q_config['language_name'][$language];
									}
								}
							?>
							<!-- Languages -->
							<li class="qtrans-language-selector"> 
								<a href="#" class="mn-has-sub"><?php echo esc_html( $active_language ); ?> <i class="fa fa-angle-down"></i></a>
								<ul class="mn-sub">
									<?php
									foreach ($languages as $language):
										$alt = $q_config['language_name'][$language] . ' (' . $language . ' )';
										$classes = array( 'lang-' . $language );
										if($language == $q_config['language']) $classes[] = 'active';
										$flag = '<img src="'.$flag_location.$q_config['flag'][$language].'" alt="'.$alt.'" /> ';
									?>
									<li class="<?php implode(' ', $classes) ?>"><a href="<?php echo esc_url( qtranxf_convertURL( $url, $language, false, true ) ); ?>" hreflang="<?php echo esc_attr( $language ); ?>"><?php echo $flag; ?><?php echo esc_html( $q_config['language_name'][$language] ); ?></a></li>
								<?php endforeach; ?>
								</ul>
							</li>
								<!-- End Languages -->
						<?php endif; ?>
					<?php endif; ?>

					<?php
						//Polylang language selector
					?>
					<?php 
					if ( ts_get_opt( 'header-enable-languages' ) && class_exists( 'Polylang' ) ): ?>
						<?php
						$languages = pll_the_languages( array( 'raw' => 1 ) );
						$active_language = pll_current_language('name');						
						if ( is_array( $languages ) && count( $languages ) > 0 ):
						?>
						<!-- Languages -->
						<li class="pll-language-selector"> 
							<a href="#" class="mn-has-sub"><?php echo esc_html( $active_language ); ?> <i class="fa fa-angle-down"></i></a>
							<ul class="mn-sub">
								<?php
								foreach ( $languages as $language ):
								$alt  = $language['name'];
								$flag = '<img src="' . esc_url( $language['flag'] ) . '" alt="' . esc_attr( $alt ) . '" /> ';
								?>
								<li <?php echo ( $language['current_lang'] == 1 ? 'class="active"' : ''); ?>><a href="<?php echo esc_url( $language['url'] ); ?>"><?php echo $flag; ?><?php echo esc_html( $language['name'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</li>
							<!-- End Languages -->					
						<?php endif; ?>
					<?php endif; ?>
							
						<?php if (ts_get_opt('header-enable-text')): ?>
							<!-- Text -->
							<li>
								<?php echo wp_kses_post(ts_get_opt('header-text-content')); ?>
							</li>
							<!-- End Text -->
						<?php endif; ?>
							
						<?php if (ts_get_opt('header-enable-social-icons')): ?>
							<!-- Social Links -->
							<li>
								<?php rhythm_social_links('%s',ts_get_opt('header-social-icons-category'), 2); ?>
							</li>
							<!-- End Social Links -->
						<?php endif; ?>
					</ul>


				</div>
				<!-- End Main Menu -->
			</div>
		</nav>
		<!-- End Navigation panel -->
	</div>
	<!-- End Menu Wrapper -->
<?php endif; ?>