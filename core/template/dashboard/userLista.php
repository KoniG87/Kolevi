<?php 
	$user = new User($app->getDbHandler());
?>


<h2>Dolgozók</h2>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Kép</th>
			<th class="wideHeader">Név</th>
			<th></th>
			<th></th>
			
			<?php 
			/*
			 
			 <th>Vendéglő</th>
			<th>Kert</th>
			<th>Szerkeszt</th>
			<th>Törlés</th>
			*/
			?>
		</tr>
	</thead>
	<tbody>
		<?php
            $user->drawUserList();
        ?>
	</tbody>
</table>


<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteDolgozo").click(function(e){
			e.preventDefault();

			containingRow = $(this).parents('tr');
			data = {
				id: containingRow.attr('data-id'),
				request: "dolgozoDelete"
			};
			
			$.post("<?=$_SESSION['helper']->getPath()?>requestHandler", data, function(resp){
				if (resp['status']){
					containingRow.hide(250, function(){ $(this).remove(); });			
				}
			}, 'json');
		});
	});
</script>