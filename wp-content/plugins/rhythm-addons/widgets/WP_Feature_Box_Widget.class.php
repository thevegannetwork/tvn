<?php
/**
 * Latest posts widget
 *
 * @package Rhythm
 */

class WP_Feature_Box_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_feature_box_entries', 'description' => __( "Displays feature box", 'rhythm-addons' ) );
		parent::__construct('feature-box', __( 'Rhythm: Feature Box', 'rhythm-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_feature_box_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;

		$cache = wp_cache_get('widget_feature_box_entries', 'widget');

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
		endif; ?>

		<div class="alt-service-wrap">
			<div class="alt-service-item">
				<div class="alt-service-icon">
					<i class="<?php echo esc_attr($instance['icon']);?>"></i>
				</div>
				<h3 class="alt-services-title font-alt"><?php echo esc_html($instance['subtitle']); ?></h3>
				<?php echo wp_kses_data($instance['content']); ?>
			</div>
		</div>
		<?php echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_feature_box_entries', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['icon'] = strip_tags($new_instance['icon']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['content'] = wp_kses_data($new_instance['content']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_feature_box_entries']) )
		{
			delete_option('widget_feature_box_entries');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_feature_box_entries', 'widget');
	}

	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		$icon = isset($instance['icon']) ? $instance['icon'] : '';
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : '';
		$content = isset($instance['content']) ? $instance['content'] : '';
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>"><?php _e( 'Icon:', 'rhythm-addons' ); ?></label>
		<select class="widefat icon-select" id="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>">
			<?php $icons = rs_fontawesome_icons();
			if (is_array($icons)):
				foreach ($icons as $icon_item): ?>
					<option value="<?php echo esc_attr($icon_item); ?>" <?php selected( $icon_item, $icon ); ?>><?php echo esc_attr($icon_item); ?></option>
				<?php endforeach;
			endif; ?>
		</select>

		<p><label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php _e( 'Subtitle', 'rhythm-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e( 'Content:', "rhythm-addons" ); ?></label>
		<textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea></p>
		<?php
	}
}
