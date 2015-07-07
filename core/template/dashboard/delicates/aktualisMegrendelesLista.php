<?php
$delicates = new Delicates($app->getDbHandler());

$delicates->drawMegrendelesAdmin('aktualis');

?>

<style type="text/css">
	.qtyInput{width:5.5rem!important;}
	.termekRow td{padding:0.3rem 0.5rem!important;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;

		$('.megrendelesEditor').hide();
		
		$(document).on('click', '.editMegrendeles', function(){
			$(".termekRow").remove();
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				nev: $('td:nth-of-type(1)', containingRow).text(),
				email: $('td:nth-of-type(2)', containingRow).text(),
				megjegyzes: $('td:nth-of-type(3)', containingRow).text(),
				osszertek: $('td:nth-of-type(4)', containingRow).text().replace(/\s/g, '')
			};

			//$(".megrendelesEditor .headerEnd").after($('tr').append('td'));

			termekAdat = $.parseJSON(containingRow.attr('data-termekek').replace(/\'/g, '"'));
			console.log(termekAdat);
			
			$.each(termekAdat, function(key, obj){
				//console.log(obj.text_hu);
				$(".megrendelesEditor .headerEnd").after('<tr class="termekRow"><td><img style="width:75px;" src="<?=$_SESSION['helper']->getPath()?>'+obj.kiskep+'" alt=""/></td><td>'+obj.text_hu+'</td><td><input type="number" class="qtyInput" name="egyseg" value="'+obj.egyseg+'"/> x <input type="number" class="qtyInput" name="egysegar" value="'+obj.egysegar+'"/> = <span class="osszar">'+obj.osszar+'</span></td></tr>');
			});
			
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addMegrendeles').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
			$(".megrendelesEditor").fadeIn(500);
		});


		$(document).on('click', '#addMegrendeles', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kategoria: $('select[name="kategoria"]').val(),
				text: $('input[name="text"]').val(),
				etterem: $('input[name="etterem"]').val(),
				tagek: ($('.selected').length > 0 ? $('.selected').map(function(){ return $(this).attr("data-val"); 	}).get().join(',') : ''),
				ar: $('input[name="ar"]').val(),
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
				data.request = "megrendelesUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						
						$(":input").removeClass('missing');
						if (data.id != "0"){
							$('td:nth-of-type(1)', triggeredRow).text(data.text);
							$('td:nth-of-type(2)', triggeredRow).attr('data-val', data.tagek);

							selectedAllergens = $('.allergenSelector.selected').clone();

							$('td:nth-of-type(2)', triggeredRow).html(selectedAllergens);
							$('td:nth-of-type(2) span.allergen', triggeredRow).removeClass('allergenSelector');
							
							$('td:nth-of-type(3)', triggeredRow).text(data.ar);
							$('td:nth-of-type(4)', triggeredRow).text(data.sorrend);
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


		$(document).on('click', '.deleteMegrendeles', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "megrendelesDelete"
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