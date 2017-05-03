<?php 
/* 
 * Breadcrumbs only title bar layout
 */

if (ts_get_opt('title-wrapper-enable') == 1): 
	
	?>
	<!-- Title Wrapper Section -->
	<section class="small-section pt-20 pb-20 bg-gray-lighter">
		<div class="relative full-wrapper">
			<?php rhythm_breadcrumbs('mod-breadcrumbs-mini mt-0 mb-0'); ?>
		</div>
	</section>
	<!-- End Title Wrapper Section -->
	 <!-- Divider -->
	<hr class="mt-0 mb-0 "/>
	<!-- End Divider -->
<?php endif; ?>
<?php get_template_part('templates/title/parts/search');