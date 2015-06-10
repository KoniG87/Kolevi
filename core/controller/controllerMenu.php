<?php
class Menu extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Menu';
        
		parent::__construct($dbHandler);
	}
	
	
	
	public function drawEtlap(){
		$elements = array(
			'cetli'	=> $this->getCetliData(),
			'kategoriak' => $this->getEtlapData()
		);
	
		$this->view->drawEtlap($elements);
	}
	
	
	public function drawEtlapAdmin($helyiseg = 'vendeglo'){
		$elements = array(
			'helyiseg'	=> $helyiseg,
			'kategoriak'=> $this->getEtlapData(true),
			'cetli'		=> $this->getCetliData()
		);
		 
	
		$this->view->drawEtlapAdmin($elements);
	}
	
	
	public function drawItallap($helyiseg = 'vendeglo'){
		$elements = $this->getItallapData($helyiseg);
	
		$this->view->drawItallap($elements, $helyiseg);
	}
	
	
	public function drawItallapAdmin($helyiseg = 'vendeglo'){
		$elements = array(
			'helyiseg'	=> $helyiseg,
			'kategoriak'	=> $this->getItallapData($helyiseg)
		);
	
	
		$this->view->drawItallapAdmin($elements);
	}
	
	
    
    public function drawNapiMenu(){
    	$dayNames = array(
    			'hu' => array(
    					'hétfő',
    					'kedd',
    					'szerda',
    					'csütörtök',
    					'péntek',
    					'szombat',
    					'vasárnap'
    			),
    			'en' => array(
    					'Monday',
    					'Tuesday',
    					'Wednesday',
    					'Thursday',
    					'Friday',
    					'Saturday',
    					'Sunday'
    			)
    	);
    	
    	$etelIndex = array( 
    		1 => 'ELSO',
    		2 => 'MASODIK',
    		3 => 'HARMADIK'
    	);
    	 
    	$year = date('Y');
    	$week = date('W');
    	$nthInWeek = date('w');
    	 
    	$napiMenuSQL = "SELECT napazon, fogasazon, ".$_SESSION['helper']->getLangLabel('text')." AS labeltext, tagek FROM koleves_napimenuk AS n
    	LEFT JOIN koleves_napimenu_idoszakok AS i ON i.id = n.idoszak_id
    	WHERE i.ev = ? AND het = ?
		ORDER BY napazon ASC, fogasazon ASC;"; 
    	$napiMenuRES = $this->fetchItems($napiMenuSQL, array($year, $week));
    	
    	$timestamp = mktime( 0, 0, 0, 1, 1,  $year ) + ( ($week-1) * 7 * 24 * 60 * 60 );
    	
    	$timestamp_for_monday = $timestamp - 86400 * ( date( 'N', $timestamp ) - 1 );
    	$dayIndicator = new DateTime( date('Y-m-d', $timestamp_for_monday ));	
			
    	$elements = array();
    	$napAzon = 0;
    	if (sizeof($napiMenuRES) > 0){
    	foreach ($napiMenuRES AS $napiMenuAdat){
    		if ($napAzon != $napiMenuAdat['napazon']){
    			if ($napAzon != 0){
    				array_push($elements, $tmpArray);
    			}
    			
    			$tmpArray = array('NAP'	=> ucfirst($dayNames['hu'][($napiMenuAdat['napazon'] - 1)]));
				$tmpArray['DATUM']	= $dayIndicator->format('m/d');
				$dayIndicator->modify('+1 day');
    		}
    		$napAzon = $napiMenuAdat['napazon'];
    		$tmpArray[$etelIndex[$napiMenuAdat['fogasazon']]] = $napiMenuAdat['labeltext'];
    		$tmpArray[$etelIndex[$napiMenuAdat['fogasazon']]."_TAG"] = $napiMenuAdat['tagek'];
    	}
    	array_push($elements, $tmpArray);
    	}
        
        $this->view->drawNapiMenu($elements);
    }
    
    
    
    public function drawNapiAdmin($date = null){
    	$dayNames = array(
    			'hu' => array(
    					'hétfő',
    					'kedd',
    					'szerda',
    					'csütörtök',
    					'péntek',
    					'szombat',
    					'vasárnap'
    			),
    			'en' => array(
    					'Monday',
    					'Tuesday',
    					'Wednesday',
    					'Thursday',
    					'Friday',
    					'Saturday',
    					'Sunday'
    			)
    	);
    	 
    	$etelIndex = array(
    			1 => 'ELSO',
    			2 => 'MASODIK',
    			3 => 'HARMADIK'
    	);
    	
    	if (is_null($date)){
    		$date = date('Y-m-d');
    	}
    	
    	
    	$year = $date->format('Y');
    	$week = $date->format('W');
    	
    	
    	$napiMenuSQL = "SELECT n.id, n.fogasazon, n.".$_SESSION['helper']->getLangLabel('text')." AS labeltext, n.tagek AS tag FROM koleves_napimenuk AS n
    	LEFT JOIN koleves_napimenu_idoszakok AS i ON i.id = n.idoszak_id
    	WHERE i.ev = ? AND i.het = ? AND n.napazon = ?
		ORDER BY napazon ASC, fogasazon ASC;";

    	$elements = array();	
   		for ($i = 1; $i <= 5; $i++){
   			$tmpArray = array(
   				'NAPSZAM'	=> $date->format('d'),
   				'NAPNEV'	=> $dayNames['hu'][($i - 1)],
   				'NAPAZON'	=> $i,
   				'EV'	=> $year,
   				'HET'	=> $week
   			);
   			
   			$napiMenuRES = $this->fetchItems($napiMenuSQL, array($year, $week, $i));
   			
			$fogasAzon = 0;
   			for ($fogasSzam = 1; $fogasSzam <= 3; $fogasSzam++){
   				$napiAdat = array(
   					'id'		=> '0',
   					'labeltext'	=> '',
					'tag'		=> ''
   				);
   				
				
				if (isset($napiMenuRES[$fogasAzon]) && $napiMenuRES[$fogasAzon]['fogasazon'] == $fogasSzam){
					
   					$napiAdat['id']			= $napiMenuRES[$fogasAzon]['id'];
   					$napiAdat['labeltext']	= $napiMenuRES[$fogasAzon]['labeltext'];
   					$napiAdat['tag']		= $napiMenuRES[$fogasAzon]['tag'];	
					
					$fogasAzon += 1;
   				}
   				
   				$tmpArray[$etelIndex[$fogasSzam]] = array(
   						'ID'	=> $napiAdat['id'],
   						'ETEL'	=> $napiAdat['labeltext'],
						'TAG'	=> $napiAdat['tag']
   						
   				);
   			}
   			
   			
   			array_push($elements, $tmpArray);
   		            
    		$date->modify('+1 day');
    	}
    	 
    	
    	$this->view->drawNapiAdmin($elements);
    }
    
    
   

    
    
    
    public function drawKertEtlap(){
    	$elements = array(
    			'kategoriak' => $this->getEtlapData()
    	);
    
    	 
    	$this->view->drawKertEtlap($elements);
    }
    
    
    
    
    
    
    
    
    public function getCetliData(){
    	$cetliSQL = "SELECT id, SUBSTRING(LABEL, 6, 1) AS cetliSzam, ".$_SESSION['helper']->getLangLabel('text')." AS labelText FROM koleves_statikus WHERE label LIKE 'CETLI%' ORDER BY label ASC;";
    	
    	return $this->fetchItems($cetliSQL);
    }
    
    public function getEtlapData($forAdminView = false){
    	$etlapArray = array();
    	
    	$etelKategoriaSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." as labelText, ikon 
    			FROM koleves_etelkategoriak 
    			ORDER BY sorrend ASC;";
    	 
    	$etelSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, TAGEK, AR, SORREND
    			FROM koleves_etelek
    				WHERE visible = 1 AND kategoria_id = ? AND etterem_id = 1
    			ORDER BY sorrend ASC, ".$_SESSION['helper']->getLangLabel('text')." ASC;";
    	
    	$kategoriaRES = $this->fetchItems($etelKategoriaSQL);
    	
    	foreach ($kategoriaRES AS $kategoriaAdat){
    		$etlapArray[$kategoriaAdat['labelText']] = array(
    				'ikon'	=> $kategoriaAdat['ikon'],
    				'etelek'=> array()
    		);
    	
    		$etelRES = $this->fetchItems($etelSQL, array($kategoriaAdat['id']));
    		foreach ($etelRES AS $etelAdat){
    			$etelAdat['AR'] = number_format($etelAdat['AR'], 0, '.', ' ');
    			if (!$forAdminView){
    				$etelAdat['TAGEK'] = $this->fetchAllergenSpan($etelAdat['TAGEK']);
    			}
    			array_push($etlapArray[$kategoriaAdat['labelText']]['etelek'], $etelAdat);
    		}
    	
    	}
    	
    	return $etlapArray;
    }
    
    
    
    public function getItallapData($helyiseg){
    	$etteremID = 0;
    	switch ($helyiseg){
    		case 'vendeglo': $etteremID = 1; break;
    		case 'kert': $etteremID = 2; break;
    	}
    	
    	$kategoriaSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text').", ikon 
    			FROM koleves_italkategoriak 
    			ORDER BY sorrend ASC;";
    	$kategoriaRES = $this->fetchItems($kategoriaSQL);
    	 
    	$italSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, AR, SORREND 
    			FROM koleves_italok 
    			WHERE kategoria_id = ? AND visible = 1 AND etterem_id = ? 
    			ORDER BY sorrend ASC;";
    	 
    	$kategoriak = array();
    	foreach ($kategoriaRES AS $key => $kategoriaData){
    		$italRES = $this->fetchItems($italSQL, array($kategoriaData['id'], $etteremID));
    	
    		$kategoriak[$kategoriaData[$_SESSION['helper']->getLangLabel('text')]] = array(
    				'ikon'	=> $kategoriaData['ikon'],
    				'italok'=> array()
    		);
    		foreach ($italRES AS $key => $italData){
    			array_push($kategoriak[$kategoriaData[$_SESSION['helper']->getLangLabel('text')]]['italok'], $italData);
    		}
    		
    	}
    	
    	return $kategoriak;
    }
    
    

    public function deleteEtlapElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_etelek WHERE id = ?;";
    
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
    
    
    public function deleteItallapElem(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$SQL = "DELETE FROM koleves_italok WHERE id = ?;";
    
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
    

    public function updateCetli(){
    	$res = array();
    
    	try{
    		$this->beginTransaction();
    		 
    		$cetliSQL = "UPDATE koleves_statikus SET ".$_SESSION['helper']->getLangLabel('text')." = ? WHERE id = ?;";
    		 
    		$cetliParams = array(
    			$_POST['text'] == '' ? NULL : $_POST['text'],
    			$_POST['id']
    		);
    		$this->updateItem($cetliSQL, $cetliParams);
    
    		$res['status'] = true;
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = false;
    		$this->rollback();
    	}
    
    	echo json_encode($res);
    	 
    }
    
    
    
    public function updateEtlapElem(){
    	$res = array();
    	
    	try{
    		$this->beginTransaction();
    		
    		$kategoriaSQL = "SELECT ek.id, count(e.sorrend) AS utolsoSorszam FROM koleves_etelkategoriak AS ek
				LEFT JOIN koleves_etelek AS e ON e.kategoria_id = ek.id
				WHERE ek.".$_SESSION['helper']->getLangLabel('text')." LIKE ?;";
    		
    		$kategoriaParams = array(
    			$_POST['kategoria']
    		);
    		$kategoriaAdat = $this->fetchItem($kategoriaSQL, $kategoriaParams);
    		
    		/*
    		 * Új sor beszúrása
    		 */
    		if ($_POST['id'] == "0"){
    			
    			$SQL = "INSERT INTO koleves_etelek SET kategoria_id = ?, ".$_SESSION['helper']->getLangLabel('text')." = ?, tagek = ?, ar = ?, etterem_id = ?, sorrend = ?;";
    			
    			$queryParams = array(
    				$kategoriaAdat['id'],
    				$_POST['text'],
    				$_POST['tagek'],
    				$_POST['ar'],
    				$_POST['etterem'],
    				$_POST['sorrend']
    			);
    			
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_etelek SET kategoria_id = ?, ".$_SESSION['helper']->getLangLabel('text')." = ?, tagek = ?, ar = ?, etterem_id = ?, sorrend = ? WHERE id = ?;";
    			 
    			$queryParams = array(
    				$kategoriaAdat['id'],
    				$_POST['text'],
    				$_POST['tagek'],
    				$_POST['ar'],
    				$_POST['etterem'],
    				$_POST['sorrend'],
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
    
    
    
    
    
    
    public function updateItallapElem(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    
    		$kategoriaSQL = "SELECT ek.id, count(e.sorrend) AS utolsoSorszam FROM koleves_italkategoriak AS ek
				LEFT JOIN koleves_italok AS e ON e.kategoria_id = ek.id
				WHERE ek.".$_SESSION['helper']->getLangLabel('text')." LIKE ?;";
    
    		$kategoriaParams = array(
                $_POST['kategoria']
    		);
    		$kategoriaAdat = $this->fetchItem($kategoriaSQL, $kategoriaParams);
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_italok SET kategoria_id = ?, ".$_SESSION['helper']->getLangLabel('text')." = ?, ar = ?, etterem_id = ?, sorrend = ?;";
    			 
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text'],
    					$_POST['ar'],
    					$_POST['etterem'],
    					$_POST['sorrend']
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_italok SET kategoria_id = ?, ".$_SESSION['helper']->getLangLabel('text')." = ?, ar = ?, etterem_id = ?, sorrend = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text'],
    					$_POST['ar'],
    					$_POST['etterem'],
    					$_POST['sorrend'],
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
    
    
    
    
    public function updateNapiMenu(){
    	$res = array();
    	try{
    		$this->beginTransaction();
	    	/*
	    	 * Új sor beszúrása 
	    	 */
	    	if ($_POST['id'] == "0"){
				$idoszakSQL = "SELECT id FROM koleves_napimenu_idoszakok WHERE ev = ? AND het = ?;";
				$idoszakParams = array(
					$_POST['ev'],
					$_POST['het']	
				);
				$idoszakAdat = $this->fetchItem($idoszakSQL, $idoszakParams);
				
				
				if (empty($idoszakAdat)){
					$insertIdoszakSQL = "INSERT INTO koleves_napimenu_idoszakok SET ev = ?, het = ?;";
					$idoszakAdat = array(
						'id' => $this->insertItem($insertIdoszakSQL, $idoszakParams)	
					);
				}
				
	    		
	    		$SQL = "INSERT INTO koleves_napimenuk SET idoszak_id = ?, napazon = ?, fogasazon = ?, ".$_SESSION['helper']->getLangLabel('text')." = ?, tagek = ?;";
	
	    		$queryParams = array(
	    			$idoszakAdat['id'],
	    			$_POST['napazon'],
	    			$_POST['fogasazon'],
	    			$_POST['menuInput'],
					$_POST['menuTag']
	    		);
	
	    		$res['inputID'] = $this->insertItem($SQL, $queryParams);
	    		
	    	}
	    	/*
	    	 * Meglévő sor updatelése
	    	 */
	    	else{
	    		$SQL = "UPDATE koleves_napimenuk SET ".$_SESSION['helper']->getLangLabel('text')." = ?, tagek = ? WHERE id = ?;";
	    		
	    		$queryParams = array(
	    			$_POST['menuInput'],
					$_POST['menuTag'],
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
    
    
    
    
    public function generateEtlapPDF(){
    	$kategoriak = $this->getEtlapData();
    			
		
    	require_once('assets/libs/tcpdf/tcpdf.php');
    	require_once('assets/libs/tcpdf/kolevespdf.php');
    	$pdf = new kolevesPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    	
    	$pdf->SetAuthor('Kőleves');
    	$pdf->SetTitle('Kőleves Menü');
    	$pdf->setPrintHeader(false);
    	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    	//$pdf->setPrintFooter(true);
    	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    	$pdf->setTopMargin(15);
    	
    	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    	$pdf->SetFont('freesans', '', 8);
    	
    	
    	
    	$bMargin = $pdf->getBreakMargin();
    	$auto_page_break = $pdf->getAutoPageBreak();
    	$pdf->SetAutoPageBreak(false, 0);
    	
    	$pdf->AddPage();
    	
    	// Background pattern
    	$img_file = 'assets/img/pdfBackground.jpg';
    	$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    	
    	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
    	$pdf->setPageMark();
    	
    	
    	$html = '
<table>
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td style="text-align:center;">
			<br/><br/>
    		<img src="assets/img/koleves_logo_vendeglo.png" style="width:100px;height:100px;"/>
    			<br/>
    		<span style="font-size:22px;font-weight:bold;">'.($_SESSION['helper']->getLang() == 'hu' ? 'ÉTLAP' : 'MENU').'</span>
    		<br/>
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
	
</table>
    	
<div style="text-align:center;">';
    	
	    foreach ($kategoriak AS $kategoria => $kategoriaAdat){
	    	$html .= '<span style="font-size:12px;font-weight:bold;">&bull; '.$kategoria.' &bull;</span><p>'; 	
	    
	    	foreach ($kategoriaAdat['etelek'] AS $etelAdat){
	    		$html .= $etelAdat['MEGNEVEZES'].' '. (!is_null($etelAdat['TAGEK']) && trim($etelAdat['TAGEK']) != "" ? '&bull; '.$etelAdat['TAGEK'] : '').' - <strong>'.$etelAdat['AR'].' Ft</strong><br/>';	
	    	}
	    	
	    	$html .= '</p>';
	    
	    }
    	
		$html .= '<span style="font-size:12px;font-weight:bold;">&bull; KÉRÉSRE GYEREKEKNEK IS KÉSZÍTÜNK ÉTELT &bull;</span><p>
			GM = gluténmentes &nbsp; TM = tejtermék mentes &nbsp; V = vegetáriánus<br/>
			</p>
		';
		$html .= '</div>';

    	
   		$pdf->writeHTML($html, true, false, true, false, '');
    	
    	$pdf->Output('Koleves-Menu.pdf', 'D');
    }
    
    
    
    public function generateVendegloItallapPDF(){
    	$kategoriak = $this->getItallapData('vendeglo');
    	 
    
    	require_once('assets/libs/tcpdf/tcpdf.php');
    	require_once('assets/libs/tcpdf/kolevespdf.php');
    	$pdf = new kolevesPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    	 
    	$pdf->SetAuthor('Kőleves');
    	$pdf->SetTitle('Kőleves Itallap');
    	$pdf->setPrintHeader(false);
    	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    	//$pdf->setPrintFooter(true);
    	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    	$pdf->setTopMargin(15);
    	 
    	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    	$pdf->SetFont('freesans', '', 8);
    	 
    	 
    	 
    	$bMargin = $pdf->getBreakMargin();
    	$auto_page_break = $pdf->getAutoPageBreak();
    	$pdf->SetAutoPageBreak(false, 0);
    	 
    	$pdf->AddPage();
    	 
    	// Background pattern
    	$img_file = 'assets/img/pdfBackground.jpg';
    	$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    	 
    	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
    	$pdf->setPageMark();
    	 
    	 
    	$html = '
<table>
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td style="text-align:center;">
			<br/><br/>
    		<img src="assets/img/koleves_logo_vendeglo.png" style="width:100px;height:100px;"/>
    			<br/>
    		<span style="font-size:22px;font-weight:bold;">'.($_SESSION['helper']->getLang() == 'hu' ? 'ITALLAP' : 'DRINKS').'</span>
    		<br/>
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
    
</table>
   
<div style="text-align:center;">';
    	 
    	foreach ($kategoriak AS $kategoria => $kategoriaAdat){
    		$html .= '<span style="font-size:12px;font-weight:bold;">&bull; '.$kategoria.' &bull;</span><p>';
    	  
    		foreach ($kategoriaAdat['italok'] AS $etelAdat){
    			$html .= $etelAdat['MEGNEVEZES'].' <strong>'.$etelAdat['AR'].' Ft</strong><br/>';
    		}
    
    		$html .= '</p>';
    	  
    	}
    	 
    	
    	$html .= '</div>';
    
    	 
    	$pdf->writeHTML($html, true, false, true, false, '');
    	 
    	$pdf->Output('Koleves-Drinks.pdf', 'D');
    }
    
    
}
?>