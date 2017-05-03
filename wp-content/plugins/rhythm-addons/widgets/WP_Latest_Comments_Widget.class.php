<?php
/**
 * Latest posts widget
 * 
 * @package Rhythm
 */

class WP_Latest_Comments_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_latest_comments', 'description' => __( "Displays the most latest posts", 'rhythm-addons' ) );
		parent::__construct('latest-comments', __( 'Rhythm: Latest Comments', 'rhythm-addons' ), $widget_ops);
		
		$this-> alt_option_name = 'widget_latest_comments';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $comments, $comment;

		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get('widget_latest_comments', 'widget');
		}
		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Comments', 'rhythm' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		/**
		 * Filter the arguments for the Recent Comments widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Comment_Query::query() for information on accepted arguments.
		 *
		 * @param array $comment_args An array of arguments used to retrieve the recent comments.
		 */
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . $title . $args['after_title'];
		}

		$output .= '<ul class="clearlist widget-posts latest-comments">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				
				$output .= '<li class="clearfix">';
				$output .= get_avatar( $comment, 40 ); ;
                $output .= '<div class="widget-posts-descr">';
                $output .= get_comment_author_link().': <a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">'.get_the_title( $comment->comment_post_ID ).'</a>';
                $output .= '</div>';
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
		$output .= $args['after_widget'];

		echo $output;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = $output;
			wp_cache_set( 'widget_latest_comments', $cache, 'widget' );
		}
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_comments']) )
		{
			delete_option('widget_latest_comments');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_latest_comments', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? $instance['number'] : 5;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:', 'rhythm-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:', 'rhythm-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		<?php
	}
}