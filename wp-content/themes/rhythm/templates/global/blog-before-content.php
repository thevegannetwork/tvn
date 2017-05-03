<?php
/**
 * Content wrapper presented before the loop (eg. used in page.php)
 * 
 * @package Rhythm
 */

$layout = rhythm_get_layout();
if ($layout == 'left_sidebar'): ?>
	<div class="row">
		<?php get_sidebar(); ?>
		<div class="col-sm-8 <?php echo (rhythm_get_sidebar_size() == '4columns' ? '' : 'col-md-offset-1'); ?>">
			<!-- Page Content -->

<?php elseif ($layout == 'right_sidebar'): ?>
	<div class="row">
		<div class="col-sm-8">
			<!-- Page Content -->
<?php else: ?>
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<!-- Page Content -->
<?php endif; 