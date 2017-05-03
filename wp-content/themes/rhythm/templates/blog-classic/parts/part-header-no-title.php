<?php
/** 
 * Header part for blog classic
 * 
 * @package Rhythm
 */
$oArgs = ThemeArguments::getInstance('page-templates/blog-classic');
if ($oArgs -> get('main-layout') == 'default'): ?>
	<!-- Date -->
	<div class="blog-item-date">
		<span class="date-num"><?php the_time('j'); ?></span><?php the_time('M'); ?>
	</div>
<?php endif; ?>