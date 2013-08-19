<?php
/*
Plugin Name: Door Manager Client
Plugin URI: http://dougcone.com
Description: Real World door management, this end handles requests and permissions. Needs to talk to a local or remote server.
Version: 0.1
Author: Doug Cone
Author URI: http://dougcone.com
License: GPLv2 or later
*/

/*0
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
include(plugin_dir_path(__FILE__).'client/door-manager-client.class.php');
$door_manager_client = new door_manager_client();
