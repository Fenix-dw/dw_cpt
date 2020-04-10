<?php 
    namespace Modules;

    use Modules\Controller\PostTypesController;
    use Modules\Controller\AdminMenyController;
    use Modules\DataModel;

    function view_post_types() {
        $data = DataModel::get_data();
        $post_types = PostTypesController::view($data);
    }

    add_action('init' , 'Modules\view_post_types');

    function view_admin_menu() {    
        $admin = new AdminMenyController;
        $admin->action_index();
    }

    add_action('admin_menu', 'Modules\view_admin_menu');

    function create_post_types() {
        $data = DataModel::get_data();
        $cpt = new PostTypesController($data, $_POST['slug'], $_POST['plural_name'], $_POST['singular_name']);  
        $cpt->save();
        wp_die();
    }    
    add_action('wp_ajax_create_post_dw', 'Modules\create_post_types');
    
    function delete_post_types() {
        $data = DataModel::get_data();
        $cpt = PostTypesController::delete($data, $_POST['slug']); 
        echo "good"; 
        wp_die();
    }    
    add_action('wp_ajax_delete_post_dw', 'Modules\delete_post_types');

    // function ajaxcommentsAnswer () {
        
    //     $comment = new CommentController ($_POST['comment'], $_POST['comment_post_ID'], $_POST['author'], $_POST['email'], $_POST['comment_parent'], $_POST['rating']);
    //     $comment->save();
    //     wp_die();        
    // }

    // add_action('wp_ajax_nopriv_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');
    // add_action('wp_ajax_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');



?>