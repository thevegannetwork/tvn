<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

		$plugins = array(
			array(
				'name'               => 'Rhythm Addons', // The plugin name.
				'slug'               => 'rhythm-addons', // The plugin slug (typically the folder name).
				'source'             => get_stylesheet_directory() . '/plugins/rhythm-addons.zip', // The plugin source.
				'required'           => true, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			),
			array(
				'name'               => 'WPBakery Visual Composer', // The plugin name
				'slug'               => 'js_composer', // The plugin slug (typically the folder name)
				'source'             =>  get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
				'required'           => true, // If false, the plugin is only 'recommended' instead of required
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'       => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'               => 'Revolution Slider WP',
				'slug'               => 'revslider',
				'required'           => false,
				'source'             => get_template_directory_uri().'/plugins/revslider.zip'
			),
			array(
				'name' => 'MailPoet Newsletters',
				'slug' => 'wysija-newsletters',
				'required' => false ,
			),
			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
		);

		$config = array(
				'domain'                => 'rhythm',            // Text domain - likely want to be the same as your theme.
				'default_path'          => '',                          // Default absolute path to pre-packaged plugins
				'parent_slug'           => 'plugins.php',               // Parent menu slug.
				'menu'                  => 'install-required-plugins',  // Menu slug
				'has_notices'           => true,                        // Show admin notices or not
				'is_automatic'          => false,                                               // Automatically activate plugins after installation or not
		);

		tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );
