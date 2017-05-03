<?php
/**
 * The main template file used in archive, index, search
 *
 * @package Rhythm
 */

get_header();
ts_get_title_wrapper_template_part();

$oArgs = ThemeArguments::getInstance('templates/pages/index');

switch ($oArgs -> get('template')) {
	case 'columns':
		$folder = 'blog-columns';
		$apply_columns = true;
		$container_start = '<div class="row multi-columns-row">';
		$container_end = '</div>';
		break;
	
	case 'masonry':
		$folder = 'blog-masonry';
		$apply_columns = true;
		$container_start = '<div class="row masonry">';
		$container_end = '</div>';
		
		wp_enqueue_script( 'masonry-pkgd' );
		wp_enqueue_script( 'imagesloaded-pkgd' );
		break;
	
	case 'classic':
	default:
		$folder = 'blog-classic';
		$apply_columns = false;
		$container_start = '';
		$container_end = '';
}

//set columns
$columns_start = '';
$columns_end = '';
if ($apply_columns === true) {
	$columns  = $oArgs -> get('columns');
	switch ($columns) {
		case 3:
			$columns_start = '<div class="col-sm-6 col-md-4 col-lg-4 mb-60 mb-xs-40">';
			break;

		case 4:
			$columns_start = '<div class="col-sm-6 col-md-3 col-lg-3 mb-60 mb-xs-40">';
			break;

		case 2:
		default:
			$columns_start = '<div class="col-md-6 col-lg-6 mb-60 mb-xs-40">';
	}
	$columns_end = '</div>';
}

?>

<!-- Page Section -->
<section class="page-section">
	<div class="container relative">
		<?php if ( have_posts() ) : ?>
			<?php get_template_part('templates/global/blog-before-content'); ?>
			<?php
			echo $container_start;
			while (have_posts()) : the_post(); ?>
				<?php 
				echo $columns_start;
				get_template_part('templates/'.$folder.'/content',get_post_format()); 
				echo $columns_end;
				?>
			<?php endwhile;
			echo $container_end;
			?>
			<?php rhythm_paging_nav(); ?>
		<?php else : ?>
			<?php get_template_part( 'templates/content/content', 'none' ); ?>
		<?php endif; ?>	
		<?php get_template_part('templates/global/blog-after-content'); ?>
	</div>
</section>
<!-- End Page Section -->

<?php get_footer(); ?>
