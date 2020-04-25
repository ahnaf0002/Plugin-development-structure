<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 
 class Activate{
     public static function activate(){
        add_action( 'shutdown', 'flush_rewrite_rules');

        if (get_option('yoast_focus_kw_auto_complete')){
            return;

        }


        $default = array();
        update_option('yoast_focus_kw_auto_complete', $default);
     }
 }