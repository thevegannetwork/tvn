<?php

/*
  Plugin Name: Newsletter - Google Analytics
  Plugin URI: http://www.thenewsletterplugin.com/extensions/analytics
  Description: Adds Google Analytics tracking to the newsletter links
  Version: 1.0.2
  Author: The Newsletter Team
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

if (!defined('NEWSLETTER_EXTENSION')) {
    define('NEWSLETTER_EXTENSION', true);
}

class NewsletterAnalytics {

    /**
     * @var NewsletterAnalytics
     */
    static $instance;
    var $prefix = 'newsletter_analytics';
    var $slug = 'newsletter-analytics';
    var $plugin = 'newsletter-analytics/analytics.php';
    var $id = 68;
    var $options;

    /* @var NewsletterLogger */
    var $logger;

    function __construct() {

        self::$instance = $this;

        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix);
        if (empty($this->options)) {
            $this->options = array('utm_source'=>'', 'utm_campaign'=>'', 'utm_mediun'=>'', 'utm_term'=>'', 'utm_content'=>'');
            update_option($this->prefix, $this->options);
        }
    }

    function hook_init() {
        if (!class_exists('Newsletter')) {
            return;
        }

        add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));
        add_filter('newsletter_redirect_url', array($this, 'hook_newsletter_redirect_url'), 10, 3);

        if (is_admin()) {
            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            add_filter('newsletter_menu_settings', array($this, 'hook_newsletter_menu_settings'));
            add_action('newsletter_emails_edit_other', array($this, 'hook_newsletter_emails_edit_other'), 10, 2);
        }
    }

    function hook_newsletter_menu_settings($entries) {
        $entries[] = array('label' => '<i class="fa fa-envelope-o"></i> Analytics', 'url' => '?page=newsletter_analytics_index', 'description' => 'Add Google Analytics tracking');
        return $entries;
    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);
    }

    function hook_site_transient_update_plugins($value) {
        if (!method_exists('Newsletter', 'set_extension_update_data')) {
            return $value;
        }

        return Newsletter::instance()->set_extension_update_data($value, $this);
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Analytics', '<span class="tnp-side-menu">Google Analytics</span>', 'manage_options', 'newsletter_analytics_index', array($this, 'menu_page_index'));
    }

    function menu_page_index() {
        global $wpdb;
        require dirname(__FILE__) . '/index.php';
    }

    /**
     * 
     * @return NewsletterLogger
     */
    function get_logger() {
        if ($this->logger) {
            return $this->logger;
        }
        $this->logger = new NewsletterLogger('analytics');
        return $this->logger;
    }

    /**
     * Fired on "other" panel while editing a newsletter.
     * 
     * @param type $email
     * @param NewsletterControls $controls
     */
    function hook_newsletter_emails_edit_other($email, $controls) {
        // Fill in with defaults
        if (!isset($controls->data['options_utm_source'])) {
            $controls->data['options_utm_source'] = $this->options['utm_source'];
            $controls->data['options_utm_medium'] = $this->options['utm_medium'];
            $controls->data['options_utm_campaign'] = $this->options['utm_campaign'];
            $controls->data['options_utm_term'] = $this->options['utm_term'];
            $controls->data['options_utm_content'] = $this->options['utm_content'];
        }
        include __DIR__ . '/email-options.php';
    }

    function hook_newsletter_redirect_url($url, $email, $user) {
        $logger = $this->get_logger();
        $logger->debug('Processing ' . $url);


        // Already tracked check
        if (strpos($url, 'utm_source') !== false) {
            $logger->debug('Already tracked with GA');
            return $url;
        }

        if (empty($email->options)) {
            $logger->debug('No analytics setting in this email');
            return $url;
        }

        if (!is_array($email->options)) {
            $email->options = unserialize($email->options);
        }

        if (empty($email->options['utm_source'])) {
            $logger->debug('Source not set');
            return $url;
        }

        // Track only our domain (?)
        if (strpos($url, $_SERVER['HTTP_HOST']) === false) {
            $logger->debug('External domain');
            return $url;
        }

        $query = 'utm_source=' . urlencode($this->replace($email->options['utm_source'], $email, $user));

        if (!empty($email->options['utm_medium'])) {
            $query .= '&utm_medium=' . urlencode($email->options['utm_medium']);
        }

        if (!empty($email->options['utm_campaign'])) {
            $query .= '&utm_campaign=' . urlencode($this->replace($email->options['utm_campaign'], $email, $user));
        }

        if (!empty($email->options['utm_term'])) {
            $query .= '&utm_term=' . urlencode($email->options['utm_term']);
        }

        if (!empty($email->options['utm_content'])) {
            $query .= '&utm_content=' . urlencode($email->options['utm_content']);
        }

        if (strpos($url, '?') !== false) {
            return $url . '&' . $query;
        } else {
            return $url . '?' . $query;
        }
    }

    function replace($text, $email, $user) {
        $text = str_replace('{email_id}', $email->id, $text);
        $text = str_replace('{email_subject}', urlencode($email->subject), $text);
        return $text;
    }

}

new NewsletterAnalytics();
