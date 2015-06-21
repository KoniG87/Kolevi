<?php

class Delicates extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Delicates';
        
		parent::__construct($dbHandler);
	}
    
	
	public function drawSliderAdmin(){
		$elements = array(
			'elerhetoKepek' => $this->loadKepek(7),
			'akciok'	=> $this->getSliderData(2)
		);
		//print_r($elements);
		$this->view->drawSliderAdmin($elements);
	}
	
	
	public function drawSlider(){
		$elements = array(
			'slidek'	 => $this->getSliderData(0),
			'kategoriak' => $this->getKategoriaStruktura()
		);
	
		$this->view->drawSlider($elements);
	}
	
	
	
	public function drawBolt(){
		$elements = array(
			'kategoriak' => $this->getKategoriaStruktura()	
		);
		
		$this->view->drawBolt($elements);
	}
    
    
    
    public function drawPartnerAdmin(){
    	$elements = array(
    		'partnerek'	=> $this->getPartnerData(2),
    		'elerhetoKepek' => $this->loadKepek(5)
    	);
    		
    
    	$this->view->drawPartnerAdmin($elements);
    }
    
    
    public function drawProgram(){
    	$elements = $this->getProgramData(0);
    	 
    	$this->view->drawProgram($elements);
    }
    
    
    
    public function drawProgramList(){
    	$elements = $this->getProgramData(2);
    
    	$this->view->drawProgramList($elements);
    }
    
    
    
    public function drawRendezveny(){
    	
    	$szervezoSQL = "SELECT NEV, KEP, TELEFON, EMAIL, FACEBOOK FROM koleves_dolgozok WHERE rendezvenyfelelos = 1;";
    	
    	$elements = array(
    		'szervezo'	=> $this->fetchItem($szervezoSQL),
    		'rendezvenyek' => $this->getRendezvenyData()
    	);
    	$elements['szervezo']['FEJLEC_IMAGE'] = 'assets/img/rendezvenyek-img.png';
    	
    
    	$this->view->drawRendezveny($elements);
    }
    
    
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
    
    
    public function getSliderData($allapot){
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, ".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, ".$_SESSION['helper']->getLangLabel('tag')." AS labelTag, ar, kep, sorrend, visible FROM koleves_delicates_slider WHERE visible <> ? ORDER BY sorrend ASC;";
    	
    	return $this->fetchItems($SQL, array($allapot));
    }
    
    public function getKategoriaData($melyseg = "full"){
    	$SQL = "SELECT id, icon, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader FROM koleves_delicates_fokategoriak ORDER BY sorrend ASC;";
    	$elements = $this->fetchItems($SQL);
    
    	if ($melyseg == "full"){
    		$alSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader FROM koleves_delicates_alkategoriak WHERE fokategoria_id = ? ORDER BY sorrend ASC;";
    
    		$kategoriaSzamlalo = 0;
    		foreach ($elements AS $kategoriaData){
    			$elements[$kategoriaSzamlalo]['alkategoriak'] = $this->fetchItems($alSQL, array($kategoriaData['id']));
    			$kategoriaSzamlalo++;
    		}
    	}
    	 
    	return $elements;
    }
    
    
    public function getMegrendelesData($megrendelsAllapot){
    	$allapot = 1;
    	if ($megrendelsAllapot == 'archiv'){
    		$allapot = 0;
    	}
    	
    	$SQL = "
    	SELECT m.id, m.nev, m.email, m.megjegyzes, SUM(egysegar*egyseg) AS osszeertek 
    		FROM koleves_delicates_megrendelesek AS m
			LEFT JOIN koleves_delicates_megrendelt_termekek AS mt ON mt.megrendeles_id = m.id
    		WHERE visible = ?
			GROUP BY mt.megrendeles_id
    			SELECT id, nev, email, megjegyzes".$_SESSION['helper']->getLangLabel('text')." AS labelHeader FROM koleves_delicates_fokategoriak ORDER BY sorrend ASC;";
    	$elements = $this->fetchItems($SQL, array($allapot));
    
    	if ($melyseg == "full"){
    		$termekSQL = "
    			SELECT mt.id, t.text_hu, t.kiskep, mt.egyseg, mt.egysegar, SUM(mt.egyseg * mt.egysegar ) AS osszar FROM koleves_delicates_megrendelt_termekek AS mt 
					LEFT JOIN koleves_delicates_termekek AS t ON t.id = mt.termek_id
					WHERE mt.megrendeles_id = ?
					GROUP BY mt.termek_id";	
    				
    
    		$megrendelesSzamlalo = 0;
    		foreach ($elements AS $megrendelesAdat){
    			$elements[$megrendelesSzamlalo]['termekek'] = $this->fetchItems($termekSQL, array($megrendelesAdat['id']));
    			$megrendelesSzamlalo++;
    		}
    	}
    
    	return $elements;
    }
    
    public function drawKategoriaAdmin(){
    	$elements = array(
    		'kategoriak'	=> $this->getKategoriaData()
    	);
    	//print_r($elements);
    	$this->view->drawKategoriaAdmin($elements);
    	
    }
    
    public function drawTermekAdmin(){
    	$elements = array(
    		'termek'	=> $this->getKategoriaData()
    	);
    	//print_r($elements);
    	$this->view->drawTermekAdmin($elements);
    	 
    }
    
    
    public function drawMegrendelesAdmin($megrendelsAllapot = 'aktualis'){
    	
    	
    	$elements = array(
    			'termek'	=> $this->getKategoriaData()
    	);
    	//print_r($elements);
    	$this->view->drawTermekAdmin($elements);
    
    }
    
    
    
    public function getKategoriaStruktura($melyseg = "full"){
    	return $this->getKategoriaData($melyseg);
    }
    
    
    
    
    
    
    public function getRendezvenyData($allapot = 0){
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, leiras_hu AS MEGJEGYZES, allapot FROM koleves_rendezvenyek WHERE allapot <> ? ORDER BY sorrend ASC;";
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
    
   
    
    public function getPartnerData($allapot){
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, ".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, visible, kep, url FROM koleves_partnerek WHERE visible <> ? ORDER BY sorrend ASC;";
    	
    	return $this->fetchItems($SQL, array($allapot));
    }
    
    
     public function getProgramData($allapot){
    	//$SQL = "SELECT id, datum, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, SUBSTRING(".$_SESSION['helper']->getLangLabel('leiras').", 1, 55) AS labelDesc, allapot, kep, fblink FROM koleves_programok WHERE allapot <> ? ORDER BY datum DESC;";
     	$SQL = "SELECT id, datum, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, ".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, allapot, kep, fblink FROM koleves_programok WHERE allapot <> ? ORDER BY datum DESC;";
     	
    	return $this->fetchItems($SQL, array($allapot));
    }
    
    
    
    
    public function deleteProgramElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_programok WHERE id = ?;";
    
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
    
    
    public function deleteRendezvenyElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_rendezvenyek WHERE id = ?;";
    		$kepSQL = "DELETE FROM koleves_kep_osszekotesek WHERE fk_id = ? AND tipus = ?;";
    		$queryParams = array(
    				$_POST['id']
    		);
    		$this->deleteItem($SQL, $queryParams);
    
    		array_push($queryParams, 1);
    		$this->deleteItem($kepSQL, $queryParams);
    		
    		$res['status'] = true;
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = false;
    		$this->rollback();
    	}
    
    	echo json_encode($res);
    }
    
    
    
    public function loadKepek($tipusID = null){
    	$SQL = "SELECT id, fajlnev FROM koleves_kepek WHERE szekcio = ?;";
    
    	return $this->fetchItems($SQL, array($tipusID));
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
    		$SQL = "SELECT id, datum, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, ".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, allapot, kep, fblink FROM koleves_programok WHERE id = ?;";
    		$tmpArray = $this->fetchItem($SQL, array($id));
    	}
    
    	return $tmpArray;
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
            $SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, ".$_SESSION['helper']->getLangLabel('leiras')." AS MEGJEGYZES, allapot FROM koleves_rendezvenyek WHERE id = ?";
            $tmpArray = $this->fetchItem($SQL, array($id));
			
			$kepSQL = "SELECT ok.id, k.fajlnev FROM koleves_kepek AS k 
				LEFT JOIN koleves_kep_osszekotesek AS ok ON ok.kep_id = k.id
				WHERE ok.fk_id = ? AND ok.tipus = ?
				ORDER BY ok.sorrend ASC;";
			$tmpArray['kepek'] = $this->fetchItems($kepSQL, array($id, 1));
        }
        
        return $tmpArray;
    }
    
    
    
    
    
    
	

    
    
   
    
    
    
    
   
    public function updateProgram(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    
    		$leirasText = str_replace(array("\r\n", "\r", "\n"), "<br/>", $_POST['leiras']);
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    
    			$SQL = "INSERT INTO koleves_programok SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?, kep = ?, fblink = ?, datum = ?;";
    
    			$queryParams = array(
    					$_POST['text'],
    					$leirasText,
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
    			$SQL = "UPDATE koleves_programok SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?, kep = ?, fblink = ?, datum = ?, allapot = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$_POST['text'],
    					$leirasText,
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
    
    
    
    
    public function updateRendezveny(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_rendezvenyek SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?;";
    			 
    			$queryParams = array(
    					$_POST['text'],
    					$_POST['leiras']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_rendezvenyek SET ".$_SESSION['helper']->getLangLabel('text')." = ?, ".$_SESSION['helper']->getLangLabel('leiras')." = ?, allapot = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$_POST['text'],
    					$_POST['leiras'],
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
    
    
    
    function foglalasErtesitoEmail($foglalasData, $ertesitesiData){
    	require 'assets/libs/phpmailer/PHPMailerAutoload.php';
    	$res = array();
    	 
    	$mail = new PHPMailer;
    	$mail->CharSet  = 'UTF-8';
    	$mail->From = 'foglalas@kolevesvendeglo.hu';
    	$mail->FromName = 'Kőleves';
    	$mail->addAddress($ertesitesiData['email'], $ertesitesiData['nev']);
    	$mail->addReplyTo('foglalas@kolevesvendeglo.hu', 'Kőleves');
    	$mail->isHTML(true);
    	 
    	$mail->Subject = 'Kőleves foglalási kérés';
    	$mail->Body    = '<table style="font-size:15px;background-image:url(http://kolevesvendeglo.hu/kolevi/assets/img/lightpaperfibers.png);">
            <tr>
                <td style="padding:10px;width:500px;text-align:center;" colspan="3">
                    <img src="http://kolevesvendeglo.hu/kolevi/assets/img/etlap-logo.png" alt="Kőleves" title="Kőleves vendéglő"/>
                </td>
            </tr>
            <tr>
                <td style="padding:10px;width:500px" colspan="3">
                    <p>A rendszer a következő adatokkal asztalfoglalási kérést fogadott:</p>
                </td>
            </tr>
            <tr>
                <td style="padding:5px 10px;width:200px">
                    <strong>Név</strong>
                </td>
                <td colspan="3" style="padding:5px 10px;width:300px">
                    '.$foglalasData['nev'].'
                </td>
            </tr>
			<tr>
                <td style="padding:5px 10px;width:200px">
                    <strong>Email</strong>
                </td>
                <td colspan="3" style="padding:5px 10px;width:300px">
                    '.$foglalasData['email'].'
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
            
        </table>';
    	$mail->AltBody = 'Foglalás érkezett a rendszerbe: '.$foglalasData['nev'].' ('.$foglalasData['email'].') foglalt összesen '.$foglalasData['hanyfo'].' főre, még pedig '.$foglalasData['idopont'].' időpontban'.(empty($foglalasData['megjegyzes']) ? '.' : ' a következő megjegyzéssel: '.$foglalasData['megjegyzes']);
    	 
    	$res['status'] = 'nope';
    	if($mail->send()) {
    		$res['status'] = 'ok';
    	}
    	 
    	return $res;
    }
    
    
    function foglalasJovahagyasEmail($foglalasData){
    	require 'assets/libs/phpmailer/PHPMailerAutoload.php';
    	$res = array();
    	
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
    	$mail->AltBody = 'Kedves '.$foglalasData['nev'].'! Megkaptuk foglalását '.$foglalasData['hanyfo'].' főre a Kőleves étterembe, a megjelölt '.$foglalasData['idopont'].' időpontban várjuk szeretettel! Az alábbi megjegyzést hagyta számunkra: '.$foglalasData['megjegyzes'];
    	
    	$res['status'] = 'nope';
    	if($mail->send()) {
    		$res['status'] = 'ok';
    	}
    	
    	return $res;
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
        
        $res = $this->foglalasJovahagyasEmail($foglalasData);
        
        echo json_encode($res);
    }
    
    
    
    
    
}
?>