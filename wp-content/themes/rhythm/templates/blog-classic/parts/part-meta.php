<?php
/** 
 * Header part for blog classic
 * 
 * @package Rhythm
 */

$meta = ts_get_opt('post-enable-meta');

?>
<!-- Author, Categories, Comments -->
<div class="blog-item-data">
	<?php if (rhythm_check_if_meta_enabled('date',$meta)):
		$oArgs = ThemeArguments::getInstance('page-templates/blog-classic');
		if ($oArgs -> get('main-layout') != 'default'): ?>
			<span class="separator">&nbsp;</span>
			<i class="fa fa-clock-o"></i> <?php the_time('j.m.Y'); ?>
		<?php endif; ?>
		
	<?php endif; ?>
	
	<?php if (rhythm_check_if_meta_enabled('author',$meta)): ?>
		<span class="separator">&nbsp;</span>
		<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
		<?php if ($author_url): ?>
			<a href="<?php echo esc_url($author_url); ?>">
		<?php endif; ?>
		<i class="fa fa-user"></i> <?php echo get_the_author(); ?>
		<?php if ($author_url): ?>
			</a>
		<?php endif; ?>
	<?php endif; ?>
		
	<?php if (rhythm_check_if_meta_enabled('categories',$meta)): ?>
		<span class="separator">&nbsp;</span>
		<i class="fa fa-folder-open"></i>
		<?php echo get_the_category_list( ', ' );?>
	<?php endif; ?>
	
	<?php if (rhythm_check_if_meta_enabled('comments',$meta)): ?>
		<span class="separator">&nbsp;</span>
		<a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?php comments_number( __('No comments', 'rhythm'), __('1 Comment','rhythm'), __('% Comments', 'rhythm') ); ?></a>
	<?php endif; ?>
</div>