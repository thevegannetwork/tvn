<?php
/*
Plugin Name: Rhythm Addons
Plugin URI: http://www.medialayout.com
Description: A part of Rhythm theme
Version: 1.0
Author: Medialayout Team
Author URI: http://www.medialayout.com
Text Domain: rhythm-addons
*/

// Define Constants
defined('RS_ROOT') or define('RS_ROOT', dirname(__FILE__));

/**
 * Shortcodes
 */
if(!class_exists('RS_Shortcode') && class_exists('Vc_Manager'))
{
  /**
   * Main plugin class
   */
  class RS_Shortcode
  {

    private $assets_css;
    private $assets_js;

  /**
   * Construct
   */
    public function __construct()
    {
	  add_action('plugins_loaded', array( $this, 'load_plugin_textdomain' ) );  
      add_action('init', array($this,'rs_init'),50);
      add_action('setup_theme', array($this,'rs_load_custom_post_types'),40);
      add_action('widgets_init', array($this,'rs_load_widgets'),50);
    }
    
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'rhythm-addons', FALSE, plugin_basename(RS_ROOT) . '/languages/' );
	}

  /**
   * Plugin activation
   */
  public static function activate() {
    flush_rewrite_rules();
  }

  /**
   * Plugin deactivation
   */
  public static function deactivate() {
    flush_rewrite_rules();
  }

  /**
   * Init
   */
  public function rs_init() {

    if (!defined('RHYTHM_THEME_ACTIVATED') || RHYTHM_THEME_ACTIVATED !== true) {
       add_action( 'admin_notices', array($this,'rs_activate_theme_notice') );

    } else {
      $this->assets_css = plugins_url('/composer/assets/css', __FILE__);
      $this->assets_js  = plugins_url('/composer/assets/js', __FILE__);
      add_action( 'admin_print_scripts-post.php',   array($this, 'rs_load_vc_scripts'), 99);
      add_action( 'admin_print_scripts-post-new.php', array($this, 'rs_load_vc_scripts'), 99);
      add_action( 'admin_print_scripts-widgets.php', array($this, 'rs_load_widget_scripts'), 99);
      add_action('vc_load_default_params', array($this, 'rs_reload_vc_js'));
      $this->rs_vc_load_shortcodes();
      //$this->rs_init_vc();
      $this->rs_vc_integration();
    }
  }

  /**
   * Print theme notice
   */
  function rs_activate_theme_notice() { ?>
    <div class="updated">
      <p><strong><?php _e('Please activate the Rhythm theme to use Rhythem Addons plugin.', 'rhythm-addons'); ?></strong></p>
      <?php
      $screen = get_current_screen();
      if ($screen -> base != 'themes'): ?>
        <p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php _e('Activate theme', 'rhythm-addons'); ?></a></p>
      <?php endif; ?>
    </div>
  <?php }

  /**
   * Init VC integration
   * @global type $vc_manager
   */
    public function rs_init_vc()
    {
      global $vc_manager;
      $vc_manager->setIsAsTheme();
      $vc_manager->disableUpdater();
      $list = array( 'page', 'post', 'portfolio', 'product');
      $vc_manager->setEditorDefaultPostTypes( $list );
      $vc_manager->setEditorPostTypes( $list ); //this is required after VC update (probably from vc 4.5 version)
      //$vc_manager->frontendEditor()->disableInline(); // enable/disable vc frontend editior
      $vc_manager->automapper()->setDisabled();
    }

  /**
   * Load custom post types
   */
  public function rs_load_custom_post_types()
  {
    require_once(RS_ROOT .'/custom-posts/faq.php');
    require_once(RS_ROOT .'/custom-posts/social-site.php');
    require_once(RS_ROOT .'/custom-posts/team.php');
    require_once(RS_ROOT .'/custom-posts/testimonial.php');
    require_once(RS_ROOT .'/custom-posts/portfolio.php');
  }

  /**
   * Load widgets
   */
  public function rs_load_widgets()
  {
    if (!defined('RHYTHM_THEME_ACTIVATED') || RHYTHM_THEME_ACTIVATED !== true) {
        return false;
    }
    $widgets = array(
      'WP_Feature_Box_Widget',
      'WP_Follow_Us_Widget',
      'WP_Latest_Comments_Widget',
      'WP_Latest_Posts_Widget',
      'WP_Multi_Tabs_Widget',
      'WP_Rhythm_Categories_Widget',
      'WP_Text_Image_Widget',
      'WP_Newsletter_Widget'
    );
    foreach ($widgets as $widget) {
      if (file_exists(RS_ROOT .'/widgets/'.$widget.'.class.php')) {
      require_once(RS_ROOT .'/widgets/'.$widget.'.class.php');
      register_widget($widget);
      }
    }
  }

  /**
   * Load shortcodes
   */
    public function rs_vc_load_shortcodes()
    {

      require_once(RS_ROOT. '/' . 'shortcodes/rs_accordion.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_banner.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_banner_heading.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_banner_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_bar.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_image_carousel.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_tilt_image_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blockquote.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_magazine.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_magazine_alt.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_carousel.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_blog_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_buttons.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_group_button.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_client_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_contact_details.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_contact_form.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_counter.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_cta.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_cta_2.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_divider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_vcard.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_educational.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_el_icons.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_feature_box.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_fontawesome.php');
	  require_once(RS_ROOT. '/' . 'shortcodes/rs_footer_social.php');    
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gallery.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_gallery_2.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_google_map.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_image_block.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_latest_news.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_latest_works.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_link.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_logo_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_media.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_msg_box.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_newsletter.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_one_post_preview.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_parallx.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_featured_image.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_fullwidth_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_gallery.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_project_details.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_portfolio_promo.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_pricing_list.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_pricing_table.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_promo_slider.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_section_title.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_service_box.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_single_work.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_slider_content.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_space.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_special_text.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_split_screen.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_tab.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_team.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_testimonial.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_tooltip.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_toggle.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_woo_products.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_woo_listed_products.php');      
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_follow_us.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_latest_comments.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_multi_tabs.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_wp_rhythm_categories.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_service_detail.php');
      require_once(RS_ROOT. '/' . 'shortcodes/rs_countdown_banner.php');

      require_once(RS_ROOT. '/' . 'shortcodes/vc_column.php');
      require_once(RS_ROOT. '/' . 'shortcodes/vc_column_text.php');
      require_once(RS_ROOT. '/' . 'shortcodes/vc_row.php');

    }

  /**
   * Visual composer integration
   */
    public function rs_vc_integration()
    {
      require_once( RS_ROOT .'/' .'composer/map.php' );
    }

  /**
   * Loand vc scripts
   */
    public function rs_load_vc_scripts()
    {
      wp_enqueue_style( 'rs-vc-custom', $this->assets_css. '/vc-style.css' );
      wp_enqueue_style( 'rs-etline',    $this->assets_css. '/et-line.css' );
      wp_enqueue_style( 'rs-chosen',    $this->assets_css. '/chosen.css' );
      wp_enqueue_script( 'vc-script',   $this->assets_js . '/vc-script.js' ,      array('jquery'), '1.0.0', true );
      wp_enqueue_script( 'vc-chosen',   $this->assets_js . '/jquery.chosen.js' ,  array('jquery'), '1.0.0', true );
    }

  /**
   * Load widget scripts
   */
    public function rs_load_widget_scripts()
    {
      wp_enqueue_script( 'rs-widgets',   $this->assets_js . '/widgets.js' ,  array('jquery','select2'), '1.0.0', true );
      wp_enqueue_media();
    }

  /**
   * Reload JS
   */
    public function rs_reload_vc_js()
    {
      echo '<script type="text/javascript">(function($){ $(document).ready( function(){ $.reloadPlugins(); }); })(jQuery);</script>';
    }

  } // end of class

  new RS_Shortcode;

  register_activation_hook( __FILE__, array( 'RS_Shortcode', 'activate' ) );
  register_deactivation_hook( __FILE__, array( 'RS_Shortcode', 'deactivate' ) );

} // end of class_exists


