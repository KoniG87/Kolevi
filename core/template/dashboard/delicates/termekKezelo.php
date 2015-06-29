<?php
$delicates = new Delicates($app->getDbHandler());

$delicates->drawTermekAdmin();

?>

<style type="text/css">
	.kategoriaTabla img{width:6em;}
	.tablaGrid thead{font-weight:bold;}
	.tablaGrid .alKategoriaRow td{background-color:#C8C8C8;padding:0.6em 0 0.6em 4em;border-bottom:0.4rem solid #E2E2E2;border-top:0.5rem solid #E2E2E2;}
	@media all and (max-width:1500px){
		.kategoriaTabla img{min-width:48px;max-width:64px!important;}		
	}	
</style>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;
		var elozoKategoria;

		$(document).on('click', '.editTermek', function(){
			
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
			data = {
				id: containingRow.attr('data-id'),
				text: $('td:nth-of-type(2)', containingRow).text(),
				leiras: $('td:nth-of-type(3)', containingRow).text(),
				ar: $('td:nth-of-type(4)', containingRow).text().replace(/\s/g, ''),
				tag: $('td:nth-of-type(5)', containingRow).text().replace(/\s/g, ''),
				kep: $('td:nth-of-type(1) img', containingRow).attr('alt'),
				sorrend: $('td:nth-of-type(6)', containingRow).text()
			};

			console.log(data);
			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#addTermek').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});


		$(document).on('click', '#addTermek', function(){
			canSubmit = true;

			data = {
				id: $('input[name="id"]').val(),
				text: $('input[name="text"]').val(),
				leiras: $('input[name="leiras"]').val(),
				kep: $('select[name="kep"]').val(),
				tagek: $('input[name="tag"]').val().replace(/\s/g, ''),
				ar: $('input[name="ar"]').val().replace(/\s/g, ''),
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
				data.request = "termekUpdate";
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp['status']){
						$.each(data, function(key, val){
							$('[name="'+key+'"]:visible').val("");
						});
						$('input[name="id"]').val("0");
						
						$(":input").removeClass('missing');
						if (data.id != "0"){
							$('td:nth-of-type(2)', triggeredRow).text(data.text);
							$('td:nth-of-type(3)', triggeredRow).text(data.leiras);
							$('td:nth-of-type(4)', triggeredRow).text(data.tag);
							$('td:nth-of-type(5)', triggeredRow).text(data.ar);
							$('td:nth-of-type(6)', triggeredRow).text(data.sorrend);
							
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


		$(document).on('click', '.deleteTermek', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "termekDelete"
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


<?php 
/*
    $termek = new Termek($app->getDbHandler());
    $termekID = isset($_POST['id']) ? $_POST['id'] : null;
    
?>
<h2>Termék rögzítése</h2>

<button id="saveTermek">Termék mentése</button>
<form id="editForm">
<?php
	$termek->drawTermekAdmin($termekID);
?>
</form>


<style type="text/css">
	.tablaGrid img{width:7.5em;}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		imageRefTemplate = $('.imageRefTemplate').parents('tr').clone();

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false && $(this).val() != ""){
				$(this).removeClass('missing');
			} else{
				$(this).addClass('missing');
			}
			
		});
		
		$('#saveTermek').click(function(){
			canSubmit = true;
			data = {
                id: $('#editForm input[name="id"]').val(),
				text: $('#editForm input[name="text"]').val(),
				leiras: $('#editForm textarea[name="leiras"]').val(),
				allapot: 1,
				kepTipus: 1
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
                data.request = 'termekUpdate';
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp.status == "ok"){
                       window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard/delicates/termekLista";
                    }
				}, 'json');
			}
		});
		
		$(document).on('click', '.deleteKep', function(e){
			e.preventDefault();
			affectedRow = $(this).parents('tr');
			data = {
				request: 'deleteImageRef',
				id:	$(this).attr('data-id')				
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>'requestHandler", data, function(resp){
				if (resp.status == "ok"){
				   affectedRow.hide(500, function(){ $(this).remove(); });
				}
			}, 'json');
		});
		
		$(document).on('change', 'select[name^="kep_"]', function(){
			data = {
				request: 'insertImageRef',
				rendezvenyID: $(this).attr('data-id'),
				kepID: $(this).val()
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


*/
?>