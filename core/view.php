<?php 

	namespace core;

	class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	function generate($content_view, $data = null)
	{
		
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			// extract($data);
			var_dump($data);
		}
		
		include CPT_PLUGIN_DIR . '/views/'. $content_view;
	}
}