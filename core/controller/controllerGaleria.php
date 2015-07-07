<?php
class Galeria extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Galeria';
        
		parent::__construct($dbHandler);
	}
    
    public function drawGaleria(){
		$SQL = "SELECT 
    	(@curRow:=@curRow+1) AS IMAGE_ID, 
		(@curPath:=substr(fajlnev, 1, length(fajlnev) - locate('/', reverse(fajlnev))+1)),
		(@curImage:=SUBSTRING_INDEX( fajlnev,  '/', -1 )),
	
    	gallery_tag AS GALLERY_TAG,
    	CONCAT(@curPath, 'th_', @curImage) AS THUMB_PATH,
    	CONCAT(@curPath, @curImage) AS IMAGE_PATH
			FROM koleves_kepek JOIN (SELECT @curRow:=-1) AS cr
			WHERE gallery_tag IS NOT NULL 
			AND gallery_tag <>  ''";
		$elements = $this->fetchItems($SQL);
	
        $this->view->drawGaleria($elements);
    }
    
    
    
}
?> 