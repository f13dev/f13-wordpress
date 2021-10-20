<?php
/*
Plugin Name: F13 WP Plugin Shortcode
Plugin URI: https://f13.dev/wordpress-plugins/wordpress-plugin-wordpress/
Description: WordPress plugin information shortcodes.
Version: 1.0.0
Author: Jim Valentine
Author URI: https://f13.dev
Text Domain: f13-wordpress
*/

namespace F13\WordPress;

if (!function_exists('get_plugins')) require_once(ABSPATH.'wp-admin/includes/plugin.php');
if (!defined('F13_WORDPRESS')) define('F13_WORDPRESS', get_plugin_data(__FILE__, false, false));
if (!defined('F13_WORDPRESS_PATH')) define('F13_WORDPRESS_PATH', realpath(plugin_dir_path( __FILE__ )));
if (!defined('F13_WORDPRESS_URL')) define('F13_WORDPRESS_URL', plugin_dir_url(__FILE__));

class Plugin
{
    public function init()
    {
        spl_autoload_register(__NAMESPACE__.'\Plugin::loader');
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        $c = new Controllers\Control();
    }

    public static function loader($name)
    {
        $name = trim(ltrim($name, '\\'));
        if (strpos($name, __NAMESPACE__) !== 0) {
            return;
        }
        $file = str_replace(__NAMESPACE__, '', $name);
        $file = ltrim(str_replace('\\', DIRECTORY_SEPARATOR, $file), DIRECTORY_SEPARATOR);
        $file = plugin_dir_path(__FILE__).strtolower($file).'.php';

        if ($file !== realpath($file) || !file_exists($file)) {
            wp_die('Class not found: '.htmlentities($name));
        } else {
            require_once $file;
        }
    }

    public function enqueue()
    {
        wp_enqueue_style('f13-wordpress', F13_WORDPRESS_URL.'css/f13-wordpress.css', array(), F13_WORDPRESS['Version']);
        wp_enqueue_style( 'dashicons' );
    }
}

$p = new Plugin();
$p->init();