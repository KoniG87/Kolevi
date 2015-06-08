<?php 
	$menu = new Menu($app->getDbHandler());
	$menu->drawItallapAdmin('kert');
?>


<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;
        
        $(document).on('click', '.editItal', function(){
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
            data = {
				id: containingRow.attr('data-id'),
				kategoria: containingRow.prevAll('tr.kategoriaRow').first().find('td').text(),
				text: $('td:nth-of-type(1)', containingRow).text(),
				ar: $('td:nth-of-type(2)', containingRow).text(),
				sorrend: $('td:nth-of-type(3)', containingRow).text()
			};
            elozoKategoria = data.kategoria;
            
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addItal').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});

		$(document).on('click', '#addItal', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kategoria: $('select[name="kategoria"]').val(),
				text: $('input[name="text"]').val(),
				ar: $('input[name="ar"]').val(),
				etterem: $('input[name="etterem"]').val(),
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
				data.request = "itallapUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('input[name="'+key+'"]:visible').val("");
						});
                        $('input[name="id"]').val("0");
                        
                        if (data.id != "0"){
							$('td:nth-of-type(1)', triggeredRow).text(data.text);
							$('td:nth-of-type(2)', triggeredRow).text(data.ar);
							$('td:nth-of-type(3)', triggeredRow).text(data.sorrend);
							if (data.kategoria != elozoKategoria){
								$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after(triggeredRow);
							}
						}else{
							$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after('<tr data-id="'+resp['inputID']+'"><td>'+data.text+'</td><td>'+data.ar+'</td><td>'+data.sorrend+'</td><td><button class="editItal">Szerkesztés</button></td><td><button class="deleteItal">Törlés</button></td></tr>');
						}
                        
                    }
				}, 'json');
				
			}
		});



		$(document).on('click', '.deleteItal', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "itallapDelete"
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
				
		});

		

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false && $(this).val() != ""){
				$(this).removeClass('missing');
			} else{
				$(this).addClass('missing');
			}
			
		});

		
		
		
	});
</script>