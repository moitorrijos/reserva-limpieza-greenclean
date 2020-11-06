<?php

// Register Custom Post Type
function gcs_registrar_limpieza() {

	$labels = array(
		'name'                  => _x( 'Limpiezas', 'Post Type General Name', 'green_c_services' ),
		'singular_name'         => _x( 'Limpieza', 'Post Type Singular Name', 'green_c_services' ),
		'menu_name'             => __( 'Limpiezas', 'green_c_services' ),
		'name_admin_bar'        => __( 'Limpiezas', 'green_c_services' ),
		'archives'              => __( 'Item Archives', 'green_c_services' ),
		'attributes'            => __( 'Item Attributes', 'green_c_services' ),
		'parent_item_colon'     => __( 'Parent Item:', 'green_c_services' ),
		'all_items'             => __( 'All Items', 'green_c_services' ),
		'add_new_item'          => __( 'Add New Item', 'green_c_services' ),
		'add_new'               => __( 'Add New', 'green_c_services' ),
		'new_item'              => __( 'New Item', 'green_c_services' ),
		'edit_item'             => __( 'Edit Item', 'green_c_services' ),
		'update_item'           => __( 'Update Item', 'green_c_services' ),
		'view_item'             => __( 'View Item', 'green_c_services' ),
		'view_items'            => __( 'View Items', 'green_c_services' ),
		'search_items'          => __( 'Search Item', 'green_c_services' ),
		'not_found'             => __( 'Not found', 'green_c_services' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'green_c_services' ),
		'featured_image'        => __( 'Featured Image', 'green_c_services' ),
		'set_featured_image'    => __( 'Set featured image', 'green_c_services' ),
		'remove_featured_image' => __( 'Remove featured image', 'green_c_services' ),
		'use_featured_image'    => __( 'Use as featured image', 'green_c_services' ),
		'insert_into_item'      => __( 'Insert into item', 'green_c_services' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'green_c_services' ),
		'items_list'            => __( 'Items list', 'green_c_services' ),
		'items_list_navigation' => __( 'Items list navigation', 'green_c_services' ),
		'filter_items_list'     => __( 'Filter items list', 'green_c_services' ),
	);
	$args = array(
		'label'                 => __( 'Limpieza', 'green_c_services' ),
		'description'           => __( 'Limpiezas Programadas de cliente', 'green_c_services' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'limpieza', $args );

}
add_action( 'init', 'gcs_registrar_limpieza', 0 );