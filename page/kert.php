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
	
	/*kell nekünk ide egy*/
	$menu->drawKertEtlap();
	$menu->drawItallap();
	
	$vendeglo->drawRendezveny();
	
	$galeria->drawGaleria();
?>

</div>