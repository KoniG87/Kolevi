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
<link href="<?=$_SESSION['helper']->getPath()?>assets/css/datepicker.css" rel="stylesheet" type="text/css"/>

<style type="text/css">
	.tablaGrid img{width:7.5em;}
</style>
<script src="<?=$_SESSION['helper']->getPath()?>assets/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		imageRefTemplate = $('.imageRefTemplate').parents('tr').clone();

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
		
		$('#saveSzoba').click(function(){
			canSubmit = true;
			data = {
                id: $('#editForm input[name="id"]').val(),
				text: $('#editForm input[name="text"]').val(),
				leiras: $('#editForm textarea[name="leiras"]').val(),
				kezdokep: "assets/img/gslide-1.jpg",
				sorrend: $('#editForm input[name="sorrend"]').val(), 
				allapot: $('#editForm select[name="allapot"]').val()
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
					newImageRow = imageRefTemplate;

					numberOfImages = $('input[name^="kep_"]:not(.shortInput)').length + 2;
					$('select[name^="kep_"]').replaceWith('<input readonly="readonly" type="text"  name="kep_'+resp.inputID+'" alt="'+resp.inputID+'. kép" value="'+selectedImage+'"/><input type="number" data-id="'+resp.inputID+'" name="kep_'+numberOfImages+'_sorrend" alt="'+numberOfImages+'. kép" value="1" class="kepSorrend shortInput reactive"/><button data-id="'+resp.inputID+'" class="deleteKep">Törlés</button>');
					$('input[name="kep_'+resp.inputID+'"]').parent('td').after('<td><img src="<?=$_SESSION['helper']->getPath()?>'+ selectedImagePath + '" alt="'+ selectedImage +'"/></td>');
					$('label', newImageRow).html(numberOfImages+ '. kép:');
					$('.tablaGrid').append(newImageRow)
				}
			}, 'json');
			
		});

		$(document).on('change', '.kepSorrend', function(){
			triggeredInput = $(this);
			
			data = {
				request: 'imageSorrendUpdate',
				sorrend: $(this).val(),
				kepID: $(this).attr('data-id')					
			};
				
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp.status == "ok"){
					triggeredInput.addClass("success");
					setTimeout(function(){
						triggeredInput.removeClass("success error");
					}, 750);
				}
			}, 'json');
		});
	});
</script>
 