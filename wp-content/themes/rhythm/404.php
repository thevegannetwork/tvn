<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Rhythm
 */

get_header(); 

?>
<!-- Home Section -->
<section class="home-section bg-dark-alfa-50 parallax-2" data-background="<?php echo esc_url(ts_get_opt_media('404-background')); ?>">
	<div class="js-height-full">

		<!-- Hero Content -->
		<div class="home-content container">
			<div class="home-text">
				<div class="hs-cont">

					<!-- Headings -->
					<div class="hs-wrap">

						<div class="hs-line-13 font-alt mb-10">
							404
						</div>

						<div class="hs-line-4 font-alt mb-40">
							<?php _e('The page you were looking for could not be found.', 'rhythm'); ?>
						</div>

						<div class="local-scroll">                                        
							<a href="<?php echo esc_url(ts_get_home_url()); ?>" class="btn btn-mod btn-w btn-round btn-small"><i class="fa fa-angle-left"></i> <?php _e('Back To Home Page', 'rhythm'); ?></a>                                        
						</div>

					</div>
					<!-- End Headings -->

				</div>
			</div>
		</div>
		<!-- End Hero Content -->

	</div>
</section>
<!-- End Home Section -->
<?php get_footer(); ?>
