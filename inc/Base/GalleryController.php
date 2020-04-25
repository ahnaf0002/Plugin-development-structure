<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 use \Inc\Base\BaseController;
 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 

 
 
 class GalleryController extends BaseController{

    public $settings;     
    public $callbacks;
   

    public $subpages = array();
   
     
    public function register()
    {
        
        $option = get_option( 'yoast_focus_kw_auto_complete' );
        $activated = isset($option['gallery_manager']) ? $option['gallery_manager'] : false;
        
        if(! $activated){
            return;
        }

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setSubPages(); //ref. hints:02

        $this->settings->addSubPages($this->subpages)->register();


         add_action('init',array($this, 'activate'));
    }
    //hints: 02...
    public function setSubPages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'yoast_focus_kw_auto_complete',
                'page_title'  =>  'Gallery Manage',
                'menu_title'  => 'Gallery Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_gallery',
                'callback'    => array($this->callbacks, 'adminGallery'),

            )

        );
    }
    public function activate()
    {
        register_post_type('yoast_gallery',
        array
        (
            'labels'=>array(
                'name'=>'Gallery Manager',
                'singular_name'=>'gallery'

            ),
            'public'=>true,
            'has_archive'=> true,

        )

        );
    }

    
 }