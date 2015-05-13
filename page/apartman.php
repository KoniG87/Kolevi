<?php 
include('page/home.php');
?>
<div class="row stickyStart">
	<div class="twelve coulumns apartman-container">


<?php 
	$db = $app->getDbHandler();
	
	$apartman = new Apartman($db);
	$galeria = new Galeria($db);
	
	$apartman->drawTerkep();
	$apartman->drawHely();
	$apartman->drawSzobak();
	$galeria->drawGaleria();
?>

	</div>