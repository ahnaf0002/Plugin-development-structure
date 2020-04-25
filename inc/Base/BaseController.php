<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 
 class BaseController{
     public $plugin_path;
     public $plugin_url;
     public $plugin;
     public $managers = array();
     public function __construct()
     {
         $this->plugin_path = plugin_dir_path(dirname(__FILE__,2));
         $this->plugin_url  = plugin_dir_url(dirname(__FILE__,2));
         $this->plugin      = plugin_basename(dirname(__FILE__,3)).'/yoast-focus-kw-auto-complete.php';
         $this->managers = array(
            'cpt_managers'=>'Activate CPT Managers',
            'taxonomi_manager'=>'Activate Taxonomi Manager',
            'media_widget'=>'Activate Media Widget Manager',
            'gallery_manager'=>'Activate Gallery Manager',
            'testimonial_manager'=>'Activate Testimonial Manager',
            'templates_manager'=>'Activate Templates Manager',
            'login_manager'=>'Activate Login Manager',
            'membership_manager'=>'Activate Membership Manager',
            'chat_manager'=>'Activate Chat Manager'

         );
     } 

     public function activated( string $key )
	{
		$option = get_option( 'yoast_focus_kw_auto_complete' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
    //  public function activated( string $key)
    //  {
    //        $option = get_option( 'yoast_focus_kw_auto_complete' );
    //        return isset($option['$key']) ? $option['$key'] : false;
    //  }

     
 }
  