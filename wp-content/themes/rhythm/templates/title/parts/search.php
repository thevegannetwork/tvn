<?php
/**
 * Title wrapper search
 */
if (ts_get_opt('title-wrapper-search') == 1): ?>
	<!-- Search Section -->
	<section class="small-section">
		<div class="container relative">
			<!-- Search -->
			<form class="form-inline form" role="form" action="<?php echo esc_url(ts_get_home_url()); ?>">
				<div class="search-wrap">
					<button class="search-button animate" type="submit" title="<?php echo esc_attr(__('Start Search', 'rhythm'));?>">
						<i class="fa fa-search"></i>
					</button>
					<input type="text" name="s" class="form-control search-field" placeholder="<?php echo esc_attr(__('Search...', 'rhythm'));?>">
				</div>
			</form>
			<!-- End Search -->
		</div>
	</section>
	<!-- End Search Section -->
	
	<!-- Divider -->
	<hr class="mt-0 mb-0"/>
	<!-- End Divider -->
	
<?php endif; ?>
