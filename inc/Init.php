<?php

/**
 * @package yoast_focus_kw_auto_complete
 */

 namespace Inc;
 
 final class Init{

    /**
     * store all the classes inside array
     * return array full list of classes
    */
    public static function get_services()
    {
        # code...

        return array(
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLinks::class,
            Base\CustomPostTypesController::class,
            Base\TaxonomiController::class,
            Base\MediaController::class,
            Base\GalleryController::class,
            Base\TestimonialController::class,
            Base\TemplatesController::class,
            Base\LoginController::class,
            Base\MembershipController::class,
            Base\ChatController::class
           
        );
    }

    //loop through the classes, initialize them, and call the register method() if it exists...
     public static function register_services()
     {
         foreach(self::get_services() as $class){

            $service = self::instantiate ($class);
            if (method_exists($service, 'register')){

                $service->register();

            }



         }
         
     }

     

     /**
     * initialize the class
     * $class from services array
     * return the class instance new instance of the class
     */

     private static function instantiate ($class){
         $service = new $class();
         return $service;
     }


 }
 





//  use Inc\Activate;
// use Inc\Deactivate;
// use Inc\Admin\AdminPages;

// if (!class_exists('FocusKw')) {
   
//     class FocusKw
//     {
//         public $plugin;
//         function __construct()
//         {
//             $this->plugin = plugin_basename(__FILE__);
            
            
//         }

//         function register()
//         {
            

            

//             add_action('admin_enqueue_scripts', array($this, 'enqueue'));

//             add_action('admin_menu', array($this, 'add_admin_pages'));

//             add_filter("plugin_action_links_$this->plugin",array($this,'settings_link'));    

//             add_filter("plugin_action_links_$this->plugin",array($this,'help_menu'));

            

//         }

//         public function help_menu($helpmenu)
//         {
//             // add custom settings link
//             $help_menu = '<a href="admin.php?page=yoast_focus_kw_auto_complete">Help</a>';
//             array_push( $helpmenu, $help_menu);
//             return $helpmenu;
//         }

//         public function settings_link($links)
//         {
//             // add custom settings link
//             $settings_link = '<a href="admin.php?page=yoast_focus_kw_auto_complete">Settings</a>';
//             array_push( $links, $settings_link);
//             return $links;
//         }

//         public function add_admin_pages()
//         {
//            add_menu_page('Yoast Focus Kw Autocomplete', 'Yoast Focus Kw', 'manage_options', 'yoast_focus_kw_auto_complete', array($this,'admin_index'), 'dashicons-nametag
//            ', 111);
//         }
//         public function admin_index()
//         {
//             // require template
//             require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
//         }



//         protected function create_post_type()
//         {
//             add_action('init', array($this, 'custom_post_type'));
//         }

//         function uninstall()
//         {
//             //delete custom post types
//             //delete all the plugin data from the db

//         }
//         function custom_post_type()
//         {
//             register_post_type('book', ['public' => true, 'label' => 'Books']);
//         }
//         function enqueue()
//         {
//             //enqueue all our scripts here...
//             wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
//             wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
//         }
//         function activate()
//         {
//             //require_once plugin_dir_path(__FILE__) . 'inc/yoast-focus-kw-autocomplete-activate.php';
//             Activate::activate();
//         }
//     }

//     $focusKw = new FocusKw('');
//     $focusKw->register();

//     //activation

//     register_activation_hook(__FILE__,  array($focusKw, 'activate'));


//     //deactivation
//     //require_once plugin_dir_path(__FILE__) . 'inc/yoast-focus-kw-autocomplete-deactivate.php';
//     register_deactivation_hook(__FILE__,  array('Deactivate', 'deactivate'));

//     //uninstall
// }