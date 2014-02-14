<?php
/*
Plugin Name: Bible Document Manager
Plugin URI: http://www.geminilearning.com/wordpress-plugins/bible-doc-mgr
Description: Document manager that serves to manage question sheets, sermons, and resource documents.
Version: 1.0
Author: David Jumeau
Author URI: http://www.geminilearning.com
License: GPLv2

Copyright 2013 David Jumeau (email : djumeau@gmail.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

register_activation_hook( __FILE__, 'dj_bible_doc_mgr_activate' ); 

add_action( 'admin_menu', 'dj_bible_doc_mgr_create_menu' );

// Register a new shortcode: [recent-question-sheet]
add_shortcode( 'recent-question-sheet', 'dj_bible_doc_mgr_recent_question_sheet' );

//Installation script
function dj_bible_doc_mgr_activate() {
	
	// WP Version Check
	if ( version_compare( get_bloginfo( 'version' ), '3.1', '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) ); // Deactivate our plugin
	}
	
	error_log("Bible Doc Manager Activated.");
	
	//Set Up Default Settings
	$dj_bible_doc_mgr_options = array(
		'altRowColor' => '0xCCCCCC'
	);
	
	update_option('dj_bible_doc_mgr_options', $dj_bible_doc_mgr_options);
	
}

// Creates Bible Document Manager Settings Menu on the left side of the admin page
function dj_bible_doc_mgr_create_menu() {
	
	//create custom top-level menu
	add_menu_page( 'Bible Document Settings', 'Bible Document Settings', 'manage_options', __FILE__, 'dj_bible_doc_settings_page', plugins_url( '/images/bible-icon-small.png', __FILE__ ) );
	
	add_submenu_page( __FILE__, "About", "About", "manage_options", __FILE__, dj_bible_doc_mgr_about);
	add_submenu_page( __FILE__, "Uninstall", "Uninstall", "manage_options", __FILE__, dj_bible_doc_mgr_uninstall);
	
}

// The callback function that will replace [recent-question-sheet]
function dj_bible_doc_mgr_recent_question_sheet() {
	$str = '<ul>'. "\n\t" . '<li>Mark 4c: <a href="'. site_url() . '/pdf/bible_study/2013-mark/mk-04c.q.pdf" target="_blank">Who is this Jesus?</a></li>'. "\n</ul>";

	return $str;
}

function dj_bible_doc_mgr_about() {
	
}

function dj_bible_doc_mgr_uninstall() {
	
}

?>