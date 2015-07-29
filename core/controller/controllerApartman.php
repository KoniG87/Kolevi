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
    
    
    public function loadReviewData($szobaID = null, $visibility = 2){
    	$tmpArray = array(
    		'id'    => '0',
    		'header'  => '',
    		'desc'   => '',
    		'allapot'   => '1',
    		'nev'	=> '',
    		'rating'	=> ''
    	);
    	
    	if (!is_null($szobaID)){
    		
    		
    		$SQL = "SELECT id, nev, cim, leiras, kep, rating, sorrend, visible FROM koleves_szoba_reviewek WHERE visible <> ? AND szoba_id = ?;";
    		$tmpArray = $this->fetchItems($SQL, array($visibility, $szobaID));
    	
    	
    	}
    	 
    	return $tmpArray;
    }
    
    
    public function drawReviewAdmin($szobaID){
    	$elements = array(
    		'szobaID'	=> $szobaID,
    		'reviewek'	=> $this->loadReviewData($szobaID)
    	);
    
    	$this->view->drawReviewAdmin($elements);
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
    		'szobak'	=> $this->getSzobaData(0)
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
    		$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS header, ".$_SESSION['helper']->getLangLabel('leiras')." AS \"desc\", kezdokep, sorrend, visible FROM koleves_szobak WHERE id = ?;";
    		$tmpArray['szoba'] = $this->fetchItem($SQL, array($id));
    		
    		$kepSQL = "SELECT ok.id, k.fajlnev, ok.sorrend FROM koleves_kepek AS k
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
    
    

    public function updateReviewElem(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		$leirasText = str_replace(array("\r\n", "\r", "\n"), "<br/>", $_POST['leiras']);
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    
    			$SQL = "INSERT INTO koleves_szoba_reviewek SET szoba_id = ?, nev = ?, leiras = ?, cim = ?, kep = ?, rating = ?, sorrend = ?, visible = ?;";
    
    			$queryParams = array(
    				$_POST['szoba_id'],
    				$_POST['nev'],
    				$leirasText,
    				$_POST['cim'],
    				'assets/img/tmb-2.png',
    				$_POST['rating'],
    				$_POST['sorrend'],
    				$_POST['allapot']
    			);
    
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_szoba_reviewek SET nev = ?, leiras = ?, cim = ?, rating = ?, sorrend = ?, visible = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$_POST['nev'],
    					$leirasText,
    					$_POST['cim'],
    					$_POST['rating'],
    					$_POST['sorrend'],
    					$_POST['allapot'],
    					$_POST['id']
    			);
    			 
    			$this->updateItem($SQL, $queryParams);
    
    		}
    
    		$res['status'] = "ok";
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = "nope";
    		$this->rollback();
    	}
    
    	echo json_encode($res);
    }
    

    public function updateSzobaElem(){
    	$res = array();
    	
    	try{
    		$this->beginTransaction();
    
    		$leirasText = str_replace(array("\r\n", "\r", "\n"), "<br/>", $_POST['leiras']);
    		
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_szobak SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?, kezdokep = ?;";
    			 
    			$queryParams = array(
    				$_POST['text'],
    				$leirasText,
    				$_POST['kezdokep']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_szobak SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?, kezdokep = ?, visible = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$_POST['text'],
    					$leirasText,
    					$_POST['kezdokep'],
    					$_POST['allapot'],
    					$_POST['id']
    			);
    			
    			$this->updateItem($SQL, $queryParams);
    			 
    		}
    
    		$res['status'] = "ok";
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = "nope";
    		$this->rollback();
    	}
    	 
    	echo json_encode($res);
    }
    
    
    public function deleteReviewElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_szoba_reviewek WHERE id = ?;";
    		
    
    		$queryParams = array(
    				$_POST['id']
    		);
    		$this->deleteItem($SQL, $queryParams);
    		
    
    		$res['status'] = true;
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = false;
    		$this->rollback();
    	}
    
    	echo json_encode($res);
    }
    
    
    public function deleteSzobaElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_szobak WHERE id = ?;";
    		$kepSQL = "DELETE FROM koleves_kep_osszekotesek WHERE fk_id = ? AND tipus = ?;";
    		$reviewSQL = "DELETE FROM koleves_szoba_reviewek WHERE szoba_id = ?;";
    		
    		$queryParams = array(
    			$_POST['id']
    		);
    		$this->deleteItem($SQL, $queryParams);
    		$this->deleteItem($reviewSQL, $queryParams);
    		
    		array_push($queryParams, 4);
    		$this->deleteItem($kepSQL, $queryParams);
    
    		$res['status'] = true;
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = false;
    		$this->rollback();
    	}
    
    	echo json_encode($res);
    }
    
}
?>
 