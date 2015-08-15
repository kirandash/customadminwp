<?php

function kiran_admin_color_schemes(){
	
	$theme_dir = get_stylesheet_directory_uri();
	
	wp_admin_css_color(
	
		'kiranadmincolors' , 
		__('Kiran Admin Colors'),
		$theme_dir . '/admin-colors/kiranadmincolors/colors.css',
		array('#384047', '#58c67b', '#838cc7', '#ffffff')
		
	);	
}

add_action('admin_init', 'kiran_admin_color_schemes');


/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function kiran_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'welcome_dashboard_widget',         // Widget slug.
                 'Welcome dashboard widget',         // Title.
                 'kiran_dashboard_widget_function' // Display function.
        );	
}
add_action( 'wp_dashboard_setup', 'kiran_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function kiran_dashboard_widget_function() {

	// Display whatever it is you want to show.
	echo "Hello User! Welcome to your site!";
}


function kiran_remove_menus(){
  
  //remove_menu_page( 'index.php' );                  //Dashboard
  //remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
  
}
add_action( 'admin_menu', 'kiran_remove_menus' );


?>