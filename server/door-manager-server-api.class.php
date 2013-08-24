<?php
class door_manager_server_api {
    function __construct() {
        add_action('init', array($this, 'rewrite_hook'));
        //add_action('wp_ajax_dsmapi', array($this, 'api_handler'));
        //add_action('wp_ajax_nopriv_dsmapi', array($this, 'api_handler'));
        add_action('template_redirect', array($this, 'api_handler'));
    }
    function api_handler() {
        global $wp_query;
        if ( !isset($wp_query->query_vars['api_action']))
            return;

        if (!empty($_POST['api_key'])) {
            $this->validate($_POST['api_key']);
        }
        switch ($wp_query->query_vars['api_action']) {
            case 'unlock':
                $this->unlock($wp_query->query_vars['door_id']);
                die();
            case 'doors':
                $this->doors();
                die();
            case 'accesslog':
                $this->accesslog();
                die();
        }

        die();
    }
    function rewrite_hook() {
        add_rewrite_tag('%door_id%', '^[0-9]/?');
        add_rewrite_tag('%api_action%', '^[*]/?');
        $regex = '^dsm/v1/([^/]+)/([^/]+)?';
        $rewrite = 'index.php?api_action=$matches[1]&door_id=$matches[2]';
        $position = 'top';
        add_rewrite_rule($regex, $rewrite, $position); //@todo move to plugin activation
        //flush_rewrite_rules();

    }

    function validate($api_key) {
        //die if they key is invalid
    }

    function unlock($door_id) {

        $pin = get_post_meta(intval($door_id), DMS_META_DOOR_PIN, true);

        $apikey = (!empty($_POST['apikey'])) ? sanitize_text_field($_POST['apikey']) : '';
        $user = (!empty($_POST['user'])) ? sanitize_text_field($_POST['user']) : '';

        $this->write_log('Unlock', $_SERVER['REMOTE_ADDR'], time(), $apikey, $user);

        if (!empty($pin)) {
            shell_exec('gpio ');
            shell_exec("gpio $pin 1");
            sleep(5);
            shell_exec("gpio $pin 0");
            wp_send_json_success("completed");
        } else {
            wp_send_json_error("no pin or door found");
        }

        die();
    }

    function doors() {
        $args = array (
            'post_type'              => DMS_DOOR,
            'posts_per_page'         => '-1',
        );

        $query = new WP_Query( $args );

        foreach ($query->posts as $postobj) {
            $json[] = array(
                'name' => $postobj->post_title,
                'id' => $postobj->ID,
                'pin' => get_post_meta($postobj->ID, DMS_META_DOOR_PIN, true),
            );
        }
        wp_send_json_success($json);
    }

    function write_log($action, $ip, $time, $apikey, $user) {
        $postobj = array(
            'post_title' => $action,
            'post_type' => DMS_DOOR_ACCESS_LOG,
            'post_status' => 'publish',
        );
        $pid = wp_insert_post($postobj);
        add_post_meta($pid, DMS_LOG_IP, $ip);
        add_post_meta($pid, DMS_LOG_TIMESTAMP, $time);
        add_post_meta($pid, DMS_LOG_KEY_USED, $apikey);
        add_post_meta($pid, DMS_LOG_USER, $user);
    }
}
