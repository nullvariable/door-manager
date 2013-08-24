<?php
class door_manager_client {
    function __construct() {
        add_action('admin_menu', array($this, 'admin_init'));
        add_shortcode('door', array($this, 'shortcode'));
    }

    function admin_init() {
        add_options_page('Client Demo', 'Client Demo', 'activate_plugins', 'clientdemo', array($this, 'admin_screen'));
    }
    function admin_screen() {
        //render and handle our settings screen
        ?>
        <div class="wrap">
            <h1>Client Demo</h1>
            <script type="text/javascript">
                jQuery('document').ready( function($){

                });
            </script>
            <input type="text"
        </div>
<?php
    }

    function shortcode() {
        //render html etc for front end usage to process door requests
    }
}
