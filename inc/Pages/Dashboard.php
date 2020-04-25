<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{

    public $settings;        //variable created to store data to create SettingsApi() 
    public $pages = array(); //foreach arrays value passed by $this->admin_pages = $pages or $pages 01...
   // public $subpages = array();
    public $callbacks;
    public $callbacks_mngr;

    function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();
        $this->setPages();    //ref. hints: initialize - 01 
       // $this->setSubPages(); //ref. hints:02
        $this->setSettings(); //ref. 03>01>01
        $this->setSections(); //ref. 03>01>02
        $this->setFields();   //ref. 03>01>01

        //method chaining for SettingsAppi - 01... + 
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->register();
        //$this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }

    //Ref. need to load data for ['page_title'] or others arrays values from SettingsApi 01...
    public function setPages()
    {
        $this->pages = array(
            array(
                'page_title' => 'Yoast Focus Kw Auto Complete',
                'menu_title' => 'Yoast Focus Kw',
                'capability' => 'manage_options',
                'menu_slug'  => 'yoast_focus_kw_auto_complete',
                'callback'   => array($this->callbacks, 'adminDashboard'),
                'icon_url'   => 'dashicons-nametag',
                'position'   => 110
            )
        );
    }
    //Ref.finish. need to load data for ['page_title'] or others arrays values from SettingsApi 01...


    //hints: 02...
    // public function setSubPages()
    // {
    //     $this->subpages = array(
    //         array(
    //             'parent_slug' => 'yoast_focus_kw_auto_complete',
    //             'page_title'  =>  'Custom post types',
    //             'menu_title'  => 'CPT',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'yoast_focus_kw_auto_complete_cpt',
    //             'callback'    => array($this->callbacks, 'adminCPT'),

    //         ),

    //         array(
    //             'parent_slug' => 'yoast_focus_kw_auto_complete',
    //             'page_title'  =>  'Custom Taxonomies',
    //             'menu_title'  => 'Taxonomies ',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'yoast_focus_kw_auto_complete_taxonomies',
    //             'callback'    => array($this->callbacks, 'adminTaxonomy'),

    //         ),
    //         array(
    //             'parent_slug' => 'yoast_focus_kw_auto_complete',
    //             'page_title'  =>  'Custom widget',
    //             'menu_title'  => 'Widget Manager',
    //             'capability'  => 'manage_options',
    //             'menu_slug'   => 'yoast_focus_kw_auto_complete_widget_manager',
    //             'callback'    => array($this->callbacks, 'adminWidget'),

    //         ),

    //     );
    // }

    //ref: 03>01>01
    public function setSettings()
    {

        $args = array(
            array(

                'option_group' => 'yoast_focus_kw_auto_complete_settings',
                'option_name' => 'yoast_focus_kw_auto_complete',
                'callback'    => array($this->callbacks_mngr, 'checkboxSanitize')

            )
        );

        $this->settings->setSettings($args);
    }



    //ref: 03>01>02
    public function setSections()
    {
        $args = array(
            array(
                'id'          => 'yoast_focus_kw_auto_complete_admin_index',
                'title'       => 'Settings Manager',
                'callback'    => array($this->callbacks_mngr, 'adminSectionManager'),
                'page'        => 'yoast_focus_kw_auto_complete'

            )
        );
        $this->settings->setSections($args);
    }

    //ref: 03>01>03
    public function setFields()
    {

        $args = array();

        foreach ($this->managers as $key => $value) {
            $args[] = array(
                'id' => $key,
                'title' => $value,
                'callback' => array($this->callbacks_mngr, 'checkboxField'),
                'page'        => 'yoast_focus_kw_auto_complete',
                'section'     => 'yoast_focus_kw_auto_complete_admin_index',
                'args'        => array(
                    'option_name' => 'yoast_focus_kw_auto_complete',
                    'label_for'   => $key,
                    'class'       => 'ui-toggle'
                )

            );
        }
        $this->settings->setFields($args);
    }
}
