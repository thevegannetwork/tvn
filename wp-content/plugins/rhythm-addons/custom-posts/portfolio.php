<?php
/**
 * Portfolio custom posty type
 */
$labels = array(
	'name'               => _x( 'Portfolio', 'Items','rhythm-addons' ),
	'singular_name'      => _x( 'Portfolio', 'Item','rhythm-addons' ),
	'add_new'            => _x( 'Add New', 'Item','rhythm-addons' ),
	'add_new_item'       => __( 'Add New Item','rhythm-addons' ),
	'edit_item'          => __( 'Edit Item','rhythm-addons' ),
	'new_item'           => __( 'New Item','rhythm-addons' ),
	'all_items'          => __( 'All Items','rhythm-addons' ),
	'view_item'          => __( 'View Item','rhythm-addons' ),
	'search_items'       => __( 'Search Items','rhythm-addons' ),
	'not_found'          => __( 'No Items found','rhythm-addons' ),
	'not_found_in_trash' => __( 'No Items found in the Trash','rhythm-addons' ),
	'parent_item_colon'  => '',
	'menu_name'          => __('Portfolio', 'rhythm-addons')
);
$args = array(
	'labels'        => $labels,
	'description'   => __('Holds our products and product specific data', 'rhythm-addons'),
	'public'        => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail','editor' ),
	'has_archive'   => true,

);
register_post_type( 'portfolio', $args );

/**
 * Portflio category
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
register_taxonomy( 'portfolio-category', 'portfolio', $args );
