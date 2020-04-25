<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc\Base;
 use \Inc\Base\BaseController;
 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 

 
 
 class MembershipController extends BaseController{

    public $settings;     
    public $callbacks;
   

    public $subpages = array();
   
     
    public function register()
    {
        
        $option = get_option( 'yoast_focus_kw_auto_complete' );
        $activated = isset($option['membership_manager']) ? $option['membership_manager'] : false;
        
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
                'page_title'  =>  'Membership Manage',
                'menu_title'  => 'Membership Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_membership',
                'callback'    => array($this->callbacks, 'adminMembership'),

            )

        );
    }
    public function activate()
    {
        register_post_type('yoast_membership',
        array
        (
            'labels'=>array(
                'name'=>'Membership',
                'singular_name'=>'membership'

            ),
            'public'=>true,
            'has_archive'=> true,

        )

        );
    }

    
 }