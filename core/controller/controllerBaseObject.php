<?php
class BaseObject{
    private $dbHandler;
    protected $view;
    protected $objectType;
    
    function __construct($dbHandler){
        $this->dbHandler = $dbHandler;
        $view = null;
        
        $this->initView();
    }
    
    protected function initView(){
        $viewName = $this->objectType.'View';
        if (file_exists('core/view/view'.$this->objectType.'.php')){
        	$this->view = new $viewName();
        }                
    }
    
    protected function fetchItem($SQL, $params = null){
    	$prep = $this->dbHandler->prepare($SQL);
    	
    	$prep->execute($params);
    	
    	return $prep->fetch(PDO::FETCH_ASSOC);
    }
    
    protected function fetchItems($SQL, $params = null){
    	$prep = $this->dbHandler->prepare($SQL);
    	
    	$prep->execute($params);
    	 
    	return $prep->fetchAll(PDO::FETCH_ASSOC);
    	
    }
    
    protected function updateItem($SQL, $params = null){
    	$prep = $this->dbHandler->prepare($SQL);
    	 
    	$prep->execute($params);
    }
    
    protected function insertItem($SQL, $params = null){
    	$prep = $this->dbHandler->prepare($SQL);
    	
    	$prep->execute($params);
    	
    	return $this->dbHandler->lastInsertId();
    }
	
	protected function deleteItem($SQL, $params = null){
    	$prep = $this->dbHandler->prepare($SQL);
    	
    	$prep->execute($params);
    	
    }

    
    protected function beginTransaction(){
  		$this->dbHandler->beginTransaction();  	
    }
    
    protected function commit(){
    	$this->dbHandler->commit();
    }
    
    protected function rollback(){
    	$this->dbHandler->rollback();
    }
    
    
    private function explodeIconString($allergenString){
    	$allergenArray = array();
    	
    	if (!empty($allergenString)){
    		$allergenArray = explode(",", $allergenString);
    	}
    	    	
    	return $allergenArray;
    }
    
    protected function fetchAllergenIcon($allergenString){
    	 
    	$viewOutput = '';
    	$allergenArray = $this->explodeIconString($allergenString);
    	 
    	foreach ($allergenArray AS $allergenSorszam){
    		 
    		$iconPath = 'assets/img/allerg_'.sprintf("%02d", $allergenSorszam).'.jpg';
    
    		if (!file_exists($iconPath)){
    			$iconPath = 'assets/img/allerg_00.jpg';
    		}
    
    		$viewOutput .= '<img src="'.$iconPath.'" alt="Allergen" style="width:18px;height:18px;"/>';
    	}
    	return $viewOutput;
    
    }
    
    protected function fetchAllergenSpan($allergenString){
    
    	$viewOutput = '';
    	$allergenArray = $this->explodeIconString($allergenString);
    
    	foreach ($allergenArray AS $allergenSorszam){
    		 $viewOutput .= '<span class="allergen alg-'.$allergenSorszam.'"></span>';
    	}
    	
    	return $viewOutput;
    
    }
}
?>