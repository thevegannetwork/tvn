<?php

/*
  Plugin Name: Newsletter - Facebook
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter/facebook-module
  Description: Add the one click subscription using the Facebook connect. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 4.0.3
  Author: Stefano Lissa
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

if (!defined('NEWSLETTER_EXTENSION')) {
    define('NEWSLETTER_EXTENSION', true);
}

class NewsletterFacebook {

    /**
     * @var NewsletterFacebook
     */
    static $instance;
    var $prefix = 'newsletter_facebook';
    var $slug = 'newsletter-facebook';
    var $plugin = 'newsletter-facebook/facebook.php';
    var $id = 55;
    var $options;

    function __construct() {
        self::$instance = $this;
        $this->options = get_option($this->prefix, array());
        add_action('init', array($this, 'hook_init'));
    }

    function hook_init() {
        if (!class_exists('Newsletter')) {
            return;
        }

        add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));

        if (is_admin()) {
            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            add_filter('newsletter_menu_subscription', array($this, 'hook_newsletter_menu_subscription'));
        }
        add_filter('newsletter_replace', array($this, 'hook_replace'), 10, 3);
        if (!is_admin()) {
            add_action('wp_head', array($this, 'hook_wp_head'), 99);
        }
    }

    function hook_newsletter_menu_subscription($entries) {
        $entries[] = array('label' => '<i class="fa fa-facebook"></i> Facebook', 'url' => '?page=newsletter_facebook_index', 'description' => 'Single click signup with Facebook');
        return $entries;
    }

    function hook_admin_menu() {       
        add_submenu_page('newsletter_main_index', 'Facebook', '<span class="tnp-side-menu">Facebook</span>', 'manage_options', 'newsletter_facebook_index', array($this, 'menu_page_index'));
    }

    function menu_page_index() {
        global $wpdb;
        require dirname(__FILE__) . '/index.php';
    }

    function hook_site_transient_update_plugins($value) {
        if (!method_exists('Newsletter', 'set_extension_update_data')) {
            return $value;
        }

        return Newsletter::instance()->set_extension_update_data($value, $this);
    }

    /**
     * @global Newsletter $newsletter
     */
    function hook_replace($text, $user_id, $email_id) {
        global $newsletter;
        $text = $newsletter->replace_url($text, 'FACEBOOK_URL', plugins_url($this->slug) . "/login.php");
        $label = 'Sign up with Facebook';
        if (!empty($this->options['button_label'])) {
            $label = $this->options['button_label'];
        }
        $text = str_replace('{facebook_button}', '<a href="' . plugins_url($this->slug) . '/login.php" class="newsletter-facebook-button">' . $label . '</a>', $text);
        return $text;
    }

    function hook_wp_head() {
        echo '<style>
            a.newsletter-facebook-button, a.newsletter-facebook-button:visited, a.newsletter-facebook-button:hover {
            display: inline-block;
            background-color: #3B5998;
            border-radius: 3px!important;
            color: #fff!important;
            text-decoration: none;
            font-size: 14px;
            padding: 7px!important;
            line-height: normal;
            margin: 0;
            border: 0;
            text-align: center;
            }
            </style>';
    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);
    }

}

new NewsletterFacebook();
