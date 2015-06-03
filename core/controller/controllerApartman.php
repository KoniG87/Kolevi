<?php

class Apartman extends BaseObject{
    
    function __construct($dbHandler){
        $this->objectType = 'Apartman';
        
        parent::__construct($dbHandler);
    }
    
    public function drawFoglalasForm(){
        $this->view->drawFoglalasForm();
    }
    
    
    public function drawHely(){  
    	$this->view->drawHely();
    }
    
    
    public function drawSzobaList(){
    	$elements = $this->getSzobaData(2);
    
    	$this->view->drawSzobaList($elements);
    }
    
    
    public function drawTerkep(){
    	$this->view->drawTerkep();
    }
    
    
    public function getSzobaData($visible = 1){
    	$elements = array();
    	
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS header, ".$_SESSION['helper']->getLangLabel('leiras')." AS \"desc\", kezdokep, visible FROM koleves_szobak WHERE visible <> ?;";
    	$params = array($visible);
    	$szobaRES = $this->fetchItems($SQL, $params);
    	
    	$kepSQL = "SELECT fajlnev FROM koleves_kepek AS k
    			LEFT JOIN koleves_kep_osszekotesek AS ok ON ok.kep_id = k.id
    			WHERE ok.fk_id = ? AND ok.tipus = ?
    			ORDER BY ok.sorrend ASC;";
    	
    	$reviewSQL = "SELECT cim, nev, leiras, kep, rating FROM koleves_szoba_reviewek WHERE szoba_id = ? AND visible = ?;";
    	
    	foreach ($szobaRES AS $szobaData){
    		$tmpArray = array(
    			'id'	=> $szobaData['id'],
    			'header'=> $szobaData['header'],
    			'desc'	=> $szobaData['desc'],
    			'allapot'	=> $szobaData['visible'],
    			'kezdokep'=> $szobaData['kezdokep'],
    			'kepek'	=> $this->fetchItems($kepSQL, array($szobaData['id'], 4)),
    			'reviewek' => $this->fetchItems($reviewSQL, array($szobaData['id'], 1))
    		);
    		
    		array_push($elements, $tmpArray);
    	}
    	
    	return $elements;
    	
    }
    
    public function drawSzobak(){
    	$elements = array(
    		'szobak'	=> $this->getSzobaData()
    	);
    	
    	$this->view->drawSzobak($elements);
    }
    
    
    public function drawSzobaAdmin($szobaID = null){
    	$elements = $this->loadSzobaData($szobaID);
    	
    	$this->view->drawSzobaAdmin($elements);
    }
    
    
    
    public function loadKepek($tipusID = null){
    	$SQL = "SELECT id, fajlnev FROM koleves_kepek WHERE szekcio = ?;";
    
    	return $this->fetchItems($SQL, array($tipusID));
    }
    
    
    
    public function loadSzobaData($id = null){
    	$tmpArray = array(
    		'szoba'	=> array(	
    			'id'    => '0',
    			'header'  => '',
    			'desc'   => '',
    			'allapot'   => '1',
    			'kepek'   => array(),
    			'reviewek'	=> array()
    		),
    		'elerhetoKepek'	=> array()
    	);
    
    	if (!is_null($id)){
    		$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS header, ".$_SESSION['helper']->getLangLabel('leiras')." AS \"desc\", kezdokep, visible FROM koleves_szobak WHERE id = ?;";
    		$tmpArray['szoba'] = $this->fetchItem($SQL, array($id));
    		
    		$kepSQL = "SELECT k.id, k.fajlnev FROM koleves_kepek AS k
    			LEFT JOIN koleves_kep_osszekotesek AS ok ON ok.kep_id = k.id
    			WHERE ok.fk_id = ? AND ok.tipus = ?
    			ORDER BY ok.sorrend ASC;";
    		 
    		$reviewSQL = "SELECT cim, nev, leiras, kep, rating FROM koleves_szoba_reviewek WHERE szoba_id = ? AND visible = ?;";
    		
    		$tmpArray['szoba']['kepek'] = $this->fetchItems($kepSQL, array($id, 4));
    		$tmpArray['szoba']['reviewek'] = $this->fetchItems($reviewSQL, array($id, 1));
    	}
    	
    	$tmpArray['elerhetoKepek'] = $this->loadKepek(4);
    
    	return $tmpArray;
    }
    
    
}
?>
