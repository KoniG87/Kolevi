<?php 
    $apartman = new Apartman($app->getDbHandler());
    $szobaID = isset($_POST['id']) ? $_POST['id'] : null;
    
    
?>
<h2>Szoba rögzítése</h2>

<button id="saveSzoba">Szoba mentése</button>
<form id="editForm">
<?php
	$apartman->drawSzobaAdmin($szobaID);
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
		
		$('#saveSzoba').click(function(){
			canSubmit = true;
			data = {
                id: $('#editForm input[name="id"]').val(),
				text: $('#editForm input[name="text"]').val(),
				leiras: $('#editForm textarea[name="leiras"]').val(),
				kezdokep: "assets/img/gslide-1.jpg",
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
                data.request = 'szobaUpdate';
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp.status == "ok"){
                       window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard/apartman/szobaLista";
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
				kepTipus: 4
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
 