<?php 
	$vendeglo = new Vendeglo($app->getDbHandler());
	$vendeglo->drawPartnerAdmin();
?>

<style type="text/css">
	.tablaGrid img{width:7.5em;max-width:7.5em;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;

		$(document).on('click', '.editPartner', function(){
			
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				kep: 'assets/uploads/'+ $('td:nth-of-type(1) img', containingRow).attr('src').substring($('td:nth-of-type(1) img', containingRow).attr('src').lastIndexOf('/') + 1),
				text: $('td:nth-of-type(2)', containingRow).text(),
				leiras: $('td:nth-of-type(3)', containingRow).text(),
				url: $('td:nth-of-type(4)', containingRow).text(),
				sorrend: containingRow.attr('data-sorrend'),
				allapot: containingRow.attr('data-allapot')
			};
			

			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addPartner').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});

		

		

		$(document).on('click', '#addPartner', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kep: $('select[name="kep"]').val(),
				text: $('input[name="text"]').val(),
				leiras: $('input[name="leiras"]').val(),
				url: $('input[name="url"]').val(),
				allapot: $('select[name="allapot"]').val(),
				sorrend: $('input[name="sorrend"]').val(),
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
				data.request = "partnerUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						

						if (data.id != "0"){
							$('td:nth-of-type(1) img', triggeredRow).attr('src', '<?=$_SESSION['helper']->getPath()?>'+ data.kep);
							$('td:nth-of-type(2)', triggeredRow).text(data.text);
							$('td:nth-of-type(3)', triggeredRow).text(data.leiras);
							$('td:nth-of-type(4)', triggeredRow).text(data.url);
							triggeredRow.attr("data-sorrend", data.sorrend);
							triggeredRow.attr("data-allapot", data.allapot);
							
							if (data.kategoria != elozoKategoria){
								$('.partnerTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after(triggeredRow);
							}
						}else{
							$('.partnerTabla tbody').after('<tr data-sorrend="'+ data.sorrend +'" data-allapot="'+ data.allapot +'" data-id="'+resp['inputID']+'"><td><img src="<?=$_SESSION['helper']->getPath()?>'+data.kep+'" alt="'+data.text+'"/></td><td>'+data.text+'</td><td>'+data.leiras+'</td><td>'+data.url+'</td><td><button class="editPartner">Szerkesztés</button></td><td><button class="deletePartner">Törlés</button></td></tr>');
						}

						
						
					}
				}, 'json');
				
			}
		});


		$(document).on('click', '.deletePartner', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "partnerDelete"
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

		
		$(document).on('click', '.deleteKep', function(e){
			e.preventDefault();
			affectedRow = $(this).parents('tr');
			data = {
				request: 'deleteImageRef',
				id:	$(this).attr('data-id')				
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp.status == "ok"){
				   affectedRow.hide(500, function(){ $(this).remove(); });
				}
			}, 'json');
		});
		
		$(document).on('change', 'select[name^="kep_"]', function(){
			data = {
				request: 'insertImageRef',
				rendezvenyID: $(this).attr('data-id'),
				kepID: $(this).val(),
				kepTipus: 5
			};
			selectedImage = $('option:selected', $(this)).text();
			selectedImagePath = $('option:selected', $(this)).attr('data-fullpath');
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp.status == "ok"){
					numberOfImages = $('input[name^="kep_"]').length;
					$('select[name^="kep_"]').replaceWith('<input readonly="readonly" type="text"  name="kep_'+resp.inputID+'" alt="'+resp.inputID+'. kép" value="'+selectedImage+'"/><button data-id="'+resp.inputID+'" class="deleteKep">Törlés</button>');
					$('input[name="kep_'+resp.inputID+'"]').parent('td').after('<td><img src="'+ selectedImagePath + '" alt="'+ selectedImage +'"/></td>');
					$('label', imageRefTemplate).html(numberOfImages+ '. kép:');
					$('.tablaGrid').append(imageRefTemplate)
				}
			}, 'json');
			
		});
		
	});
</script> 