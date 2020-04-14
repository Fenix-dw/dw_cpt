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

    function wp_ajax_post_types_dw() {
        $data = DataModel::get_data();
        $cpt = new PostTypesController($data, $_POST['slug'], $_POST['plural_name'], $_POST['singular_name']);
        if ($_POST['cheack'] == "delete") {
            registration_validation($_POST['slug'], $_POST['plural_name'], $_POST['singular_name'], $data, '0');
            $cpt->delete($_POST['old_slug']);
            wp_send_json_success(["message" => "Удалили удачно!!!"]);
        } else {
            registration_validation($_POST['slug'], $_POST['plural_name'], $_POST['singular_name'], $data, '');
            if ($_POST['cheack'] == "edit" ) {
                $cpt->edit($_POST['old_slug']);
                wp_send_json_success(["message" => "Редактирование удачное" ]);
            } else if($_POST['cheack'] == "create" ) {
                // $cpt->save();
                // wp_send_json_success(["message" => "Поздравляю вы создали Post Type!!" ]);
            }                     
        }
    }    
    add_action('wp_ajax_post_types_dw', 'Modules\wp_ajax_post_types_dw');

    function registration_validation( $slug, $plural_name, $singular_name, $data, $cheak = '1' )  {
        $data = json_decode($data);
        // $inputs = PostTypesController::get($data, $_POST['old_slug']);
        // $inputs = json_decode($inputs); 
         // if(is_array($slugs)) extract($slugs);

        if ( !is_array($data) &&  $_POST['cheack'] == "edit") {
            $reg_errors['message'] = 'Ошибка сервара!!!';
        }
        // if ( $_POST['cheack'] == "create") {
        //     foreach ($inputs->slugs as $value) {
        //         if($value == $slug) {
        //             $reg_errors['message'] = 'Slug который вы увели уже существует';
        //         }
        //     }
        // }
        if($cheack == '1'){
            if ( empty( $slug ) || empty( $plural_name ) || empty( $singular_name ) ) {
                $reg_errors['message'] = 'Обязательные поля формы не заполнено';
            }
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