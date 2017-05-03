<?php
/* 
 * Default preheader layout
 */

?>

<?php if (ts_get_opt('preheader-enable-switch') == 1): ?>
	<!-- Top Bar -->
		<div class="top-bar <?php echo (ts_get_opt('preheader-style') == 'dark' ? 'dark' : '') ?>">
			<div class="<?php echo (ts_get_opt('preheader-full-width') ? 'full-wrapper' : 'container'); ?> clearfix">

				<!-- Top Links -->
				<?php 
				if (has_nav_menu('preheader-left')):
					wp_nav_menu(array(
						'theme_location'	=> 'preheader-left',
						'container'			=> false,
						'menu_id'			=> 'preheader-left-nav',
						'menu_class'		=> 'top-links left',
						'depth'				=> 1,
						'walker'			=> new rhythm_menu_widget_walker_nav_menu,
					));
				endif; ?>
				<!-- End Top Links -->

				<!-- Social Links -->
				<?php 
				if (has_nav_menu('preheader-right')):
					wp_nav_menu(array(
						'theme_location'	=> 'preheader-right',
						'container'			=> false,
						'menu_id'			=> 'preheader-right-nav',
						'menu_class'		=> 'top-links right tooltip-bot',
						'depth'				=> 1,
						'walker'			=> new rhythm_menu_widget_walker_nav_menu,
					));
				endif; ?>
				<!-- End Social Links -->

			</div>
		</div>
		<!-- End Top Bar -->
<?php endif; ?>