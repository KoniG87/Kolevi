<?php 

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
			
			case 'itallapDelete':
				$menu = new Menu($app->getDbHandler());
				$menu->deleteItallapElem();
					
				break;
			
		case 'szobaUpdate':
			
			$apartman = new Apartman($app->getDbHandler());
			$apartman->updateSzobaElem();
					
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
			
		case 'generateKertEtlapPDF':
			$kert = new Kert($app->getDbHandler());
			$kert->generateEtlapPDF();
			
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
			
		case 'switchLanguage':
			$_SESSION['helper']->registerValue('lang', $_POST['lang']);
			
			
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