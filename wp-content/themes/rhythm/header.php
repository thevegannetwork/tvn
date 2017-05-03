<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="page" id="top">
 *
 * @package Rhythm
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if (ts_get_opt('enable-preloader') == 1):
	$preloader_custom_image = ts_get_opt_media('preloader-custom-image');
	$preloader_style = ts_get_opt('preloader-style');
	?>
	<!-- Page Loader -->
	<div class="page-loader <?php echo ( !empty($preloader_custom_image) ? 'loader-custom-image' : '' ); ?>">
		<?php if (!empty($preloader_custom_image)): ?>
			<div class="loader-image"><img src="<?php echo esc_url($preloader_custom_image); ?>" alt="<?php _e('Loading...', 'rhythm'); ?>" /></div>
		<?php endif; ?>

		<?php
			
			switch( $preloader_style ) {
				case 'presto': ?>

				<div class="sk-folding-cube">
					<div class="sk-cube1 sk-cube"></div>
					<div class="sk-cube2 sk-cube"></div>
					<div class="sk-cube4 sk-cube"></div>
					<div class="sk-cube3 sk-cube"></div>
				</div>

		<?php 
			
			break; 
			default:
		?>
			<div class="loader"><?php _e('Loading...', 'rhythm'); ?></div>

		<?php } ?>

	</div>
	<!-- End Page Loader -->
<?php endif; ?>

<?php
//under construction
if (ts_get_opt('enable-under-construction') == 1 && !current_user_can('level_10')): ?>

	<!-- Page Wrap -->
	<div class="page" id="top">
		<?php get_template_part('templates/header/under-construction'); ?>

<?php
//side menu
elseif (ts_get_opt('header-template') == 'side'): ?>

	<?php ts_get_header_template_part(); ?>
	<!-- Page Wrap -->
	<div class="page side-panel-is-left" id="top">
		<?php get_template_part('templates/preheader/default'); ?>

<?php
//top menu
else: ?>

	<!-- Page Wrap -->
	<div class="page" id="top">
		<?php get_template_part('templates/preheader/default'); ?>
		<?php ts_get_header_template_part(); ?>

<?php endif; ?>