=== F13 WordPress ===
Contributors: f13dev
Tags: table of wordpress, plugin, shortcode, developers
Requires at least: 5.0
Tested up to: 5.8.1
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add WordPress plugin information to posts and pages, ideally suited to WordPress developers for showcasing their work.

== Description ==
Add a formatted plugin information box using simple shortcodes to your website. Transient cache can be utilised allowing for faster page loading times and less API calls in excahnge for delayed updates.

F13 WordPress does not require any configuration, simply add the shortcode [f13-wordpress slug=plugin-slug]. An optional attribute can also be included to set the cache time in minutes [f13-wordpress slug=plugin-slug cache=1440]

Should you wish to override the default appearance, simple CSS rules can be added to your own CSS files.

[Read more about F13-WordPress](https://f13.dev/wordpress-plugin-wordpress/)

[https://f13.dev/wp-content/uploads/2021/10/f13-wordpress-shortcode.png  Example output of the f13-wordpress shortcode]
[https://f13.dev/wp-content/uploads/2021/10/f13-wordpress-requirements.png  Expanded requirements tab of the f13-wordpress shortcode]
[https://f13.dev/wp-content/uploads/2021/10/f13-wordpress-error.png  Example soft error for a non existing plugin slug]