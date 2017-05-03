<?php
/**
 * The template displaying post content inside other templates from page-templates folder
 *
 * @package Rhythm
 */

if (get_the_content()): //show page content if not empty 
	$oArgs = ThemeArguments::getInstance('templates/global/inner-page'); ?>
	<div class="<?php echo ($oArgs -> get('add_inner_page_container') === true ? 'container' : ''); ?> inner-section">
		<?php get_template_part('templates/content/content', 'page'); ?>
	</div>
<?php endif; ?>
