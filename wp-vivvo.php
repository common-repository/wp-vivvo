<?php
/*
	Plugin Name: WP VIVVO
	Plugin URI: http://www.codehub.us/vivvo2wordpress
	Description: VIVVO CMS to WordPress Migration Tool
	Author: CodeHub, Inc.
	Version: 1.0
	Author URI: http://www.codehub.us
	License: GPL 2.0
*/

define('VIVVO_TABLE_PREFIX', 'v45_'); /* Change this to your VIVVO table prefix */

/* Don't change things below */
define('SYS_VTW', WP_PLUGIN_DIR . '/wp-vivvo');

require_once SYS_VTW . '/include/vivvo-functions.php';
require_once SYS_VTW . '/include/vivvo-tools.php';

function vtw_tools_link($links) {
	array_unshift($links, '<a href="tools.php?page=vivvo2wordpress/include/vivvo-tools.php">Tools</a>');
	return $links;
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'vtw_tools_link');

/* eof */
?>
