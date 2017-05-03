<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rhythm
 */
 
 /**
 * Theme logo
 * @param string $logo_field
 * @param string $default_url
 */
function rhythm_logo($logo_field = '', $default_url = '', $class = 'logo') {
	
	if (empty($logo_field)) {
		$logo_field = 'logo';
	}
	
	$logo = '';
	$logo_retina = '';
	
	if( ts_get_opt( $logo_field ) != null ) {
		$logo_array = ts_get_opt( $logo_field );
	}

	?>
	<a class="<?php echo sanitize_html_classes($class);?>" href="<?php echo esc_url( ts_get_home_url() ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"> 
		<?php
		if( !isset( $logo_array['url'] ) || empty($logo_array['url']) ) {
			echo '<img src="'.esc_url($default_url).'" alt="'. esc_attr(get_bloginfo( 'name' )) .'" />';
		} else {
			echo '<img src="'. esc_url($logo_array['url']) . '" width="'.esc_attr($logo_array['width']).'" height="'.esc_attr($logo_array['height']).'" alt="'. esc_attr(get_bloginfo( 'name' )) .'" />';
		}
		?>
	</a>
	<?php
}

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'rhythm' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'rhythm' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'rhythm' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'rhythm_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 */
function rhythm_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<!-- Prev/Next Post -->
	<div class="clearfix mt-40 post-navigation" role="navigation">
		<?php
		previous_post_link( '%link', '<i class="fa fa-angle-left"></i>&nbsp;'.__('Prev post', 'rhythm') );
		next_post_link( '%link', __('Next post','rhythm').'&nbsp;<i class="fa fa-angle-right"></i>' );
		?>
		
<!--		<a href="#" class="blog-item-more left"><i class="fa fa-angle-left"></i>&nbsp;Prev post</a>
		<a href="#" class="blog-item-more right">Next post&nbsp;<i class="fa fa-angle-right"></i></a>-->
	</div>
	<!-- End Prev/Next Post -->
	<?php
}
endif;

if ( ! function_exists( 'rhythm_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function rhythm_posted_on() { ?>
	<div class="blog-item-data">
		<i class="fa fa-clock-o"></i> <?php 
		echo sprintf( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		?>
		<span class="separator">&nbsp;</span>
		
		<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
		<?php if ($author_url): ?>
			<a href="<?php echo esc_url($author_url); ?>">
		<?php endif; ?>
		<i class="fa fa-user"></i> <?php echo get_the_author(); ?>
		<?php if ($author_url): ?>
			</a>
		<?php endif; ?>
		<span class="separator">&nbsp;</span>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'rhythm_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rhythm_entry_footer() {
	
	$meta = ts_get_opt('post-enable-meta');
	
	$tags_list = '';
	if ( 'post' == get_post_type() ) {
		$tags_list = get_the_tag_list( '', __( ', ', 'rhythm' ) );
	} ?>
	<div class="blog-item-data">
		<?php if (rhythm_check_if_meta_enabled('date',$meta)): ?>
			<span class="separator">&nbsp;</span>
			<i class="fa fa-clock-o"></i> <?php 
			echo sprintf( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			?>
		<?php endif; ?>
		
		<?php if (rhythm_check_if_meta_enabled('author',$meta)): ?>
			<span class="separator">&nbsp;</span>
			<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
			<?php if ($author_url): ?>
				<a href="<?php echo esc_url($author_url); ?>">
			<?php endif; ?>
			<i class="fa fa-user"></i> <?php echo get_the_author(); ?>
			<?php if ($author_url): ?>
				</a>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if (rhythm_check_if_meta_enabled('categories',$meta)): ?>
			<span class="separator">&nbsp;</span>
			<i class="fa fa-folder-open"></i>
			<?php _e('Posted in:','rhythm')?> <?php echo get_the_category_list( __( ', ', 'rhythm' ) );?>
		<?php endif; ?>
		
		<?php if (rhythm_check_if_meta_enabled('tags',$meta)): ?>
			<span class="separator">&nbsp;</span>
			<?php if (!empty($tags_list)): ?>
				<i class="fa fa-tags"></i>
				<?php _e('Tagged:','rhythm')?> <?php echo $tags_list; ?>
				<span class="separator">&nbsp;</span>
			<?php endif; ?>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'rhythm' ), '<span class="separator">&nbsp;</span><span class="edit-link">', '</span>' ); ?>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'rhythm_get_title' ) ) : 

