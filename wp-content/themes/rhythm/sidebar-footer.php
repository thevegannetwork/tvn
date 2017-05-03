<?php
/**
 * The sidebar footer containing the main widget area.
 *
 * @package Rhythm
 */

if (ts_get_opt('footer-widgets-enable') == 1): ?>
	<!-- Divider -->
	<hr class="mt-0 mb-0"/>
	<!-- End Divider -->

	<!-- Widgets Section -->
	<section class="footer-sidebar page-section">
		<div class="container relative">
			<div class="row multi-columns-row">
				<div class="col-sm-6 col-md-3 col-lg-3">
					<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') )): ?>
						<?php dynamic_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') )): ?>
						<?php dynamic_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') )): ?>
						<?php dynamic_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') ); ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-6 col-md-3 col-lg-3">
					<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') )): ?>
						<?php dynamic_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<!-- End Widgets Section -->
<?php endif; ?>