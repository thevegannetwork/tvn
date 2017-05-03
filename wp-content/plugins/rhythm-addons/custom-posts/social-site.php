<?php
/**
 * Social sites
 */
$labels = array(
		'name'               => __( 'Social Sites', 'rhythm-addons' ),
		'singular_name'      => __( 'Social Site', 'rhythm-addons' ),
		'add_new'            => __( 'Add New','rhythm-addons' ),
		'add_new_item'       => __( 'Add New Social Site','rhythm-addons' ),
		'edit_item'          => __( 'Edit Social Site','rhythm-addons' ),
		'new_item'           => __( 'New Social Site','rhythm-addons' ),
		'all_items'          => __( 'All Social Sites','rhythm-addons' ),
		'view_item'          => __( 'View Social Site','rhythm-addons' ),
		'search_items'       => __( 'Search Social Sites','rhythm-addons' ),
		'not_found'          => __( 'No Social Sites found','rhythm-addons' ),
		'not_found_in_trash' => __( 'No Social Sites found in the Trash','rhythm-addons' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Social Sites', 'rhythm-addons' ),
);

$args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'page-attributes' ),
	'has_archive'   => false,
	'rewrite' => array(
		'slug' => 'cpt-social-site'
	)
);
register_post_type( 'social-site', $args );

/**
 * Social sie category
 */

$labels = array(
	'name'              => _x( 'Categories', 'taxonomy general name', 'rhythm-addons' ),
	'singular_name'     => _x( 'Category', 'taxonomy singular name', 'rhythm-addons' ),
	'search_items'      => __( 'Search categories', 'rhythm-addons' ),
	'all_items'         => __( 'All Categories', 'rhythm-addons' ),
	'parent_item'       => __( 'Parent Category', 'rhythm-addons' ),
	'parent_item_colon' => __( 'Parent Category:', 'rhythm-addons' ),
	'edit_item'         => __( 'Edit Category', 'rhythm-addons' ),
	'update_item'       => __( 'Update Category', 'rhythm-addons' ),
	'add_new_item'      => __( 'Add New Category', 'rhythm-addons' ),
	'new_item_name'     => __( 'New Category Name', 'rhythm-addons' ),
	'menu_name'         => __( 'Categories' ),
);
$args = array(
	'labels' => $labels,
	'hierarchical' => true,
);
register_taxonomy( 'social-site-category', 'social-site', $args );

/**
 * Social sites - replace "enter title here" with "enter url here" when adding new site
 */
function ts_custom_post_social_sites_change_title( $title ){
	$screen = get_current_screen();

	if  ( 'social-site' == $screen->post_type ) {
		$title = __('http:// Enter URL here', 'rhythm-addons');
	}
	return $title;
}
add_filter( 'enter_title_here', 'ts_custom_post_social_sites_change_title' );

/**
 * Social Site special columns head
 * @param type $defaults
 * @return type
 */
function ts_social_site_columns_head($defaults) {
    $defaults['social_site'] = __('Social Site', 'rhythm-addons');
    $defaults['social_site_categories'] = __('Categories', 'rhythm-addons');
    $defaults['menu_order'] = __('Order', 'rhythm-addons');
    return $defaults;
}
 
/**
 * Social site special columns content
 * @param type $column_name
 * @param type $post_ID
 */
function ts_social_site_columns_content($column_name, $post_ID) {
    
	global $post;
	
	if ($column_name == 'social_site') {
		echo str_replace('fa-', '', get_post_meta( $post_ID, 'icon', true ));
    }
	else if ($column_name == 'menu_order') {
		$order = $post->menu_order;
		echo $order;
    }
	else if ($column_name == 'social_site_categories') {
		
		$categories = get_the_terms($post_ID,'social-site-category');
		if (is_array($categories)) {
			$categories_output = array();
			foreach($categories as $key => $category) {
				$edit_link = get_term_link($category,'social-site-category');
				$categories_output[$key] = '<a href="'.$edit_link.'">' . $category->name . '</a>';
			}
			echo implode(' | ',$categories_output);
		}
    }
}

add_filter( 'manage_edit-social-site_columns', 'ts_social_site_columns_head' ) ;
add_action('manage_social-site_posts_custom_column', 'ts_social_site_columns_content', 10, 2);