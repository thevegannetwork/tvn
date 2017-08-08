<?php

/*
  Plugin Name: Newsletter - Contact Form 7
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter/archive-module
  Description:
  Version: 4.0.9
  Author: The Newsletter Team
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

defined('ABSPATH') || exit;

if (!defined('NEWSLETTER_EXTENSION')) {
    define('NEWSLETTER_EXTENSION', true);
}

class NewsletterCF7 {

    /**
     * @var NewsletterCF7
     */
    static $instance;
    var $prefix = 'newsletter_cf7';
    var $slug = 'newsletter-cf7';
    var $plugin = 'newsletter-cf7/cf7.php';
    var $id = 61;
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

        // Max priority to be axctive before the redirect plugin "Contact Form 7 - Success Page Redirects"
        add_action('wpcf7_mail_sent', array($this, 'hook_wpcf7_mail_sent'), 1);
    }

    function hook_newsletter_menu_subscription($entries) {
        $entries[] = array('label' => '<i class="fa fa-pencil-square-o"></i> Contact Form 7', 'url' => '?page=newsletter_cf7_index', 'description' => 'Collect subscriptions with CF7');
        return $entries;
    }

    var $current_form_id = null;

    /**
     * 
     * @param WPCF7_ContactForm $form
     */
    function hook_wpcf7_mail_sent($form) {

        $this->current_form_id = $form->id();

        $form_options = get_option('newsletter_cf7_' . $form->id(), null);
        if (empty($form_options))
            return;

        if (isset($_REQUEST[$form_options['newsletter']])) {
            $email = $_REQUEST[$form_options['email']];
            if (!NewsletterModule::is_email($email)) {
                return;
            }
            $_REQUEST['ne'] = $email;
            $_REQUEST['nr'] = 'cf7-' . $form->id();
            if (!empty($form_options['name']) && isset($_REQUEST[$form_options['name']])) {
                $_REQUEST['nn'] = stripslashes($_REQUEST[$form_options['name']]);
            }
            if (!empty($form_options['surname']) && isset($_REQUEST[$form_options['surname']])) {
                $_REQUEST['ns'] = stripslashes($_REQUEST[$form_options['surname']]);
            }
            
            // Gender
            if (!empty($form_options['gender'])) {
                $_REQUEST['nx'] = $_REQUEST[$form_options['gender']];
            }
            
            // Extra profiles
            for ($i = 1; $i <= NEWSLETTER_PROFILE_MAX; $i++) {
                if (empty($form_options['profile_' . $i])) {
                    continue;
                }
                $form_field = $form_options['profile_' . $i];
                if (!isset($_REQUEST[$form_field])) continue;
                if (is_array($_REQUEST[$form_field])) $value = $_REQUEST[$form_field][0];
                else $value = $_REQUEST[$form_field];
                $_REQUEST['np' . $i] = stripslashes($value);
            }
       
            $_REQUEST['nl'] = array();
            for ($i = 1; $i <= NEWSLETTER_LIST_MAX; $i++) {
                if (!isset($_REQUEST['list_' . $i])) continue;
                $_REQUEST['nl'][] = $i;
            }
            
            
            $user = NewsletterSubscription::instance()->subscribe();
            $user = array('id' => $user->id);
            for ($i = 1; $i <= NEWSLETTER_LIST_MAX; $i++) {

                if (empty($form_options['preferences_' . $i])) {
                    continue;
                }

                $user['list_' . $i] = 1;
            }
            // At least one list set?
            if (count($user) > 1) {
                
                NewsletterSubscription::instance()->save_user($user);
            }
        } else {
            
        }
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'CF7 Integration', '<span class="tnp-side-menu">CF7 Integration</span>', 'manage_options', 'newsletter_cf7_index', array($this, 'menu_page_index'));
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

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);
    }

}

new NewsletterCF7();
