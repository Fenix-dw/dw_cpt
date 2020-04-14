<?php 

    use Modules\Controller\PostTypesController;
    use Modules\DataModel;

    $data = DataModel::get_data();
	$slugs = PostTypesController::get($data);
	$slugs = (array) json_decode($slugs);
	if(is_array($slugs)) extract($slugs);

 ?>
<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<form action="" data-action="post_types_dw" method="POST" class="dw-cpt-form">
	<?php
	 // var_dump($slugs);
decode($data);

	  ?>
		<p>
			<select name="old_slug">
	    		<?php foreach ( $slugs as $slug ) : ?>
	    			<option value="<?php echo $slu = ($slug != 'no_name') ? $slug : '' ; ?>"><?php echo $slug ?></option>
	    		<?php endforeach; ?>
	   		</select>

			<input type="hidden" name="cheack"  value="delete">		

		</p>

		<?php
			submit_button("delete");
		?>
		<p id="loader">
			<img src="<?php echo CPT_PLUGIN_URL . "/assets/imges/loader.gif" ?>" alt="">
		</p>

			<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
			  <span class="alert"> Good!! </span>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>					
	</form>
</div>
