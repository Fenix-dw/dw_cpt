<?php 

    use Modules\Controller\PostTypesController;
    use Modules\DataModel;

    $data = DataModel::get_data();
	$slugs = PostTypesController::get_slugs($data);
	$slugs = json_decode($slugs);
 ?>
<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<form action="" data-action="delete_post_dw" method="POST" class="dw-cpt-form">
	<?php var_dump($slugs) ?>
		<p>
			<select name="slug">
	    		<?php foreach ( $slugs as $slug ) : ?>
	    			<option value="<?php echo $slu = ($slug != 'no_name') ? $slug : '' ; ?>"><?php echo $slug ?></option>
	    		<?php endforeach; ?>
	   		</select>
		</p>

		<?php
			submit_button("delete");
		?>
		<p id="loader">
			<img src="<?php echo CPT_PLUGIN_URL . "/assets/imges/loader.gif" ?>" alt="">
		</p>		
	</form>
</div>
