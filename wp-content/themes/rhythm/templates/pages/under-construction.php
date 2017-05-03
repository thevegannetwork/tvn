<?php

/**
 * The main template file used in archive, index, search
 *
 * @package Rhythm
 */

get_header(); 
?>
<!-- Home Section -->
<section class="home-section bg-dark-alfa-90 parallax-2" data-background="<?php echo esc_url(ts_get_opt_media('under-construction-background')); ?>">
	<div class="js-height-full">

		<!-- Hero Content -->
		<div class="home-content container">
			<div class="home-text">
				<div class="hs-cont">

					<!-- Headings -->
					<div class="hs-wrap">

						<div class="hs-line-12 font-alt mb-10">
							<?php echo wp_kses_post(ts_get_opt('under-construction-title')); ?>
						</div>

						<div class="hs-line-6 no-transp font-alt mb-40">
							<?php echo wp_kses_post(ts_get_opt('under-construction-subtitle')); ?>
						</div>

						<p>
							<?php echo wp_kses_post(ts_get_opt('under-construction-text')); ?>
						</p>

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