/**
 * Get page title
 * @global object $wp_query
 */
function rhythm_get_title() {
		
	$title = '';
	
	//woocoomerce page
	if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()):
		if (apply_filters( 'woocommerce_show_page_title', true )):
			$title = woocommerce_page_title(false);
		endif;
	// Default Latest Posts page
	elseif( is_home() && !is_singular('page') ) :
		$title = __('Blog','rhythm');

	// Singular
	elseif( is_singular() ) :
		$title = get_the_title();
		
	// Search
	elseif( is_search() ) :
		global $wp_query;
		$total_results = $wp_query->found_posts;
		$prefix = '';

		if( $total_results == 1 ){
			$prefix = __('1 search result for', 'rhythm');
		}
		else if( $total_results > 1 ) {
			$prefix = $total_results . ' ' . __('search results for', 'rhythm');
		}
		else {
			$prefix = __('Search results for', 'rhythm');
		}
		//$title = $prefix . ': ' . get_search_query();
		$title = get_search_query();

	// Category and other Taxonomies
	elseif ( is_category() ) :
		$title = single_cat_title('', false);

	elseif ( is_tag() ) :
		$title = single_tag_title('', false);

	elseif ( is_author() ) :
		$title = sprintf( __( 'Author: %s', 'rhythm' ), '<span class="vcard">' . get_the_author() . '</span>' );

	elseif ( is_day() ) :
		$title = sprintf( __( 'Day: %s', 'rhythm' ), '<span>' . get_the_date() . '</span>' );

	elseif ( is_month() ) :
		$title = sprintf( __( 'Month: %s', 'rhythm' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'rhythm' ) ) . '</span>' );

	elseif ( is_year() ) :
		$title = sprintf( __( 'Year: %s', 'rhythm' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'rhythm' ) ) . '</span>' );

	elseif( is_tax() ) :
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = $term->name;

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		$title = __( 'Asides', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		$title = __( 'Galleries', 'rhythm');

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		$title = __( 'Images', 'rhythm');

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		$title = __( 'Videos', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		$title = __( 'Quotes', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		$title = __( 'Links', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		$title = __( 'Statuses', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		$title = __( 'Audios', 'rhythm' );

	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		$title = __( 'Chats', 'rhythm' );

	elseif( is_404() ) :
		$title = __( '404', 'rhythm' );

	else :
		$title = __( 'Archives', 'rhythm' );
	endif;
	
	return $title;
}
endif;

if ( ! function_exists( 'rhythm_get_subtitle' ) ) : 

/**
 * Get page subtitle
 * @global object $wp_query
 */
function rhythm_get_subtitle() {
	
	if (is_singular()) {
		return ts_get_post_opt('title-wrapper-subtitle-local');
	}
	return '';
}
endif;



if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rhythm_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rhythm_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rhythm_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rhythm_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rhythm_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rhythm_categorized_blog.
 */
function rhythm_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'rhythm_categories' );
}
add_action( 'edit_category', 'rhythm_category_transient_flusher' );
add_action( 'save_post',     'rhythm_category_transient_flusher' );

if ( ! function_exists( 'rhythm_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @param int/boolean $max_num_pages
 * @return void
 */
function rhythm_paging_nav( $max_num_pages = false ) {

	$prev_icon = 'fa-angle-left';
	$next_icon = 'fa-angle-right';

	if( true == is_rtl() ) {
		$prev_icon = 'fa-angle-right';
		$next_icon = 'fa-angle-left';
	}

	if ( $max_num_pages === false ) {
		global $wp_query;
		$max_num_pages = $wp_query -> max_num_pages;
	}
	
	if( is_front_page() || is_home() ) {
        $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
    } else {
        $paged = intval( get_query_var('paged') );
    }

	$big = 999999999; // need an unlikely integer

	$links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $max_num_pages,
		'prev_next'		=> true,
		'prev_text' 	=> '<i class="fa '.$prev_icon.'"></i>',
		'next_text' 	=> '<i class="fa '.$next_icon.'"></i>',
		'end_size'		=> 1,
		'mid_size'		=> 2,
		'type' 			=> 'plain',
	) );

	if (!empty($links)): ?>
		<div class="pagination">
			<?php echo $links; ?>
		</div>
	<?php endif;
}
endif;

if ( ! function_exists( 'rhythm_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since rhythm 1.0
 */
function rhythm_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
				<div class="media-body"><?php _e( 'Pingback:', 'rhythm' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'rhythm' ), ' ' ); ?></div>
			</li>
			<?php
		break;
	
		default :
			$class = array('comment_wrap');
			if ($depth > 1) {
				$class[] = 'chaild';
			}
			?>
			<!-- Comment Item -->
			<li <?php comment_class('media comment-item'); ?> id="comment-<?php comment_ID(); ?>">

				<a class="pull-left" href="#"><?php echo get_avatar( $comment, 50 ); ?></a>

				<div class="media-body">

					<div class="comment-item-data">
						<div class="comment-author">
							<?php comment_author_link();?>
						</div>
						<?php echo comment_date(get_option('date_format')) ?>, <?php echo comment_date(get_option('time_format')) ?><span class="separator">&mdash;</span>
						
						<?php $reply = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) );
						if (!empty($reply)): ?>
							<i class="fa fa-comment"></i>&nbsp;<?php echo $reply; ?>
						<?php endif;
						edit_comment_link( __( 'Edit', 'rhythm' ), '<i class="fa fa-edit"></i>&nbsp;' );?>
					</div>

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php _e( 'Your comment is awaiting moderation.', 'rhythm' ); ?></em>
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
			<?php
			break;
	endswitch;
}

