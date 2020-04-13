jQuery(document).ready(function( $ ) {

	if($('#my_slug').length){

		var old_slug = $('#my_slug');

		function get_post(){
			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {action: 'get_post', old_slug: old_slug.val(), },
				beforeSend: function() {
					$('#basic_post').fadeOut('300', function() {
						$('#loader').fadeIn();
					});
				},
				success: function(data) {
					console.log(data);
					var inputs = JSON.parse(data);
					$('#slug').val(inputs.slug);
					$('#plural_name').val(inputs.plural_name);
					$('#singular_name').val(inputs.singular_name);

					$('#loader').fadeOut('300', function() {
						$('#basic_post').fadeIn();
					});
				},				
				  
			});	
		}	
		get_post();
		old_slug.change(get_post);
	}
	

	$('.dw-cpt-form').on('submit', function(event) {
		event.preventDefault();

        var way = $(this).data('action');

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
		})
		.done( function(res) {
			console.log(res);
			if (res.success) {
				refreshContent();
				$('#message .alert').text("Создался успешно!!!");
			} else if (res.success == 'false') {
				$('#message .alert')
				 .text(res.data.field)
				 .addClass('alert-danger')
				 .removeClass('alert-success');
					var e = 0;
				$( ".form-group" )
					.removeClass('error_dw')
					.each(function(index) {
						if (index == res.data.no_value[e]){
							e++;
							$( this ).addClass( "error_dw" );
						}
					}); 
				// $('.form-group').eq(0).addClass('error_dw');
				$('.message-error').remove();
				$('.error_dw').append('<div class="message-error"><p>Это обязательное поле.</p></div>');
			}
		})
		.fail( function() {
			alert('Ошибка на сервере!!!');
		})
		.always( function() {
			$('#loader').fadeOut('300', function() {
					$('.submit').fadeIn();
					$('#message').fadeIn();
				});	
		})
	});

	$('#slug').on('change', function(event) {
		var slug = urlLit($('#slug').val(),0);
		$('#slug').val(slug);
	});

	function urlLit(w,v) {
		var tr='a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
		var ww=''; w=w.toLowerCase();
		for(i=0; i<w.length; ++i) {
			cc=w.charCodeAt(i); ch=(cc>=1072?tr[cc-1072]:w[i]);
			if(ch.length<3) ww+=ch; else ww+=eval(ch)[v];	
		}
		return(ww.replace(/[^a-zA-Z0-9\-]/g,'-').replace(/[-]{2,}/gim, '-').replace( /^\-+/g, '').replace( /\-+$/g, ''));	
	}

	function refreshContent() {
		var href = document.location.href;
			if( $(' input[name="cheack"]').val() == "create" ){
				$('#slug').val('');
				$('#plural_name').val('');
				$('#singular_name').val('');				
			}

			$.ajax({  
                url: href,  
                cache: false,  
                success: function(html){  
                	html = $(html);
                	$('#adminmenuwrap').html($('#adminmenuwrap', html));
                    // $("#content").html(html);  
                }  
		});

	}
});