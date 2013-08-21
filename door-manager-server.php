<?php
/*
Plugin Name: Door Manager Server
Plugin URI: http://dougcone.com
Description: Real World door controller, server side. handles incoming requests.
Version: 0.1
Author: Doug Cone
Author URI: http://dougcone.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
define('DMS_BASE_DIR', plugin_dir_path(__FILE__).'server/');

//meta field names
define('DMS_META_DOOR_PIN', 'dms_meta_door_pin'); //door pin meta field name

define('DMS_LOG_IP', 'dms_log_ip');//meta field for logged IP
define('DMS_LOG_TIMESTAMP', 'dms_log_timestamp'); //meta field for logged time
define('DMS_LOG_KEY_USED', 'dms_log_key_used'); //meta field for api key used for access
define('DMS_LOG_USER', 'dms_log_user'); //meta field for the user id on the client site

define('DMS_API_KEY_FIELD', 'dms_api_key_field'); //meta field for the API key
define('DMS_API_KEY_STATUS', 'dms_api_key_status'); //meta field for the api key status

//custom post type names
define('DMS_DOOR_ACCESS_LOG', 'dms_door_access_log'); //custom post type name
define('DMS_DOOR', 'dms_door'); //custom post type name
define('DMS_API_KEYS', 'dms_api_keys'); //custom post type name

include(DMS_BASE_DIR.'door-manager-server.class.php');
$door_manager_server = new door_manager_server();
//include(DMS_BASE_DIR.'door-manager-server-screens.class.php');
//$door_manager_server_screens = new door_manager_server_screens();
include(DMS_BASE_DIR.'door-manager-server-api.class.php');
$door_manager_server_api = new door_manager_server_api();

