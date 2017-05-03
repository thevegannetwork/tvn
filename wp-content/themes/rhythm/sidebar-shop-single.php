<?php
/**
 * The sidebar containing the shop single widget area.
 *
 * @package Rhythm
 */

if (is_active_sidebar( 'shop-single' )): ?>
	<?php dynamic_sidebar( 'shop-single' ); ?>
<?php endif; 

