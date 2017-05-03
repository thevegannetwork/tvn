<?php
if (!defined( 'ABSPATH' )) {
	die( 'You cannot access this script directly' );
}

add_action( 'admin_init', 'rhythm_importer_init' );
add_action( 'wp_ajax_refresh_import_log', 'rhythm_refresh_import_log' );
add_action( 'wp_ajax_reset_importer_status', 'rhythm_reset_import_status' );

/**
 * Check if wordpress importer is activated
 * @return boolean
 */
function rhythm_check_if_wordpress_importer_activated() {
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ) {
		return true;
	}
	
	return false;
}

/**
 * Enqueue importer scripts if not enqueued
 */
function rhythm_importer_script() {
	
	 $screen = get_current_screen();
	 
	
	if ($screen -> id == 'appearance_page__options') { 
		add_thickbox();
		wp_enqueue_script( 'plugin-install' );
	}
}

if (!rhythm_check_if_wordpress_importer_activated()) {
	add_action('admin_enqueue_scripts', 'rhythm_importer_script');
}

/**
 * Importer init
 */
function rhythm_importer_init() {
	
	if (isset($_GET['import_sample_data'])) {
		
		if (wp_verify_nonce( $_GET['import_sample_data'], 'importer_sample_data' )) {		
			try {
				
				$importer = new rhythm_importer;

				if ($importer -> init(isset($_GET['template'])? $_GET['template'] : '' )) {		
					//nothing to do
				}
	
			} catch (Exception $e) {

				$importer -> log('ERROR - '.$e->getMessage());
			}
			
			die();
		} 
		die('Importer - Not valid nonce');	
	}
}

/**
 * Refresh import log
 */
function rhythm_refresh_import_log() {
	
	$importer = new rhythm_importer;
	
	$log_check = $importer -> get_log();
	//don't add message if ERROR was found, JS script is going to stop refreshing
	if (strpos($log_check,'ERROR') === false) { 
		$importer -> log('MESSAGE - Import in progress...');
	}
	$log = $importer -> get_log();
	echo nl2br($log);
	die();
}

/**
 * Reset importer status
 */
function rhythm_reset_import_status() {
	delete_option('rhythm_import_started');
	die();
}

class rhythm_importer {
	
	/**
	 * Import starts if initiated and value is true, otherwise does not start
	 * @var bool 
	 */
	var $import = false;
	
	/**
	 * Template folder name
	 * @var string 
	 */
	var $template = '';
	
	/**
	 * Template path
	 * @var string 
	 */
	var $template_path = '';
	
	/**
	 * Revolution slider UniteDBRev class object
	 * @var object
	 */
	var $db = null;
	
	/**
	 * Construct
	 */
	public function __construct() {
		
		if ( current_user_can( 'manage_options' ) ) {
			$this -> import = true;
			
			if ( !defined('WP_LOAD_IMPORTERS') ) {
				define('WP_LOAD_IMPORTERS', true); 
			}
		}
	}
	
	/**
	 * Init importer
	 * @return boolean false if import failed
	 */
	public function init($template = '') {
		
		if ($this -> import !== true) {
			return false;
		}
		
		$this -> log('', false);
		
		$this -> template = $template;
		
		$this -> log('NOTICE - '.$this -> template);
		
		if (!empty($this -> template)) {
			$this -> template_path = get_template_directory() . '/sample-data/'.$this -> template.'/';
		}
			
		if (empty($this -> template_path)) {
			$this -> template_path = get_template_directory() . '/sample-data/';
		}
		
		$this -> log('NOTICE - '.$this -> template_path);
		
		
		if (get_option('rhythm_import_started') == 1) {
			$this -> log('ERROR - Import already started. You can\'t import sample data again. Please use fresh Wordpress installation or refresh this page and reset import using "Reset Status" button.');
			return false;
		}
		
		if (!class_exists('DOMDocument')) {
			$this -> log('ERROR - DOMDocument class doesn\'t exists. PHP extension libxml is required. Please contact your server administrator.');
			return false;
		}
		
		if (!$this -> include_files()) {
			$this -> log('ERROR - Importer can\'t load required files');
			return false;
		}
		
		//check if required importer classes exist
		if (!class_exists('WP_Import')) {
			
			$this -> log('ERROR - Wordpress Importer plugin must be installed and activated');
			return false;
		}
		
		if (function_exists('ini_get')) {
			$max_execution_time = ini_get('max_execution_time');
			if ($max_execution_time < 500) {
				$this -> log('NOTICE - Your script maximum execution time is set to '.$max_execution_time.' seconds. It may be not enough for import to succeed. Suggested value is 500 seconds.');
			}
		}
		
		$this -> log('MESSAGE - Import initialized!');
		
		if( class_exists('Woocommerce') ) {
			$this -> import('data.xml');
			$this -> set_woocommerce();
			
		} else {
			$this -> import('data.xml');
		}
		
		$this -> set_menus();		
		$this -> import_theme_options();
		$this -> import_widgets();		
		$this -> set_reading_options();
		return true;
	}
	
