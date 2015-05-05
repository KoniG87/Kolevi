<?php 
include('page/home.php');
?>

<div class="row stickyStart">
	<div class="twelve coulumns vendeglo-container">
<?php
	$db = $app->getDbHandler();
	
	$vendeglo = new Vendeglo($db);
	$galeria = new Galeria($db);
	$menu = new Menu($db);

	
	$menu->drawNapiMenu();
	$menu->drawEtlap();
	$menu->drawItallap();
	
	$vendeglo->drawFoglalasForm();
	$vendeglo->drawRendezveny();
	$vendeglo->drawProgram();
	$vendeglo->drawRolunk();

	$galeria->drawGaleria();
?>

	</div>