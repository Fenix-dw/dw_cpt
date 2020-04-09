jQuery(document).ready(function( $ ) {

	$('.dw-cpt-form').on('submit', function(event) {
		event.preventDefault();
        var way = 'create_post_dw';
        var formData = $(this).serialize() + "&action=" + way;
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$('.submit').fadeOut('300', function() {
					$('#loader').fadeIn();
				});
			},
			success: function(res) {
				alert(res);

				$('#loader').fadeOut('300', function() {
					$('.submit').fadeIn();
				});
			},
			error: function(){
				alert('Ошибка!!!');

				$('#loader').fadeOut('300', function() {
					$('.submit').fadeIn();
				});				
			}
		})
	});	

});