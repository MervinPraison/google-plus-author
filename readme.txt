=== WP Google Authorship ===
Contributors: mervinpraison
Donate link: https://mer.vin
Tags: google, authorship, author, google-plus, seo
Requires at least: 3.0
Tested up to: 6.8
Stable tag: 2.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Google Plus Profile Picture appear in Google Search. Very Easy to implement. Including Google authorship for multiple authors and multisite.

== Description ==

This plugin helps you add Google authorship markup to your WordPress site, allowing your Google Plus profile picture to appear in Google Search results.

Features:
* Easy 4-step setup process
* Multiple author support
* Multisite compatible
* Shortcode support

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/google-plus-author/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Users > Your Profile
4. Enter your Google Plus Profile URL
5. Use the shortcode [googleplusauthor] or the PHP function

== Frequently Asked Questions ==

= How do I use this plugin? =

Simply add your Google Plus profile URL in your user profile settings, then use the shortcode [googleplusauthor] in your posts or the PHP function google_plus_author() in your theme.

== Changelog ==

= 2.1 =
* Security: Added nonce verification for form submissions
* Security: Added input sanitization with esc_url_raw() and sanitize_text_field()
* Security: Added proper output escaping
* Improved: Replaced deprecated get_currentuserinfo() with wp_get_current_user()
* Improved: Replaced deprecated update_usermeta() with update_user_meta()
* Improved: Added text domain for translations
* Improved: WordPress 6.8 compatibility
* Fixed: Updated license to GPLv2 or later

= 2.0 =
* Previous version

== Upgrade Notice ==

= 2.1 =
Security update: Fixes vulnerabilities and updates deprecated functions. Please update immediately.
