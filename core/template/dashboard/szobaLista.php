<?php 
	$apartman = new Apartman($app->getDbHandler());
	
?>

	<h2>Szobák</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Szoba</th>
			<th class="wideHeader">Leírás</th>
			<th>Látható</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	$apartman->drawSzobaList();
?>
	</tbody>
</table>
<link href="assets/css/datepicker.css" rel="stylesheet" type="text/css"/>
<script src="assets/js/vendor/jquery-ui.min.js"></script>
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
		
		$('.deleteSzoba').click(function(){
			containingRow = $(this).parents('tr');
			canSubmit = true;
			data = {
				id: containingRow.attr('data-id'),
				request: 'szobaDelete'
			};

			if (canSubmit){
				$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
					containingRow.hide(250, function(){ $(this).remove(); });
				});
			}
		});
	});
</script>
 