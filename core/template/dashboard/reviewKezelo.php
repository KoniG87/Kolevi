<?php 
	$apartman = new Apartman($app->getDbHandler());
	$apartman->drawReviewAdmin($_POST['szobaID']);
?>

<style type="text/css">
	.tablaGrid img{width:7.5em;max-width:7.5em;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;
		
		$(document).on('click', '.editReview', function(){
			
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				nev: $('td:nth-of-type(1)', containingRow).text(),
				cim: $('td:nth-of-type(2)', containingRow).text(),
				leiras: $('td:nth-of-type(3)', containingRow).text(),
				rating: containingRow.attr('data-rating'),
				sorrend: containingRow.attr('data-sorrend'),
				allapot: containingRow.attr('data-allapot')
			};
			
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addReview').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});

		
		$(document).on('click', '#addReview', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				szoba_id: $('input[name="szoba_id"]').val(),
				nev: $('input[name="nev"]').val(),
				cim: $('input[name="cim"]').val(),
				leiras: $('textarea[name="leiras"]').val(),
				rating: $('input[name="rating"]').val(),
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
				data.request = "reviewUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						
					console.log(data);
						if (data.id != "0"){ 
							$('td:nth-of-type(1)', triggeredRow).text(data.nev);
							$('td:nth-of-type(2)', triggeredRow).text(data.cim);
							$('td:nth-of-type(3)', triggeredRow).text(data.leiras);
							$('td:nth-of-type(4) .star-rating', triggeredRow).attr("data-rating", data.rating).attr("style", "width: "+ (parseInt(data.rating, 10) * 31) + "px");
							$('td:nth-of-type(5)', triggeredRow).text(data.allapot == "1" ? 'Igen' : 'Nem');
							triggeredRow.attr('data-allapot', data.allapot);
							triggeredRow.attr('data-sorrend', data.sorrend);
							triggeredRow.attr('data-rating', data.rating);
							
							if (data.kategoria != elozoKategoria){
								$('.reviewTabla tbody').after(triggeredRow);
							}
						}else{
							$('.reviewTabla tbody').after('<tr data-allapot="'+data.allapot+'" data-sorrend="'+data.sorrend+'" data-rating="'+data.rating+'" data-id="'+resp['inputID']+'"><td>'+data.nev+'</td><td>'+data.cim+'</td><td>'+data.leiras+'</td><td><div class="star-rating" data-rating="'+data.rating+'" style="width: '+ (parseInt(data.rating, 10) * 31) +'px;"></div></td><td>'+(data.allapot ? 'Igen' : 'Nem')+'</td><td><button class="editReview">Szerkesztés</button></td><td><button class="deleteReview">Törlés</button></td></tr>');
						}

						
					}
				}, 'json');
				
			}
		});


		$(document).on('click', '.deleteReview', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "reviewDelete"
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