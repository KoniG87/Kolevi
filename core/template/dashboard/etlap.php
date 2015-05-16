<?php 
	$menu = new Menu($app->getDbHandler());
	$menu->drawEtlapAdmin();
?>


<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;
		$(document).on('click', '.editEtel', function(){
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				kategoria: containingRow.prevAll('tr.kategoriaRow').first().find('td').text(),
				text: $('td:nth-of-type(1)', containingRow).text(),
				tagek: $('td:nth-of-type(2)', containingRow).text(),
				ar: $('td:nth-of-type(3)', containingRow).text()
			};
			elozoKategoria = data.kategoria;

			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addEtel').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});

		$(document).on('click', '#addEtel', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kategoria: $('select[name="kategoria"]').val(),
				text: $('input[name="text"]').val(),
				tagek: $('input[name="tagek"]').val(),
				ar: $('input[name="ar"]').val()
			};


			$.each(data, function(key, val){
				attr = $('[name="'+key+'"]').attr('required');
				if (typeof attr !== typeof undefined && attr !== false 
						&& 
						$('[name="'+key+'"]').val() == ""){
					canSubmit = false;
					$('[name="'+key+'"]').addClass('missing');
				}
			});

			if (canSubmit){
				data.request = "etlapUpdate";
				$.post('requestHandler.php', data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");


						if (data.id != "0"){
							$('td:nth-of-type(1)', triggeredRow).text(data.text);
							$('td:nth-of-type(2)', triggeredRow).text(data.tagek);
							$('td:nth-of-type(3)', triggeredRow).text(data.ar);
							if (data.kategoria != elozoKategoria){
								$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after(triggeredRow);
							}
						}else{
							$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after('<tr data-id="'+resp['inputID']+'"><td>'+data.text+'</td><td>'+data.tagek+'</td><td>'+data.ar+'</td></tr>');
						}
						
					}
				}, 'json');
				
			}
		});


		$(document).on('click', '.deleteEtel', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "etlapDelete"
			};
			
			$.post('requestHandler.php', data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
				
		});

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false){
				if ($(this).val() != ""){
					$(this).removeClass('missing');
				} else{
					$(this).addClass('missing');
				
				}	
			}
			
		});

		$('input[name^="cetli"]').focus(function(){
			originalValue = $(this).val();
		}).change(function(){
			triggeredInput = $(this);
			 		
			data = {
				id: triggeredInput.attr("data-id"),
				text: triggeredInput.val(),
				request: "cetliUpdate"
			};
		
			$.post("requestHandler.php", data, function(resp){
				if (resp["status"]){
					triggeredInput.addClass("success");
				}else{
					triggeredInput.addClass("error");
					triggeredInput.val(originalValue);
				}
		
				setTimeout(function(){
					triggeredInput.removeClass("success error");
				}, 750);
		}, "json");		
		});	
		
		
	});
</script>