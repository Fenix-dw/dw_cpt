<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<?php
	// settings_errors() не срабатывает автоматом на страницах отличных от опций
	if( get_current_screen()->parent_base !== 'options-general' )
		settings_errors('название_опции');
	?>

	<form action="dw_cpt_form_post_create" method="POST" id="dw-cpt-form-post-create">

		<div>
			<label for="slug">Post Type Slug *</label>
			<input type="text" name="slug">
		</div>
		<div>
			<label for="plural_name">Plural Label *</label>
			<input type="text" name="plural_name">
		</div>
		<div>
			<label for="singular_name">Singular Label *</label>
			<input type="text" name="singular_name">
		</div>


		<?php
			submit_button("delete");
		?>
	</form>
</div>
