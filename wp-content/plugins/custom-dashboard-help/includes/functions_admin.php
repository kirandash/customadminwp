<?php
/*
Admin Class for the Custom Dashboard Help Plugin
Version 2.1

Author: Jo Landers
Author URI: http://www.jolanders.com/

Copyright 2012-2014 Jo Landers
Any redistribution or modification must include the original copyright notices and licenses.
*/

require_once($path.'includes/Jo_Landers_WP_Plugin_Admin/admin.php');	// add the plugin admin class
if ( file_exists($path.'extras/admin_extras.php') ) include($path.'extras/admin_extras.php');	// if available, add extra options

if ( !class_exists('Custom_Dashboard_Help_Admin') ) {
Class Custom_Dashboard_Help_Admin extends Jo_Landers_WP_Plugin_Admin_v1_4 {

/**
 *	Add Extra Options
 *
 *	If there is an 'extras' class, makes it available to the current class
 *
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return void
 */
public function __construct() {
	if ( class_exists('Custom_Dashboard_Help_Admin_Extras') ) $this->extras = new Custom_Dashboard_Help_Admin_Extras;
	else $this->extras = false;
}

/**
 *	Activate the plugin
 *
 *	Allows this plugin to add additional to the basic activate_plugin() in package Plugin Admin
 *
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return void

function custom_activate_plugin()	{

}
*/


/**
 *	Add custom links on the plugins list page at plugin.php
 *
 *	Allows this plugin to add additional links to the plugin description
 *
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 3.0
 * 	@params none
 * 	@return array $links
*/
function add_custom_meta_links() {
	$links = array();
	$links[] = '<a href="http://www.jolanders.com/wordpress_plugins.php?plugin='.$this->unique_id.'">'.__('Donate', $this->unique_id).'</a>';
	
	return $links;
}


/**
 *	Set default options
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return array of options
 */
function default_options() {
	$options = array();
	$options['version'] = $this->base_version;
	$options['title'] = '';
	$options['content'] = '';
	$options['user_can'] = 'manage_options';
	$options['lock_position'] = false;
	$options['background'] = '';
	$options['color'] = '';
	$options['widgets'] = array();
	$options['upgrade'] = false;
	return $options;
}	

/**
 *	Plugin options page form handler
 *
 *	Calls appropriate function when user enters the plugin options page or selects an action.
 *
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return void
 */
function do_action() {
	if ( function_exists( 'current_user_can' ) && !current_user_can( $this->user_can ) ) exit( __( 'You do not have permission to be here', $this->unique_id) );	
	
	$saved = __( "Your options have been saved. Don't forget to visit the Dashboard to make sure the widget looks the way you expected, and test any links in your content.", $this->unique_id );
	$not_saved = __( "Your options were not updated. Did you make any changes?", $this->unique_id );
	$reminder = __( 'Reminder: your widget will not display if the title is blank.', $this->unique_id );
	$cancelled = __( 'Your changes were cancelled', $this->unique_id);
	$choices = array('save'=>__('Save Changes', $this->unique_id), 'delete'=>__( 'Save This and Delete the Old Version', $this->unique_id ), 'cancel'=>__('Cancel', $this->unique_id), 'readme'=>__('View Readme File', $this->unique_id), 'options'=>__('Manage Options', $this->unique_id), 'copy'=>__('Copy From Version 1', $this->unique_id) );

	$top = $this->base_plugin_title;
	$msgs = array();

	if ( !isset($_POST['cdh_submit']) || $_POST['cdh_submit'] != $choices['readme'] ) $top .= __(': Settings', $this->unique_id);

	echo '<div class="wrap"><h2>'.$top.'</h2>';
	
	if ( isset($_POST['cdh_submit']) )	{
		check_admin_referer('cdh_nonce');
		$action = $_POST['cdh_submit'];
		switch ( $action )	{
			case( $choices['save']):
				$result = $this->save_options();
				if ( $result ) $msgs[] = $saved;
				else $msgs[] = $not_saved;
				$options = $this->get_options();
				if ( empty($options['title']) ) $msgs[] = $reminder;
				$this->manage_options($choices, $msgs);
			break;
			
			case( $choices['cancel'] ):
				$msgs[] = $cancelled;
				$this->manage_options($choices, $msgs);
			break;
			
			case( $choices['readme'] ):
				echo $this->show_text_file();
			break;
		}
	}	else	{
		$this->manage_options($choices, $msgs);
	}
	
	echo '</div>';
	echo $this->basic_footer();
}

/**
 *	Save plugin options
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return void
 */
function save_options()	{
	$input = $this->validate_options();
	return update_option( $this->unique_id, $input );
}

/**
 *	Validate user options
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return array Validated user input
 */
function validate_options()	{
	$input = $this->get_options();
	//$input = $this->default_options();

	$input['title'] = ( isset($_POST['title']) ? trim(preg_replace('/\s+/', ' ', wp_filter_nohtml_kses(stripslashes($_POST['title'])))) : '' );
	$input['content'] = ( isset($_POST['content']) ? wp_filter_post_kses(stripslashes($_POST['content'])) : '' );

	if ( $this->extras ) {
		$input = $this->extras->validate_extra_options($input);
	}

	return($input);
}

/**
 *	Manage plugin options
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@param array $choices Text strings for submit buttons
 *	@params array $msgs Status messages generated by the previous submit
 * 	@return void
 */
function manage_options($choices, $msgs) {
	$options = $this->get_options();
	
	$buttons = array('<div class="clear" style="margin:1em 0;">');
	$buttons[] = '<input type="submit" name="cdh_submit" class="button-primary" value="'.$choices['save'].'" />';
	$buttons[] ='<input type="submit" class="button-primary" name="cdh_submit" value="'.$choices['cancel'].'" />';
	$buttons[] = '<input type="submit" name="cdh_submit" value="'.$choices['readme'].'" />';
	$buttons[] = '</div>';

	if ( !empty($msgs) ) echo $this->display_messages($msgs);
	
	echo '<form method="post" name="cdh_options" id="cdh_options_form" action="">';
	wp_nonce_field('cdh_nonce');
	
	if ( !$options['upgrade'] )	echo implode(' ', $buttons);
	
	echo '
	<h3>'.__('Widget Title and Content').'</h3>
	<p><strong>'.__( 'Title:').'</strong> 
	<input type="text" size="30" maxlength="63" name="title" value="'.$options['title'].'" /> '.__('If left blank, the widget will not appear on the dashboard.', $this->unique_id);
	if ( $this->extras ) echo '<br />'.__("Even when the widget does not appear on the dashboard, if the plugin is active and you've used it to disable other dashboard widgets, they will remain disabled.", $this->unique_id );
	
	echo '</p>';
	
	$this->make_editor($options['content']);

	if ( $this->extras ) $this->extras->additional_options($options);
	else $this->upgrade_notice();
	
	echo implode(' ', $buttons);
	echo '</form>';
}

/**
 *	Upgrade Notice
 *  @package Custom Dashboard Help
 *	@subpackage Admin
 * 	@since 2.2
 * 	@params none
 * 	@return string Upgrade Notice
 */
function upgrade_notice() {
	echo '<p><strong>'.__('The', $this->unique_id).' <a href="http://www.jolanders.com/wordpress_plugins.php?plugin='.$this->unique_id.'">'.__('premium version', $this->unique_id).'</a> ' .__('of this plugin includes the following additional options:', $this->unique_id).'</strong></p>';
	echo '<ul class="ul-square">';
	echo '<li>'.__('Selectively disable any or all default WordPress dashboard widgets, for all users.', $this->unique_id).'</li>';
	echo '<li>'.__('Keep the widget visible, open, and above other widgets on the dashboard, regardless of user settings.', $this->unique_id).'</li>';
	echo '<li>'.__('Apply custom colors to the widget title bar to make it stand out.', $this->unique_id).'</li>';
	echo '<li>'.__("Restrict access to this plugin's settings to site administrators, even if other roles can manage plugins.", $this->unique_id).'</li>';
	echo '</ul>';
}

}	// end class
}	// end if ( !class_exists...
?>