<?php
/**
 *
 * RS Footer Social
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_footer_social( $atts, $content = '', $id = '' ) { 
	
	ob_start();
?>

	<div class="footer-social-links">
	<?php echo rhythm_social_links( '%s', ts_get_opt( 'footer-social-icons-category' ) ); ?>
	</div>

<?php
	
	$output = ob_get_contents();
	ob_end_clean();  
	return $output;
}
add_shortcode('rs_footer_social', 'rs_footer_social');
