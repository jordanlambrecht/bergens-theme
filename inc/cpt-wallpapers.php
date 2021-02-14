<?php

// Register Custom Post Type Wallpaper
// Post Type Key: wallpaper
function create_wallpaper_cpt() {

	$labels = array(
		'name' => _x( 'Wallpapers', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Wallpaper', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Wallpapers', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Wallpaper', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Wallpaper Archives', 'textdomain' ),
		'attributes' => __( 'Wallpaper Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Wallpaper:', 'textdomain' ),
		'all_items' => __( 'All Wallpapers', 'textdomain' ),
		'add_new_item' => __( 'Add New Wallpaper', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Wallpaper', 'textdomain' ),
		'edit_item' => __( 'Edit Wallpaper', 'textdomain' ),
		'update_item' => __( 'Update Wallpaper', 'textdomain' ),
		'view_item' => __( 'View Wallpaper', 'textdomain' ),
		'view_items' => __( 'View Wallpapers', 'textdomain' ),
		'search_items' => __( 'Search Wallpaper', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Wallpaper', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Wallpaper', 'textdomain' ),
		'items_list' => __( 'Wallpapers list', 'textdomain' ),
		'items_list_navigation' => __( 'Wallpapers list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Wallpapers list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Wallpaper', 'textdomain' ),
		'description' => __( 'Upload custom photography and make wallpapers', 'textdomain' ),
		'labels' => $labels,
			'menu_icon' => 'dashicons-format-image',
		'supports' => array('title'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'wallpapers', $args );

}
add_action( 'init', 'create_wallpaper_cpt', 0 );
 ?>
