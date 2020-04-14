<?php  

    namespace Modules\Controller;

    use core\Controller;
    use Modules\Controller\PostTypesController;

    class AdminMenyController extends Controller{

		public function action_index()
		{
			add_menu_page( 'Создание пост типов', 'CPT_DW',  'manage_options', 'cpt_dw.php', '' , '', 65 );

			add_submenu_page( 'cpt_dw.php', 'Создание пост типа', 'Create_Post', 'manage_options', 'cpt_dw.php', array( $this, 'admin_page_create' ) );
			add_submenu_page( 'cpt_dw.php', 'Удаление пост типа', 'Delete_Post', 'manage_options', 'delte_cpt_dw.php', array( $this, 'admin_page_delete' ) );
			add_submenu_page( 'cpt_dw.php', 'Редактирование/Удаление пост типов', 'Edit/Delete_Post', 'manage_options', 'edit_cpt_dw.php', array( $this, 'admin_page_edit' ) );
		}		

		public function admin_page_create() 
		{	
			$this->view->generate('admin-create.php');	
		}

		public function admin_page_delete() 
		{	
        	$this->view->generate('admin-delete.php');			
		}

		public function admin_page_edit() 
		{	
        	$this->view->generate('admin-edit.php');			
		}
    }
		
		