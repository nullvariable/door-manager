<?php
class door_manager_server {
    function __construct() {
        add_action('admin_init', array($this, 'admin_init'));
        add_action( 'init', array($this, 'register_custom_post_types'), 0 ); //add content type.
        add_action('add_meta_boxes', array($this, 'meta_boxes'));
        add_action('save_post', array($this, 'save_meta'), 1, 2);
    }

    function admin_init() {
        //add menu items
        $menu = add_menu_page('Manage Doors', 'Manage Doors', 'activate_plugins', 'edit.php?post_type='.DMS_DOOR);
        add_submenu_page('edit.php?post_type='.DMS_DOOR, 'Access Log', 'Access Log', 'activate_plugins', 'edit.php?post_type='.DMS_DOOR_ACCESS_LOG);
        add_submenu_page('edit.php?post_type='.DMS_DOOR, 'API Keys', 'API Keys', 'activate_plugins', 'edit.php?post_type='.DMS_API_KEYS);
    }

    function register_custom_post_types() {

        $labels_cpt_door = array(
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
        $args_cpt_door = array(
            'label'               => __( 'door', 'door_manager' ),
            'description'         => __( 'Doors managed by the server', 'door_manager' ),
            'labels'              => $labels_cpt_door,
            'supports'            => array( 'title', ),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
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

        $labels_cpt_access_log = array(
            'name'                => _x( 'Access Logs', 'Post Type General Name', 'door_manager' ),
            'singular_name'       => _x( 'Access Log', 'Post Type Singular Name', 'door_manager' ),
            'menu_name'           => __( 'Access Log', 'door_manager' ),
            'parent_item_colon'   => __( 'Parent Log:', 'door_manager' ),
            'all_items'           => __( 'All Logs', 'door_manager' ),
            'view_item'           => __( 'View Log', 'door_manager' ),
            'add_new_item'        => __( 'Add New Log', 'door_manager' ),
            'add_new'             => __( 'New Log', 'door_manager' ),
            'edit_item'           => __( 'Edit Log', 'door_manager' ),
            'update_item'         => __( 'Update Log', 'door_manager' ),
            'search_items'        => __( 'Search logs', 'door_manager' ),
            'not_found'           => __( 'No logs found', 'door_manager' ),
            'not_found_in_trash'  => __( 'No logs found in Trash', 'door_manager' ),
        );
        $args_cpt_access_log = array(
            'label'               => __( 'door_access_log', 'door_manager' ),
            'description'         => __( 'Door Access Log', 'door_manager' ),
            'labels'              => $labels_cpt_access_log,
            'supports'            => array( 'title', ),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
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

        $labels_api_keys = array(
            'name'                => _x( 'API Keys', 'Post Type General Name', 'door_manager' ),
            'singular_name'       => _x( 'API Key', 'Post Type Singular Name', 'door_manager' ),
            'menu_name'           => __( 'API Keys', 'door_manager' ),
            'parent_item_colon'   => __( 'Parent Key:', 'door_manager' ),
            'all_items'           => __( 'All Keys', 'door_manager' ),
            'view_item'           => __( 'View Keys', 'door_manager' ),
            'add_new_item'        => __( 'Add New Key', 'door_manager' ),
            'add_new'             => __( 'New Key', 'door_manager' ),
            'edit_item'           => __( 'Edit Key', 'door_manager' ),
            'update_item'         => __( 'Update Key', 'door_manager' ),
            'search_items'        => __( 'Search Keys', 'door_manager' ),
            'not_found'           => __( 'No keys found', 'door_manager' ),
            'not_found_in_trash'  => __( 'No keys found in Trash', 'door_manager' ),
        );
        $args_api_keys = array(
            'label'               => __( 'door_api_keys', 'door_manager' ),
            'description'         => __( 'Door Client API Keys', 'door_manager' ),
            'labels'              => $labels_api_keys,
            'supports'            => array( 'title', ),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
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

        register_post_type( DMS_DOOR_ACCESS_LOG, $args_cpt_access_log );
        register_post_type( DMS_DOOR, $args_cpt_door );
        register_post_type( DMS_API_KEYS, $args_api_keys );

    }

    function meta_boxes() {
        //$id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null
        add_meta_box(DMS_DOOR, 'Door Details', array($this, 'door_meta_box'), DMS_DOOR, 'advanced', 'high');
        add_meta_box(DMS_API_KEYS, 'API Access Details', array($this, 'api_meta_box'), DMS_API_KEYS, 'advanced', 'high');
        add_meta_box(DMS_DOOR_ACCESS_LOG, 'Access Log Details', array($this, 'log_meta_box'), DMS_DOOR_ACCESS_LOG, 'advanced', 'high');
    }

    function door_meta_box() {
        global $post;
        $door_pin = get_post_meta($post->ID, DMS_META_DOOR_PIN, true);
        ?>
        <input type="hidden" name="dms_door_noncename" id="dms_door_noncename" value="<?php print wp_create_nonce('dms_door_noncename')?>" />
        <label for="dms_door_pin">Pin</label><input type="text" name="dms_door_pin" id="dms_door_pin" value="<?php print $door_pin;?>" class="widefat" />
        <?php
    }
    function api_meta_box() {
        global $post;
        $meta = get_post_meta($post->ID, DMS_API_KEY_FIELD, true);
        $apikey = (!empty($meta)) ? $meta : $this->generate_api_key();
        $disabled = (!empty($apikey)) ? "disabled " : "";
        ?>
        <input type="hidden" name="dms_api_noncename" id="dms_api_noncename" value="<?php print wp_create_nonce('dms_api_noncename')?>" />
        <input type="text" name="<?php print DMS_API_KEY_FIELD?>" id="<?php print DMS_API_KEY_FIELD?>" value="<?php print $apikey;?>" class="widefat" <?php print $disabled;?>/>
        <?php
    }
    function log_meta_box() {
        global $post;
        $ip = get_post_meta($post->ID, DMS_LOG_IP, true);
        $time = get_post_meta($post->ID, DMS_LOG_TIMESTAMP, true);
        $apikey = get_post_meta($post->ID, DMS_LOG_KEY_USED, true);
        $user = get_post_meta($post->ID, DMS_LOG_USER, true);
        print <<<HTML
        <table class="widefat">
            <tr><th>IP</th><th>Time</th><th>API Key</th><th>User</th></tr>
            <tr><td>$ip</td><td>$time</td><td>$apikey</td><td>$user</td></tr>
        </table>
HTML;

    }

    function save_meta($post_id, $post) {
        if (!empty($_POST['dms_door_noncename']) && wp_verify_nonce($_POST['dms_door_noncename'], 'dms_door_noncename')) {
            if (!current_user_can('activate_plugins')) return $post->ID;
            update_post_meta($post->ID, DMS_META_DOOR_PIN, intval($_POST['dms_door_pin']));
        }
        if (!empty($_POST['dms_api_noncename']) && wp_verify_nonce($_POST['dms_api_noncename'], 'dms_api_noncename')) {
            if (!current_user_can('activate_plugins')) return $post->ID;
            //update_post_meta($post->ID, DMS_META_DOOR_PIN, intval($_POST['dms_door_pin']));
        }
        return $post->ID;
    }

    function generate_api_key() {
        return wp_hash(time(), 'nonce'); //there may be a better way to do this...
    }
}
