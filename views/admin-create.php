<div class="wrap">
	<div class="align-content-center"><h2><?php echo get_admin_page_title() ?></h2></div>
	 <form action="" data-action="post_types_dw" method="POST" class="dw-cpt-form">
	      <div class="bottom-border">
	         <!-- <div class="form-group"> -->
	            <!-- <div class="form-group row"> -->
	               <label for="inputPassword" class="col-sm-6 col-form-label">Basic settings</label>   
	            <!-- </div> -->
	         <!-- </div> -->
	      </div>
	      <div class="input3">
			<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">
			  <span class="alert"> Не предвидена ошибка!!! </span>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>	      	
<div id="basic_post">
	         <div class="form-group row">
	             <div class="col-sm-2 col-form-label">
	               <label for="inputText">Post type slag</label>
	               <span class="star">*</span>
	             </div>  
	               <div class="from-dw col-sm-9 ">               	 
	                  <input id="slug" type="text" value="" name="slug" class="form-control inputP ">
	               </div>
	         </div>
	         <div class="form-group row">
	            <div class="col-sm-2 col-form-label">
	               <label for="inputText">Plural Label</label>
	               <span class="star">*</span>
	            </div>   
	            <div class="from-dw col-sm-9">
				   <input id="plural_name" type="text" value="" name="plural_name" class="form-control inputP">
	            </div>
	         </div>
	         <div class="form-group row">
	            <div class="col-sm-2 col-form-label">
	               <label for="inputText">Singular Label</label>
	               <span class="star">*</span>
	            </div>   
	            <div class="from-dw col-sm-9">            	
	               <input id="singular_name" type="text" value="" name="singular_name" class="form-control inputP">
	            </div>
	         </div>
	      <div class="submit">
		      <button type="submit" name="cheack"  value="create" class="btn btn-success">Create</button>
	      </div>
</div>

		</div>
	   </form>
	
		<p id="loader">
			<img src="<?php echo CPT_PLUGIN_URL . "/assets/imges/loader.gif" ?>" alt="">
		</p>	

					
	</form>
</div>