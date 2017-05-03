<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Rhythm
 */

$layout = rhythm_get_layout();
$sidebar = rhythm_get_main_sidebar();

switch ($layout):
	case 'left_sidebar': ?>
		<!-- Sidebar -->
		<div class="col-sm-4 <?php echo (rhythm_get_sidebar_size() == '4columns' ? 'col-md-4' : 'col-md-3'); ?> sidebar <?php echo (rhythm_if_header_fixed_sidebar() ? 'sidebar-fixed' : ''); ?>">
			<div class="sidebar-inner">
				<?php if (is_active_sidebar( $sidebar )): ?>
					<?php dynamic_sidebar( $sidebar ); ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- End Sidebar -->
		<?php break;
	
	case 'right_sidebar': ?>
		<!-- Sidebar -->
		<div class="col-sm-4 <?php echo (rhythm_get_sidebar_size() == '4columns' ? 'col-md-4' : 'col-md-3 col-md-offset-1'); ?> sidebar <?php echo (rhythm_if_header_fixed_sidebar() ? 'sidebar-fixed' : ''); ?>">
			<div class="sidebar-inner">
				<?php if (is_active_sidebar( $sidebar )): ?>
					<?php dynamic_sidebar( $sidebar ); ?>
				<?php endif; ?>
			</div>
		</div>
		<!-- End Sidebar -->	
		<?php break;
endswitch;
?>