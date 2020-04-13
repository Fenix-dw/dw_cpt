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

    function post_types_dw() {
        $data = DataModel::get_data();
        $cpt = new PostTypesController($data, $_POST['slug'], $_POST['plural_name'], $_POST['singular_name']);
        if ($_POST['cheack'] == "delete") {
            $cpt->delete($_POST['old_slug']);
            wp_send_json_success( );
        } else {
            registration_validation($_POST['slug'], $_POST['plural_name'], $_POST['singular_name']);
            if ($_POST['cheack'] == "edit" ) {
                $cpt->edit($_POST['old_slug']);
                wp_send_json_success( );
            } else if($_POST['cheack'] == "create" ) {
                $cpt->save();
                wp_send_json_success( );
            }                     
        }
    }    
    add_action('wp_ajax_post_types_dw', 'Modules\post_types_dw');

    function registration_validation( $slug, $plural_name, $singular_name )  {

        if ( empty( $slug ) || empty( $plural_name ) || empty( $singular_name ) ) {
            $reg_errors['field'] = 'Обязательные поля формы не заполнено';
        }

        if ( empty( $slug ) ) {
            $reg_errors['no_value'][] = 0;
        }
        if ( empty( $plural_name ) ) {
            $reg_errors['no_value'][] = 1;
        }
        if ( empty( $singular_name ) ) {
            $reg_errors['no_value'][] = 2;
        }
    
        if( isset( $reg_errors ) ){
            wp_send_json_error( $reg_errors );
        }
    }  

    function get_post() {
        $data = DataModel::get_data();
        $inputs = PostTypesController::get($data, $_POST['old_slug']);
        // $inputs = (array) json_decode($inputs); 
         echo $inputs;
         wp_die();
    }
    add_action('wp_ajax_get_post', 'Modules\get_post');

    // function ajaxcommentsAnswer () {
        
    //     $comment = new CommentController ($_POST['comment'], $_POST['comment_post_ID'], $_POST['author'], $_POST['email'], $_POST['comment_parent'], $_POST['rating']);
    //     $comment->save();
    //     wp_die();        
    // }

    // add_action('wp_ajax_nopriv_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');
    // add_action('wp_ajax_ajaxcommentsAnswer', 'Modules\ajaxcommentsAnswer');



?>