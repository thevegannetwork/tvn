<?php
/*
  Plugin Name: Newsletter - Leads
  Plugin URI: http://www.thenewsletterplugin.com/plugins/newsletter
  Description: Adds a leads generation system to the Newsletter plugin. Automatic updates available setting the license key on Newsletter configuration panel.
  Version: 1.0.4
  Author: The Newsletter Team
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

if (!defined('NEWSLETTER_EXTENSION')) {
    define('NEWSLETTER_EXTENSION', true);
}

class NewsletterLeads {

    /**
     * @return NewsletterLeads
     */
    static $instance;
    var $prefix = 'newsletter_leads';
    var $slug = 'newsletter-leads';
    var $plugin = 'newsletter-leads/leads.php';
    var $id = 67;
    var $options;
    static $required_nl_version = "4.7.0";
    static $leads_colors = array(
        'autumn' => array('#db725d', '#5197d5'),
        'winter' => array('#38495c', '#5197d5'),
        'summer' => array('#eac545', '#55ab68'),
        'spring' => array('#80c99d', '#ee7e33'),
        'sunset' => array('#d35400', '#ee7e33'),
        'night' => array('#204f56', '#ee7e33'),
        'sky' => array('#5197d5', '#55ab68'),
        'forest' => array('#55ab68', '#5197d5'),
    );

    function __construct() {
        self::$instance = $this;
        register_activation_hook(__FILE__, array($this, 'hook_activation'));
        register_deactivation_hook(__FILE__, array($this, 'hook_deactivation'));
        add_action('init', array($this, 'hook_init'));
        $this->options = get_option($this->prefix, array());
        add_filter('newsletter_subscription_buttons', array($this, 'hook_newsletter_subscription_buttons'));
    }

    function hook_newsletter_subscription_buttons($buttons) {
        $button = array('url' => '?page=newsletter-leads/index.php',
            'title' => 'Leads',
            'description' => 'Collect subscribers with a popup or something else');
        $buttons[] = $button;
        return $buttons;
    }

    function hook_activation() {

        delete_option('newsletter_leads_available_version');
        delete_option('newsletter_leads_version');

        if (empty($this->options)) {
            $this->options = array();
        }
        if (empty($this->options['theme'])) {
            $this->options['theme'] = 'default';
        }
        if (empty($this->options['width'])) {
            $this->options['width'] = '500';
        }
        if (empty($this->options['height'])) {
            $this->options['height'] = '450';
        }
        if (!isset($this->options['delay'])) {
            $this->options['delay'] = 2;
        }
        if (!isset($this->options['count'])) {
            $this->options['count'] = 0;
        }
        if (!isset($this->options['days'])) {
            $this->options['days'] = 30;
        }
        if (empty($this->options['theme_title'])) {
            $this->options['theme_title'] = 'Subscribe to stay tuned!';
        }
        if (empty($this->options['subscribe_label'])) {
            $this->options['theme_subscribe_label'] = 'Subscribe';
        }
        if (empty($this->options['theme_popup_color'])) {
            $this->options['theme_popup_color'] = 'winter';
        }
        if (empty($this->options['theme_bar_color'])) {
            $this->options['theme_bar_color'] = 'winter';
        }

        update_option($this->prefix, $this->options);

        delete_transient($this->prefix . '_plugin');
    }

    function hook_deactivation() {
        delete_transient($this->prefix . '_plugin');
    }

    function hook_init() {

        if (!class_exists('Newsletter')) {
            return;
        }

        if (NEWSLETTER_VERSION < NewsletterLeads::$required_nl_version) {
            if (is_admin()) {
                add_action('admin_notices', array($this, 'leads_admin_notice__error'));
            } else {
                return;
            }
        }

        add_filter('site_transient_update_plugins', array($this, 'hook_site_transient_update_plugins'));

        if (!is_admin() && ((isset($this->options['popup-enabled']) && $this->options['popup-enabled'] == 1) || isset($_GET['newsletter_leads']))) {
            add_action('wp_footer', array($this, 'hook_wp_footer'), 99);
            add_action('wp_head', array($this, 'hook_wp_head'), 1);
            add_action('wp_enqueue_scripts', array($this, 'hook_wp_enqueue_scripts'));
        }

        // notification bar
        if (!is_admin() && ((isset($this->options['bar-enabled']) && $this->options['bar-enabled'] == 1) || isset($_GET['newsletter_leads']))) {
            add_action('wp_footer', array($this, 'hook_wp_footer_bar'), 99);
            add_action('wp_head', array($this, 'hook_wp_head_bar'), 1);
            add_action('wp_enqueue_scripts', array($this, 'hook_wp_enqueue_scripts_bar'));
        }

        if (is_admin()) {
            add_action('admin_init', array($this, 'hook_admin_init'));
            add_action('admin_menu', array($this, 'hook_admin_menu'), 100);
            add_filter('newsletter_menu_subscription', array($this, 'hook_newsletter_menu_subscription'));
            add_action('admin_enqueue_scripts', array($this, 'hook_admin_enqueue_scripts'));
        }
    }

    function hook_admin_enqueue_scripts() {
//        wp_enqueue_script('jquery-ui-tabs');
//        wp_enqueue_script('jquery-ui-accordion');
//        wp_enqueue_script('wp-color-picker');
//        wp_enqueue_style('wp-color-picker');
    }

    function hook_newsletter_menu_subscription($entries) {
        $entries[] = array('label' => '<i class="fa fa-clone"></i> Leads', 'url' => '?page=newsletter_leads_index', 'description' => 'Simple subscription systems');
        return $entries;
    }

    function hook_admin_init() {
        
    }

    function hook_admin_menu() {
        $parent = 'newsletter_main_index';
        add_submenu_page($parent, 'Leads', '<span class="tnp-side-menu">Leads</span>', 'manage_options', 'newsletter_leads_index', array($this, 'menu_page_index'));
    }

    function menu_page_index() {
        global $wpdb, $newsletter;
        require dirname(__FILE__) . '/index.php';
    }

    function hook_site_transient_update_plugins($value) {
        if (!method_exists('Newsletter', 'set_extension_update_data')) {
            return $value;
        }

        return Newsletter::instance()->set_extension_update_data($value, $this);
    }

    function hook_wp_enqueue_scripts() {
        wp_enqueue_script('simplemodal', plugins_url('newsletter-leads') . '/libs/simplemodal/jquery.simplemodal.js', array('jquery'), false, true);
    }

    function save_options($options) {
        $this->options = $options;
        update_option($this->prefix, $options);

        add_option($this->prefix . '_theme_' . $options['theme'], array(), null, 'no');
        $theme_options = array();
        foreach ($options as $key => &$value) {
            if (substr($key, 0, 6) != 'theme_') {
                continue;
            }
            $theme_options[$key] = $value;
        }
        update_option($this->prefix . '_theme_' . $options['theme'], $theme_options);
    }

    function get_theme_options($theme) {
        return get_option($this->prefix . '_theme_' . $theme);
    }

    function get_theme_url($theme) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-leads/themes/' . $theme;
        if (is_dir($path)) {
            return WP_CONTENT_URL . '/extensions/newsletter-leads/themes/' . $theme;
        } else {
            return plugins_url($this->slug) . '/themes/' . $theme;
        }
    }

    function get_theme_file($theme, $file) {
        $path = WP_CONTENT_DIR . '/extensions/newsletter-leads/themes/' . $theme . '/' . $file;
        if (is_file($path)) {
            return $path;
        } else {
            return dirname(__FILE__) . '/themes/' . $theme . '/' . $file;
        }
    }

    function hook_wp_head() {
        $this->leads_wp_head_common();

        $leads_colors = NewsletterLeads::$leads_colors;
        $theme_popup_color = $theme_bar_color = "winter";
        if (isset($this->options['theme_popup_color']) && array_key_exists($this->options['theme_popup_color'], $leads_colors)) {
            $theme_popup_color = $this->options['theme_popup_color'];
        }
        ?>
        <style>

            #simplemodal-container {
                height:<?php echo $this->options['height']; ?>px;
                width:<?php echo $this->options['width']; ?>px;
            }

            .tnp-modal {
                background-color: <?php echo $leads_colors[$theme_popup_color][0] ?> !important;
                font-family: "Lato", sans-serif;
                text-align: center;
                padding: 30px;
            }

            #simplemodal-container input.tnp-submit {
                background-color: <?php echo $leads_colors[$theme_popup_color][1] ?> !important;
                border: none;
                color: #fff;
                cursor: pointer;
            }

            #simplemodal-container input[type="submit"]:hover {
                background-color: <?php echo $leads_colors[$theme_popup_color][1] ?> !important;
                filter: brightness(110%);
            }

        </style>
        <?php
    }

    function hook_wp_footer() {
        if (!isset($_GET['newsletter_leads'])) {
            if (class_exists("Newsletter")) {
                $user = Newsletter::instance()->check_user();
                if ($user && $user->status == 'C') {
                    return;
                }
            }
        }
        ?>
        <script>
            function newsletter_set_cookie(name, value, time) {
                var e = new Date();
                e.setTime(e.getTime() + time * 24 * 60 * 60 * 1000);
                document.cookie = name + "=" + value + "; expires=" + e.toGMTString() + "; path=/";
            }
            function newsletter_get_cookie(name, def) {
                var cs = document.cookie.toString().split('; ');
                var c, n, v;
                for (var i = 0; i < cs.length; i++) {
                    c = cs[i].split("=");
                    n = c[0];
                    v = c[1];
                    if (n == name)
                        return v;
                }
                return def;
            }
            jQuery(document).ready(function () {

        <?php if (isset($_GET['newsletter_leads'])) { ?>
                    newsletter_leads_open();
        <?php } else { ?>
                    if (newsletter_get_cookie("newsletter", null) == null) {
                        var newsletter_leads = parseInt(newsletter_get_cookie("newsletter_leads", 0));
                        newsletter_set_cookie("newsletter_leads", newsletter_leads + 1, <?php echo (int) $this->options['days']; ?>);
                        if (newsletter_leads == <?php echo (int) $this->options['count']; ?>) {
                            setTimeout(newsletter_leads_open, <?php echo $this->options['delay'] * 1000; ?>);
                        }
                    }
        <?php } ?>
            });

            function newsletter_leads_open() {
                jQuery.get("<?php echo plugins_url('newsletter-leads') . '/iframe.php'; ?>", function (html) {
                    jQuery.modal(html,
                            {
                                autoResize: true,
                                barClose: true,
                                zIndex: 99000,
                                onOpen: function (dialog) {
                                    dialog.overlay.fadeIn('fast');
                                    dialog.container.fadeIn('slow');
                                    dialog.data.fadeIn('slow');
                                },
                                closeHTML: '<a class="modalCloseImg" title="Close"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24"><g  transform="translate(0, 0)"><circle fill="#fff" stroke="#fff" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" cx="12" cy="12" r="11" stroke-linejoin="miter"/><line data-color="color-2" fill="#fff" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="8" x2="8" y2="16" stroke-linejoin="miter"/><line data-color="color-2" fill="none" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="16" x2="8" y2="8" stroke-linejoin="miter"/></g></svg></a>'
                            });
                });
            }
        </script>
        <?php
    }

    function hook_wp_enqueue_scripts_bar() {
        //wp_enqueue_script('simplemodal', plugins_url('newsletter-leads') . '/libs/simplemodal/jquery.simplemodal.js', array('jquery'), false, true);
    }

    function hook_wp_head_bar() {
        $this->leads_wp_head_common();
        ?>
        <style>
            #topbar {
                <?php if ($this->options['position'] == "top") { ?>
                    top: -100px;
                    transition: top 1s;
                <?php } else { ?>
                    bottom: -100px;
                    transition: bottom 1s;
                <?php } ?>
            }
            #toggleTop:checked + #topbar {
                <?php if ($this->options['position'] == "top") { ?>
                    transition: top 1s;
                    <?php if (is_admin_bar_showing()) { ?>
                        top:32px;
                    <?php } else { ?>
                        top:0px;
                    <?php } ?>
                <?php } else { ?>
                    transition: bottom 1s;
                    bottom:0px;
                <?php } ?>
            }
            #topbar {
                background-color: <?php echo NewsletterLeads::$leads_colors[$this->options['theme_bar_color']][0] ?> !important;
            }
            #topbar .tnp-subscription-minimal input.tnp-submit {
                background-color: <?php echo NewsletterLeads::$leads_colors[$this->options['theme_bar_color']][1] ?> !important;
            }
        </style>
        <?php
    }

    function hook_wp_footer_bar() {
        if (!isset($_GET['newsletter_leads'])) {
            if (class_exists("Newsletter")) {
                $user = Newsletter::instance()->check_user();
                if ($user && $user->status == 'C') {
                    return;
                }
            }
        }
        ?>
        <!-- The checkbox -->
        <input type="checkbox" id="toggleTop" name="toggleTop" value="toggleTop" checked="checked">
            <!-- The Notification bar container -->
            <div id="topbar">

                <!-- the form code -->
                <?php echo $this->getBarMinimalForm(); ?>

                <!-- Label to Hide Notification bar -->
                <label for="toggleTop" id="hideTop"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24"><g  transform="translate(0, 0)"><circle fill="#fff" stroke="#fff" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" cx="12" cy="12" r="11" stroke-linejoin="miter"/><line data-color="color-2" fill="#fff" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="8" x2="8" y2="16" stroke-linejoin="miter"/><line data-color="color-2" fill="none" stroke="#343434" stroke-width="1" stroke-linecap="square" stroke-miterlimit="10" x1="16" y1="16" x2="8" y2="8" stroke-linejoin="miter"/></g></svg></label>
            </div>
            <?php
        }

        function leads_admin_notice__error() {
            echo('<div class="notice notice-error"><p>Leads requires at least Newsletter version '
            . NewsletterLeads::$required_nl_version . ' to work, <a href="' . site_url('/wp-admin/plugins.php') . '">please update</a>.</p></div>');
        }

        function leads_wp_head_common() {
            wp_enqueue_style('newsletter-leads', plugins_url('newsletter-leads') . '/css/leads.css', 'newsletter-subscription');
        }

        private function getBarMinimalForm() {
            $options = array();
            if (isset($this->options['bar_subscribe_label']) && $this->options['bar_subscribe_label']) {
                $options["button"] = $this->options['bar_subscribe_label'];
            }
            if (isset($this->options['bar_placeholder']) && $this->options['bar_placeholder']) {
                $options["placeholder"] = $this->options['bar_placeholder'];
            }
            return NewsletterSubscription::$instance->get_subscription_form_minimal($options);
        }

    }

    new NewsletterLeads();
    