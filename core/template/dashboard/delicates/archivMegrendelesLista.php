<?php 
	$delicates = new Delicates($app->getDbHandler());
	
?>
<h2>Rendezvények</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Rendezvény</th>
			<th class="wideHeader">Leírás</th>
			<th>Látható</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php 
	$delicates->drawTermekList();
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
	});
</script>


