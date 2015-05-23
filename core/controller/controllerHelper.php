<?php
class Helper{
    private $parameters;
    
    function __construct($initParams){
    	$this->objectType = 'Helper';
    	
    	$this->parameters = array(
    		'lang' => $this->mapSessionVariable('lang', $initParams['language'])
    	);    
    }
    
    public function mapSessionVariable($varName, $defaultValue){
    	$value = $defaultValue;
    	if (isset($_SESSION['pref'][$varName])){
    		$value = $_SESSION['pref'][$varName];
    	}
    	
    	return $value;
    }
    
    public function getLangLabel($labelBase){
    	return $labelBase.'_'.$this->getLang();
    }
    
    public function getLang(){
    	return $this->parameters['lang'];
    }
    
    public function getBasket(){
    	//TODO delicates
    }
    
}
?>