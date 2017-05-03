<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Rhythm
 */

if ( ts_get_opt( 'enable-under-construction' ) == 1 && !current_user_can('level_10') ) : else:
	ts_get_footer_template_part();
endif;

?>
</div>
<!-- End Page Wrap -->
<?php wp_footer(); ?>
</body>
</html>
