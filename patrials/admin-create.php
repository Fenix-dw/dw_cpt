<div class="wrap">
	<h2><?php echo get_admin_page_title() ?></h2>

	<?php
	// settings_errors() не срабатывает автоматом на страницах отличных от опций
	if( get_current_screen()->parent_base !== 'options-general' )
		settings_errors('название_опции');
	?>

	<form action="" data-action="create-post-dw" method="POST" class="dw-cpt-form">

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
		// public $slucs;
		echo "dds" . $slugs;
// settings_fields("opt_group");     // скрытые защитные поля
			// do_settings_sections("opt_page");		
			submit_button("Create");
		?>
		<p id="loader">
			<img src="<?php echo CPT_PLUGIN_URL . "/assets/imges/loader.gif" ?>" alt="">
		</p>
	</form>
</div>
