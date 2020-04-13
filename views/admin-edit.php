<?php 

    use Modules\Controller\PostTypesController;
    use Modules\DataModel;

    $data = DataModel::get_data();
	$inputs = PostTypesController::get($data);
	$inputs = (array) json_decode($inputs);
	if(is_array($inputs)) extract($inputs);
	
 ?>
<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>
	 <form action="" data-action="post_types_dw" method="POST" class="dw-cpt-form">
	      <div class="bottom-border">
	         <!-- <div class="form-group"> -->
	            <!-- <div class="form-group row"> -->
	               <label for="inputPassword" class="col-sm-6 col-form-label">Basic settings</label>   
	            <!-- </div> -->
	         <!-- </div> -->
	      </div>
	      <div class="input3">

	      	 <div class="form-group row">
	               <label for="inputPassword" class="col-sm-2 col-form-label">Select</label>
	               <div class="col-sm-9">
		               <select class="form-control" id="my_slug" name="old_slug">
				    		<?php foreach ( $slugs as $slug ) : ?>
				    			<option value="<?php echo $slu = ($slug != 'no_name') ? $slug : '' ; ?>"><?php echo $slug ?></option>
				    		<?php endforeach; ?>
				   		</select>
		               <p class="text">Lorem ipsum dolor sit amet.</p>  
	                </div>
	         </div>
<div id="basic_post">
	         <div class="form-group row">
	             <div class="col-sm-2 col-form-label">
	               <label for="inputText">Post type slag</label>
	               <span class="star">*</span>
	             </div>  
	               <div class="col-sm-9">               	 
	                  <input id="slug" type="text" name="slug" class="form-control inputP">
	                  <p class="text">Lorem ipsum dolor sit amet.</p>                                  
	               </div>
	         </div>
	         <div class="form-group row">
	            <div class="col-sm-2 col-form-label">
	               <label for="inputText">Plural Label</label>
	               <span class="star">*</span>
	            </div>   
	            <div class="col-sm-9">
				   <input id="plural_name" type="text" name="plural_name" class="form-control inputP">
	               <p class="text">Lorem ipsum dolor sit amet.</p>
	            </div>
	         </div>
	         <div class="form-group row">
	            <div class="col-sm-2 col-form-label">
	               <label for="inputText">Singular Label</label>
	               <span class="star">*</span>
	            </div>   
	            <div class="col-sm-9">            	
	               <input id="singular_name" type="text" name="singular_name" class="form-control inputP">
	               <p class="text">Lorem ipsum dolor sit amet.</p>
	            </div>
	         </div>
	      </div>
	      
	      <button type="button" name="cheack"  value="delete" class="btn btn-light">Delete</button>
	      <a href="#" id="btn-sign" name="cheack"  value="edit" class="btn btn-primary">Edit</a>

</div>
	   </form>
	<!-- <form action="" data-action="post_types_dw" method="POST" class="dw-cpt-form">
<?php 
	// decode($inputs); 
?>
		<p>
			<select id="my_slug" name="old_slug">
	    		<?php foreach ( $slugs as $slug ) : ?>
	    			<option value="<?php echo $slu = ($slug != 'no_name') ? $slug : '' ; ?>"><?php echo $slug ?></option>
	    		<?php endforeach; ?>
	   		</select>
		</p>
		<div id="basic_post">
			<p>
					<div class="form-group">
						<label for="slug">Post Type Slug *</label>
						<input id="slug" type="text" name="slug">
					</div>
					<div class="form-group">
						<label for="plural_name">Plural Label *</label>
						<input id="plural_name" type="text" name="plural_name">
					</div>
					<div class="form-group">
						<label for="singular_name">Singular Label *</label>
						<input id="singular_name" type="text" name="singular_name">
					</div>	
					<input type="hidden" name="cheack"  value="edit">		
			</p>

			<?php
				// submit_button("Edit");
			?>
		</div> -->
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
