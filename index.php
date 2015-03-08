<?php
	include('core/config.php');
    include('core/functions.php');
    

    $page = isset($_GET['page']) ? (isset($_SERVER['HTTP_REFERER']) || $_GET['page'] == 'login' ? $_GET['page'] : 'login') : 'home';
    
    if (file_exists('page/'.$page.'.php')){
        include('page/'.$page.'.php');
    }
   
?>