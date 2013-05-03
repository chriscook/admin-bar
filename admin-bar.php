<?php

/*
Plugin Name: Admin Bar
Description: Adds a very simple administration bar to the front-end of the website
Version: 1.0
Author: Chris Cook
Author URI: http://chris-cook.co.uk
*/

register_plugin(
	basename(__FILE__, ".php"),
	'Admin Bar',
	'1.0',
	'Chris Cook',
	'http://chris-cook.co.uk',
	'Adds a very simple administration bar to the front-end of the website',
	'none',
	'ab_admin_bar_show'
);

add_action('content-bottom', 'ab_admin_bar');

register_style('admin-bar', $SITEURL.'plugins/admin-bar/admin-bar.css', GSVERSION, 'screen');

if (ab_is_admin()) {
	queue_style('admin-bar', GSFRONT);
}

function ab_admin_bar() {
	if (ab_is_admin()) {
		GLOBAL $USR;
		GLOBAL $SITEURL;
		GLOBAL $url;
		echo '<div id="admin-bar">';
		echo '<ul class="left">';
		echo '<li><a href="' . $SITEURL . 'admin/pages.php">Page manager</a></li>';
		if (ab_news_manager_installed()) {
			echo '<li><a href="' . $SITEURL . 'admin/load.php?id=news_manager">News manager</a></li>';
		}
		echo '<li><a href="' . $SITEURL . 'admin/upload.php">File manager</a></li>';
		echo '<li>|</li>';
		echo '<li><a href="' . $SITEURL . 'admin/edit.php">Add page</a></li>';
		if (ab_news_manager_installed()) {
			echo '<li><a href="' . $SITEURL . 'admin/load.php?id=news_manager&amp;edit">Add news post</a></li>';
		}
		echo '<li>|</li>';
		echo '<li><a href="' . $SITEURL . 'admin/edit.php?id=' . $url . '">Edit this page</a></li>';
		echo '</ul>';
		echo '<ul class="right">';
		echo '<li>Logged in as ' . $USR . '</li>';
		echo '<li>|</li>';
		echo '<li><a href="' . $SITEURL . 'admin">Control panel</a></li>';
		echo '<li><a href="' . $SITEURL . 'admin/logout.php">Logout</a></li>';
		echo '</ul>';
		echo '</div>';
	}
}

function ab_is_admin() {
	GLOBAL $USR;
	return (isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'));
}

function ab_news_manager_installed() {
	GLOBAL $live_plugins;
	return isset($live_plugins['news_manager.php']) && $live_plugins['news_manager.php'] == 'true';
}

?>
