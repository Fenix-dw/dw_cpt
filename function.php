<?php 
function decod($json) {
	// $json = json_decode($json);
	echo '<pre>';
	var_dump($json);
	echo '<pre>';
	// wp_die();
}

function dw_cpt_add_menu() {
	add_menu_page( 'Создание пост типов', 'CreatePost',  'manage_options', MPF_PLUGIN_DIR . '/patrials/admin.php', '', '', 65 );
}

function dw_cpt_scripts() {
	wp_enqueue_script( 'dw-cpt-jquery', CPT_PLUGIN_URL . '/assets/js/jquery-3.4.1.min.js', array() , null , true );
	wp_enqueue_script( 'dw-cpt-scripts', CPT_PLUGIN_URL . '/assets/js/dw-cpt-script.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'dw-cpt-style', CPT_PLUGIN_URL . '/assets/css/style.css' );
}

function dw_cpt_view_post_types() {
	$post_types = json_decode( require MPF_PLUGIN_DIR . "/data.php");
	
	if($post_types == '') return;
	foreach ($post_types as $post_type) {
		foreach ($post_type as $key => $labels) {
			$args = array(
				'labels' => $labels,
				'public' => true, // благодаря этому некоторые параметры можно пропустить
				'show_ui' => true, // показывать интерфейс в админке
				'menu_icon' => 'dashicons-admin-post', // иконка корзины
				'menu_position' => 25,
				'has_archive' => true,
				'exclude_from_search' => true,
				'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail'),
				'taxonomies' => array('post_tag')
			);
			register_post_type($key ,$args);
		}
	}
};

function wp_ajax_dw_cpt_form_post_create() {
	if ( isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST" ){
		if( $_POST['slug'] != "" && $_POST['plural_name'] != "" && $_POST['singular_name'] != "" ) {
			$post_types = json_decode( require MPF_PLUGIN_DIR . "/data.php");

			$post_types[] = [$_POST['slug'] => [
				'name' => $_POST['plural_name'],
				'singular_name' => $_POST['singular_name'], // админ панель Добавить->Функцию
				'add_new' => 'Добавить '. $_POST['singular_name'] ,
				'add_new_item' => 'Добавить новый '. $_POST['singular_name'], // заголовок тега <title>
				'edit_item' => 'Редактировать '. $_POST['singular_name'],
				'new_item' => 'Новый ' . $_POST['singular_name'],
				'all_items' => 'Все ' . $_POST['plural_name'],
				'view_item' => 'Просмотр на сайте',
				'search_items' => 'Искать товары',
				'not_found' =>  $_POST['singular_name'] . ' не найдено.',
				'not_found_in_trash' => 'В корзине нет ' . $_POST['singular_name'],
				'menu_name' => $_POST['plural_name'],// ссылка в меню в админке					
			]];
			file_put_contents(MPF_PLUGIN_DIR . "/data.php", "<?php return '". json_encode($post_types) ." ';");
			// header("Location: ". $_POST['_wp_http_referer']);
			wp_die('Post type был зарегестрирован, обновите страницу чтобы увидеть изменения :)');		
		}
		wp_die('Что то не полностью заполнили');
	}	
	wp_die('Ошибка безопастности!!!');
}
