<!-- <div class="section-label" data-labelpos="1">
	<div class="papercut-left"></div>
	<label for="aktualis"><span></span>
	<h2>Aktuális hét</h2></label>
	<div class="papercut-right"></div>
</div> -->
<h2>Aktuális hét</h2>
<?php
	$date = new DateTime(date('Y-m-d'));	
		
	$nthInWeek = $date->format('w') == 0 ? 7 : $date->format('w');
	
	$firstDay = $date->modify("-".($nthInWeek - 1)." days");
	
	$menu = new Menu($app->getDbHandler());
	$menu->drawNapiAdmin($firstDay);
?>
    