<?php
/* 
 * Footer alternative layout
 */

?>
<?php if (ts_get_opt('footer-enable') == 1 || ts_get_opt('footer-widgets-enable') == 1): ?>
	<!-- Foter -->
	<footer class="small-section bg-gray-lighter footer pb-60">
		<div class="container">
			
			<?php if (ts_get_opt('footer-widgets-enable')): ?>
			
				<!-- Footer Widgets -->
				<div class="row align-left">
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') )): ?>
							<?php dynamic_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') ); ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') )): ?>
							<?php dynamic_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') ); ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') )): ?>
							<?php dynamic_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') ); ?>
						<?php endif; ?>
					</div>
					<div class="col-sm-6 col-md-3">
						<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') )): ?>
							<?php dynamic_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') ); ?>
						<?php endif; ?>
					</div>
				</div>
				<!-- End Footer Widgets -->

				<!-- Divider -->
				<hr class="mt-0 mb-80 mb-xs-40"/>
				<!-- End Divider -->
			<?php endif; ?>
			
			<?php if (ts_get_opt('footer-enable')): ?>
				
				<!-- Footer Logo -->
				<?php if (ts_get_opt('footer-logo-enable')): ?>
					<div class="local-scroll mb-30 wow fadeInUp" data-wow-duration="1.5s">
						<?php rhythm_logo('footer-logo', get_template_directory_uri().'/images/logo-footer.png', ''); ?>
					</div>
				<?php endif; ?>
				<!-- End Footer Logo -->
				<?php
				if (ts_get_opt('footer-enable-social-icons') == 1): ?>
					<!-- Social Links -->
					<div class="footer-social-links <?php echo ( ts_get_opt('footer-social-icons-margin') != '' ? sanitize_html_classes( ts_get_opt('footer-social-icons-margin') ) : 'mb-110 mb-xs-60' ) ?>">
						<?php rhythm_social_links('%s',ts_get_opt('footer-social-icons-category')); ?>
					</div>
					<!-- End Social Links --> 
				<?php endif; ?>

				<!-- Footer Text -->
				<div class="footer-text">
					<div class="footer-copy font-alt">
						<?php echo ts_get_opt('footer-text-content'); ?>
					</div>
					<div class="footer-made">
						<?php echo ts_get_opt('footer-small-text-content'); ?>
					</div>
				</div>
				<!-- End Footer Text --> 
				
			<?php endif; ?>
		 </div>

		 <!-- Top Link -->
		 <div class="local-scroll">
			 <a href="#top" class="link-to-top"><i class="fa fa-caret-up"></i></a>
		 </div>
		 <!-- End Top Link -->

	</footer>
	<!-- End Foter -->
<?php endif; ?>