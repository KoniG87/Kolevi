<?php 
    $vendeglo = new Vendeglo($app->getDbHandler());
    $rendezvenyID = isset($_POST['id']) ? $_POST['id'] : null;
    
?>
<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="rendezveny"><span></span>
	<h2>Új rögzítése</h2></label>
	<div class="papercut-right"></div>
</div>
<button id="saveRendezveny">Rendezvény mentése</button>
<form id="editForm">
<?php
	$vendeglo->drawRendezvenyAdmin($rendezvenyID);
?>
</form>
<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css"/>

<style type="text/css">
	.tablaGrid img{width:7.5em;}
</style>
<script src="assets/js/vendor/jquery-ui.min.js"></script>
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
		
		$('#saveRendezveny').click(function(){
			canSubmit = true;
			data = {
                id: $('#editForm input[name="id"]').val(),
				text_hu: $('#editForm input[name="text_hu"]').val(),
				leiras_hu: $('#editForm textarea[name="leiras_hu"]').val(),
				allapot: 1
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
                data.request = 'rendezvenyUpdate';
				$.post("requestHandler.php", data, function(resp){
					if (resp.status == "ok"){
                       window.location.href = "index.php?page=dashboard&sub=rendezvenyLista";
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
			
			$.post("requestHandler.php", data, function(resp){
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
			
			$.post("requestHandler.php", data, function(resp){
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


