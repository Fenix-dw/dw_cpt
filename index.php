<?php 
/**
 * Plugin Name: DW_CPT
 * Description: Создание пост типов
 * Author: Felix DW
 * Version: 0.0.1
*/
	define( 'CPT_PLUGIN', __FILE__ );

	define( 'CPT_PLUGIN_DIR', untrailingslashit( dirname( CPT_PLUGIN ) ) );

	define( 'CPT_PLUGIN_URL', plugins_url() . '/dw_cpt' );

	require_once CPT_PLUGIN_DIR . '/core/model.php';
	require_once CPT_PLUGIN_DIR . '/core/view.php';
	require_once CPT_PLUGIN_DIR . '/core/controller.php';

	require_once CPT_PLUGIN_DIR . '/Modules/DataModel.php';
	require_once CPT_PLUGIN_DIR . '/Modules/Helper.php';
	require_once CPT_PLUGIN_DIR . '/Modules/AuthError.php';
	require_once CPT_PLUGIN_DIR . '/Modules/Controller/AdminMenyController.php';
	require_once CPT_PLUGIN_DIR . '/Modules/Controller/PostTypesController.php';
	require_once CPT_PLUGIN_DIR . "/function.php";