endif; // ends check for rhythm_comment()

if (!function_exists('rhythm_close_comment')):
/**
 * Close comment
 * 
 * @since rhythm 1.0
 */
function rhythm_close_comment() { ?>		
			</li>
			<!-- End Comment Item -->
<?php }

endif; // ends check for rhythm_close_comment()


/**
 * Show breadcrumbs
 * 
 * @since rhythm 1.0
 */
function rhythm_breadcrumbs( $class = 'align-right', $separator = '&nbsp;/&nbsp;' ) { 
	
	$before = '';
	$after = '';
	$before_last = '<span>';
	$after_last = '</span>';
	?>
	<!-- Breadcrumbs -->
	<div class="mod-breadcrumbs font-alt <?php echo sanitize_html_classes($class); ?>">
		<?php
		
		if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()) {
			$args = array(
				'delimiter'   => '&nbsp;/&nbsp;',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
			);

			woocommerce_breadcrumb($args);

		} else if (!is_home()) {

			echo $before.'<a href="';
			echo esc_url(ts_get_home_url());
			echo '">';
			echo __('Home', 'rhythm');
			echo '</a>'.$after. $separator .'';
			
			if (is_single()) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					echo $before.'<a href="'. esc_url(get_category_link( $cats[0]->term_id )) .'">'. $cats[0]->cat_name.'</a>' . $after . $separator;
				endif;

				if (is_single()) {
					echo $before.$before_last;
					the_title();
					echo $after_last.$after;
				}
			} elseif( is_category() ) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					echo $before.$before_last.single_cat_title('', false).$after_last.$after;
				endif;

			} elseif (is_page()) {
				global $post;
				
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = $before.'<a href="'.esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'"  rel="v:url" property="v:title">'.get_the_title($ancestor).'</a>'.$after.' ' . $separator;
					}
					echo $output;
					echo $before.$before_last.$title.$after_last.$after;
				} else {
					echo $before.$before_last.get_the_title().$after_last.$after;
				}
			}
			elseif (is_tag()) { 
				echo $before.$before_last.single_cat_title('', false).$after_last.$after; 
				
			} elseif (is_day()) {
				echo $before.$before_last. __('Archive for', 'rhythm').' '; 
				the_time('F jS, Y');
				echo $after_last.$after;
				
			} elseif (is_month()) {
				echo $before.$before_last.__('Archive for', 'rhythm').' '; 
				the_time('F, Y');
				echo $after_last.$after;
				
			} elseif (is_year()) {
				echo $before.$before_last. __('Archive for', 'rhythm').' '; 
				the_time('Y');
				echo $after_last.$after;
				
			} elseif (is_author()) {
				echo $before.$before_last. __('Author Archive', 'rhythm');
				echo $after_last.$after;
				
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				echo $before.$before_last.__('Blog Archives', 'rhythm').$after_last.$after;
				
			} elseif (is_search()) {
				echo $before.$before_last. __('Search Results', 'rhythm').$after_last.$after;
				
			}

		} elseif (is_home()) { 
			echo $before.$before_last. __('Home', 'rhythm') .$after_last.$after; 
		}
		?>
	</div>
	<!-- End Breadcrumbs -->
