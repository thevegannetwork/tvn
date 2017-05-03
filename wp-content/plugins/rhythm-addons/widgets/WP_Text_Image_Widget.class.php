<?php
/**
 * Latest posts widget
 *
 * @package Rhythm
 */

class WP_Text_Image_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_text_image_entries', 'description' => __( "Displays text block with image", 'rhythm-addons' ) );
        parent::__construct('text-block', __( 'Rhythm: Text Block With Image', 'rhythm-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_text_image_entries';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;

        $cache = wp_cache_get('widget_text_image_entries', 'widget');

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
        $rounded = (isset($instance['rounded'])) ? $instance['rounded']:'true';
        $round_class = ($rounded == 1) ? 'img-circle':'img';

        if ($title):
            echo $before_title.esc_html($title).$after_title;
        endif; ?>

        <div class="widget-text clearfix">
            <?php if (esc_url($instance['image'])): ?>
				<img src="<?php echo esc_url($instance['image']); ?>" alt="" width="70" class="<?php echo sanitize_html_class($round_class); ?> left img-<?php echo sanitize_html_class($instance['align']); ?>">
			<?php endif; ?>
            <?php echo wp_kses_data($instance['content']); ?>
        </div>

        <?php echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_text_image_entries', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['rounded'] = strip_tags($new_instance['rounded']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['align'] = strip_tags($new_instance['align']);
        $instance['content'] = wp_kses_data($new_instance['content']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_text_image_entries']) )
        {
            delete_option('widget_text_image_entries');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_text_image_entries', 'widget');
    }

    function form( $instance )
    {
        $title   = isset($instance['title']) ? $instance['title'] : '';
        $image   = isset($instance['image']) ? $instance['image'] : '';
        $rounded = isset($instance['rounded']) ? $instance['rounded'] : '';
        $align   = isset($instance['align']) ? $instance['align'] : '';
        $content = isset($instance['content']) ? $instance['content'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><input id="<?php echo esc_attr($this->get_field_id('rounded')); ?>" name="<?php echo esc_attr($this->get_field_name('rounded')); ?>" type="checkbox" value="1" <?php checked( '1', $rounded ); ?> />
        <label for="<?php echo esc_attr($this->get_field_id('rounded')); ?>"><?php _e('Rounded', 'rhythm-addons'); ?></label></p>


        <p><label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php _e( 'Upload:', 'rhythm-addons' ); ?></label></p>
        <div class="efa_field efa_field_upload">
          <div class="efa-uploader">
              <input class="widefat media-attachment" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
              <a href="#" class="button efa-add-media" data-frame-title="Upload" data-upload-type="image" data-return="url" data-insert-title="Use Image">Upload</a>
          </div>
        </div>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'align' )); ?>"><?php _e( 'Align:', 'rhythm-addons' ); ?></label>
        <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'align' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'align' )); ?>">
            <option value="left" <?php selected( 'left', $align ); ?>>Left</option>
            <option value="center" <?php selected( 'center', $align ); ?>>Center</option>
            <option value="right" <?php selected( 'right', $align ); ?>>Right</option>
        </select>

        <p><label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e( 'Content:', "rhythm-addons" ); ?></label>
        <textarea class="widefat" rows="7" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo esc_textarea($content); ?></textarea></p>
        <?php
    }
}
