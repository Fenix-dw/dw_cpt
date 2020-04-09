<?php  

    namespace Modules\Controller;

    use Modules\AuthError;

    class AdminMenyController {

		public function __construct()
		{
			$this->view();
		}    	

		public function view()
		{
			add_menu_page( 'Создание пост типов', 'CPT_DW',  'manage_options', 'cpt_dw.php', '' , '', 65 );
			
			add_submenu_page( 'cpt_dw.php', 'Создание пост типа', 'Create_Post', 'manage_options', 'cpt_dw.php', array( $this, 'admin_page_delete' ) );
			add_submenu_page( 'cpt_dw.php', 'Удаление пост типа', 'Delete_Post', 'manage_options', 'delte_cpt_dw.php', array( $this, 'admin_page_delete' ) );
			add_submenu_page( 'cpt_dw.php', 'Редактирование пост типов', 'Edit_Post', 'manage_options', CPT_PLUGIN_DIR . '/patrials/admin-edit.php' );
		}		

		public function admin_page_create() 
		{
			require_once CPT_PLUGIN_DIR . "/patrials/admin-create.php";
		}
		public function admin_page_delete() 
		{
			require_once CPT_PLUGIN_DIR . "/patrials/admin-delete.php";
		}
    }
		
		