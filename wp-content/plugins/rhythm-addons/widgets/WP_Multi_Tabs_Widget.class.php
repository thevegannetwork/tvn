<?php
/**
 * Multi Tabs
 *
 * @package Rhythm
 */

class WP_Multi_Tabs_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'widget_multi_tabs', 'description' => __( "Displays popular and latests posts on tabs", 'rhythm-addons' ) );
        parent::__construct('multi-tabs', __( 'Rhythm: Multi Tabs', 'rhythm-addons' ), $widget_ops);

        $this-> alt_option_name = 'widget_multi_tabs';

        add_action( 'save_post', array(&$this, 'flush_widget_cache') );
        add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
        add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
    }

    function widget($args, $instance)
    {
        global $post;
		
		$cache = wp_cache_get('widget_multi_tabs', 'widget');

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
        
        if ( empty( $instance['limit'] ) || ! $limit = absint( $instance['limit'] ) )
		{
			$limit = 4;
		} ?>
		
		<!-- Nav tabs -->
		<ul class="nav nav-tabs tpl-tabs animate">
			<li class="active">
				<a href="#popular" data-toggle="tab"><?php _e('Popular', 'rhythm'); ?></a>
			</li>
			<li>
				<a href="#latest" data-toggle="tab"><?php _e('Latest', 'rhythm'); ?></a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content tpl-tabs-cont section-text">
			<div class="tab-pane fade in active" id="popular">

				<ul class="clearlist widget-posts">
					
					<?php 
					$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'comment_count DESC', 'posts_per_page' => $limit, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );					
					if ($r->have_posts()) : ?>
						<?php  while ($r->have_posts()) : $r->the_post(); ?>
							<!-- Preview item -->
							<li class="clearfix">
								<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('ts-tiny',array('class' => 'widget-posts-img'))?></a>
								<div class="widget-posts-descr">
									<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
									<div>
										<?php echo sprintf(__('Posted by %s', 'rhythm-addons'),get_the_author()); ?>
										<?php the_date('d M');?>
									</div>
								</div>
							</li>
							<!-- End Preview item -->
						
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					
					
				</ul>

			</div>
			
			<div class="tab-pane fade" id="latest">
				
				<ul class="clearlist widget-posts">
				
					<?php 
					$r = new WP_Query( apply_filters( 'widget_posts_args', array('orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $limit, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true) ) );
					if ($r->have_posts()) : ?>
						<?php  while ($r->have_posts()) : $r->the_post(); ?>
							<!-- Preview item -->
							<li class="clearfix">
								<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_post_thumbnail('ts-tiny',array('class' => 'widget-posts-img'))?></a>
								<div class="widget-posts-descr">
									<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
									<div>
										<?php echo sprintf(__('Posted by %s', 'rhythm-addons'),get_the_author()); ?>
										<?php the_date('d M');?>
									</div>
								</div>
							</li>
							<!-- End Preview item -->
						
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</ul>
			</div>
		</div> 
		<?php 
		
		echo $after_widget;
        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_multi_tabs', $cache, 'widget');
    }

    function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = (int) $new_instance['limit'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_posts_entries']) )
		{
			delete_option('widget_latest_posts_entries');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_latest_posts_entries', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		$limit = isset($instance['limit']) ? $instance['limit'] : '';
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php _e( 'Number of posts to show:', 'rhythm-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="text" value="<?php echo esc_attr($limit); ?>" size="3" /></p>
		<?php
	}
}
