<?php

/*
  Plugin Name: Newsletter - Geo
  Plugin URI: http://www.thenewsletterplugin.com
  Description:
  Version: 1.0.2
  Author: Stefano Lissa
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

class NewsletterGeo {

    /**
     * @var NewsletterGeo
     */
    static $instance;
    var $prefix = 'newsletter_geo';
    var $slug = 'newsletter-geo';
    var $plugin = 'newsletter-geo/geo.php';
    var $id = 75;
    var $options;
    var $min_core_version = '4.9.1';

    function __construct() {
        self::$instance = $this;
        $this->options = get_option($this->prefix, array());
        add_action('init', array($this, 'hook_init'));
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
    }
    
    function hook_deactivation() {
        wp_clear_scheduled_hook('newsletter_geo_run');
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
            add_filter('newsletter_menu_subscribers', array($this, 'hook_newsletter_menu_subscribers'));
            add_action('newsletter_emails_edit_target', array($this, 'hook_newsletter_emails_edit_target'), 10, 2);
            add_action('newsletter_emails_email_query', array($this, 'hook_newsletter_emails_email_query'), 10, 2);
        }
        if (!defined('DOING_CRON') || !DOING_CRON) {
            if (wp_get_schedule('newsletter_geo_run') === false) {
                wp_schedule_event(time() + 60, 'newsletter', 'newsletter_geo_run');
            }
        }
        add_action('newsletter_geo_run', array($this, 'run'), 100);
    }
    
    function hook_admin_notices() {
        echo '<div class="notice notice-error">
            <p>This extension requires a Newsletter updated version, <a href="' . admin_url('plugins.php') . '">please update</a>.</p>
        </div>';
    }

    function hook_newsletter_emails_edit_target($email, $controls) {
        global $wpdb;
        include __DIR__ . '/email-options.php';
    }

    function hook_newsletter_emails_email_query($query, $email) {
        global $wpdb;
        if (!empty($email->options['countries'])) {
            $countries = array();
            foreach ($email->options['countries'] as $country) {
                $countries[] = "'" . esc_sql($country) . "'";
            }

            $countries = implode(',', $countries);

            $query .= " and country in (" . $countries . ")";
        }
        if (!empty($email->options['regions'])) {
            $regions = array();
            foreach ($email->options['regions'] as $region) {
                $regions[] = "'" . esc_sql($region) . "'";
            }

            $regions = implode(',', $regions);

            $query .= $wpdb->prepare(" and region in (" . $regions . ")");
        }
        return $query;
    }

    function hook_newsletter_menu_subscribers($entries) {
        $entries[] = array('label' => '<i class="fa fa-globe"></i> Geolocation', 'url' => '?page=newsletter_geo_index', 'description' => 'Geolocation of subscribers for a precise targeting');
        return $entries;
    }

    function hook_admin_menu() {
        add_submenu_page('newsletter_main_index', 'Geo', '<span class="tnp-side-menu">Geo</span>', 'manage_options', 'newsletter_geo_index', array($this, 'menu_page_index'));
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
     * 
     * @return NewsletterLogger
     */
    function get_logger() {
        if ($this->logger) {
            return $this->logger;
        }
        $this->logger = new NewsletterLogger('geo');
        return $this->logger;
    }

    var $country_result = '';

    function get_response_data($url) {
        $response = wp_remote_get($url);
        if (is_wp_error($response)) {
            return $response;
        } else if (wp_remote_retrieve_response_code($response) != 200) {
            return new WP_Error(wp_remote_retrieve_response_code($response), 'Error on connection to ' . $url . ' with error HTTP code ' . wp_remote_retrieve_response_code($response));
        }
        $data = json_decode(wp_remote_retrieve_body($response));
        if (!$data) {
            return new WP_Error(1, 'Unable to decode the JSON from ' . $url, $body);
        }
        return $data;
    }

    function resolve($ip) {
        static $service = 0;

//        if ($service == 2) {
//            $data = $this->get_response_data('http://geoip.nekudo.com/api/' . $ip);
//            if (is_wp_error($data)) {
//                $service++;
//            } else {
//                return array('country' => $data->country->code, 'region' => '', 'city' => '');
//            }
//        }

        if ($service == 0) {
            $data = $this->get_response_data('http://ip-api.com/json/' . $ip);
            if (is_wp_error($data) || empty($data->countryCode)) {
                $service++;
            } else {
                return array('country' => $data->countryCode, 'region' => $data->regionName, 'city' => $data->city);
            }
        }

        if ($service == 1) {
            $data = $this->get_response_data('https://ipinfo.io/' . $ip . '/json/');
            if (is_wp_error($data) || empty($data->country)) {
                $service++;
            } else {
                return array('country' => $data->country, 'region' => $data->region, 'city' => $data->city);
            }
        }

        if ($service == 2) {
            $data = $this->get_response_data('http://www.freegeoip.net/json/' . $ip);
            if (is_wp_error($data) || empty($data->country_code)) {
                $service++;
            } else {
                return array('country' => $data->country_code, 'region' => $data->region_name, 'city' => $data->city);
            }
        }
        
        // Restart;
        $service = 0;

        return new WP_Error(1, 'No service for country resolution reachable');
    }

    /**
     * 
     * @global wpdb $wpdb
     * @param type $test
     * @return type
     */
    function run($test = false) {
        global $wpdb;
        $logger = $this->get_logger();
        
        $logger->info('Start');
        
        @set_time_limit(0);

        if (!$test) {
            $this->save_last_run(time());
        } else {
            $logger->debug('Test mode');
            $data = $this->resolve($_SERVER['REMOTE_ADDR']);
            return $data;
        }

        $list = $wpdb->get_results("select id, ip from " . NEWSLETTER_USERS_TABLE . " where ip<>'' and country='' limit 100");
        if (!empty($list)) {
            $this->country_result .= ' Processed ' . count($list) . ' subscribers.';
            foreach ($list as $r) {
                $logger->debug($r);
                $data = $this->resolve($r->ip);
                if (is_wp_error($data)) {
                    $logger->fatal($data);
                    $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set country='XX', region='', city='' where id=%d limit 1", $r->id));
                    //return $data;
                } else {
                    if (!empty($data)) {
                        $rr = $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set country=%s, region=%s, city=%s where id=%d limit 1", $data['country'], $data['region'], $data['city'], $r->id));
                        if (!empty($wpdb->last_error))
                            die($wpdb->last_error);
                    } else {
                        $wpdb->query($wpdb->prepare("update " . NEWSLETTER_USERS_TABLE . " set country='XX', region='', city='' where id=%d limit 1", $r->id));
                        if (!empty($wpdb->last_error))
                            die($wpdb->last_error);
                    }
                }
            }
        }
        return count($list);
    }

    function save_last_run($time) {
        update_option($this->prefix . '_last_run', $time);
    }

    function get_last_run() {
        return get_option($this->prefix . '_last_run', 0);
    }

}

new NewsletterGeo();
