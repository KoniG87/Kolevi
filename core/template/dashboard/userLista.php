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

