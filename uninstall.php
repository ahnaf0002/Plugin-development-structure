<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 if(!defined('WP_UNINSTALL_PLUGIN')){
     die;
 }

 //clear database stored data
//  $books = get_post(array('post_type'=>'book', 'number_posts'=>-1));

//  foreach($books as $book){

//     wp_delete_post($book->ID, true);
//  }

// global $wpdb;
// $wpdb->query("DELETE FROM wp_posts where post_type ='book'");
// $wpdb->query("DELETE FROM wp_posts where post_id NOT IN (select id from wp_posts)");
// $wpdb->query("DELETE FROM wp_term_relationships where object_id NOT IN (select id from wp_posts)");