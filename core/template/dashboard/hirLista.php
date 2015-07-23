<?php 
	$vendeg = new Vendeglo($app->getDbHandler());
	
?>
<h2>Hír kezelése</h2>
<button id="saveHir">Hír mentése</button>
<form id="editForm">
<table class="tablaGrid">
	<tbody>
		<tr>
			<td>
                <input type="hidden" name="id" value="0"/>
                <label>Típus</label></td>
			<td>
                
                <select name="tipus_id" title="Hírelem jellege" required>
                    <option value=""></option>
                    <option value="1">Rendezvény</option>
                    <option value="2">Program</option>
                    <option value="3">Link-nélkül</option>
                    <option value="4">Külső hivatkozás</option>
                </select>
				<span class="tooltip">Hírelem jellege</span>
			</td>
		</tr>
    
        <tr class="urlRow">
			<td><label>Hivatkozás</label></td>
			<td><input maxlength="250" type="text" name="url" title="Hivatkozás címe" value=""/>
			<span class="tooltip">Hivatkozás címe, max. 250 karakter</span>
			</td>
		</tr>
		<tr>
			<td><label>Felirat</label></td>
			<td><input maxlength="80" type="text" name="text" title="Megjelenő felirat" value="" required/>
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

<h2>Hírlista</h2>

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
<link href="<?=$_SESSION['helper']->getPath()?>assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="<?=$_SESSION['helper']->getPath()?>assets/js/vendor/jquery-ui.min.js"></script>
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
                tipus_id: containingRow.attr('data-tipus'),
				url: containingRow.attr('data-url'),
				text: $('td:nth-of-type(1)', containingRow).text(),
				allapot: containingRow.attr('data-allapot')
			};
			
			if (data.tipus_id == 4){
				$('.urlRow').fadeIn(250);
			}else{
				$('.urlRow').fadeOut(250);
			}

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
				text: $('#editForm input[name="text"]').val(),
				url: $('#editForm input[name="url"]').val(),
                tipus_id: $('#editForm select[name="tipus_id"]').val(),
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
				data.request = "updateHir";
					
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					
					$('input:visible, select:visible').val("");
					
					$('.urlRow').fadeOut(250);
					$('input', '.urlRow').removeAttr('required');
					$('input[name="id"]').val("0");
                    
                    if (data.id != "0"){
						$('td:nth-of-type(1)', triggeredRow).text(data.text);
						$('td:nth-of-type(2)', triggeredRow).text(data.allapot ? 'Igen' : 'Nem');
					}else{
                    	$('.hirTabla tbody').after('<tr data-url="'+data['url']+'" data-id="'+resp['inputID']+'"><td>'+data.text+'</td><td>'+(data.allapot ? 'Igen' : 'Nem')+'</td><td><button class="editHir">Szerkesztés</button></td><td><button class="deleteHir">Törlés</button></td></tr>');
                    }
				}, 'json');
			}
		}); 

		$('.urlRow').hide();
		$('select[name="tipus_id"]').change(function(){
			if ($(this).val() == 4){
				$('.urlRow').fadeIn(250);
				$('input', '.urlRow').attr('required', 'required');
			}else{
				$('.urlRow').fadeOut(250);
				$('input', '.urlRow').removeAttr('required');
			}
		});

		$(document).on('click', '.deleteHir', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "hirDelete"
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
				
		});
	});
</script>
 