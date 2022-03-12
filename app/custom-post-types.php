<?php
/**
 * Custom Post Types
 *
 * Return an array that will be passed to register_post_type() WordPress core function.
 *
 * You should just fill the array (or leave an empty array) and genese will do the rest.
 * Note: It is important that this file returns an array.
 *
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 *
 * @package  Genese
 * @subpackage Custom_Post_Types
 * @since 1.0
 */

/*
 * Edit this array to fit your needs.
 */
return array(
	// Event Post Type.
	'event'  => array(
		'label'                 => __( 'Event', 'genese' ),
		'description'           => __( 'Event Description', 'genese' ),
		'labels'                => array(
			'name'                  => _x( 'Events', 'Post Type General Name', 'genese' ),
			'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'genese' ),
			'menu_name'             => __( 'Events', 'genese' ),
			'name_admin_bar'        => __( 'Event', 'genese' ),
		),
		'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', ),
		'rewrite'               => array('slug' => 'event', 'with_front' => false),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',

		'show_in_rest' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'event',
		'graphql_plural_name' => 'events',
	),

	// People Post Type.
	'people' => array(
		'label'                 => __( 'People', 'genese' ),
		'description'           => __( 'People Description', 'genese' ),
		'labels'                => array(
			'name'                  => _x( 'People', 'Post Type General Name', 'genese' ),
			'singular_name'         => _x( 'Person', 'Post Type Singular Name', 'genese' ),
			'menu_name'             => __( 'People', 'genese' ),
			'name_admin_bar'        => __( 'People', 'genese' ),
		),
		'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields', ),
		'rewrite'               => array('slug' => 'people', 'with_front' => false),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'				=> 'dashicons-universal-access-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',

		'show_in_rest' => true,
		'show_in_graphql' => true,
		'graphql_single_name' => 'people',
		'graphql_plural_name' => 'people',
	),
);
