<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<?php
	// settings_errors() не срабатывает автоматом на страницах отличных от опций
	if( get_current_screen()->parent_base !== 'options-general' )
		settings_errors('название_опции');
	?>

	<form action="" data-action="post_types_dw" method="POST" class="dw-cpt-form">

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
			<input type="hidden" name="cheack"  value="create">		
			

		<?php submit_button("Create");	?>
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
