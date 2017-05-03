<?php if (ts_get_opt('footer-enable') == 1):
	?>
<!-- Foter -->
<footer class="medium-section bg-gray-dark footer pt-80 pb-90">
	<div class="container">

		<!-- Footer Text -->
		<div class="footer-text footer-text-style2">

			<div class="row">

				<div class="col-md-5">

					<!-- Copyright -->
					<div class="footer-copy">
						<?php echo ts_get_opt('footer-text-content'); ?>
					</div>
					<!-- End Copyright -->

				</div><!-- /.col-md-5 -->

				<div class="col-md-2">

					<!-- Footer Logo -->
					<?php if (ts_get_opt('footer-logo-enable')): ?>
						<div class="local-scroll">
							<?php rhythm_logo('footer-logo', get_template_directory_uri().'/images/logo-presto-footer.png', ''); ?>
						</div>
					<?php endif; ?>
					<!-- End Footer Logo -->

				</div><!-- /.col-md-2 -->

				<div class="col-md-5">

					<div class="footer-made">
						<?php echo ts_get_opt('footer-small-text-content'); ?>
					</div>

				</div><!-- /.col-md-5 -->

			</div><!-- /.row -->
		</div>
		<!-- End Footer Text -->

	<?php
	if (ts_get_opt('footer-enable-social-icons') == 1): ?>
		<!-- Social Links -->
		<div class="footer-social-links footer-social-links-style2">
			<?php rhythm_social_links('%s',ts_get_opt('footer-social-icons-category')); ?>
		</div>
		<!-- End Social Links -->
	<?php endif; ?>

	</div>
	<!-- Top Link -->
	<div class="local-scroll">
		<a href="#top" class="link-to-top white"><i class="fa fa-caret-up"></i></a>
	</div>
	<!-- End Top Link -->
</footer>
<!-- End Foter -->
<?php endif; ?>