	/**
	 * Include requried classes
	 * @return boolean true if all required files are included, false otherwise
	 */
	protected function include_files() {
		
		if (!class_exists( 'WP_Importer')) {
            include_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        }

        //check if required importer classes exist
		if (!class_exists('WP_Importer')) {
			return false;
		}
		return true;
	}
	
	/**
	 * Import file with data including posts, pages, comments, custom fields, terms, navigation menus and custom posts and settings
	 * @param string file name to import eg. data.xml or data_woocommerce.xml
	 * @return boolean
	 */
	protected function import($file) {
		
		$importer = new WP_Import();
        
		$xml = $this -> template_path.$file;
		
		if (!file_exists($xml)) {
			$this -> log('ERROR - data.xml file not found');
			throw new Exception(sprintf(esc_html__('File %s not found.','splendid'),$xml).' <br/><strong>'.esc_html__('Import stopped!','splendid').'</strong>');
		}
		
		$importer->fetch_attachments = true;
			
		ob_start();
		$this -> log('MESSAGE - data.xml import started');
		update_option('rhythm_import_started',1);
		$importer->import($xml);
		ob_end_clean();
		$this -> log('MESSAGE - data.xml import completed');
		return true;
	}
	
	/**
	 * Set woocommerce pages
	 * @return boolean
	 */
	protected function set_woocommerce() {
		
		global $wpdb;
		
		$pages = array(
			'woocommerce_shop_page_id' => 'shop',
			'woocommerce_cart_page_id' => 'cart',
			'woocommerce_checkout_page_id' => 'checkout',
			'woocommerce_myaccount_page_id' => 'my-account',
			'woocommerce_lost_password_page_id' => 'lost-password',
			'woocommerce_edit_address_page_id' => 'edit-address',
			'woocommerce_view_order_page_id' => 'view-order',
			'woocommerce_change_password_page_id' => 'change-password',
			'woocommerce_logout_page_id' => 'logout',	
			'woocommerce_pay_page_id' => 'pay',
			'woocommerce_thanks_page_id' => 'order-received'
		);
		$this -> log('MESSAGE - saving woocommerce settings.');
		foreach($pages as $page_key => $slug) {
			
			$page = $wpdb -> get_row($wpdb -> prepare('SELECT * FROM '.$wpdb -> posts.' WHERE post_name= %s', $slug));
			if(isset( $page->ID ) && $page->ID) {
				update_option($page_key, $page->ID);
			}
		}
		
		// We no longer need to install pages
		delete_option( '_wc_needs_pages' );
		delete_transient( '_wc_activation_redirect' );
		$this -> log('MESSAGE - woocommerce settings saved.');
		// Flush rules after install
		flush_rewrite_rules();
		return true;
	}
	
	/**
	 * Set menus
	 * @return boolean
	 */
	protected function set_menus() {
		
		$registered_menus = get_registered_nav_menus();
		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		
		if ($registered_menus && $menus) {
			foreach ($registered_menus as $registered_menu_key => $registered_menu) {
				foreach ($menus as $menu) {
					
					if (stristr($menu->slug,$registered_menu_key)) {
						
						if (!is_array($locations)) {
							$locations = array();
						}
						
						$locations[$registered_menu_key] = $menu -> term_id;
					}
				}
			}
			set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations
			$this -> log('MESSAGE - menu location set.');
		}
		return true;
	}
	
