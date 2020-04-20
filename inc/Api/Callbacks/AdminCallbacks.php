<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController{
    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/admin.php");
    }
    public function adminCPT(){
        return require_once("$this->plugin_path/templates/cpt.php");
    }
    public function adminTaxonomy(){
        return require_once("$this->plugin_path/templates/taxonomy.php");
    }
    public function adminWidget(){
        return require_once("$this->plugin_path/templates/widget.php");
    }
    public function yoastOptionsGroup($input)
    {
        return $input;
    }
    public function yoastAdminSections()
    {
        echo "Check this beautiful sections";
    }
    public function yoastTextExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="'.$value.'" placeholder="Write something here">';
        
    }
    public function yoastFirstName()
    {
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="'.$value.'" placeholder="Write your first name">';
        
    }

}