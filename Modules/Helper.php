<?php 
    namespace Modules;

    use Modules\Controller\PostTypesController;
    use Modules\Controller\AdminMenyController;
    
    function view_post_types() {

        $data = require CPT_PLUGIN_DIR . "/data.php";
        $post_types = PostTypesController::view($data);
    }

    add_action('init' , 'Modules\view_post_types');

    function view_admin_menu() {    

        new AdminMenyController();
    }

    add_action('admin_menu', 'Modules\view_admin_menu');

    function create_post_types() {

        $data = require CPT_PLUGIN_DIR . "/data.php";
        $cpt = new PostTypesController($data, $_POST['slug'], $_POST['plural_name'], $_POST['singular_name']);  
        $cpt->save();
        wp_die();
    }    
    add_action('wp_ajax_create_post_dw', 'Modules\create_post_types');

    function get_slugs() {

        $data = require CPT_PLUGIN_DIR . "/data.php";
        $slugs = PostTypesController::get_slugs($data);
        // public $slugs;
        // wp_die();
    }
    add_action('init' , 'Modules\get_slugs');
    

    
    // function ajaxcommentsAnswer () {
        
    //     $comment = new CommentController ($_POST['comment'], $_POST['comment_post_ID'], $_POST['author'], $_POST['email'], $_POST['comment_parent'], $_POST['rating']);
    //     $comment->save();
    //     wp_die();        
    // }

    // add_action('wp_ajax_nopriv_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');
    // add_action('wp_ajax_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');



?>