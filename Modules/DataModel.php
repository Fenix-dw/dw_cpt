<?php	

    namespace Modules;

    use core\Model;

    class DataModel extends Model
    {
    	
    	function get_data()
    	{
    		return require CPT_PLUGIN_DIR . "/data.php";
    	}
    }