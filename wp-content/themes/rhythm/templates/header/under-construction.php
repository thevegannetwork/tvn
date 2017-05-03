<?php
/* 
 * Under construction header layout
 */
?>
<!-- Navigation panel -->
<nav class="main-nav dark transparent stick-fixed">
	<div class="full-wrapper relative clearfix">
		<!-- Logo ( * your text or image into link tag *) -->
		<div class="nav-logo-wrap local-scroll">
			<?php rhythm_logo('logo-light', get_template_directory_uri().'/images/logo.png'); ?>
		</div>
		<div class="mobile-nav">
			<i class="fa fa-bars"></i>
		</div>
		<!-- Main Menu -->
		<div class="inner-nav desktop-nav">
			<ul class="clearlist scroll-nav local-scroll">
				<li><?php echo wp_kses_post(ts_get_opt('under-construction-header1')); ?></li>
				<li><?php echo wp_kses_post(ts_get_opt('under-construction-header2')); ?></li>
			</ul>
		</div>
	</div>
</nav>
<!-- End Navigation panel -->
