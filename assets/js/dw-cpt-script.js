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
	
	var cheack = null;
	$('button[type="submit"]').on('click', function(event){
		cheack = $(this).val();
	});

	$('.dw-cpt-form').on('submit', function(event) {
		event.preventDefault();

        var way = $(this).data('action');

        var formData = $(this).serialize() + "&action=" + way + "&cheack=" + cheack;
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: formData,
			beforeSend: function() {
				$('.submit').fadeOut('300', function() {
					$('#loader').fadeIn();
					$('#message').fadeOut();
				});
			},
		})
		.done( function(res) {
			console.log(res);
			if (res.success) {
				refreshContent();
				$('#message .alert').text(res.data.message);
				$('#message')
					.addClass('alert-success')
					.removeClass('alert-danger')
					.fadeIn();				
				$( ".inputP" ).removeClass('dw-error');	
				$('.text-error').remove();

			}
			if (!res.success) {
				$('#message .alert').text(res.data.message);
				$('#message')
					.addClass('alert-danger')
					.removeClass('alert-success')
					.fadeIn();

// 					
				$( ".inputP" )
					.removeClass('dw-error')
					.each(function(index) {
						if ($(this).val().length == 0){
							$( this ).addClass( "dw-error" );
						}
					}); 				// 	

                var emptyfields = $(".dw-error");
                    emptyfields.each(function() {
                        $(this)
                        	.stop()
                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
                            .animate({ left: "0px" }, 100);
                    });
				$('.text-error').remove();
				$('.dw-error').parent('.from-dw').append('<p class="text text-error">Это поле обовязкове к заполнению.</p>');
			} 
		})
		.fail( function() {
			$('#message .alert').text('Ошибка на сервере!!!');
			$('#message')
					.addClass('alert-danger')
					.removeClass('alert-success')
					.fadeIn();			
		})
		.always( function() {
			$('#loader').fadeOut('300', function() {
					$('.submit').fadeIn();
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
			if( $(' button[name="cheack"]').val() == "create" ){
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
					if($('#my_slug').length){
	                	$('.input3').html($('.input3', html));
	                	get_post();
                	}
                }  
		});

	}



if($('.btn-success[value="create"]').length) {
	$('#slug').change(function() {
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {action: 'slug_change', slug: $('#slug').val(), },
			beforeSend: function() {
				// $('#basic_post').fadeOut('300', function() {
				// 	$('#loader').fadeIn();
				// });
			},
			success: function(res) {
				console.log(res);

				if(res.success){
					$('.text-error').remove();				
					if($('#slug').hasClass('dw-error')){
						$('.dw-error').parent('.from-dw').append('<p class="text text-success">' + res.data.message + '</p>');
					}
					$( "#slug" ).removeClass('dw-error');
					$('#message').fadeOut();
				}
				if (!res.success) {
					// $('#message .alert').text(res.data.message);
					// $('#message')
					// 	.addClass('alert-danger')
					// 	.removeClass('alert-success')
					// 	.fadeIn();
					if($('p').hasClass('text-success')){
						$('.text-success').remove();
					}
						
					$( "#slug" )
						.removeClass('dw-error')
						.addClass( "dw-error" );

	                var emptyfields = $(".dw-error");
	                    emptyfields.each(function() {
	                        $(this)
	                        	.stop()
	                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
	                            .animate({ left: "-10px" }, 100).animate({ left: "10px" }, 100)
	                            .animate({ left: "0px" }, 100);
	                    });
					$('.text-error').remove();
					$('.dw-error').parent('.from-dw').append('<p class="text text-error">' + res.data.message + '</p>');
				} 	
			},				
			  
		});	
	});
}
	$('.close').on('click', function(event) {
		event.preventDefault();
		$('#message').fadeOut();
	});
});