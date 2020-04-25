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
    public function adminTaxonomi(){
        return require_once("$this->plugin_path/templates/taxonomi.php");
    }
    public function adminWidget(){
        return require_once("$this->plugin_path/templates/widget.php");
    }
    
    public function adminChat(){
        return require_once("$this->plugin_path/templates/chat.php");
    }
    public function adminGallery(){
        return require_once("$this->plugin_path/templates/gallery.php");
    }
    public function adminLogin(){
        return require_once("$this->plugin_path/templates/login.php");
    }
    public function adminMedia(){
        return require_once("$this->plugin_path/templates/media.php");
    }
    public function adminMembership(){
        return require_once("$this->plugin_path/templates/membership.php");
    }
    public function adminTemplates(){
        return require_once("$this->plugin_path/templates/templates.php");
    }
    public function adminTestimonial(){
        return require_once("$this->plugin_path/templates/testimonial.php");
    }
    // public function yoastOptionsGroup($input)
    // {
    //     return $input;
    // }
    // public function yoastAdminSections()
    // {
    //     echo "Check this beautiful sections";
    // }
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