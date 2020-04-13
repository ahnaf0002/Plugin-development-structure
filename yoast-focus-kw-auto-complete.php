<?php

/**
 * @package yoast_focus_kw_auto_complete
 * @version 1.7.2
 */
/*
Plugin Name: Yoast Focus KW Autocomplete & SEO Enhancer
Plugin URI: https://a2zcoder.com/plugins/yoast-focus-kw-auto-complete-seo-enhancer/
Description: Are you a Yoast SEO plugin users? Then this plugin must installed because this plugin boostup your SEO by auto completing your Yoast focus kw. Also this plugin has lot of SEO enhancing features. Just activate this <cite>Yoast Focus KW Auto Complete Plugin </cite> and find your businness as a top leading.        
Author: A2zCoder
Version: 0.0.8
Author URI: https://a2zcoder.com/
License: GPLv2 or later
Text Domain: yoast-focus-kw-auto-complete-seo-enhancer/
*/

defined('ABSPATH') or die('Hey, you can\t access this page, you silly human');

if( file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once dirname(__FILE__).'/vendor/autoload.php'; 
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLUGIN', plugin_basename(__FILE__));

use Inc\Base\Activate;
use Inc\Base\Deactivate;

function activate_yoast_focus_kw_auto_complete(){
    Activate::activate();
}
function deactivate_yoast_focus_kw_auto_complete(){
    Deactivate::deactivate();
}

if (class_exists('Inc\\Init')){
    Inc\Init::register_services();

}