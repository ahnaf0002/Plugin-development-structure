<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 
 class Activate{
     public static function activate(){
        add_action( 'shutdown', 'flush_rewrite_rules');
     }
 }