<?php 
	$user = new User($app->getDbHandler());
?>


<div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="dolgozok"><span></span>
	<h2>Dolgozók</h2></label>
	<div class="papercut-right"></div>
</div>

<table class="tablaGrid striped">
	<thead>
		<tr>
			<th>Kép</th>
			<th class="wideHeader">Név</th>
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

