<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

namespace Inc\Api;

class SettingsApi

{
    public $admin_pages = array(); //hints: 01
    public $admin_subpages = array(); //hints: 02...
    public $settings = array(); //03>01>01
    public $sections = array(); //03>01>02
    public $fields = array(); //03>01>03

    //register method needed for every pages in 01 ...
    public function register()
    {
        if (!empty($this->admin_pages) || !empty($this->admin_subpages)) {
            //method callback addAdminMenu() 01...
            add_action('admin_menu', array($this, 'addAdminMenu'));
        }
    
        if (!empty($this->settings)) {
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
    }

    //register method called addAdminMenu() 01 ...
    public function addAdminMenu()
    {
        //$this->admin_pages is a array, thats why foreach loop called 01...
        foreach ($this->admin_pages as $page) {
            //need to load data for ['page_title'] or others arrays values from SettingsApi 01...
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        //hints: 02...
        foreach ($this->admin_subpages as $page) {

            add_submenu_page($page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback']);
        }
    }

    //foreach $this->admin_pages as $page (above) arrays value passed by $this->admin_pages = $pages or $pages 01...
    public function addPages(array $pages)
    {
        $this->admin_pages = $pages;
        return $this;
    }

    //hints: 02...
    public function withSubPage(string $title = null)
    {
        if (empty($this->admin_pages)) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $subpage = array(
            array(
                'parent_slug' => $admin_page['menu_slug'],
                'page_title' => $admin_page['page_title'],
                'menu_title' => ($title) ? $title : $admin_page['menu_title'],
                'capability' => $admin_page['capability'],
                'menu_slug' => $admin_page['menu_slug'],
                'callback' => $admin_page['callback'],

            )
        );
        $this->admin_subpages = $subpage;
        return $this;
    }


    //hints: 02...
    public function addSubPages(array $pages)
    {
        $this->admin_subpages = array_merge($this->admin_subpages, $pages);
        return $this;
    }


    public function setSettings(array $settings)
    {
        $this->settings = $settings;
        return $this;
    }

    public function setSections(array $sections)
    {
        $this->sections = $sections;
        return $this;
    }
    public function setFields(array $fields)
    {
        $this->fields = $fields;
        return $this;
    }

    //hints: 03>01...
    public function registerCustomFields()
    {
        //register settings 03>01>01
        foreach ($this->settings as $setting) {
            register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : ''));
        }
        //add settings sections 03>01>02
        foreach ($this->sections as $section) {
            add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ''), $section["page"]);
        }
        //add settings fields 03>01>03
        foreach ($this->fields as $field) {
            add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ''), $field["page"], $field["section"], (isset($field["args"]) ? $field["args"] : ''));
        }
    }
}
