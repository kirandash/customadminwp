<?php
/*
Display Class for the Custom Dashboard Help Plugin
Version 2.1

Author: Jo Landers
Author URI: http://www.jolanders.com/

Copyright 2012-2014 Jo Landers
Any redistribution or modification must include the original copyright notices and licenses.
*/

if ( !class_exists('Custom_Dashboard_Help_Display') ) {
Class Custom_Dashboard_Help_Display {

/**
 *	Add the widget to the dashboard
 *	Widget is not displayed if the title or content are empty.
 *
 *  @package Custom Dashboard Help
 *	@subpackage Display
 * 	@since 2.0
 * 	@params none
 * 	@return void
 */
function add_dashboard_widget() {
	$options = $this->options;
	if ( !$options ) return;
	if ( !empty($options['title']) && !empty($options['content']) ) {
		wp_add_dashboard_widget( $this->unique_id, $options['title'], array($this, 'dashboard_content') );
	}
} 

/**
 *	Display widget content
 *  @package Custom Dashboard Help
 *	@subpackage Display
 * 	@since 2.0
 * 	@params none
 * 	@return string
 */
function dashboard_content() {
	$options = get_option('custom-dashboard-help');
	echo wpautop(stripslashes($options['content']));
}

}	// end class
}	// end if ( !class_exists...

?>