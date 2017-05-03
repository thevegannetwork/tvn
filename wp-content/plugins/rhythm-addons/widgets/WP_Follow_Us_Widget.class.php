<?php
/**
 * Follow Us
 *
 * @package Rhythm
 */

class WP_Follow_Us_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_follow_us', 'description' => __( "Displays list of buttons", 'rhythm-addons' ) );
        parent::__construct('follow-us', __( 'Rhythm: Follow Us', 'rhythm-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_follow_us';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;
		
		$cache = wp_cache_get('widget_follow_us', 'widget');

        if ( !is_array($cache) )
        {
            $cache = array();
        }
        if ( ! isset( $args['widget_id'] ) )
        {
            $args['widget_id'] = $this->id;
        }

        if ( isset( $cache[ $args['widget_id'] ] ) )
        {
            echo $cache[ $args['widget_id'] ];
            return;
        }
		
        ob_start();
        extract($args);
		
		echo $before_widget;

        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        
        if ($title):
            echo $before_title.esc_html($title).$after_title;
        endif; 
		
		$sites = array(
			'facebook' => __('Facebook', 'rhythm'),
			'twitter' => __('Twitter', 'rhythm'),
			'googleplus' => __('Google+', 'rhythm'),
			'pinterest' => __('Pinterest', 'rhythm'),
			'youtube' => __('YouTube', 'rhythm'),
			'linkedin' => __('LinkedIn', 'rhythm'),
			'rss' => __('RSS', 'rhythm'),
		);
		$icons = array(
			'facebook' => 'facebook',
			'twitter' => 'twitter',
			'googleplus' => 'google-plus',
			'pinterest' => 'pinterest',
			'youtube' => 'youtube',
			'linkedin' => 'linkedin',
			'rss' => 'rss',
		);
		
		foreach ($sites as $site => $label) {
			if (!empty($instance[$site])) { ?>
				<a href="<?php echo esc_url($instance[$site]); ?>" class="btn btn-mod btn-small btn-round btn-gray mb-10"><i class="fa fa-<?php echo sanitize_html_class($icons[$site]); ?>"></i> <?php echo esc_html($label);?></a>
			<?php }
		}
		
		echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_follow_us', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['googleplus'] = strip_tags($new_instance['googleplus']);
        $instance['pinterest'] = strip_tags($new_instance['pinterest']);
        $instance['youtube'] = strip_tags($new_instance['youtube']);
        $instance['linkedin'] = strip_tags($new_instance['linkedin']);
        $instance['rss'] = strip_tags($new_instance['rss']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_follow_us']) )
        {
            delete_option('widget_follow_us');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_follow_us', 'widget');
    }

    function form( $instance )
    {
        $title   = isset($instance['title']) ? $instance['title'] : '';
        $facebook   = isset($instance['facebook']) ? $instance['facebook'] : '';
        $twitter   = isset($instance['twitter']) ? $instance['twitter'] : '';
        $googleplus   = isset($instance['googleplus']) ? $instance['googleplus'] : '';
        $pinterest   = isset($instance['pinterest']) ? $instance['pinterest'] : '';
        $youtube   = isset($instance['youtube']) ? $instance['youtube'] : '';
        $linkedin   = isset($instance['linkedin']) ? $instance['linkedin'] : '';
        $rss   = isset($instance['rss']) ? $instance['rss'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e( 'Facebook URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e( 'Twitter URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php _e( 'Google Plus URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php _e( 'Pinterest URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php _e( 'Youtube URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e( 'LinkedIn URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>
        
		<p><label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php _e( 'RSS URL:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" type="text" value="<?php echo esc_attr($rss); ?>" /></p>
		<?php
    }
}
