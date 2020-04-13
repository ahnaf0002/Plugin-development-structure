<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Pages;
 
 class Admin{
   
     function register()
        {
            add_action('admin_menu', array($this, 'add_admin_pages'));
        }
    public function add_admin_pages()
        {
           add_menu_page('Yoast Focus Kw Autocomplete', 'Yoast Focus Kw', 'manage_options', 'yoast_focus_kw_auto_complete', array($this,'admin_index'), 'dashicons-nametag
           ', 111);
        }
        public function admin_index()
        {
            // require template
            require_once PLUGIN_PATH. 'templates/admin.php';
        }
 }