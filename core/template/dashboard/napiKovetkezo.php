<div class="section-label" data-labelpos="2">
	<div class="papercut-left"></div>
	<label for="kovetkezo"><span></span>
	<h2>Következő hét</h2></label>
	<div class="papercut-right"></div>
</div>
<?php 
	$date = new DateTime(date('Y-m-d'));	
	$nthInWeek = $date->format('w');
	
    $firstDay = $date->modify("+".(7 - $nthInWeek + 1)." days");

	$menu = new Menu($app->getDbHandler());
	$menu->drawNapiAdmin($firstDay);
?>