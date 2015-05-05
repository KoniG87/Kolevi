<?php 
	$vendeg = new Vendeglo($app->getDbHandler());
	
?>
<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="hirkezelo"><span></span>
	<h2>Hír kezelése</h2></label>
	<div class="papercut-right"></div>
</div>
<button id="saveHir">Hír mentése</button>
<form id="editForm">
<table class="tablaGrid">
	<tbody>
		<tr>
			<td>
                <input type="hidden" name="id" value="0"/>
                <label>Típus</label></td>
			<td>
                <input type="hidden" name="id" value="0"/>
                <select name="tipus"required>
                    <option value=""></option>
                    <option value="1">Rendezvény</option>
                    <option value="2">Program</option>
                    <option value="3">Link-nélkül</option>
                </select>
			<span class="tooltip">Hírelem jellege</span>
			</td>
		</tr>
        <?php
/*<tr>
			<td><label>Bejegyzésválasztó</label></td>
			<td>
                <select name="bejegyzes"required>
                    <option value=""></option>
                
                </select>
			<span class="tooltip">Bejegyzés kiválasztása</span>
			</td>
		</tr>*/
        ?>
		<tr>
			<td><label>Felirat</label></td>
			<td><input maxlength="80" type="text" name="felirat" value="" required/>
			<span class="tooltip">Megjelenő felirat, max. 80 karakter</span>
			</td>
		</tr>
		
		<tr>
			<td>Látható</td>
			<td>
				 <select name="allapot"required>
                    <option value=""></option>
                    <option value="0">Inaktív</option>
                    <option value="1">Látható</option>
                    
                </select>
                <span class="tooltip">Látható legyen-e a Barcasban</span>
			</td>
		</tr>
		
	</tbody>
</table>
</form>

<div class="section-label" data-labelpos="2">
	<div class="papercut-left"></div>
	<label for="hirlista"><span></span>
	<h2>Hírlista</h2></label>
	<div class="papercut-right"></div>
</div>

<table class="tablaGrid hirTabla striped">
	<thead>
		<tr>
			<th class="wideHeader">Leírás</th>
			<th>Látható</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	$vendeg->drawHirList();
?>
	</tbody>
</table>
<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="assets/js/vendor/jquery-ui.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var triggeredRow;

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false && $(this).val() != ""){
				$(this).removeClass('missing');
			} else{
				$(this).addClass('missing');
			}
			
		});
        
        
        $(document).on('click', '.editHir', function(){
			containingRow = $(this).parents('tr');
			triggeredRow = containingRow;
            data = {
				id: containingRow.attr('data-id'),
                tipus: containingRow.attr('data-tipus'),
				felirat: $('td:nth-of-type(1)', containingRow).text(),
				allapot: containingRow.attr('data-allapot')
			};

			$.each(data, function(key, val){
				$('[name="'+key+'"]').val(val);
			});

			$('#saveHir').velocity("scroll", {
	            duration: 800,
	            easing: "ease",
	            offset:-100
	        });
	
				
		});
		
		$('#saveHir').click(function(){
			canSubmit = true;
			data = {
				id: $('#editForm input[name="id"]').val(),
				text_hu: $('#editForm input[name="felirat"]').val(),
                tipus_id: $('#editForm select[name="tipus"]').val(),
                allapot: $('#editForm select[name="allapot"]').val(),
                request: "updateHir"
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
				$.post("requestHandler.php", data, function(resp){
					$.each(data, function(key, val){
							$('input:visible, select:visible').val("");
						});
						$('input[name="id"]').val("0");
                    
                    if (data.id != "0"){
							$('td:nth-of-type(1)', triggeredRow).text(data.text_hu);
							$('td:nth-of-type(2)', triggeredRow).text(data.allapot ? 'Igen' : 'Nem');
							
						}else{
                    $('.hirTabla tbody').after('<tr data-id="'+resp['inputID']+'"><td>'+data.text_hu+'</td><td>'+data.allapot+'</td><td><button class="editHir">Szerkesztés</button></td></tr>');
                        }
				});
			}
		});
	});
</script>


