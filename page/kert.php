<?php 
include('page/home.php');
?>

<div class="row stickyStart">
	<div class="twelve coulumns vendeglo-container">
<?php
	$db = $app->getDbHandler();
	
	$vendeglo = new Vendeglo($db);
	$kert = new Kert($db);
	$galeria = new Galeria($db);
	$menu = new Menu($db);

	
	$kert->drawRolunk();
	
	
	$menu->drawKertEtlap();
	$menu->drawItallap();
	
	$kert->drawRendezveny();
	
	$galeria->drawGaleria();
	
?>

</div>