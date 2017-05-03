<?php
/** 
 * Header part for blog classic
 * 
 * @package Rhythm
 */
?>
<?php
$oArgs = ThemeArguments::getInstance('page-templates/blog-classic');
if ($oArgs -> get('main-layout') == 'default'): ?>
	<!-- Date -->
	<div class="blog-item-date">
		<span class="date-num"><?php the_time('j'); ?></span><?php the_time('M'); ?>
	</div>
<?php endif; ?>

<!-- Post Title -->
<h2 class="blog-item-title font-alt"><a href="<?php echo esc_url(get_permalink());?>"><?php the_title(); ?></a></h2>