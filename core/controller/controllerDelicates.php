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
    
    public function drawCheckout(){
    	$elements = array(
    		'termekek' => $_SESSION['helper']->getBasketContents()
    	);
    	
    	$this->view->drawCheckout($elements);
    }
    
    
    public function getTermekData($termekID, $includeShopKepek = false){
    	$termekSQL = "SELECT 
    			t.id, 
    			t.".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, 
    			t.".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc,
    			f.".$_SESSION['helper']->getLangLabel('text')."	AS labelKategoria,
    			a.".$_SESSION['helper']->getLangLabel('text')." AS labelAlkategoria,
    			t.ar AS egysegar, 
    			t.kiskep AS kep 
    		FROM 
    			koleves_delicates_termekek AS t
    		LEFT JOIN 
				koleves_delicates_alkategoriak AS a ON a.id = t.alkategoria_id
			LEFT JOIN 
				koleves_delicates_fokategoriak AS f ON f.id = a.fokategoria_id 
	    	WHERE 
    			t.id = ?;";
    	
    	$termekAdat = $this->fetchItem($termekSQL, array($termekID));
    	
    	if ($includeShopKepek){
    		$SQL = "SELECT kep FROM koleves_delicates_termekkepek WHERE termek_id = ? ORDER BY sorrend ASC;";
    		$termekAdat['kepek'] =  array(
    				/*
    				'nav'	=> array(),
    				'slider'=> array()
    				*/
    		);
    		/*
    		$termekAdat['kepek'] =  array(
    				'nav'	=> array(
    						'assets/uploads/raspberry-jam-01.jpg',
    						'assets/uploads/raspberry-jam-02.jpg',
    						'assets/uploads/raspberry-jam-03.jpg',
    						'assets/uploads/raspberry-jam-04.jpg'
    				),
    				'slider'	=> array(
    						'assets/uploads/raspberry-jam-01.jpg',
    						'assets/uploads/raspberry-jam-02.jpg',
    						'assets/uploads/raspberry-jam-03.jpg',
    						'assets/uploads/raspberry-jam-04.jpg'
    				)
    		);
    		*/
    		
    		$termekKepek = $this->fetchItems($SQL, array($termekID));
    		foreach ($termekKepek AS $kepAdat){
    			/*
    			array_push($termekAdat['kepek']['nav'], $kepAdat['kep']);
    			array_push($termekAdat['kepek']['slider'], $kepAdat['kep']);
    			*/
    			array_push($termekAdat['kepek'], $kepAdat['kep']);
    		}
    		
    		
    	}
    	
    	return $termekAdat;

    }
    
    public function removeCartItem($termekID){
    	// TODO: debug Helper->checkCartContainsItem
    	// $benneVan = $_SESSION['helper']->checkCartContainsItem($ujTermek['id']);
    	$kosarTartalom = $_SESSION['helper']->getBasketContents();
    	$termekSzamlalo = 0;
    	$benneVan = false;
    	 
    	foreach ($kosarTartalom AS $termekAdat){
    		
    		if ($termekAdat['id'] == $termekID){
    			$benneVan = true;
    	
    			break;
    		}
    		 
    		$termekSzamlalo += 1;
    	}

    	if ($benneVan){
    		$_SESSION['helper']->removeBasketItem($benneVan ? $termekSzamlalo : null);
    	}
    	
    }
    
    
    public function updateCartItem($ujTermek){
    	// TODO: debug Helper->checkCartContainsItem
    	// $benneVan = $_SESSION['helper']->checkCartContainsItem($ujTermek['id']);
	    $kosarTartalom = $_SESSION['helper']->getBasketContents();
    	$termekSzamlalo = 0;
    	$benneVan = false;
    	
    	foreach ($kosarTartalom AS $termekAdat){
    		
    		if ($termekAdat['id'] == $ujTermek['id']){
    			$benneVan = true;
    			 
    			break;
    		}
    	
    		$termekSzamlalo += 1;
    	}
    	
    	$termekAdat = $this->getTermekData($ujTermek['id']);
    	$termekAdat['egyseg'] = $ujTermek['egyseg']; 

    	
    	$_SESSION['helper']->updateBasketItem($termekAdat, $benneVan ? $termekSzamlalo : null);
    	
    }
    
    
    public function drawProductPage($termekID){
    	$elements = array(
    		'termek'	=> $this->getTermekData($termekID, true) 
    	);
    	 
    	$this->view->drawProductPage($elements);
    }
    
    
    public function addToCart(){
    	$termekAdat = array( 
    		'id'	=> $_POST['id'],
    		'egyseg'=> $_POST['egyseg']	
    	);
    	
    	$this->updateCartItem($termekAdat);
    }
    
    
    public function getSliderData($allapot){
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, ".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, ".$_SESSION['helper']->getLangLabel('tag')." AS labelTag, ar, kep, sorrend, visible FROM koleves_delicates_slider WHERE visible <> ? ORDER BY sorrend ASC;";
    	
    	return $this->fetchItems($SQL, array($allapot));
    }
    
    public function getKategoriaData($melyseg = "full", $zeroCategoryExcluded = true){
    	$SQL = "SELECT id, icon, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader FROM koleves_delicates_fokategoriak ORDER BY sorrend ASC;";
    	$elements = $this->fetchItems($SQL);
    
    	if ($melyseg == "full"){
    		$alSQL = "SELECT id, fokategoria_id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, sorrend FROM koleves_delicates_alkategoriak WHERE fokategoria_id = ? ".($zeroCategoryExcluded ? 'AND sorrend > 0' : '')." ORDER BY sorrend ASC;";
    
    		$kategoriaSzamlalo = 0;
    		foreach ($elements AS $kategoriaData){
    			$elements[$kategoriaSzamlalo]['alkategoriak'] = $this->fetchItems($alSQL, array($kategoriaData['id']));
    			$kategoriaSzamlalo++;
    		}
    	}
    	 
    	return $elements;
    }
    
    
    
    public function getKeresettTermekek($keresesiSzoveg = null){
    	$whereStatement = "";
    	$kifejezesParams = array();
    	if (!is_null($keresesiSzoveg)){
    		$kifejezesArray = explode(" ", $keresesiSzoveg);
    		$whereStatement = "WHERE allapot = 1";
    		
    		$checkedTexts = "CONCAT(".$_SESSION['helper']->getLangLabel('text').", ".$_SESSION['helper']->getLangLabel('leiras').")";
    		
    		foreach ($kifejezesArray AS $kifejezes){
    			$whereStatement .= " AND ".$checkedTexts." LIKE ?";
    			array_push($kifejezesParams, '%'. $kifejezes .'%');
    		}
    	}
    	
    	
    	
    	$SQL = "SELECT id,
    			".$_SESSION['helper']->getLangLabel('text')." AS labelHeader,
    			".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc,
    			".$_SESSION['helper']->getLangLabel('tag')." AS labelTag,
    			kiskep, nagykep, ar, sorrend
    				FROM koleves_delicates_termekek
    				".$whereStatement."
    				ORDER BY sorrend ASC;";
    	$elements = $this->fetchItems($SQL, $kifejezesParams);
    	
    	
    	return $elements;
    }
    
    
    public function getKategoriaTermekek($kategoriaID = 1){
    	$SQL = "SELECT id, 
    			".$_SESSION['helper']->getLangLabel('text')." AS labelHeader, 
    			".$_SESSION['helper']->getLangLabel('leiras')." AS labelDesc, 
    			".$_SESSION['helper']->getLangLabel('tag')." AS labelTag, 
    			kiskep, nagykep, ar, sorrend 
    				FROM koleves_delicates_termekek 
    				WHERE alkategoria_id = ? 
    				ORDER BY sorrend ASC;";
    	$elements = $this->fetchItems($SQL, array($kategoriaID));
    
    	/*if ($melyseg == "full"){
    		$alSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS labelHeader FROM koleves_delicates_alkategoriak WHERE fokategoria_id = ? ORDER BY sorrend ASC;";
    
    		$kategoriaSzamlalo = 0;
    		foreach ($elements AS $kategoriaData){
    			$elements[$kategoriaSzamlalo]['alkategoriak'] = $this->fetchItems($alSQL, array($kategoriaData['id']));
    			$kategoriaSzamlalo++;
    		}
    	}*/
    
    	return $elements;
    }
    
    
    public function drawBoltKeresettTermekek($keresesiSzoveg){
    	$elements = array(
    		'termekek'	=> $this->getKeresettTermekek($keresesiSzoveg)
    	);
    	 
    	$this->view->drawBoltKategoriaTermekek($elements);
    }
    
    public function drawBoltKategoriaTermekek($alkategoriaID){
    	$elements = array(
    		'termekek'	=> $this->getKategoriaTermekek($alkategoriaID)		
    	);
    	
    	$this->view->drawBoltKategoriaTermekek($elements);
    }
    
    
    public function getMegrendelesData($megrendelesAllapot = 'aktualis'){
    	$allapot = 1;
    	if ($megrendelesAllapot == 'archiv'){
    		$allapot = 0;
    	}
    	
    	$SQL = "
    	SELECT m.id, m.nev, m.email, m.megjegyzes, SUM(egysegar*egyseg) AS osszertek 
    		FROM koleves_delicates_megrendelesek AS m
			LEFT JOIN koleves_delicates_megrendelt_termekek AS mt ON mt.megrendeles_id = m.id
    		WHERE visible = ?
			GROUP BY mt.megrendeles_id;";
    	
    	$elements = $this->fetchItems($SQL, array($allapot));
    	$melyseg = "full";
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
    		'kategoriak'	=> $this->getKategoriaData('full', false),
    		'elerhetoKepek' => $this->loadKepek(9)
    	);
    	
    	$kategoriaSzamlalo = 0;
    	foreach ($elements['kategoriak'] AS $kategoriaAdat){
    		$alkategoriaSzamlalo = 0;
    		foreach ($kategoriaAdat['alkategoriak'] AS $alkategoriaAdat){
    				
    			$elements['kategoriak'][$kategoriaSzamlalo]['alkategoriak'][$alkategoriaSzamlalo]['termekek'] = $this->getKategoriaTermekek($alkategoriaAdat['id']);
    			$alkategoriaSzamlalo += 1;
    		}
    		
    		$kategoriaSzamlalo += 1;
    	}
    	
    	$this->view->drawTermekAdmin($elements);
    }
    
    
    public function drawMegrendelesAdmin($megrendelesAllapot = 'aktualis'){
    	
    	
    	$elements = array(
    		'megrendelesek'	=> $this->getMegrendelesData($megrendelesAllapot),
    		'allapot'		=> ($megrendelesAllapot == 'aktualis' ? 'Aktuális' : 'Archivált') 
    	);
    	//print_r($elements);
    	$this->view->drawMegrendelesAdmin($elements);
    
    }
    
    
    
    public function getKategoriaStruktura($melyseg = "full"){
    	return $this->getKategoriaData($melyseg);
    }
    
    
    
    public function deleteSlideElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_delicates_slider WHERE id = ?;";
    
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