<?php 

    use Modules\Controller\PostTypesController;
    use Modules\DataModel;
    use Modules\Helper;


function select_dw() {
    $data = DataModel::get_data();
    if(!$data) return;
	$inputs = PostTypesController::get($data);
	$inputs = (array) json_decode($inputs);
	if(is_array($inputs)) extract($inputs);
?>
	<select class="form-control" id="my_slug" name="old_slug">
		<?php if(is_array($slugs)) { foreach ( $slugs as $slug ) : ?>
			<option value="<?php echo $slu = ($slug != 'no_name') ? $slug : '' ; ?>"><?php echo $slug ?></option>
		<?php endforeach; } ?>
	</select>	
<?php 
}

function dw_cpt_scripts() {
	wp_enqueue_script( 'dw-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js');
	wp_enqueue_script( 'dw-cpt-jquery', CPT_PLUGIN_URL . '/assets/js/jquery-3.4.1.min.js');
	wp_enqueue_script( 'dw-cpt-scripts', CPT_PLUGIN_URL . '/assets/js/dw-cpt-script.js', array( 'jquery' ), null, true );
	wp_enqueue_style( 'dw-cpt-bootstrap', CPT_PLUGIN_URL . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'dw-cpt-style', CPT_PLUGIN_URL . '/assets/css/style.css' );
}
add_action("admin_enqueue_scripts", 'dw_cpt_scripts', 99);	

function decode($json) {
	// if(is_array($json)) {
		// $json = json_decode($json);
	// }	
	echo '<pre>';
	var_dump($json);
	echo '<pre>';
	// wp_die();
}