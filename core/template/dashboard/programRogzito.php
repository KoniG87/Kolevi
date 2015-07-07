<?php 
    $vendeglo = new Vendeglo($app->getDbHandler());
    $programID = isset($_POST['id']) ? $_POST['id'] : null;
    $programData = $vendeglo->loadProgramData($programID);

    $programKepek = $vendeglo->loadKepek(1);
?>

<h2>Új rögzítése</h2>

<button id="saveProgram">Program mentése</button>
<form id="editForm">
<table class="tablaGrid">
	<tbody>
		<tr>
			<td>
                <input type="hidden" name="id" value="<?=$programData['id']?>"/>
                <label>Neve</label></td>
			<td><input maxlength="75" title="Cím" type="text" name="text" value="<?=$programData['labelHeader']?>" required/>
			<span class="tooltip">Cím, max. 75 karakter</span>
			</td>
		</tr>
		<tr>
			<td><label>Dátum</label></td>
			<td><input title="Dátum" type="text" class="datepicker" name="datum" value="<?=$programData['datum']?>" required/>
			<span class="tooltip">Dátum</span>
			</td>
		</tr>
		<tr>
			<td><label>Leírás</label></td>
			<td><textarea maxlength="1024" title="Leírás" type="text" name="leiras" required><?=str_replace(array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;"), "\r\n", $programData['labelDesc'])?></textarea>
			<span class="tooltip">Leírás, max. 1024 karakter</span></td>
		</tr>
		<tr>
			<td><label>Kép</label></td>
			<td>
                 <select name="kep" required title="Program képe">
                    <option value=""></option>
               <?php
            foreach ($programKepek AS $kepData){
                echo '<option '.($programData['kep'] == $kepData['fajlnev'] ? 'selected="selected"' : '').' value="'.$kepData['fajlnev'].'">'.basename($kepData['fajlnev']).'</option>';
            }
            ?>
                </select>
                
			<span class="tooltip">Kép</span></td>
		</tr>
		<tr>
			<td><label>Facebook oldala</label></td>
			<td><input maxlength="155" title="Facebook oldal" type="text" name="fblink" value="<?=$programData['fblink']?>" placeholder=""/>
			<span class="tooltip">Facebook oldal, max. 155 karakter</span></td>
		</tr>
		
	</tbody>
</table>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').datepicker({
			inline: true,
			showOtherMonths: true,
			dateFormat: 'yy-mm-dd',
			dayNamesMin: ['Va', 'Hé', 'Ke', 'Sze', 'Cs', 'Pé', 'Szo'],
			firstDay: 1
		});

		$('input, textarea, select').change(function(){
			attr = $(this).attr('required');
			if (typeof attr !== typeof undefined && attr !== false && $(this).val() != ""){
				$(this).removeClass('missing');
			} else{
				$(this).addClass('missing');
			}
			
		});
		
		$('#saveProgram').click(function(){
			canSubmit = true;
			data = {
                id:  $('#editForm input[name="id"]').val(),
				text: $('#editForm input[name="text"]').val(),
				leiras: $('#editForm textarea[name="leiras"]').val(),
				datum: $('#editForm input[name="datum"]').val(),
				kep: $('#editForm select[name="kep"]').val(),
				fblink: $('#editForm input[name="fblink"]').val(),
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
				data.request = 'programUpdate';
				
                $.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					if (resp.status == "ok"){
                        window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard/programLista";
                    }
				}, 'json');
			}
		});
	});
</script>
 