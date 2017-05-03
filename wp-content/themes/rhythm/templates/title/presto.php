<?php 
/* 
* Presto title bar layout
*/

	if (ts_get_opt('title-wrapper-enable') == 1):
?>
<section class="small-section pb-30 pt-0 bb-black-transparent">
	<div class="mod-breadcrumbs mod-breadcrumbs-style2 bg-gray-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php rhythm_presto_breadcrumbs(); ?>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div>

	<div class="relative container align-left">
		<div class="row">
			<!-- /.col-md-12 -->
			<div class="col-md-8">
				<h1 class="mb-0"><?php echo rhythm_get_title(); ?></h1>
				<?php $subtitle = rhythm_get_subtitle();
					if (!empty($subtitle)): ?>
					<h6 class="mt-0"><?php echo wp_kses_data($subtitle); ?></h6>
					<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
	
	endif;

?>