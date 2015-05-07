<?php
class Menu extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Menu';
        
		parent::__construct($dbHandler);
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
    	 
    	$napiMenuSQL = "SELECT napazon, fogasazon, text_hu AS labeltext, tagek FROM koleves_napimenuk AS n
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
    	
    	
    	$napiMenuSQL = "SELECT n.id, n.fogasazon, n.text_hu AS labeltext, n.tagek AS tag FROM koleves_napimenuk AS n
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
    
    
    public function drawEtlapAdmin(){
    	$elements = array(
    		'kategoriak'	=> $this->getEtlapData(),
    		'cetli'	=> $this->getCetliData()
    	);
    	
    	 
    	$this->view->drawEtlapAdmin($elements);
    }

    public function drawItallapAdmin(){
    	$elements = array(
    			'kategoriak'	=> $this->getItallapData()
    	);
    	 
    
    	$this->view->drawItallapAdmin($elements);
    }
    
    
    public function getCetliData(){
    	$cetliSQL = "SELECT id, text_hu AS labelText FROM koleves_statikus WHERE label LIKE 'CETLI%' ORDER BY label ASC;";
    	
    	return $this->fetchItems($cetliSQL);
    }
    
    public function getEtlapData(){
    	$etlapArray = array();
    	
    	$etelKategoriaSQL = "SELECT id, text_hu as labelText, ikon FROM koleves_etelkategoriak ORDER BY id ASC;";
    	 
    	$etelSQL = "SELECT id, text_hu AS MEGNEVEZES, TAGEK, AR
    			FROM koleves_etelek
    				WHERE visible = 1 AND kategoria_id = ?
    			ORDER BY kategoria_id ASC, text_hu ASC;";
    	
    	$kategoriaRES = $this->fetchItems($etelKategoriaSQL);
    	
    	foreach ($kategoriaRES AS $kategoriaAdat){
    		$etlapArray[$kategoriaAdat['labelText']] = array(
    				'ikon'	=> $kategoriaAdat['ikon'],
    				'etelek'=> array()
    		);
    	
    		$etelRES = $this->fetchItems($etelSQL, array($kategoriaAdat['id']));
    		foreach ($etelRES AS $etelAdat){
    			array_push($etlapArray[$kategoriaAdat['labelText']]['etelek'], $etelAdat);
    		}
    	
    	}
    	
    	return $etlapArray;
    }
    
    public function getItallapData(){
    	$kategoriaSQL = "SELECT id, text_hu, ikon FROM koleves_italkategoriak ORDER BY sorrend ASC;";
    	$kategoriaRES = $this->fetchItems($kategoriaSQL);
    	 
    	$italSQL = "SELECT id, text_hu AS MEGNEVEZES, AR FROM koleves_italok WHERE kategoria_id = ? AND visible = 1 ORDER BY sorrend ASC;";
    	 
    	$kategoriak = array();
    	foreach ($kategoriaRES AS $key => $kategoriaData){
    		$italRES = $this->fetchItems($italSQL, array($kategoriaData['id']));
    	
    		$kategoriak[$kategoriaData['text_hu']] = array(
    				'ikon'	=> $kategoriaData['ikon'],
    				'italok'=> array()
    		);
    		foreach ($italRES AS $key => $italData){
    			array_push($kategoriak[$kategoriaData['text_hu']]['italok'], $italData);
    		}
    		
    	}
    	
    	return $kategoriak;
    }
    
    public function drawEtlap(){
    	
    	$elements = array(
    		'cetli'	=> $this->getCetliData(),
    		'kategoriak' => $this->getEtlapData()
    	);
    	
    	
    	
    	$this->view->drawEtlap($elements);
    }

    
    public function drawKertEtlap(){
    	 $elements = array(
    		'kategoriak' => $this->getEtlapData()
    	);
    	 
    		 
    	$this->view->drawKertEtlap($elements);
    }
    
    
    
    public function updateEtlapElem(){
    	$res = array();
    	
    	try{
    		$this->beginTransaction();
    		
    		$kategoriaSQL = "SELECT ek.id, count(e.sorrend) AS utolsoSorszam FROM koleves_etelkategoriak AS ek
				LEFT JOIN koleves_etelek AS e ON e.kategoria_id = ek.id
				WHERE ek.text_hu LIKE ?;";
    		
    		$kategoriaParams = array(
    			$_POST['kategoria']
    		);
    		$kategoriaAdat = $this->fetchItem($kategoriaSQL, $kategoriaParams);
    		
    		/*
    		 * Új sor beszúrása
    		 */
    		if ($_POST['id'] == "0"){
    			
    			$SQL = "INSERT INTO koleves_etelek SET kategoria_id = ?, text_hu = ?, tagek = ?, ar = ?, sorrend = ?;";
    			
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text'],
    					$_POST['tagek'],
    					$_POST['ar'],
    					($kategoriaAdat['utolsoSorszam'] + 1)
    			);
    			
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_etelek SET kategoria_id = ?, text_hu = ?, tagek = ?, ar = ? WHERE id = ?;";
    			 
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text'],
    					$_POST['tagek'],
    					$_POST['ar'],
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
				WHERE ek.text_hu LIKE ?;";
    
    		$kategoriaParams = array(
                $_POST['kategoria']
    		);
    		$kategoriaAdat = $this->fetchItem($kategoriaSQL, $kategoriaParams);
    
    		/*
    		 * Új sor beszúrása
    		*/
    		if ($_POST['id'] == "0"){
    			 
    			$SQL = "INSERT INTO koleves_italok SET kategoria_id = ?, text_hu = ?, ar = ?, sorrend = ?;";
    			 
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text_hu'],
    					$_POST['ar'],
    					($kategoriaAdat['utolsoSorszam'] + 1)
    			);
    			 
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_italok SET kategoria_id = ?, text_hu = ?, ar = ? WHERE id = ?;";
    
    			$queryParams = array(
    					$kategoriaAdat['id'],
    					$_POST['text_hu'],
    					$_POST['ar'],
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
    
    
    public function updateCetli(){
    	$res = array();
    	 
    	try{
    		$this->beginTransaction();
    	
    		$cetliSQL = "UPDATE koleves_statikus SET text_hu = ? WHERE id = ?;";
    	
    		$cetliParams = array(
    				$_POST['text'],
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
				
	    		
	    		$SQL = "INSERT INTO koleves_napimenuk SET idoszak_id = ?, napazon = ?, fogasazon = ?, text_hu = ?, tagek = ?;";
	
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
	    		$SQL = "UPDATE koleves_napimenuk SET text_hu = ?, tagek = ? WHERE id = ?;";
	    		
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
    
    
    public function drawItallap(){
    	$elements = $this->getItallapData();
    	    	
    	$this->view->drawItallap($elements);
    }
    
    public function generateEtlapPDF(){
    	$kategoriak = $this->getEtlapData();
    			
		
    	require_once('assets/libs/tcpdf/tcpdf.php');
    	require_once('assets/libs/tcpdf/kolevespdf.php');
    	$pdf = new kolevesPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    	
    	$pdf->SetAuthor('Kőleves');
    	$pdf->SetTitle('Kőleves Menü');
    	$pdf->setPrintHeader(false);
    	$pdf->setPrintFooter(false);
    	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    	$pdf->setTopMargin(15);
    	
    	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    	$pdf->SetFont('freesans', '', 8);
    	
    	$pdf->AddPage();
    	
    	$bMargin = $pdf->getBreakMargin();
    	$auto_page_break = $pdf->getAutoPageBreak();
    	$pdf->SetAutoPageBreak(false, 0);
    	
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
			<br/><br/><img src="assets/img/etlap-logo.png"/><br/><span style="font-size:22px;font-weight:bold;">ÉTLAP</span><br/>
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
    	
    	$pdf->Output('KolevesMenu.pdf', 'D');
    }
}
?>