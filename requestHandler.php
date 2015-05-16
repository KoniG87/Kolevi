<?php 

/*$_POST['request'] = 'asztalfoglalasUpdate';
$_POST['id'] = "0";
$_POST['nev'] = 'Asd Józsi';
$_POST['datum'] = '2015.04.04';
$_POST['ido'] = '16:30';
$_POST['email'] = 'asd@vasd.com';
$_POST['megjegyzes'] = "";
$_POST['hanyfo'] = "öt";
*/
/*
$_POST['id'] = "0";
$_POST['request'] = "rendezvenyUpdate";
$_POST['text_hu'] = 'Ujrendezveny';
$_POST['leiras_hu'] = 'leiras';
$_POST['allapot'] = 1;
*/
/*
$_POST['id'] = "1";
$_POST['request'] = 'itallapUpdate';
$_POST['text_hu'] = 'Capuchino';
$_POST['ar'] = '550';
$_POST['kategoria'] = 'forró italok';
*/
/*
$_POST['request'] = 'updateImage';
$_POST['id'] = '2';
$_POST['param'] = 'gallery_tag';
$_POST['value'] = '1';
*/
/*
$_POST['request'] = 'foglalasJovahagyas';
$_POST['id'] = '10';
*/
if (isset($_POST['request'])){
	include('core/config.php');

	switch ($_POST['request']){
		case 'napiUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateNapiMenu();
				
			break;
			
					
		case 'dolgozoUpdate':
			$user = new User($app->getDbHandler());
			$user->updateUser();
			
			break;
			
		case 'etlapUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateEtlapElem();
			
			break;

		case 'itallapUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateItallapElem();
				
			break;
			
		case 'etlapDelete':
			$menu = new Menu($app->getDbHandler());
			$menu->deleteEtlapElem();
			
			break;
			
		case 'cetliUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateCetli();
			break;
			
		case 'programUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateProgram();
        
			break;
        
        case 'rendezvenyUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateRendezveny();
        
			break;
			
		case 'asztalfoglalasUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateFoglalas();
			
			break;
			
		case 'authUser':
			$user = new User($app->getDbHandler());
			$user->authUser();
			
			break;
			
		case 'generateEtlapPDF':
			
			break;
			
        case 'handleImages':
            $imageHandler = new Image($app->getDbHandler());    
            $imageHandler->processImages();
        
            break;
        
        case 'updateImage':
            $imageHandler = new Image($app->getDbHandler());    
            $imageHandler->updateImage();
        
            break;
        
        
        case 'updateHir':
            $vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateHir();
            break;
        
        case 'foglalasJovahagyas':
            $vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->foglalasJovahagyas();
        
            break;
        
		case 'deleteImageRef':
			$image = new Image($app->getDbHandler());
			$image->deleteImageRef();
		
			break;
			
		case 'insertImageRef':
			$image = new Image($app->getDbHandler());
			$image->insertImageRef();
		
			break;
		
		default:
			$menu = new Menu($app->getDbHandler());
			$menu->generateEtlapPDF();
				
			
	}
	
}else{
	if (isset($_GET['request'])){
		$_POST = $_GET;
		$vendeglo = new Vendeglo($app->getDbHandler());
		$vendeglo->updateFoglalas();
		
	}else{
	
		if (isset($_SERVER['HTTP_REFERER'])){
			include('core/config.php');
		
			$menu = new Menu($app->getDbHandler());
			$menu->generateEtlapPDF();
		}else{
			header('Location: /');
			
		}
	}
}

?>