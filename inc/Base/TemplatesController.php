<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 use \Inc\Base\BaseController;
 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 

 
 
 class TemplatesController extends BaseController{

    public $settings;     
    public $callbacks;
   

    public $subpages = array();
   
     
    public function register()
    {
        
        $option = get_option( 'yoast_focus_kw_auto_complete' );
        $activated = isset($option['templates_manager']) ? $option['templates_manager'] : false;
        
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
                'page_title'  =>  'Templates Manage',
                'menu_title'  => 'Templates Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_templates',
                'callback'    => array($this->callbacks, 'adminTemplates'),

            )

        );
    }
    public function activate()
    {
        register_post_type('yoast_templates',
        array
        (
            'labels'=>array(
                'name'=>'Templates',
                'singular_name'=>'templates'

            ),
            'public'=>true,
            'has_archive'=> true,

        )

        );
    }

    
 }