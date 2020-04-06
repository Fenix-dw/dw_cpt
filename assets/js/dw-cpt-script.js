jQuery(document).ready(function( $ ) {

	$('#dw-cpt-form-post-create').on('submit', function(event) {
		event.preventDefault();

        var way =  "dw_cpt_form_post_create";

        var formData = $(this).serialize() + "&action=" + way;
            // formData.push({ "action": way });
console.log(formData);
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: formData,
			success: function(res) {
				alert(res);
			},
			error: function(){
				alert('Ошибка!!!');
			}
		})
		
		 

	});	

});