	/**
	 * Import theme options
	 * @return boolean
	 */
	protected function import_theme_options() {

		$reduxConfig = new rhythm_Redux_Framework_config();
			
		$redux = $reduxConfig -> ReduxFramework;
	
		$import_json = rhythm_read_file( $this -> template_path, 'redux.json');
		
		$import_data = get_option(REDUX_OPT_NAME);
		
		if (!is_array($import_data)) {
			return false;
		}
		
		$import_data['import'] = 'Import';
		$import_data['import_code'] = $import_json;

		$data = $redux-> _validate_options( $import_data );
		
		if (is_array($data)) {
			
			$basedir = '';
			$upload_dir = wp_upload_dir();
			if (isset($upload_dir['basedir'])) {
				$basedir = $upload_dir['basedir'];
			}
			
			foreach ($data as $key => $item) {
				if (is_array($item)) {
					
					//upload image from url field
					if (isset($item['url']) && !empty($item['url'])) {
						
						//skip images already downloaded (it should rather not happen)
						if (strstr($item['url'], $basedir)) {
							continue;
						}
						
						$id = $this -> import_image($item['url']);
						if ($id !== false) {
						
							$image = wp_get_attachment_image_src( $id, 'full' );
							
							if (is_array($image) && !is_wp_error($image)) {
								
								$data[$key]['url'] = $image[0];
								$data[$key]['id'] = $id;
								$data[$key]['height'] = $image[2];
								$data[$key]['width'] = $image[1];

								$thumb = wp_get_attachment_image_src( $id, 'thumbnail' );
								if (is_array($thumb) && !is_wp_error($thumb)) {
									$data[$key]['thumbnail'] = $thumb[0];
								}
							}
						}
					}
					
					//upload image from background-image field
					if (isset($item['background-image']) && !empty($item['background-image'])) {
						
						//skip images already downloaded (it should rather not happen)
						if (strstr($item['background-image'], $basedir)) {
							continue;
						}
						
						$id = $this -> import_image($item['background-image']);
						if ($id !== false) {
						
							$image = wp_get_attachment_image_src( $id, 'full' );
							if (is_array($image) && !is_wp_error($image)) {
								$data[$key]['background-image'] = $image[0];
								
								$data[$key]['media'] = array();
								$data[$key]['media']['id'] = $id;
								$data[$key]['media']['height'] = $image[2];
								$data[$key]['media']['width'] = $image[1];

								$thumb = wp_get_attachment_image_src( $id, 'thumbnail' );
								if (is_array($thumb) && !is_wp_error($thumb)) {
									$data[$key]['media']['thumbnail'] = $thumb[0];
								}
							}
						}
					}
				}
			}
		}
		
		$this -> log('MESSAGE - saving redux settings.');
		if ( ! empty( $data ) ) {
			$redux -> set_options( $data );
			$this -> log('MESSAGE - redux settings saved.');
		} else {
			$this -> log('ERROR - redux settings empty.');
		}
		
		return true;
	}
	
