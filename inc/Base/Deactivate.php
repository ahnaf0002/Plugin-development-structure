<?php

/**
 * @package yoast_focus_kw_auto_complete
 */
namespace Inc\Base;
 class Deactivate{
     public static function deactivate(){
        add_action( 'shutdown', 'flush_rewrite_rules');
     }
 }