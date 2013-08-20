<?php
class door_manager_client {
    function __construct() {
        add_action('admin_init', array($this, 'admin_init'));
        add_shortcode('door', array($this, 'shortcode'));
    }

    function admin_init() {
        //add our menu item
    }
    function admin_screen() {
        //render and handle our settings screen
    }

    function shortcode() {
        //render html etc for front end usage to process door requests
    }
}
