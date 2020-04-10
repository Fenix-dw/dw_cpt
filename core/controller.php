<?php	

	namespace core;

	use core\View;

	class Controller {
		
		public $model;
		public $view;

		public function __construct()
		{
			$this->view = new View;
		}
		
		function action_index()
		{
		}
	}