<?php
class Helper{
    private $parameters;
    private $validParams;
    private $dirParams;
    
    function __construct($initParams){
    	$this->objectType = 'Helper';
    	
    	$this->validParams = $initParams['validParams'];
    	
    	$this->parameters = array(
    		'lang' => $this->mapSessionVariable('lang', $initParams['language']),
    		'base' => $this->mapSessionVariable('base', $initParams['basePath'])
    	);    
    }
    
    public function mapSessionVariable($varName, $defaultValue){
    	$value = $defaultValue;
    	if (isset($_SESSION['pref'][$varName])){
    		$value = $_SESSION['pref'][$varName];
    	}
    	
    	return $value;
    }
    
    public function initDirectories($dirParams){
    	$this->dirParams = $dirParams;
    }
    
    public function getLangLabel($labelBase){
    	return $labelBase.'_'.$this->getLang();
    }
    
    public function getLang(){
    	return $this->parameters['lang'];
    }
    
    public function getPage(){
    	return $this->parameters['page'];
    }
    
    public function getPath($dir = null){
    	$path = $this->parameters['base'];
    	
    	if (!is_null($dir) && in_array($dir, array_keys($this->dirParams))){
    		$path .= $this->dirParams[$dir];
    	}
    	
    	return $path;
    }
    
    public function registerValue($param, $value){
    	if (in_array($param, $this->validParams)){
    		$_SESSION['pref'][$param] = $value;
    		$this->parameters[$param] = $value;
    	}    	    	
    }
    
    public function dispatchUser(){
    	if (isset($_SESSION['user'])){
    		unset($_SESSION['user']);
    	}
    }

    public function updateBasketItem($termekAdat, $termekIndex = null){
		if (!isset($_SESSION['kosar']['termekek'])){
			$_SESSION['kosar'] = array(
				'termekek'	=> array()
			);
		}
		
    	if (!is_null($termekIndex)){
			$_SESSION['kosar']['termekek'][$termekIndex]['egyseg'] += $termekAdat['egyseg'];
		}else{
			array_push($_SESSION['kosar']['termekek'], $termekAdat);
		}
    }
    
    
    public function removeBasketItem($termekIndex = null){
    	if (!isset($_SESSION['kosar']['termekek'])){
    		$_SESSION['kosar'] = array(
    			'termekek'	=> array()
    		);
    	}
    	
    	if (!is_null($termekIndex)){
    		$_SESSION['kosar']['termekek'][$termekIndex]['egyseg'] += $termekAdat['egyseg'];
    	}else{
    		array_push($_SESSION['kosar']['termekek'], $termekAdat);
    	}
    	
    }
    
    
    public function checkCartContainsItem($termekID){
    	$kosarTartalom = $_SESSION['helper']->getBasketContents();
    	$termekSzamlalo = 0;
    	$benneVan = false;
    	
    	foreach ($kosarTartalom AS $termekAdat){
    		file_put_contents('data.txt', '\n'.$termekSzamlalo.'. '.$termekAdat['id'].' '.$termekID, FILE_APPEND);
    		if ($termekAdat['id'] == $termekID){
    			$benneVan = true;
    			 
    			break;
    		}
    	
    		$termekSzamlalo += 1;
    	}
    	
    	if ($termekSzamlalo == sizeof($kosarTartalom) && !$benneVan){
    		$termekSzamlalo = false;
    	}

    	return $termekSzamlalo;
    }
    
    
    public function emptyBasket(){
    	unset($_SESSION['kosar']['termekek']);
    }
    
    
    
    public function getBasketContents(){
    	$contentArray = array();
    	
    	if (isset($_SESSION['kosar']['termekek'])){
    		$contentArray = $_SESSION['kosar']['termekek'];
    	}
    	
    	return $contentArray;
    }
    

 public function getKosarEgysegek(){
     $egysegSzam = 0;
     
     if (isset($_SESSION['kosar']['termekek'])){
      foreach ($_SESSION['kosar']['termekek'] AS $termekAdat){
       $egysegSzam += $termekAdat['egyseg'];
      }
     }
     
     return $egysegSzam;

    }

}
?>
