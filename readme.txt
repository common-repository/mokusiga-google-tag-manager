                 === Mokusiga Google Tag Manager ===
Contributors: mokusiga
Donate link: 
Tags: google tag manager, datalayer, head
Requires at least: 2.9.1
Tested up to: 3.5.1
Stable tag: 1.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This is a plugin to insert Google Tag Manager to a Wordpress site.


== Description ==

This is a Plugin to insert Google Tag Manager (GTM) into your Wordpress site.
The GTM tag is inserted into the footer by default, using the wp_footer() hook. 
A custom hook can also be used instead.

The plugin allows the user to choose the container ID to use, and also change the 
dataLayer name. There is one extra option to add into the datalayer on whether the current user is a logged in user. Other custom datalayer variables can be added, and these will be added to the generated code.

Author website is http://mokusiga.com/google-tag-manager-a-wordpress-plugin/

== Installation ==
1. Upload contents of mokusiga_google_tag_manager to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in Wordpress
3. Insert the GTM container ID in the plugin's settings.
4. Place '<?php do_action('plugin_name_hook'); ?>' (without quotes) in your template or select 'footer'

== Frequently Asked Questions ==

= How can I place the GTM code to immediately after the <body> tag? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_location_head

= What is my Container ID? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_container_id 

= Where do I set the GTM code? What is the location of the script? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_location 

= What is the dataLayer name? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_name

= How do I use the dataLayer? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_using_datalayer 

= What is my dataLayer variable for logged in users? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_loggedin

= What is my dataLayer variable for the Word Press version? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_wp_version


= What are custom dataLayer variables I can add? =
see http://mokusiga.com/wordpress/google-tag-manager/#gtm_datalayer_custom



== Screenshots ==
1. Admin page screenshot for the Google Tag Manager

== Changelog ==
= 1.2.2 =
* Added a space in the GTM code. To validate against HTML5
* Custom Datalayer text not saving correctly. Fixed
* Added new custom datalayer variable to set WP version.
* Using stripslashes() for the datalayer text. WP is adding slashes automatically.
* 
= 1.2.1 =
* Updated Readme file and version number

= 1.2 =
* Fixed datalayer show logged in users bug

= 1.1.1 =
* Fixed SVN upload mistake

= 1.1 =
* Fixed Datalayer Name

= 1.0 =
* First Version

= 0.1 =
* First Draft

== Upgrade Notice ==
= 1.2.1 =
* Updated Readme file and version number

= 1.2 =
* Fixed datalayer show logged in users bug

= 1.1.1 =
* Fixed SVN upload mistake


= 1.0 =
* Updated the links in Plugin Page

= 0.1 =
* First Draft

== Arbitrary section ==

