<?php

/*
  Plugin Name: Newsletter - Extended Composer Blocks
  Plugin URI: http://www.thenewsletterplugin.com
  Description: New extended blocks for the composer
  Version: 1.0.0
  Author: The Newsletter Team
  Author URI: http://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

class NewsletterBlocks {

    /**
     * @var NewsletterBlocks
     */
    static $instance;
    var $prefix = 'newsletter_blocks';
    var $slug = 'newsletter-blocks';
    var $plugin = 'newsletter-blocks/blocks.php';
    var $id = 74;
    var $options;

    /**
     * @var NewsletterLogger 
     */
    var $logger;

    function __construct() {
        self::$instance = $this;

        if (is_admin() || isset($_GET['na'])) {
            add_filter('newsletter_blocks_dir', array($this, 'hook_newsletter_blocks_dir'));
        }
    }

    function hook_newsletter_blocks_dir($blocks_dir) {
        $blocks_dir[] = __DIR__ . '/blocks';
        
        return $blocks_dir;
    }

    /**
     * 
     * @return NewsletterLogger
     */
    function get_logger() {
        if ($this->logger) {
            return $this->logger;
        }
        $this->logger = new NewsletterLogger('blocks');
        return $this->logger;
    }

    function scan($dir) {
        if (!is_dir($dir)) {
            return false;
        }

        $handle = opendir($dir);
        $list = array();
        $relative_dir = substr($dir, strlen(WP_CONTENT_DIR));
        while ($file = readdir($handle)) {

            $full_file = $dir . '/' . $file . '/block.php';
            if (!is_file($full_file)) {
                continue;
            }

            $data = get_file_data($full_file, array('name' => 'Name', 'section' => 'Section', 'description' => 'Description'));
            $data['id'] = $file;
            if (empty($data['name'])) {
                $data['name'] = $file;
            }
            if (empty($data['section'])) {
                $data['section'] = 'content';
            }
            if (empty($data['description'])) {
                $data['description'] = '';
            }

            $data['icon'] = content_url($relative_dir . '/' . $file . '/icon.png');
            $list[$file] = $data;
        }
        closedir($handle);
        return $list;
    }

}

new NewsletterBlocks();
