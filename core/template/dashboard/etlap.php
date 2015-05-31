<?php 
	$menu = new Menu($app->getDbHandler());
	$menu->drawEtlapAdmin();
?>

<style type="text/css">
	.allergenSelector{

  		border-radius: 0.1rem;
  		width:20px;
  		height:20px;
  		cursor:pointer;
  		transition:background-color 0.5s;
	}
	.allergenSelector.alg-1{background-position:0 0;}
	.allergenSelector.alg-2{background-position:-20px 0;}
	.allergenSelector.alg-3{background-position:-40px 0;}
	.allergenSelector.alg-4{background-position:-60px 0;}
	.allergenSelector.alg-5{background-position:-80px 0;}
	.allergenSelector.alg-6{background-position:-100px 0;}
	.allergenSelector.alg-7{background-position:-120px 0;}
	.allergenSelector.alg-8{background-position:-140px 0;}
	.allergenSelector.alg-9{background-position:-160px 0;}
	.allergenSelector.alg-10{background-position:-180px 0;}
	.allergenSelector.alg-11{background-position:-200px 0;}
	.allergenSelector.alg-12{background-position:-220px 0;}
	.allergenSelector.alg-13{background-position:-240px 0;}
	.allergenSelector.alg-14{background-position:-260px 0;}
	
	.allergenSelector:hover{background-color:#ddd;}
	.allergenSelector.selected{background-color:#7ddd31;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;
		$(document).on('click', '.editEtel', function(){
			$('.allergenSelector').removeClass('selected');
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				kategoria: containingRow.prevAll('tr.kategoriaRow').first().find('td').text(),
				text: $('td:nth-of-type(1)', containingRow).text(),
				ar: $('td:nth-of-type(3)', containingRow).text()
			};

			var selectedAllergens = $('td:nth-of-type(2)', containingRow).attr('data-val').split(',');
			$('.allergenSelector').each(function(){
			    if ($.inArray($(this).attr('data-val'), selectedAllergens) >= 0){
			        $(this).addClass('selected');
			    } 
			});
						
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

		$('.allergenSelector').click(function(){
			$(this).toggleClass('selected');
		});

		$(document).on('click', '#addEtel', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				kategoria: $('select[name="kategoria"]').val(),
				text: $('input[name="text"]').val(),
				//tagek: $('input[name="tagek"]').val(),
				tagek: $('.selected').map(function(){ return $(this).attr("data-val"); 	}).get().join(','),
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
							$('td:nth-of-type(2)', triggeredRow).attr('data-val', data.tagek);

							selectedAllergens = $('.allergenSelector.selected').clone();

							$('td:nth-of-type(2)', triggeredRow).html(selectedAllergens);
							$('td:nth-of-type(2) span.allergen', triggeredRow).removeClass('allergenSelector');
							
							$('td:nth-of-type(3)', triggeredRow).text(data.ar);
							if (data.kategoria != elozoKategoria){
								$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after(triggeredRow);
							}
						}else{
							$('.etlapTabla tr.kategoriaRow:contains("'+data.kategoria+'")').after('<tr data-id="'+resp['inputID']+'"><td>'+data.text+'</td><td>'+data.tagek+'</td><td>'+data.ar+'</td></tr>');
						}

						$('.allergenSelector').removeClass('selected');
						
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