<?php
/**
 * Initalize admin features
 * 
 * @package Rhythm
 */

require_once get_template_directory().'/extensions/font-awesome.php';

/**
 * Load custom admin styles
 */
function ts_load_custom_wp_admin_style() {
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), TS_THEME_VERSION, 'all' );
	wp_register_style( 'select2', get_template_directory_uri() . '/extensions/assets/css/select2.css', array(), TS_THEME_VERSION, 'all' );
	wp_register_style( 'admin-style', get_template_directory_uri() . '/extensions/assets/css/style.css', array(), TS_THEME_VERSION, 'all' );
	
	wp_enqueue_style('font-awesome' );
	wp_enqueue_style('select2' );
	wp_enqueue_style('admin-style' );
	wp_enqueue_style('thickbox');
}

add_action('admin_enqueue_scripts', 'ts_load_custom_wp_admin_style');

/**
 * Load custom admin styles
 */
function ts_load_custom_wp_admin_script() {
	
	wp_register_script( 'select2', get_template_directory_uri().'/extensions/assets/js/select2.min.js',array('jquery'),TS_THEME_VERSION,true);
	wp_register_script( 'admin-script', get_template_directory_uri().'/extensions/assets/js/script.js',array('jquery'),TS_THEME_VERSION,true);
	
	wp_enqueue_script( 'select2' );
	wp_enqueue_script('thickbox');
	wp_enqueue_script( 'admin-script' );
}

add_action('admin_enqueue_scripts', 'ts_load_custom_wp_admin_script');

/**
 * Create JS variable theme_url
 */
function ts_admin_head() {
	?>
	<script type="text/javascript">
		var theme_url = '<?php echo esc_url(get_template_directory_uri()); ?>';
		var admin_ajax_url = '<?php echo admin_url('admin-ajax.php' ); ?>';
		var import_url = '<?php echo admin_url('import.php?import_sample_data='.wp_create_nonce( 'importer_sample_data' )); ?>';
	</script>
	<?php
}
add_action('admin_head', 'ts_admin_head');

/**
 * Get custom sidebars list
 * @return array
 */
function ts_get_custom_sidebars_list($add_default = true) {
	
	$sidebars = array();
	if ($add_default) {
		$sidebars['default'] = __('Default', 'rhythm');
	}
	
	$options = get_option('ts_theme_options');
	
	if (!isset($options['custom-sidebars']) || !is_array($options['custom-sidebars'])) {
		return $sidebars;
	}
	
	if (is_array($options['custom-sidebars'])) {
		foreach ($options['custom-sidebars'] as $sidebar) {
			$sidebars[sanitize_title ( $sidebar )] = $sidebar; 
		}
	}
	
	return $sidebars;
}