<?php }

/**
 * Show presto breadcrumbs
 * 
 */
function rhythm_presto_breadcrumbs( $class = 'align-right'  ) { 
	
	$before = '';
	$after = '';
	$before_last = '<span>';
	$after_last = '</span>';
	$separator = '<i class="fa fa-angle-right"></i>';
	?>
		<?php
		
		if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()) {
			$args = array(
				'delimiter'   => '&nbsp;/&nbsp;',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
			);

			woocommerce_breadcrumb($args);

		} else if (!is_home()) {

			echo $before.'<a href="';
			echo esc_url(ts_get_home_url());
			echo '">';
			echo __('Home', 'rhythm');
			echo '</a>'.$after. $separator .'';
			
			if (is_single()) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					echo $before.'<a href="'. esc_url(get_category_link( $cats[0]->term_id )) .'">'. $cats[0]->cat_name.'</a>' . $after . $separator;
				endif;

				if (is_single()) {
					echo $before.$before_last;
					the_title();
					echo $after_last.$after;
				}
			} elseif( is_category() ) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					echo $before.$before_last.single_cat_title('', false).$after_last.$after;
				endif;

			} elseif (is_page()) {
				global $post;
				
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = $before.'<a href="'.esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'"  rel="v:url" property="v:title">'.get_the_title($ancestor).'</a>'.$after.' ' . $separator;
					}
					echo $output;
					echo $before.$before_last.$title.$after_last.$after;
				} else {
					echo $before.$before_last.get_the_title().$after_last.$after;
				}
			}
			elseif (is_tag()) { 
				echo $before.$before_last.single_cat_title('', false).$after_last.$after; 
				
			} elseif (is_day()) {
				echo $before.$before_last. __('Archive for', 'rhythm').' '; 
				the_time('F jS, Y');
				echo $after_last.$after;
				
			} elseif (is_month()) {
				echo $before.$before_last.__('Archive for', 'rhythm').' '; 
				the_time('F, Y');
				echo $after_last.$after;
				
			} elseif (is_year()) {
				echo $before.$before_last. __('Archive for', 'rhythm').' '; 
				the_time('Y');
				echo $after_last.$after;
				
			} elseif (is_author()) {
				echo $before.$before_last. __('Author Archive', 'rhythm');
				echo $after_last.$after;
				
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				echo $before.$before_last.__('Blog Archives', 'rhythm').$after_last.$after;
				
			} elseif (is_search()) {
				echo $before.$before_last. __('Search Results', 'rhythm').$after_last.$after;
				
			}

		} elseif (is_home()) { 
			echo $before.$before_last. __('Home', 'rhythm') .$after_last.$after; 
		}
		?>
<?php }

