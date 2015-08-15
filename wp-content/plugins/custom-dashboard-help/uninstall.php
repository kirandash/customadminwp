<?php
/*
Uninstall Action for the Custom Dashboard Help Plugin
Version 1.0

Author: Jo Landers
Author URI: http://www.jolanders.com/

Copyright 2012 Jo Landers
Any redistribution or modification must include the original copyright notices and licenses.
*/

if ( defined( 'ABSPATH') && defined('WP_UNINSTALL_PLUGIN') ) {
	delete_option( "custom-dashboard-help" );
}
?>