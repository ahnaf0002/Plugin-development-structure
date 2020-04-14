<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{

    public $settings;
    public $pages = array();
    public $subpages = array(); 
    public $callbacks;

    function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->setPages();
        $this->setSubPages();
        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
    }
    public function setPages(){
        $this->pages = array(
            array(
                'page_title' => 'Yoast Focus Kw Autocomplete',
                'menu_title' => 'Yoast Focus Kw',
                'capability' => 'manage_options',
                'menu_slug'  => 'yoast_focus_kw_auto_complete',
                'callback'   => array($this->callbacks, 'adminDashboard'),
                'icon_url'   => 'dashicons-nametag',
                'position'   => 110
            )
        );

    }
    public function setSubPages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'yoast_focus_kw_auto_complete',
                'page_title'  =>  'Custom post types',
                'menu_title'  => 'CPT',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_cpt',
                'callback'    => array($this->callbacks, 'adminCPT'),

            ),

            array(
                'parent_slug' => 'yoast_focus_kw_auto_complete',
                'page_title'  =>  'Custom Taxonomies',
                'menu_title'  => 'Taxonomies ',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_taxonomies',
                'callback'    => array($this->callbacks, 'adminTaxonomy'),

            ),
            array(
                'parent_slug' => 'yoast_focus_kw_auto_complete',
                'page_title'  =>  'Custom widget',
                'menu_title'  => 'Widget Manager',
                'capability'  => 'manage_options',
                'menu_slug'   => 'yoast_focus_kw_auto_complete_widget_manager',
                'callback'    => array($this->callbacks, 'adminWidget'),

            ),

        );
        
    }
}
