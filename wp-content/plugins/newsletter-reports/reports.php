<?php

/*
  Plugin Name: Newsletter - Reports
  Plugin URI: http://www.thenewsletterplugin.com/
  Description: Extends the statistic viewer adding graphs, link clicks, export and many other data. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 4.1.4
  Author: The Newsletter Team
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

if (!defined('NEWSLETTER_EXTENSION')) {
    define('NEWSLETTER_EXTENSION', true);
}

class NewsletterReports {

    var $prefix = 'newsletter_reports';
    var $slug = 'newsletter-reports';
    var $plugin = 'newsletter-reports/reports.php';
    var $id = 50;
    var $options;
    var $min_core_version = '4.9.1';

    /**
     * @return NewsletterReports
     */
    static $instance;

    function __construct() {
        self::$instance = $this;
        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix, array());
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
    }
    
    function hook_deactivation() {
        wp_clear_scheduled_hook('newsletter_reports_country');
    }

    function hook_newsletter_users_edit_general($id, $controls) {
        include __DIR__ . '/users/edit-general.php';
    }

    function hook_init() {

        if (!class_exists('Newsletter')) {
            return;
        }

        add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));

        if (is_admin()) {
            
            if (version_compare(NEWSLETTER_VERSION, $this->min_core_version, '<')) {
                add_action('admin_notices', array($this, 'hook_admin_notices'));
            }

            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);

            add_filter('newsletter_statistics_view', array($this, 'hook_newsletter_statistics_view'));

            add_action('newsletter_users_edit_newsletters', array($this, 'hook_newsletter_users_edit_newsletters'));
            add_action('newsletter_statistics_index_map', array($this, 'hook_newsletter_statistics_index_map'));

            add_action('newsletter_statistics_settings_countries', array($this, 'hook_newsletter_statistics_settings_countries'));

            add_action('newsletter_users_edit_general', array($this, 'hook_newsletter_users_edit_general'), 10, 2);

            add_action('newsletter_users_statistics_countries', array($this, 'hook_newsletter_users_statistics_countries'));
            add_action('newsletter_users_statistics_time', array($this, 'hook_newsletter_users_statistics_time'));
            add_action('newsletter_statistics_view', array($this, 'hook_newsletter_statistics_view'));
            add_action('newsletter_statistics_view_retarget', array($this, 'hook_newsletter_statistics_view_retarget'));
            add_action('newsletter_statistics_view_urls', array($this, 'hook_newsletter_statistics_view_urls'));
            add_action('newsletter_statistics_view_users', array($this, 'hook_newsletter_statistics_view_users'));

            add_action('wp_ajax_newsletter_reports_export', array($this, 'hook_wp_ajax_newsletter_reports_export'));
        }

    }
    
    function hook_admin_notices() {
        echo '<div class="notice notice-error">
            <p>This extension requires a Newsletter updated version, <a href="' . admin_url('plugins.php') . '">please update</a>.</p>
        </div>';
    }

    function hook_wp_ajax_newsletter_reports_export() {
        global $wpdb;
        
        $email_id = (int) $_GET['email_id'];

        header('Content-Type: application/octect-stream;charset=UTF-8');
        header('Content-Disposition: attachment; filename=newsletter-' . $email_id . '.csv');

        echo '"Subscriber ID";"Email";"Name";"Surname";"Sex";"Open";"URL"';
        echo "\n";

        $page = 0;
        while (true) {
            $users = $wpdb->get_results($wpdb->prepare("select distinct u.id, u.email, u.name, u.surname, u.sex, t.open as sent_open, s.url from " . NEWSLETTER_USERS_TABLE . " u
    join " . NEWSLETTER_SENT_TABLE . " t on t.user_id=u.id and t.email_id=%d
        left join " . NEWSLETTER_STATS_TABLE . " s on u.id=s.user_id and s.email_id=%d
        order by u.id limit " . $page * 500 . ",500", $email_id, $email_id));

            if (!empty($wpdb->last_error)) {
                die($wpdb->last_error);
            }

            for ($i = 0; $i < count($users); $i++) {
                echo '"' . $users[$i]->id;
                echo '";"';
                echo $users[$i]->email;
                echo '";"';
                echo $this->sanitize_csv($users[$i]->name);
                echo '";"';
                echo $this->sanitize_csv($users[$i]->surname);
                echo '";"';
                echo $users[$i]->sex;
                echo '";"';
                echo $users[$i]->sent_open == 0 ? '0' : '1';
                echo '";"';
                echo $this->sanitize_csv($users[$i]->url);
                echo '"';
                echo "\n";
                flush();
            }
            if (count($users) < 500) {
                break;
            }
            $page++;
        }
        die('');
    }

    function sanitize_csv($text) {
        $text = str_replace('"', "'", $text);
        $text = str_replace("\n", ' ', $text);
        $text = str_replace("\r", ' ', $text);
        $text = str_replace(";", ' ', $text);
        return $text;
    }


    function hook_newsletter_users_statistics_countries() {
        global $wpdb;
        include __DIR__ . '/users/statistics-countries.php';
    }

    function hook_newsletter_statistics_settings_countries($controls) {
        global $wpdb;
        include __DIR__ . '/statistics/settings-countries.php';
    }

    function hook_newsletter_users_statistics_time() {
        global $wpdb;
        include __DIR__ . '/users/statistics-time.php';
    }

    function hook_newsletter_statistics_index_map() {
        include __DIR__ . '/statistics/index-map.php';
    }

    function hook_newsletter_users_edit_newsletters($user_id) {
        global $wpdb;
        include __DIR__ . '/users/edit-newsletters.php';
    }

    function hook_site_transient_update_plugins($value) {
        if (!method_exists('Newsletter', 'set_extension_update_data')) {
            return $value;
        }

        return Newsletter::instance()->set_extension_update_data($value, $this);
    }

    function hook_admin_menu() {
        $newsletter = Newsletter::instance();
        $capability = ($newsletter->options['editor'] == 1) ? 'manage_categories' : 'manage_options';
        add_submenu_page(null, 'Report', 'Report', $capability, 'newsletter_reports_view', array($this, 'hook_newsletter_reports_view'));
        add_submenu_page(null, 'Users', 'Users', $capability, 'newsletter_reports_view_users', array($this, 'hook_newsletter_reports_view_users'));
        add_submenu_page(null, 'URLs', 'URLs', $capability, 'newsletter_reports_view_urls', array($this, 'hook_newsletter_reports_view_urls'));
        add_submenu_page(null, 'Retarget', 'Retarget', $capability, 'newsletter_reports_view_retarget', array($this, 'hook_newsletter_reports_view_retarget'));
    }

    function menu_page_index() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/index.php';
    }

    function hook_newsletter_reports_view() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/view.php';
    }

    function hook_newsletter_reports_view_users() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/view-users.php';
    }

    function hook_newsletter_reports_view_urls() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/view-urls.php';
    }

    function hook_newsletter_reports_view_retarget() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/view-retarget.php';
    }

    function hook_newsletter_statistics_view($page) {
        return 'newsletter_reports_view';
    }

    function save_last_run($time) {
        update_option($this->prefix . '_last_run', $time);
    }

    function get_last_run() {
        return get_option($this->prefix . '_last_run', 0);
    }

}

new NewsletterReports();
