<?php

/*
Plugin Name: Admin Bar
Description: Adds a very simple administration bar to the front-end of the website
Version: 0.1
Author: Chris Cook
Author URI: http://chris-cook.co.uk
*/

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile,
	'Admin Bar',
	'0.1',
	'Chris Cook',
	'http://chris-cook.co.uk',
	'Adds a very simple administration bar to the front-end of the website'
);

# activate filter
add_action('content-bottom','ab_admin_bar');

# functions
function ab_is_admin() {
	GLOBAL $USR;
	return (isset($USR) && $USR == get_cookie('GS_ADMIN_USERNAME'));
}

function ab_admin_bar() {
	if (ab_is_admin()) {
		echo "<style>
			#admin-bar {
				background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6);
				left: 0;
				padding: 0.25em 0;
				position: fixed;
				top: 0;
				width: 100%;
				z-index: 1000;
			}

			#admin-bar ul {
				margin: 0;
			}

			#admin-bar .left {
				float: left;
			}

			#admin-bar .right {
				float: right;
			}

			#admin-bar li {
				float: left;
				list-style-type: none;
				margin: 0 0.5em;
			}

			#admin-bar a {
				color: #FEFEFE;
				text-decoration: none;
			}
			</style>";
		echo '<div id="admin-bar">';
		echo '<ul class="left">';
		echo '<li><a href="';
		get_site_url();
		echo 'admin/edit.php">Add page</a></li>';
		echo '<li><a href="';
		get_site_url();
		echo 'admin/load.php?id=news_manager&amp;edit">Add news post</a></li>';
		echo '<li><a href="';
		get_site_url();
		echo 'admin/edit.php?id=' . return_page_slug() . '">Edit this page</a></li>';
		echo '</ul>';
		echo '<ul class="right">';
		echo '<li><a href="';
		get_site_url();
		echo 'admin">Control panel</a></li>';
		echo '<li><a href="';
		get_site_url();
		echo 'admin/logout.php">Logout</a></li>';
		echo '</ul>';
		echo '</div>';
	}
}

?>
