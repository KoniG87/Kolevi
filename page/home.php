<?php

include('core/template/landing.php');

if (in_array($page, $frameRequired) && $pageExists){
	$app->drawNav(false);
}
?>