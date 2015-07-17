<?php 
include('core/config.php');

try{
if (isset($_POST['request'])){

	switch ($_POST['request']){
		

		/*
		 * Delete handlers
		 */	
			
		case 'etlapDelete':
			$menu = new Menu($app->getDbHandler());
			$menu->deleteEtlapElem();
			
			break;
			
		case 'itallapDelete':
			$menu = new Menu($app->getDbHandler());
			$menu->deleteItallapElem();
				
			break;
			
		case 'programDelete':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->deleteProgramElem();
		
			break;
			
		case 'hirDelete':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->deleteHirElem();
		
			break;

		case 'cikkDelete' :
			$vendeglo = new Vendeglo ( $app->getDbHandler () );
			$vendeglo->deleteCikkElem ();
			
			break;
			
		case 'partnerDelete':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->deleteHirElem();
		
			break;
	
		case 'rendezvenyDelete':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->deleteRendezvenyElem();
		
			break;
			
		case 'slideDelete':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->deleteSlideElem();
		
			break;
			
		case 'deleteImageRef':
			$image = new Image($app->getDbHandler());
			$image->deleteImageRef();
		
			break;
			
		/*
		 * Additional handlers
		 */
			
		case 'checkoutForm':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->drawCheckout();
		
			break;
			
		case 'itemForm':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->drawProductPage($_POST['id']);
		
			break;
			
		case 'shopCategoryData':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->drawBoltKategoriaTermekek($_POST['id']);
			
			break;
			
			
		case 'shopSearchData':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->drawBoltKeresettTermekek($_POST['kereses']);
				
			break;
			
		case 'addToCart':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->addToCart();
			
			break;
			
		case 'removeFromCart':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->removeCartItem($_POST['id']);
				
			break;
			
		case 'insertImageRef':
			$image = new Image($app->getDbHandler());
			$image->insertImageRef();
		
			break;
			
		case 'generateKertEtlapPDF':
			$kert = new Kert($app->getDbHandler());
			$kert->generateEtlapPDF();
			
			break;
			
		case 'generateVendegloItallapPDF':
			$menu = new Menu($app->getDbHandler());
			$menu->generateVendegloItallapPDF();
				
			break;
			
			
		case 'authUser':
			$user = new User($app->getDbHandler());
			$user->authUser();
				
			break;
			
        case 'handleImages':
            $imageHandler = new Image($app->getDbHandler());    
            $imageHandler->processImages();
        
            break;
        
        case 'foglalasJovahagyas':
            $vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->foglalasJovahagyas();
        
            break;
        
		case 'switchLanguage':
			$_SESSION['helper']->registerValue('lang', $_POST['lang']);
			
			
			break;
		
			
		/*
		 * Update handlers
		 * */
		case 'asztalfoglalasUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateFoglalas();
		
			break;
		
		case 'cetliUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateCetli();
			break;
			
		case 'cikkUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateCikk();
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
			
		case 'kategoriaUpdate':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->updateKategoriaElem();
		
			break;
		
		case 'napiUpdate':
			$menu = new Menu($app->getDbHandler());
			$menu->updateNapiMenu();
		
			break;
			
		case 'partnerUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updatePartner();
		
			break;
		
		case 'programUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateProgram();
		
			break;
		
		case 'rendezvenyUpdate':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateRendezveny();
		
			break;

		case 'slideUpdate':
			$delicates = new Delicates($app->getDbHandler());
			$delicates->updateSlide();
		
			break;
			
		case 'updateImage':
			$imageHandler = new Image($app->getDbHandler());
			$imageHandler->updateImage();
		
			break;
		
		case 'szobaUpdate':
		
			$apartman = new Apartman($app->getDbHandler());
			$apartman->updateSzobaElem();
		
			break;
			
		case 'updateHir':
			$vendeglo = new Vendeglo($app->getDbHandler());
			$vendeglo->updateHir();
			
			break;
			
		
		/*
		 * Default: generate vendeglo etlap PDF
		 * */
			
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
			
			$menu = new Menu($app->getDbHandler());
			$menu->generateEtlapPDF();
		}else{
			header('Location: /');
			
		}
	}
	
}
}catch(Exception $e){
	echo $e->getMessage();
	
}
?>