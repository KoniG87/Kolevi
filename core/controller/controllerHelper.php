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
    
    public function getBasket(){
    	//TODO delicates
    }
    
}
?>