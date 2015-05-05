<?php

class Galeria extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Galeria';
        
		parent::__construct($dbHandler);
	}
    
    public function drawGaleria(){
		$SQL = 'SELECT id AS IMAGE_ID, fajlnev AS PATH, gallery_tag AS GALLERY_TAG FROM koleves_kepek WHERE gallery_tag IS NOT NULL AND gallery_tag <> "";';
		$elements = $this->fetchItems($SQL);
		
		/*
		SELECT substr(fajlnev, 0, length(fajlnev) - locate('/', reverse(fajlnev))) AS PATH, SUBSTRING_INDEX( fajlnev,  '/', -1 ) AS filename, gallery_tag AS GALLERY_TAG
			FROM koleves_kepek
			WHERE gallery_tag IS NOT NULL 
			AND gallery_tag <>  ""
			*/
        $this->view->drawGaleria($elements);
    }
    
    
    
}
?>