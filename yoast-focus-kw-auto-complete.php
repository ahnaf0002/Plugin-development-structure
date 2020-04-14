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


//this code run during activation
function activate_yoast_focus_kw_auto_complete(){
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__,  'activate_yoast_focus_kw_auto_complete');

//this code run during deactivation
function deactivate_yoast_focus_kw_auto_complete(){
    Inc\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__,'deactivate_yoast_focus_kw_auto_complete');

if (class_exists('Inc\\Init')){
    Inc\Init::register_services();

}