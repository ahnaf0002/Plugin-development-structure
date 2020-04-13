<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 
 class SettingsLinks{
     protected $plugin;
     function __construct()
     {
         
         $this->plugin = PLUGIN;
     }
     public function register(){
        add_filter("plugin_action_links_$this->plugin",array($this,'settings_link'));  

     }
     public function Settings_Link($links)
     {
         # code...
         $settings_link = '<a href="admin.php?page=yoast_focus_kw_auto_complete">Settings</a>';
         array_push( $links, $settings_link);
         return $links;
     }
 }