<?php
/**
 * Register Custom Post Types
 *
 * @package SWS
 */

defined( 'WPINC' ) || exit;

/**
 * Main class of Custom Post Types
 */
class Custom_Post_Types {

	/**
	 * The Construct
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'members_custom_post_type' ] );
		add_action( 'init', [ $this, 'member_profile_taxonomy' ] );
		add_action( 'init', [ $this, 'member_skill_taxonomy' ] );
		add_action( 'init', [ $this, 'testimonials_custom_post_type' ] );
	}

	/**
	 * Members CPT
	 */
	public function members_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Members', 'Post Type General Name', 'sws' ),
			'singular_name'      => _x( 'Member', 'Post Type Singular Name', 'sws' ),
			'menu_name'          => __( 'Members', 'sws' ),
			'parent_item_colon'  => __( 'Parent Member', 'sws' ),
			'all_items'          => __( 'All Members', 'sws' ),
			'view_item'          => __( 'View Member', 'sws' ),
			'add_new_item'       => __( 'Add New Member', 'sws' ),
			'add_new'            => __( 'Add New', 'sws' ),
			'edit_item'          => __( 'Edit Member', 'sws' ),
			'update_item'        => __( 'Update Member', 'sws' ),
			'search_items'       => __( 'Search Member', 'sws' ),
			'not_found'          => __( 'Not Found', 'sws' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'sws' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Members', 'sws' ),
			'menu_icon'           => 'dashicons-id-alt',
			'description'         => __( 'Member posts', 'sws' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'members', $args );
	}

	/**
	 * Create a custom taxonomy named 'profile' for Members CPT.
	 */
	public function member_profile_taxonomy() {

		$labels = [
			'name'              => _x( 'Profiles', 'taxonomy general name', 'sws' ),
			'singular_name'     => _x( 'Profile', 'taxonomy singular name', 'sws' ),
			'search_items'      => __( 'Search Profiles', 'sws' ),
			'all_items'         => __( 'All Profiles', 'sws' ),
			'parent_item'       => __( 'Parent Profile', 'sws' ),
			'parent_item_colon' => __( 'Parent Profile: ', 'sws' ),
			'edit_item'         => __( 'Edit Profile', 'sws' ),
			'update_item'       => __( 'Update Profile', 'sws' ),
			'add_new_item'      => __( 'Add New Profile', 'sws' ),
			'new_item_name'     => __( 'New Profile Name', 'sws' ),
			'menu_name'         => __( 'Profiles', 'sws' ),
		];

		register_taxonomy(
			'profile',
			[ 'members' ],
			[
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => [ 'slug' => 'profile' ],
				// 'show_in_rest'      => true,
			]
		);
	}

	/**
	 * Create a custom taxonomy named 'skill' for Members CPT.
	 */
	public function member_skill_taxonomy() {

		$labels = [
			'name'              => _x( 'Skills', 'taxonomy general name', 'sws' ),
			'singular_name'     => _x( 'Skill', 'taxonomy singular name', 'sws' ),
			'search_items'      => __( 'Search Skills', 'sws' ),
			'all_items'         => __( 'All Skills', 'sws' ),
			'parent_item'       => __( 'Parent Skill', 'sws' ),
			'parent_item_colon' => __( 'Parent Skill: ', 'sws' ),
			'edit_item'         => __( 'Edit Skill', 'sws' ),
			'update_item'       => __( 'Update Skill', 'sws' ),
			'add_new_item'      => __( 'Add New Skill', 'sws' ),
			'new_item_name'     => __( 'New Skill Name', 'sws' ),
			'menu_name'         => __( 'Skills', 'sws' ),
		];

		register_taxonomy(
			'skill',
			[ 'members' ],
			[
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => [ 'slug' => 'skill' ],
				// 'show_in_rest'      => true,
			]
		);
	}

	/**
	 * Testimonials CPT
	 */
	public function testimonials_custom_post_type() {

		// Set UI labels for Custom Post Type.
		$labels = [
			'name'               => _x( 'Testimonials', 'Post Type General Name', 'sws' ),
			'singular_name'      => _x( 'Testimonial', 'Post Type Singular Name', 'sws' ),
			'menu_name'          => __( 'Testimonials', 'sws' ),
			'parent_item_colon'  => __( 'Parent Testimonial', 'sws' ),
			'all_items'          => __( 'All Testimonials', 'sws' ),
			'view_item'          => __( 'View Testimonial', 'sws' ),
			'add_new_item'       => __( 'Add New Testimonial', 'sws' ),
			'add_new'            => __( 'Add New', 'sws' ),
			'edit_item'          => __( 'Edit Testimonial', 'sws' ),
			'update_item'        => __( 'Update Testimonial', 'sws' ),
			'search_items'       => __( 'Search Testimonial', 'sws' ),
			'not_found'          => __( 'Not Found', 'sws' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'sws' ),
		];

		// Set other options for Custom Post Type.
		$args = [
			'label'               => __( 'Testimonials', 'sws' ),
			'menu_icon'           => 'dashicons-admin-comments',
			'description'         => __( 'Testimonial posts', 'sws' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
			/**
			 * A hierarchical CPT is like Pages and can have
			 * Parent and child items. A non-hierarchical CPT
			 * is like Posts.
			 */
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			// 'show_in_rest'        => true,

		];

		// Registering your Custom Post Type.
		register_post_type( 'testimonials', $args );
	}

}

/**
 * Init
 */
new Custom_Post_Types();
