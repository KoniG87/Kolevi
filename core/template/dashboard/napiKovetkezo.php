<h2>Következő hét</h2>
<?php 
	$date = new DateTime(date('Y-m-d'));	
	$nthInWeek = $date->format('w');
	
    $firstDay = $date->modify("+".(7 - $nthInWeek + 1)." days");

	$menu = new Menu($app->getDbHandler());
	$menu->drawNapiAdmin($firstDay);
?> 