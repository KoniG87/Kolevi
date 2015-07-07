<?php
	include('core/config.php');
    include('core/functions.php');
    
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $path = 'page/'.$page.'.php';
    $pageExists = file_exists($path);
        
	$_SESSION['helper']->registerValue('page', $page);
    
	if (in_array($page, $frameRequired) && $pageExists){
    	$app->drawHeader();
    	$app->drawNav(true, $page);
	}else{
		$app->drawHeader(true);
	}
    
	if ($pageExists){
        if ($page == "dashboard"){
            if (isset($_SESSION['user'])){
                include($path);
            }else{
                include('page/home.php');    
            }
        }else{
            include($path);
        }
	}else{
    	include('page/home.php');
        
    }
   
    if (in_array($page, $frameRequired) && $pageExists){
    	$app->drawFooter();
    }
    
    $app->drawPageClosure($page);
?>