<?php
/*
 * Import/Export Section
*/

$button = '';

if (rhythm_check_if_wordpress_importer_activated()) {
	
	$max_execution_time = null;
	if (function_exists('ini_get')) {
		$max_execution_time = ini_get('max_execution_time');
		
	}
	
	if ($max_execution_time != null && $max_execution_time < 500) {
		$execution_time = sprintf(esc_html__('Your script maximum execution time is set to %d seconds. It may be not enough for import to succeed. Suggested value is 500 seconds.', 'rhythm'),$max_execution_time);
	} else {
		$execution_time = esc_html__('Before running import check script maximum execution time. Suggested value is 500 seconds. Lower value may be not enough for import to succeed', 'rhythm');
	}
	
	$importer_message = '
		<p class="description">
			'.esc_html__('Import sample data including posts, pages, portfolio items, theme options, images, sliders etc. It may take severals minutes!', 'rhythm').'
			<br/><br/>
			'.$execution_time.'
		</p>';
	
	$button = '
		<p>
			<span id="import-sample-data" class="button button-primary">'.esc_html__('Import', 'rhythm').'</span>
			<span class="hidden" id="import-sample-data-confirm">'.esc_html__('Do you want to continue? Your data will be lost!', 'rhythm').'</span>

			'.(get_option('rhythm_import_started') == 1 ? '
				<span id="reset-importer-status" class="button button-primary">'.esc_html__('Reset Status', 'rhythm').'</span>' : '').'
				<span class="hidden" id="reset-importer-status-confirm">'.esc_html__('Do you want to continue? If you already imported sample data some theme features WILL NOT WORK CORRECTLY for imported post, pages, portfolio and other items!', 'rhythm').'</span>
				<span class="hidden" id="reset-importer-status-done">'.esc_html__('Done','rhythm').'</span>
		</p>
		<div id="import-sample-data-log" class="hidden"><div>';
	
} else {
	$plugin_slug = 'wordpress-importer';
	
	if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
		// Looks like Importer is installed, But not active
		$plugins = get_plugins( '/' . $plugin_slug );
		if ( !empty($plugins) ) {
			$keys = array_keys($plugins);
			$plugin_file = $plugin_slug . '/' . $keys[0];
			$action = '<a href="' . esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $plugin_file), 'activate-plugin_' . $plugin_file)) .
									'"title="' . esc_attr__('Activate importer', 'rhythm') . '"">' . esc_html__('Activate Wordpress Importer', 'rhythm') . '</a>';
		}
	}
	if ( empty($action) ) {
		if ( is_main_site() ) {
			$action = '<a href="' . esc_url( network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $plugin_slug .
								'&TB_iframe=true&width=600&height=550' ) ) . '" class="thickbox" title="' .
								esc_attr__('Install importer', 'rhythm') . '">' . esc_html__('Install Wordpress Importer', 'rhythm') . '</a>';
		} 

	}
	
	$importer_message = esc_html__('Wordpress Importer plugin must be installed and activated to import sample data.', 'rhythm').' '.$action;
}

$fields = array(
		
	array(
		'id' => 'section-start',
		'type' => 'section',
		'title' => esc_html__('Import Sample Data', 'rhythm'),
		'indent' => true 
	),

	array(
		'id' => 'opt-import-message',
		'type' => 'raw',
		'content' => $importer_message,
	)
);

if ($button) {
	$fields[] = array(
		'id'=>'opt-import-template',
		'type' => 'select',
		'title' => esc_html__('Template', 'rhythm'),
		'subtitle'=> esc_html__('Choose template to import.', 'rhythm'),
		'options' => array(
			'default'             => esc_html__( 'Default', 'rhythm' ),	
			'barber'              => esc_html__( 'Barber', 'rhythm' ),
			'coming-soon'         => esc_html__( 'Coming Soon classic menu', 'rhythm' ),
			'coming-soon-2'       => esc_html__( 'Coming Soon fullscreen menu', 'rhythm' ),
			'construction'        => esc_html__( 'Construction', 'rhythm' ),
			'construction-2'      => esc_html__( 'Construction 2', 'rhythm' ),
			'construction-3'      => esc_html__( 'Construction 3', 'rhythm' ),
			'cv-resume'           => esc_html__( 'CV Resume', 'rhythm' ),
			'fashion'             => esc_html__( 'Fashion', 'rhythm' ),
			'finance'             => esc_html__( 'Finance', 'rhythm'),
			'finance-multi'       => esc_html__( 'Finance Multi', 'rhythm' ),
			'landing-page'        => esc_html__( 'Landing Page', 'rhythm' ),
			'landing-page-2'      => esc_html__( 'Landing Page 2', 'rhythm' ),
			'magazine'            => esc_html__( 'The Rhythm Magazine', 'rhythm' ),
			'magazine-2'          => esc_html__( 'The Rhythm Magazine 2', 'rhythm' ),
			'photography'         => esc_html__( 'Photography', 'rhythm' ),
			'photography-sidebar' => esc_html__( 'Photography with Sidebar', 'rhythm' ),
			'presto'              => esc_html__( 'Presto', 'rhythm' ),
			'product-designer'    => esc_html__( 'Product Designer' ),
			'restaurant'          => esc_html__( 'Restaurant', 'rhythm' ),
			'restaurant-multi'    => esc_html__( 'Restaurant Multi', 'rhythm' ),
		),
		'default' => 'default',
		'validate' => 'not_empty',
	);

	$fields[] = array(
		'id'            => 'opt-import-sample-data-button',
		'type'			=> 'raw',
		'content'		=> $button,
	);
}

$fields[] = array(
	'id' => 'section-end',
	'type' => 'section',
	'indent' => false 
);

$fields[] = array(
	'id'            => 'opt-import-export',
	'type'          => 'import_export',
	'title'         => esc_html__('Import Export', 'rhythm'),
	'subtitle'      => esc_html__('Save and restore your Redux options', 'rhythm'),
	'full_width'    => false,
);

$this->sections[] = array(
	'title' => esc_html__('Import/Export', 'rhythm'),
	'desc' => esc_html__('Import/Export Options', 'rhythm'),
	'icon' => 'el-icon-arrow-down',
	'fields' => $fields
);