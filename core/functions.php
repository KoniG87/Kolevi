<?php

function currentTime(){
	return date('Y-m-d H:i:s');
}

function currentYear(){
	return date('Y');
} 
 
function validDate($date, $format = 'Y-m-d'){
	$d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>