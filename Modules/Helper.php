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
        registration_validation($_POST['slug'], $_POST['plural_name'], $_POST['singular_name'], $data, $_POST['cheack'], $_POST['old_slug']);

        if ($_POST['cheack'] == "delete") {
            $cpt->delete($_POST['old_slug']);
            wp_send_json_success(["message" => "Удалили удачно!!!"]);
        } else {
            if ($_POST['cheack'] == "edit" ) {
                $cpt->edit($_POST['old_slug']);
                wp_send_json_success(["message" => "Редактирование удачное" ]);
            } else if($_POST['cheack'] == "create" ) {
                $cpt->save();
                wp_send_json_success(["message" => "Поздравляю вы создали Post Type!!" ]);
            }                     
        }
    }    
    add_action('wp_ajax_post_types_dw', 'Modules\wp_ajax_post_types_dw');

    function registration_validation( $slug, $plural_name, $singular_name, $data, $cheak, $old_slug )  {
        $inputs = PostTypesController::get($data);
        $data = json_decode($data);
        $inputs = json_decode($inputs); 
         // if(is_array($slugs)) extract($slugs);

        if ( !is_array($data) &&  $cheack == "edit") {
            $reg_errors['message'] = 'Ошибка сервара!!!';
        }
        if($cheack != "delete" ){

            foreach ($inputs->slugs as $value) {
                if($value == $slug && $old_slug != $value) {
                    $reg_errors['message'] = 'Slug который вы увели уже существует';
                }
            }            
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

    function slug_change() {
        $data = DataModel::get_data();
        $inputs = PostTypesController::get($data);
        $inputs = json_decode($inputs); 
        foreach ($inputs->slugs as $value) {
            if($value == $_POST['slug']) {
                $reg_errors['message'] = 'Это поле заполнено существующим Slug.';
            }
        }            
        if( isset( $reg_errors ) ){
            wp_send_json_error( $reg_errors );
        } 
        wp_send_json_success(["message" => "Можете его использовать" ]);
    }
    add_action('wp_ajax_slug_change', 'Modules\slug_change');
