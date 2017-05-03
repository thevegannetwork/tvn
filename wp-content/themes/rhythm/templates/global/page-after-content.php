<?php 
/**
 * Content wrapper presented after the loop (eg. used in page.php)
 * 
 * @package Rhythm
 */

$layout = rhythm_get_layout();

if ($layout == 'left_sidebar'): ?>
		</div>
	</div><!-- .row -->
<?php elseif ($layout == 'right_sidebar'): ?>
		</div>
		<?php get_sidebar(); ?>
	</div><!-- .row -->
<?php endif; ?>
