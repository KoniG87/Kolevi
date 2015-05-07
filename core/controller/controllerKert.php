<?php

class Kert extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Kert';
        
		parent::__construct($dbHandler);
	}
    
    public function drawFoglalasForm(){
        $this->view->drawFoglalasForm();
    }
    
    /*
      
    public function drawRendezveny(){
    	
    	$szervezoSQL = "SELECT NEV, KEP, TELEFON, EMAIL, FACEBOOK FROM koleves_dolgozok WHERE rendezvenyfelelos = 1;";
    	
    	$elements = array(
    		'szervezo'	=> $this->fetchItem($szervezoSQL),
    		'rendezvenyek' => $this->getRendezvenyData()
    	);
    	   	
    	
    
    	$this->view->drawRendezveny($elements);
    }
    
    
    public function getRendezvenyData($allapot = 0){
    	$SQL = "SELECT id, text_hu AS MEGNEVEZES, leiras_hu AS MEGJEGYZES, allapot FROM koleves_rendezvenyek WHERE allapot <> ? ORDER BY sorrend ASC;";
    	$kepSQL = "SELECT FAJLNEV FROM koleves_kepek AS k LEFT JOIN koleves_kep_osszekotesek AS ko ON ko.kep_id = k.id WHERE ko.tipus = 1 AND ko.fk_id = ? ORDER BY ko.sorrend ASC;";
    	
    	
    	$rendezvenyCounter = 0;
    	
    	$tmpArray = $this->fetchItems($SQL, array($allapot));
    	
    	if (sizeof($tmpArray) > 0){
    		foreach ($tmpArray AS $rendezvenyData){
    			$tmpArray[$rendezvenyCounter]['kepek'] = $this->fetchItems($kepSQL, array($rendezvenyData['id']));
    			$rendezvenyCounter++;
    		}
    	}
    	
    	return $tmpArray;
    }
    
   
    
     public function getProgramData($allapot){
    	$SQL = "SELECT id, datum, text_hu AS labelHeader, SUBSTRING(leiras_hu, 1, 55) AS labelDesc, allapot, kep, fblink FROM koleves_programok WHERE allapot <> ? ORDER BY datum DESC;";
    	
    	return $this->fetchItems($SQL, array($allapot));
    }
    
    
    
    public function loadRendezvenyData($id = null){
        $tmpArray = array(
            'id'    => '0',
            'MEGNEVEZES'  => '',
            'MEGJEGYZES'   => '',
            'allapot'   => '1',
			'kepek'	=> null
        );
        
        if (!is_null($id)){
            $SQL = "SELECT id, text_hu AS MEGNEVEZES, leiras_hu AS MEGJEGYZES, allapot FROM koleves_rendezvenyek WHERE id = ?";
            $tmpArray = $this->fetchItem($SQL, array($id));
			
			$kepSQL = "SELECT ok.id, k.fajlnev FROM koleves_kepek AS k 
				LEFT JOIN koleves_kep_osszekotesek AS ok ON ok.kep_id = k.id
				WHERE ok.fk_id = ? AND ok.tipus = ?
				ORDER BY ok.sorrend ASC;";
			$tmpArray['kepek'] = $this->fetchItems($kepSQL, array($id, 1));
        }
        
        return $tmpArray;
    }
    
    
    public function loadProgramData($id = null){
        $tmpArray = array(
            'id'    => '0',
            'labelHeader'  => '',
            'labelDesc'   => '',
            'datum'		=> '',
			'allapot'   => '1',
            'kep'   => '',
            'fblink'    => ''
        );
        
        if (!is_null($id)){
            $SQL = "SELECT id, datum, text_hu AS labelHeader, SUBSTRING(leiras_hu, 1, 55) AS labelDesc, allapot, kep, fblink FROM koleves_programok WHERE id = ?;";
            $tmpArray = $this->fetchItem($SQL, array($id));
        }
        
        return $tmpArray;
    }
    
    
    public function drawProgram(){
    	$elements = $this->getProgramData(0);
    	
    	$this->view->drawProgram($elements);
    }
    */
    public function drawRolunk(){
    	$SQL = "SELECT username AS NICK, nev AS FULLNAME, megjegyzes AS DESCRIPTION, kep AS KEP FROM koleves_dolgozok WHERE vendeglo = 1 AND allapot = 1;";
    	$elements = $this->fetchItems($SQL);
    	
    	$this->view->drawRolunk($elements);
    	
    }
    
    /*
    
    public function loadKepek($tipusID = null){
        $SQL = "SELECT id, fajlnev FROM koleves_kepek WHERE szekcio = ?;";
        
        return $this->fetchItems($SQL, array($tipusID));
    }
    
	

    
    
    public function getFoglalasData(){
    	$foglalasSQL = "SELECT id, nev, megjegyzes, email, hanyfo, idopont, jovahagyva FROM koleves_asztalfoglalasok ORDER BY idopont DESC;";
    	$foglalasRES = $this->fetchItems($foglalasSQL);
    	 
    	return $foglalasRES;
    }
    
    
    
    public function drawFoglalasLista(){
        $elements = $this->getFoglalasData();
        
        $this->view->drawFoglalasLista($elements);
    }
    */
    
    public function updateFoglalas(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    	
    			    		
    		
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_asztalfoglalasok SET nev = ?, email = ?, megjegyzes = ?, hanyfo = ?, idopont = ?;";
    			 
    			$queryParams = array(
    					$_POST['nev'],
    					$_POST['email'],
    					$_POST['megjegyzes'],
    					$_POST['hanyfo'],
    					$_POST['datum'].' '.$_POST['ido']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_asztalfoglalasok SET nev = ?, email = ?, megjegyzes = ?, hanyfo = ?, idopont = ?, jovahagyta = ?, jovahagyva = ? WHERE id = ?;";
    	
    			$queryParams = array(
    					$_POST['nev'],
    					$_POST['email'],
    					$_POST['megjegyzes'],
    					$_POST['hanyfo'],
    					$_POST['datum'].' '.$_POST['ido'],
    					$_SESSION['user']['id'],
    					currentTime(),
    					$_POST['id']
    			);
    	
    			$this->updateItem($SQL, $queryParams);
    			 
    		}
    	
    		$res['status'] = true;
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = false;
    		$this->rollback();
    	}
    	 
    	echo json_encode($res);
    }
	
	/*
	public function drawRendezvenyAdmin($rendezvenyID){
		$elements = array(
			'rendezveny'	=> $this->loadRendezvenyData($rendezvenyID),
			'elerhetoKepek'	=> $this->loadKepek(1)
		);
		
		$this->view->drawRendezvenyAdmin($elements);
	}
    
    public function drawRendezvenyList(){
  		$elements = $this->getRendezvenyData(2);
    	
    	$this->view->drawRendezvenyList($elements);
    }
    
    
    public function drawProgramList(){
    	$elements = $this->getProgramData(2);
    	
    	$this->view->drawProgramList($elements);
    }
    */
    
    public function updateRendezveny(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_rendezvenyek SET text_hu = ?, leiras_hu = ?;";
    			 
    			$queryParams = array(
    					$_POST['text_hu'],
    					$_POST['leiras_hu']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_rendezvenyek SET text_hu = ?, leiras_hu = ?, allapot = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$_POST['text_hu'],
    					$_POST['leiras_hu'],
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
    
    
    public function updateProgram(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_programok SET text_hu = ?, leiras_hu = ?, kep = ?, fblink = ?, datum = ?;";
    			 
    			$queryParams = array(
    				$_POST['text_hu'],
    				$_POST['leiras_hu'],
                    $_POST['kep'],
                    $_POST['fblink'],
                    $_POST['datum']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_programok SET text_hu = ?, leiras_hu = ?, kep = ?, fblink = ?, datum = ?, allapot = ? WHERE id = ?;";
    
    			$queryParams = array(
    				$_POST['text_hu'],
    				$_POST['leiras_hu'],
                    $_POST['kep'],
                    $_POST['fblink'],
                    $_POST['datum'],
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
    
    
    
    public function getHirData($allapot = 0){
        $SQL = "SELECT id, fk_id, tipus_id, text_hu AS felirat, sorrend, allapot FROM koleves_hirsav WHERE allapot <> ?;";
    
        return $this->fetchItems($SQL, array($allapot));
    }
    
    
    public function drawHirList(){
        $elements = $this->getHirData(2);
        
        $this->view->drawHirList($elements);
    }
    
    
    public function foglalasJovahagyas(){
        $res = array();
        
        $SQL = "UPDATE koleves_asztalfoglalasok SET jovahagyva = ?, jovahagyta = ? WHERE id = ?;";
        $queryParams = array(
            1,
            $_SESSION['user']['id'],
            $_POST['id']
        );
        $this->updateItem($SQL, $queryParams);
        
        $SQL = "SELECT nev, email, megjegyzes, hanyfo, idopont FROM koleves_asztalfoglalasok WHERE id = ?;";
        $queryParams = array($_POST['id']);
        $foglalasData = $this->fetchItem($SQL, $queryParams);
        
        require 'assets/libs/phpmailer/PHPMailerAutoload.php';

        $mail = new PHPMailer;
        $mail->CharSet  = 'UTF-8';
        $mail->From = 'foglalas@kolevesvendeglo.hu';
        $mail->FromName = 'Kőleves';
        $mail->addAddress($foglalasData['email'], $foglalasData['nev']);     
        $mail->addReplyTo('foglalas@kolevesvendeglo.hu', 'Kőleves');
        $mail->isHTML(true);                                  

        $mail->Subject = 'Kőleves foglalás';
        $mail->Body    = '<table style="font-size:15px;background-image:url(http://kolevesvendeglo.hu/kolevi/assets/img/lightpaperfibers.png);">
            <tr>
                <td style="padding:10px;width:500px;text-align:center;" colspan="3">
                    <img src="http://kolevesvendeglo.hu/kolevi/assets/img/etlap-logo.png" alt="Kőleves" title="Kőleves vendéglő"/>
                </td>
            </tr>
            <tr>
                <td style="padding:10px;width:500px" colspan="3">
                    <h2>Kedves '.$foglalasData['nev'].'!</h2>
                    <p>Rendelését fogadtuk, a megjelölt időpontban várjuk szeretettel!</p>
                    <p>Emlékeztetőül a foglalás adatai:</p>
                </td>
            </tr>
            <tr>
                <td style="padding:5px 10px;width:200px">
                    <strong>Időpont</strong>
                </td>
                <td colspan="3" style="padding:5px 10px;width:300px">
                    '.$foglalasData['idopont'].'
                </td>
            </tr>
            </tr>
                <tr>
                <td style="padding:5px 10px;width:200px">
                    <strong>Hány fő</strong>
                </td>
                <td colspan="3" style="padding:5px 10px;width:300px">
                    '.$foglalasData['hanyfo'].'
                </td>
            </tr>
            </tr>
                <tr>
                <td style="width:200px">
                    <strong>Megjegyzés</strong>
                </td>
                <td colspan="3" style="width:300px">
                    '.$foglalasData['megjegyzes'].'
                </td>
            </tr>
            <tr>
                <td style="padding:10px;width:500px" colspan="3">
                    <p>Amennyiben módosítani szeretne a foglalás adatain, úgy kérjük időben vegye fel velünk a kapcsolatot!</p>
                </td>
            </tr>
        </table>';
        $mail->AltBody = 'Kedves '.$foglalasData['nev'].'! Megkaptuk foglalását a Kőleves étterembe, a megjelölt '.$foglalasData['idopont'].' időpontban várjuk szeretettel!';

        $res['status'] = 'nope';
        if($mail->send()) {
           $res['status'] = 'ok'; 
        }
        
        echo json_encode($res);
    }
    
    
    
    
    public function updateHir(){
        $res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_hirsav SET tipus_id = ?, text_hu = ?, rogzitve = ?;";
    			 
    			$queryParams = array(
    				$_POST['tipus_id'],	
                    $_POST['text_hu'],
                    date('Y-m-d H:i:s')   					
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_hirsav SET tipus_id = ?, text_hu = ? WHERE id = ?;";
    
    			$queryParams = array(
    				$_POST['tipus_id'],	
                    $_POST['text_hu'],
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
}
?>