<?php
$delicates = new Delicates($app->getDbHandler());

$delicates->drawKategoriaAdmin();

?>

<style type="text/css">
	.slideTabla img{width:6em;}
	.tablaGrid thead{font-weight:bold;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;

		$(document).on('click', '.editKategoria', function(){
			
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				kategoria: containingRow.attr('data-kategoria'),
				text: $('td:nth-of-type(1)', containingRow).text(),
				sorrend: $('td:nth-of-type(2)', containingRow).text(),
			};

			
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addKategoria').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});


		$(document).on('click', '#addKategoria', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kategoria: $('select[name="kategoria"]').val(),
				text: $('input[name="text"]').val(),
				sorrend: $('input[name="sorrend"]').val()
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
				data.request = "kategoriaUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						
						$(":input").removeClass('missing');
						if (data.id != "0"){
							$('td:nth-of-type(1)', triggeredRow).text(data.text);
							$('td:nth-of-type(2)', triggeredRow).text(data.sorrend);

							if (data.kategoria != elozoKategoria){
								$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after(triggeredRow);
							}
							triggeredRow.addClass('justAdded');
						}else{
							$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after('<tr class="justAdded" data-id="'+resp['inputID']+'"><td>'+data.text+'</td><td>'+data.tagek+'</td><td>'+data.ar+'</td><td>'+data.sorrend+'</td><td><button class="editEtel">Szerkesztés</button></td><td><button class="deleteEtel">Törlés</button></td></tr>');
							triggeredRow = $("tr.justAdded");
						}

						$(triggeredRow).velocity("scroll", {
				            duration: 800,
				            easing: "ease",
				            offset:-350,
				            complete: function(){
								$("tr.justAdded").removeClass("justAdded");
					    	} 
					        
				    	});

						
					}
				}, 'json');
				
			}
		});


		$(document).on('click', '.deleteKategoria', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "kategoriaDelete"
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
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

		
		
		
	});
</script> 