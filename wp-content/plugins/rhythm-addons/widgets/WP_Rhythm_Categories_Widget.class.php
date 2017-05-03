<?php
/**
 * Rhythm Categories
 *
 * @package Rhythm
 */

class WP_Rhythm_Categories_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_rhythm_categories', 'description' => __( "Displays list of categories", 'rhythm-addons' ) );
        parent::__construct('rhythm-categories', __( 'Rhythm Categories', 'rhythm-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_rhythm_categories';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;
		
		$cache = wp_cache_get('widget_rhythm_categories', 'widget');

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
		
		$cat_args = array(
			'type'                     => 'post',
			'child_of'                 => 0,
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 0,
			'hierarchical'             => 0,
			'taxonomy'                 => 'category',
		); 
		$categories = get_categories( $cat_args );
		
		if (is_array($categories) && !is_wp_error($categories)) {
		
			$cat_per_row = ceil(count($categories) / 2);
			
			?>
			<div class="row">
				<?php 
				for ($i = 0; $i < 2; $i++) { ?>
					<div class="col-md-6">
						<ul class="clearlist widget-menu">
							<?php
							$k = 0;
							foreach ($categories as $category) { 
								$k ++;
								if ( ($i == 0 && $k > $cat_per_row) || ($i == 1 && $k <= $cat_per_row) ) {
									continue;
								}
								?>
								<li>
									<a href="<?php echo esc_url(get_category_link($category -> term_id)); ?>" title="<?php echo esc_attr($category -> name); ?>"><?php echo esc_html($category -> name); ?></a>
									<small> - <?php echo intval($category -> category_count); ?> </small>
								</li>
							<?php }
							?>
						</ul>
					</div>
				<?php } ?>
			</div>

        <?php 
		}
		
		echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_rhythm_categories', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_rhythm_categories']) )
        {
            delete_option('widget_rhythm_categories');
        }
        return $instance;
    }

    function flush_widget_cache()
    {
        wp_cache_delete('widget_rhythm_categories', 'widget');
    }

    function form( $instance )
    {
        $title   = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <?php
    }
}
