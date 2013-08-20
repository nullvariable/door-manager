<?php
class door_manager_server {
    function __construct() {
        add_action('admin_init', array($this, 'admin_init'));
        add_action('wp_ajax_doormanager', array($this, 'api_handler'));

        add_action( 'init', array($this, 'cpt_door'), 0 ); //add content type.
    }

    function admin_init() {
        //add menu item
    }
    function admin_page() {
        //admin page handler

    }

    /**
     *
     */
    function api_handler() {
        //handle calls to the server
    }

    function cpt_door() {

        $labels = array(
            'name'                => _x( 'Doors', 'Post Type General Name', 'door_manager' ),
            'singular_name'       => _x( 'Door', 'Post Type Singular Name', 'door_manager' ),
            'menu_name'           => __( 'Door', 'door_manager' ),
            'parent_item_colon'   => __( 'Parent Door:', 'door_manager' ),
            'all_items'           => __( 'All Doors', 'door_manager' ),
            'view_item'           => __( 'View Door', 'door_manager' ),
            'add_new_item'        => __( 'Add New Door', 'door_manager' ),
            'add_new'             => __( 'New Door', 'door_manager' ),
            'edit_item'           => __( 'Edit Door', 'door_manager' ),
            'update_item'         => __( 'Update Door', 'door_manager' ),
            'search_items'        => __( 'Search Doors', 'door_manager' ),
            'not_found'           => __( 'No doors found', 'door_manager' ),
            'not_found_in_trash'  => __( 'No doors found in Trash', 'door_manager' ),
        );
        $args = array(
            'label'               => __( 'door', 'door_manager' ),
            'description'         => __( 'Doors managed by the server', 'door_manager' ),
            'labels'              => $labels,
            'supports'            => array( 'title', ),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => false,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'show_in_admin_bar'   => false,
            'menu_position'       => 5,
            'menu_icon'           => '',
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'rewrite'             => false,
            'capability_type'     => 'page',
        );
        register_post_type( 'door', $args );

    }
}