	/**
	 * Import image to media library
	 * @param string $url
	 * @return boolean
	 */
	protected function import_image($url) {
		
		$tmp = download_url( $url );
		$file_array = array(
			'name' => basename( $url ),
			'tmp_name' => $tmp
		);

		// Check for download errors
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array[ 'tmp_name' ] );
			return false;
		}

		$id = media_handle_sideload( $file_array, 0 );
		
		// Check for handle sideload errors.
		if ( is_wp_error( $id ) ) {
			@unlink( $file_array['tmp_name'] );
			return false;
		}
		return $id;
	}
	
	/**
	 * Import widgets
	 * Thanks to http://wordpress.org/plugins/widget-settings-importexport/
	 * @return boolean
	 */
	protected function import_widgets() {

		$widget_data_json = rhythm_read_file( $this -> template_path, 'widget_data.json');
		
		$import_array = json_decode($widget_data_json, true);
		
		if (!is_array($import_array)) {
			return false;
		}
		
		$this -> log('MESSAGE - widgets import started.');
		
		$sidebars_data = $import_array[0];
		$widget_data = $import_array[1];
		$current_sidebars = get_option( 'sidebars_widgets' );
		
		if (is_array($GLOBALS['wp_registered_sidebars'])) {
			foreach ($GLOBALS['wp_registered_sidebars'] as $key => $sidebar) {
				
				if (!isset($current_sidebars[$key])) {
					$current_sidebars[$key] = array();
				}
			}
		}
		
		//fix nav_menu widget IDs
		if (isset($widget_data['nav_menu'])) {
			
			$menus = wp_get_nav_menus(array('orderby' => 'name'));
			
			foreach ($widget_data['nav_menu'] as $widget_key => $widget_menu) {
				
				if (is_array($menus) && !is_wp_error($menus)) {
					foreach ($menus as $menu_key => $menu) {
						if (isset($widget_menu['title'])) {
							if ($widget_menu['title'] == $menu -> name) {
								$widget_data['nav_menu'][$widget_key]['nav_menu'] = $menu -> term_id;
							}
						}
					}
				}
				
			}
		}
		
		$new_widgets = array( );

		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :
			
			foreach ( $import_widgets as $import_widget ) :
				//if the sidebar exists
				if ( isset( $current_sidebars[$import_sidebar] ) ) :
					
					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					$current_widget_data = get_option( 'widget_' . $title );
					
					$new_widget_name =  $this -> get_new_widget_name( $title, $index );
					
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = $current_widget_data['_multiwidget'];
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $new_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				endif;
			endforeach;
		endforeach;
		
		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );
			
			foreach ( $new_widgets as $title => $content ) {
				$content = apply_filters( 'widget_data_import', $content, $title );
				update_option( 'widget_' . $title, $content );
			}
			$this -> log('MESSAGE - widgets import completed.');
			return true;
		}
		$this -> log('NOTICE - widget import not completed.');
		return false;
	}
	
	/**
	 *
	 * @param string $widget_name
	 * @param string $widget_index
	 * @return string
	 */
	public static function get_new_widget_name( $widget_name, $widget_index ) {
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}

	/**
	 * Set reading options
	 * @global type $wpdb
	 * @return boolean
	 */
	protected function set_reading_options() {
		
		global $wpdb;
		
		$homepage = $wpdb -> get_row('
			SELECT 
				* 
			FROM 
				'.$wpdb -> posts.' 
			WHERE 
				post_type="page" AND 
				post_status="publish" AND
				post_name IN ("home", "homepage") ');
		$this -> log('MESSAGE - Setting home page');
		if(isset( $homepage ) && $homepage->ID) {
			update_option('show_on_front', 'page');
			update_option('page_on_front', $homepage->ID);
			
			$this -> log('MESSAGE - Home page set');
		} else {
			$this -> log('NOTICE - Home page couldn\'t be set.');
		}
		return true;
	}

		/**
	 * Download images
	 * @param type $data
	 * @return type
	 */
	protected function download_images($data) {
		
		if (is_array($data)) {
			foreach ($data as $key => $val) {
				$data[$key] = $this -> download_images($val);
			}
		} else {
			
			$image_exp = '!http://[a-z0-9\-\.\/]+\.(?:jpe?g|png|gif)!Ui';
			
			if (preg_match_all($image_exp , $data , $matches)) {
				
				if (isset($matches[0]) && is_array($matches[0])) {
					foreach ($matches[0] as $match) {
						
						$new_image = media_sideload_image( $match, null );
						
						if (!is_wp_error($new_image)) {
							
							//$new_image is html tag img, we need to retrieve src attribute
							$dom = new DOMDocument();
							$dom -> loadHTML($new_image);
							$imageTags = $dom->getElementsByTagName('img') -> item(0);
							$data = $imageTags->getAttribute('src');
						}
					}
				}
			}
		}
		return $data;
	}
	
	/**
	 * Log message
	 * @param string $message
	 * @param boolean $append
	 */
	public function log($message, $append = true) {
		$upload_dir = wp_upload_dir();
		if (isset($upload_dir['baseurl'])) {
			
			$data = '';
			if (!empty($message)) {
				$data = date("Y-m-d H:i:s").' - '.$message."\n";
			}
			rhythm_write_file($upload_dir['basedir'].'/', 'importer.log', $data, $append); 
		}
	}
	
	/**
	 * Get Log content
	 * @return string
	 */
	public function get_log() {
		$upload_dir = wp_upload_dir();
		if (isset($upload_dir['baseurl'])) {
			
			if (file_exists($upload_dir['basedir'].'/importer.log')) {
				return rhythm_read_file( $upload_dir['basedir'] . '/', 'importer.log');
			}
		}
		return '';
	}
}