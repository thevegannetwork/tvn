<?php
/**
 * Team custom post type
 */
$labels = array(
	'name'               => _x( 'Team', 'Team','rhythm-addons' ),
	'singular_name'      => _x( 'Team', 'Team','rhythm-addons' ),
	'add_new'            => _x( 'Add New', 'Team','rhythm-addons' ),
	'add_new_item'       => __( 'Add New Team Member','rhythm-addons' ),
	'edit_item'          => __( 'Edit Team Memeber','rhythm-addons' ),
	'new_item'           => __( 'New Team Member','rhythm-addons' ),
	'all_items'          => __( 'All Team Memebers','rhythm-addons' ),
	'view_item'          => __( 'View Team','rhythm-addons' ),
	'search_items'       => __( 'Search Team Member','rhythm-addons' ),
	'not_found'          => __( 'No Member found','rhythm-addons' ),
	'not_found_in_trash' => __( 'No Team Member found in the Trash','rhythm-addons' ), 
	'parent_item_colon'  => '',
	'menu_name'          => __('Team', 'rhythm-addons')
);
$args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail', 'editor' ),
	'has_archive'   => true,
	'rewrite' => array(
		'slug' => 'cpt-team'
	)
	//'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_green.png',
);
register_post_type( 'team', $args ); 
