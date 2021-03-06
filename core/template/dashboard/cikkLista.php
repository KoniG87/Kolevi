<?php 
	$vendeglo = new Vendeglo($app->getDbHandler());
	$vendeglo->drawCikkAdmin();
?>

<style type="text/css">
	.tablaGrid img{width:7.5em;max-width:7.5em;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;
		
		$(document).on('click', '.editCikk', function(){
			
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				text: $('td:nth-of-type(2)', containingRow).text(),
				url: containingRow.attr('data-url'),
				nagykep: 'assets/uploads/'+containingRow.attr('data-nagykep'),
				kiskep: 'assets/uploads/'+containingRow.attr('data-kiskep'),
				sorrend: containingRow.attr('data-sorrend'),
				allapot: containingRow.attr('data-allapot')
			};
			
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addCikk').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});

		
		$(document).on('click', '#addCikk', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				text: $('input[name="text"]').val(),
				url: $('input[name="url"]').val(),
				kiskep: $('select[name="kiskep"]').val(),
				nagykep: $('select[name="nagykep"]').val(),
				allapot: $('select[name="allapot"]').val(),
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
				data.request = "cikkUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						
					console.log(data);
						if (data.id != "0"){
							$('td:nth-of-type(1) img', triggeredRow).attr('src', '<?=$_SESSION['helper']->getPath()?>'+data.kiskep);
							$('td:nth-of-type(2)', triggeredRow).text(data.text);
							triggeredRow.attr('data-url', data.url);
							triggeredRow.attr('data-allapot', data.allapot);
							triggeredRow.attr('data-sorrend', data.sorrend);
							triggeredRow.attr('data-nagykep', data.nagykep.substring(data.nagykep.lastIndexOf('/') + 1));
							triggeredRow.attr('data-kiskep', data.kiskep.substring(data.kiskep.lastIndexOf('/') + 1 ));
							
							if (data.kategoria != elozoKategoria){
								$('.cikkTabla tbody').after(triggeredRow);
							}
						}else{
							$('.cikkTabla tbody').after('<tr data-allapot="'+data.allapot+'" data-sorrend="'+data.sorrend+'" data-kiskep="'+data.kiskep+'" data-nagykep="'+data.nagykep+'" data-url="'+data.url+'" data-id="'+resp['inputID']+'"><td><img src="<?=$_SESSION['helper']->getPath()?>'+data.kiskep+'" alt="'+data.text+'"/></td><td>'+data.text+'</td><td><button class="editCikk">Szerkesztés</button></td><td><button class="deleteCikk">Törlés</button></td></tr>');
						}

						
					}
				}, 'json');
				
			}
		});


		$(document).on('click', '.deleteCikk', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "cikkDelete"
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