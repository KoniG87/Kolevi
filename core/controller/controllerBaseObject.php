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
    
    
    
    /**
     * Helper function for converting comma-separated allergen string to array representation
     * @param string $allergenString comma-separated string containing allergen tag numbers
     * @return array array representation of input string
     */
    private function explodeIconString($allergenString){
    	$allergenArray = array();
    	
    	if (!empty($allergenString)){
    		$allergenArray = explode(",", $allergenString);
    	}
    	    	
    	return $allergenArray;
    }
    
    
    /**
     * Converts comma-separated allergen tags to PDF compliant image format
     * @param string $allergenString comma-separated string containing allergen tag numbers
     * @param integer $imageSize provided size (width & height in one) for image output (default 16)
     * @return string constructed images ready for inserting into html formatted output aimed at pdf 
     */    
    protected function fetchAllergenIcon($allergenString, $imageSize = 16){
    	$viewOutput = '';
    	$allergenArray = $this->explodeIconString($allergenString);
    	 
    	foreach ($allergenArray AS $allergenSorszam){
    		 
    		$iconPath = 'assets/img/allerg_'.sprintf("%02d", $allergenSorszam).'.jpg';
    
    		if (!file_exists($iconPath)){
    			$iconPath = 'assets/img/allerg_00.jpg';
    		}
    
    		$viewOutput .= '<img src="'.$iconPath.'" alt="Allergen" style="width:'.$imageSize.'px;height:'.$imageSize.'px;"/>';
    	}
    	return $viewOutput;
    
    }

    
    /**
     * Converts comma-separated allergen tags to html browser compliant image format 
     * @param string $allergenString
     * @return string constructed images ready for inserting into html formatted output aimed at browser
     */
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