function rhythm_social_links($pattern = '%s', $category = '', $style = 1) {
	$args = array(
		'posts_per_page' => -1,
		'offset'          => 0,
		'orderby'         => 'menu_order',
		'order'           => 'ASC',
		'post_type'       => 'social-site',
		'post_status'     => 'publish'
	);
	
	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'social-site-category',
				'field'    => 'id',
				'terms'    => $category,
			),
		);
	}
	
	$custom_query = new WP_Query( $args );
	if ( $custom_query->have_posts() ):
		
		$found_posts = $custom_query -> found_posts;
		$ts_loop_it = 0;
		while ( $custom_query -> have_posts() ) :
			$custom_query -> the_post(); 
		
			if ($style == 5) {
				echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><span class="mn-soc-link brand-bg" title="'.esc_attr(ucfirst(str_replace('fa-','',ts_get_post_opt('icon')))).'"><i class="fa '.esc_attr(ts_get_post_opt('icon')).'"></i></span></a>');
			} elseif ($style == 4) {
				echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><span class="mn-soc-link brand-color" title="'.esc_attr(ucfirst(str_replace('fa-','',ts_get_post_opt('icon')))).'"><i class="fa '.esc_attr(ts_get_post_opt('icon')).'"></i></span></a>');
			} elseif ($style == 3) {
				echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><span class="mn-soc-link tooltip-bot" title="'.esc_attr(ucfirst(str_replace('fa-','',ts_get_post_opt('icon')))).'"><i class="fa '.esc_attr(ts_get_post_opt('icon')).'"></i></span></a>');
			} elseif ($style == 2) {
				echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><span class="mn-soc-link tooltip-top" title="'.esc_attr(ucfirst(str_replace('fa-','',ts_get_post_opt('icon')))).'"><i class="fa '.esc_attr(ts_get_post_opt('icon')).'"></i></span></a>');
			} else {
				echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><i class=" fa '.esc_attr(ts_get_post_opt('icon')).'"></i></a>');
			}

		?>
		<?php endwhile; // end of the loop.
	endif;
	wp_reset_postdata();
}

function rhythm_get_social_links( $pattern = '%s', $category = '', $style = 1 ) {
	
	$args = array(
		'posts_per_page' => -1,
		'offset'          => 0,
		'orderby'         => 'menu_order',
		'order'           => 'ASC',
		'post_type'       => 'social-site',
		'post_status'     => 'publish'
	);
	
	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'social-site-category',
				'field'    => 'id',
				'terms'    => $category,
			),
		);
	}
	
	$out = '';
	
	$custom_query = new WP_Query( $args );
	if ( $custom_query->have_posts() ):
		
		$found_posts = $custom_query -> found_posts;
		$ts_loop_it = 0;
		while ( $custom_query -> have_posts() ) :
			$custom_query -> the_post(); 
		
			$icon = ts_get_post_opt( 'icon' );
			if (!is_string($icon)) {
				$icon = '';
			}

			if ( $style == 3 ) {
				$out .= sprintf( $pattern, '<a href="' . esc_url( get_the_title() ) . '" target="_blank"><span class="mn-soc-link tooltip-bot" title="' . esc_attr( ucfirst( str_replace( 'fa-', '', $icon ) ) ) . '"><i class="fa ' . esc_attr( $icon ) . '"></i></span></a> ');
			} elseif ( $style == 2 ) {
				$out .= sprintf( $pattern, '<a href="' . esc_url( get_the_title() ) . '" target="_blank"><span class="mn-soc-link tooltip-top" title="' . esc_attr( ucfirst( str_replace( 'fa-', '', $icon ) ) ) . '"><i class="fa ' . esc_attr( $icon ) . '"></i></span></a> ' );
			} else {
				$out .= sprintf( $pattern, '<a href="' . esc_url( get_the_title() ) . '" target="_blank"><i class=" fa ' . esc_attr( $icon ) . '"></i></a> ');
			}

		?>
		<?php endwhile; // end of the loop.
	endif;
	wp_reset_postdata();
	
	return $out;
}