<?php
/*
Custom dashboard help widget
==============================================================================

Show custom help or announcements on the dashboard

Info for WordPress:
==============================================================================
Plugin Name: Custom Dashboard Help
Plugin URI: http://www.jolanders.com/wordpress_plugins.php?plugin=custom-dashboard-help
Description: Adds a widget with custom text to the dashboard. Great for Admin-only announcements or making a short README for  site contributors. Display basic help or link to more detailed information. The <a href="http://www.jolanders.com/wordpress_plugins.php?plugin=custom-dashboard-help" title="premium version"><strong>premium version</strong></a> has more options, including disabling any or all built-in dashboard widgets. <strong>Version 1.0 Users:</strong> See the upgrade notice in the read-me file BEFORE upgrading.
Version: 3.0
Text Domain: custom-dashboard-help
Author: Jo Landers
Author URI: http://www.jolanders.com/

==============================================================================
Copyright 2012-2014 Jo Landers (email : http://www.jolanders.com/contact.php?subject=custom-dashboard-help)

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Don't do any of this unless you're on an admin page...
if ( is_admin() ) {
	global $pagenow;
	//if ( $pagenow == 'index.php' ) 
	cdh_dashboard_load();
	//$pages = array("plugins.php", "options-general.php");
	//if ( in_array($pagenow, $pages) ) 
	cdh_admin_load();
}	

// define plugin variables
function cdh_vars() {
	$vars = array();
	$vars['plugin_title'] = __('Custom Dashboard Help');
	$vars['version'] = '3.0';
	$vars['unique_id'] = 'custom-dashboard-help';
	$vars['path'] = plugin_dir_path(__FILE__);
	$vars['plugin'] = plugin_basename(__FILE__);
	$vars['url'] = plugin_dir_url(__FILE__);
	$vars['min_php'] = '5.2.4';
	$vars['min_wp'] = '3.3';
	
	return $vars;
}

// load display functions
function cdh_dashboard_load() {
	extract( cdh_vars() );	
	$options = get_option($unique_id);
	
	if ( $options ) {
		// load the help widget
		$title = ( isset($options['title']) ? $options['title'] : '' );
		if ( !empty($title) ) {
			if ( !class_exists('Custom_Dashboard_Help_Display') ) require_once( $path.'includes/functions_display.php' );
			if ( class_exists('Custom_Dashboard_Help_Display') ) {
				$cdh = new Custom_Dashboard_Help_Display;
				$cdh->unique_id = $unique_id;
				$cdh->options = $options;
				if ( !empty($title) ) add_action( "wp_dashboard_setup", array($cdh, 'add_dashboard_widget') );
			}
		}
		// load extras for the premium version of the plugin
		if ( file_exists($path.'/extras/display_extras.php') ) include($path.'/extras/display_extras.php');
		if ( class_exists('Custom_Dashboard_Help_Display_Extras') ) { 
			$cdh->options = $options;
			// disable selected widgets, add styles, location locking, etc.
			//add_action( "wp_dashboard_setup", array($cdh, 'do_dashboard_extra') );
			add_action( "admin_init", array($cdh, 'do_dashboard_extra') );
		}		
	}
}

// load management functions
function cdh_admin_load() {	
	extract( cdh_vars() );	
	$options = get_option($unique_id);

 	$user_can = ( isset($options['user_can']) ? $options['user_can'] : 'manage_options' );
 	
	// 	Avoid problems with current_user_can
	if ( !function_exists( 'wp_get_current_user' ) ) {
		if ( file_exists(ABSPATH.'wp-includes/pluggable.php') ) require_once( ABSPATH.'wp-includes/pluggable.php' );
	}
	
 	if ( function_exists( 'current_user_can' ) && current_user_can( $user_can ) ) {
		require_once( $path.'includes/functions_admin.php' );
		if ( class_exists('Custom_Dashboard_Help_Admin') ) {
			$cdh = new Custom_Dashboard_Help_Admin;
			$cdh->base_settings($plugin, $path, $url, $unique_id, $version, $plugin_title, $user_can);
			$cdh->min_wp = $min_wp;
			$cdh->min_php = $min_php;	
			
			// Activate the plugin
			register_activation_hook( __FILE__, array($cdh, 'activate_plugin') );
			
			// Add links on the plugins page (plugins.php)		
			add_filter( "plugin_action_links_$plugin", array($cdh, 'add_settings_link') );
			add_filter("plugin_row_meta", array($cdh, 'add_plugin_meta_links'),10,2);

			// Add the plugin to the settings menu
			add_action( 'admin_menu', array($cdh, 'add_menu') );
		}
	}	else	{	// user can not manage the plugin
		require_once($path.'includes/Jo_Landers_WP_Plugin_Admin/help.php');
		if ( class_exists('Jo_Landers_WP_Help_v1_3') ) {
			add_filter( "plugin_action_links_$plugin", array('Jo_Landers_WP_Help_v1_3', 'remove_plugin_links'),10,1 );
		}
	}	
}