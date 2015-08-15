=== Custom Dashboard Help Widget ===
Contributors: Jo Landers  
Donate link: http://www.jolanders.com/wordpress_plugins.php?plugin=custom-dashboard-help 
Tags: dashboard, widget, widget, user help, customize, admin  
Requires at least: 3.3 
Tested up to: 3.8.2
Stable tag: trunk  

Add a custom widget to the dashboard to display announcements, help or other information users will see at login.

== Description ==
Do you want to add site announcements, contributor guidelines or help to the WordPress dashboard?

This plugin adds a widget with custom text to the dashboard. Great for Admin-only announcements or making a short README text block for your site contributors. You can display basic help or include links to more detailed information. The [premium version](http://www.jolanders.com/wordpress_plugins.php?plugin=custom-dashboard-help "premium version") has more options and allows you to disable/hide any or all default dashboard widgets.

**Important!** If you're upgrading from Version 1.0, make sure you follow the correct installation procedure.

= Suggested Use =
* Display general site announcements
* Add guidelines for content, category usage, or image sizes that fit the theme
* Tell contributors when they should use pages, posts, or custom write panels
* Provide links to more detailed "contributor help" pages or posts

= Features =
* Includes the same WYSIWYG editor your posts do, so you can format your widget content more easily.
* Lightweight - For most users, only the widget display and help functions (less than 100 lines of code) are loaded. Management functions are only loaded if the user can manage the plugin.

= Premium Version =
* Selectively disable any or all default WordPress dashboard widgets, for all users (the widget list occasionally changes; the plugin can disable all default widgets for WP v. 3.1 to 3.8.2)
* Keep the widget visible, open, and above other widgets on the dashboard, regardless of user settings.
* Apply custom colors to the widget title bar to make it stand out.
* Restrict access to this plugin's settings to site administrators, even if other roles can manage plugins.

== Installation ==
**Important! If you have Version 1.0 installed, use one of the alternate installation methods.**

1. Download `custom-dashboard-help.zip` and unzip the file.
2. Upload the `custom-dashboard-help` folder to your plugins directory. 
3. Go to the plugin management page of your site and activate the new plugin.
4. Use the "Settings" link to add the widget title and content and set any other options.
5. Save your options, then go to the dashboard to see how the widget looks. If your custom content includes links, test the links.

= Upgrading from Version 1.0 =
1. Open the original `custom-dashboard-help.php` file through the plugin editor. Copy and paste it to a text file and save it.
2. Follow the Installation instructions steps 1-3 above.
3. Copy and paste the old title from your saved text file into the plugin title field. Switch the editor from Visual to HTML and do the same thing with the old content. Set any other options.
4. Save your options, then go to the dashboard to see how the widget looks. If your custom content includes links, test the links.


== Screenshots ==
1. A widget on the dashboard using basic options. Individual users can reposition or hide the widget.
2. The basic options screen.
3. A widget on the dashboard using the premium version of the plugin. User help is added.
4. The premium version options screen.

== Frequently Asked Questions ==
= My users don't go to the dashboard when they login. I redirect them to another page. Can I change the widget to display announcements there? =
No. The widget is added using `wp_dashboard_setup` which only applies to the dashboard.

== Changelog ==

= v3.0 (2/15/14) =
* Updated the plugin admin and help classes so even less code is loaded for users who can't manage the plugin
* Removed code needed to keep the plugin compatible with WP versions prior to 3.3
* Added `function add_custom_meta_links()` and disabled `function custom_activate_plugin()`
* The plugin now creates a list of dashboard widgets which can be disabled, based on which version of WordPress is running (premium version only)
* Tested under WordPress 3.8.2.

= v2.3 (10/11/12) =
* Minor code changes.
* Tested under WordPress 3.4.2.

= v2.2 (1/22/12) =
* Tested under WordPress 3.3.1

= v2.1 (12/5/11) =
* Rewrote as a class, extending shared admin and options classes.
* If [Markdown Converter Plus](http://www.jolanders.com/wordpress_plugins.php?plugin=markdown-converter-plus "Markdown Converter Plus") is in the plugins directory (whether or not it is active), the readme file uses it to format and display the file.
* Created a [premium version](http://www.jolanders.com/wordpress_plugins.php?plugin=custom-dashboard-help "premium version") with additional options to restrict access, style the widget, override user settings to make the widget always visible in the upper left of the dashboard, and selectively disable other dashboard widgets.

= v2.0 (9/23/11) =
* No longer just an 'example' demonstrating how to add a widget to the dashboard.
* Added function to retrieve content from Version 1.
* Added on-screen content editing through an options page. Content is now saved to the options table in the WordPress database.

= v1.0 (5/7/10) =
* Initial release. Really just an example of how to use existing WP functions to add a widget to the dashboard.

== Upgrade Notice ==
V. 1.0 required you to edit `custom-dashboard.php` directly to change the widget content. Later versions added a settings page and save everything in your WP options table. Upgrading from Version 1.0 in the usual way will overwrite your content, so read the installation instructions first.