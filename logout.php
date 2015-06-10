<?php
	include('core/config.php');
	
	$_SESSION['helper']->dispatchUser();
	header('Location: '.$_SESSION['helper']->getPath());
?>