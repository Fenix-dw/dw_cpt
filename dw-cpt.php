<?php 
/**
 * Plugin Name: CreatePost
 * Description: Создание пост типов
 * Author: Felix DW
 * Version: 0.0.1
*/
	define( 'MPF_PLUGIN', __FILE__ );
	define( 'MPF_PLUGIN_DIR', untrailingslashit( dirname( MPF_PLUGIN ) ) );
	define( 'MPF_PLUGIN_URL', plugins_url() . '/dw_cpt' );

require_once MPF_PLUGIN_DIR . "/function.php";
// esc_html_e();
add_action('admin_menu', function(){
	add_menu_page( 'Создание пост типов', 'CreatePost',  'manage_options', MPF_PLUGIN_DIR . '/templete/admin.php', '', '', 65 );
} );

add_action("admin_enqueue_scripts", 'dw_cpt_scripts');
add_action( 'init', 'dw_cpt_view_post_types' );
add_action('wp_ajax_dw_cpt_form_post_create', 'dw_cpt_create_post_type');
