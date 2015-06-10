<?php 
	$vendeg = new Vendeglo($app->getDbHandler());
	
?>
<h2>Programok</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Program</th>
			<th class="wideHeader">Leírás</th>
			<th>Dátum</th>
			<th>Látható</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	$vendeg->drawProgramList();
?>
	</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function(){
		

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
				megnevezes: $('#editForm input[name="megnevezes"]').val(),
				megjegyzes: $('#editForm textarea[name="megjegyzes"]').val()
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
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					window.location.href = "<?=$_SESSION['helper']->getPath()?>dashboard";
				});
			}
		});

		$(document).on('click', '.deleteProgram', function(){
			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "programDelete"
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
				
		});
	});
</script>


