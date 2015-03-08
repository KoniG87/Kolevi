<?php
	include('core/config.php');
    include('core/functions.php');
    

    $page = isset($_GET['page']) ? (isset($_SERVER['HTTP_REFERER']) || $_GET['page'] == 'login' ? $_GET['page'] : 'login') : 'home';
    
    if (file_exists('page/'.$page.'.php')){
        include('page/'.$page.'.php');
    }
    /*
    if (!$app->validView($page)){
        header("HTTP/1.0 404 Not Found");
        $page = '404';
    }
    
    if (!isset($_POST['formSubmitted']) && $page != 'process' && !isset($_POST['processIndicator'])){
    //if (!isset($_POST['formSubmitted']) && $page != 'process' && $page != 'home' && !isset($_POST['processIndicator'])){
        $app->generateHtmlFrame('header');
		$app->loadDependencies($defaultDependencies);
        $app->generateHtmlFrame('menu');
    }
    
    $app->generateView($page); 
    
    
    if (!isset($_POST['formSubmitted']) && $page != 'process' && !isset($_POST['processIndicator'])){
    //if (!isset($_POST['formSubmitted']) && $page != 'process' && $page != 'home' && !isset($_POST['processIndicator'])){
        $app->generateHtmlFrame('footer');
    }
    */
?>