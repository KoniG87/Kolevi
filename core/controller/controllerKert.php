<?php

class Kert extends BaseObject{
    
    function __construct($dbHandler){
        $this->objectType = 'Kert';
        
        parent::__construct($dbHandler);
    }
    
    
    
    public function drawEtlapAdmin($helyiseg = "kert"){
    	$elements = array(
    		'helyiseg'	=> $helyiseg,
    		'kategoriak'=> $this->getEtlapData()
    	);
    
    
    	$this->view->drawEtlapAdmin($elements);
    }
    
    
    public function drawFoglalasForm(){
        $this->view->drawFoglalasForm();
    }
    
    
    public function drawKertEtlap(){
    	$elements = array(
    		'kategoriak' => $this->getEtlapData()
    	);
    
    
    	$this->view->drawKertEtlap($elements);
    }  
    
    
    public function drawRendezveny(){
    	$szervezoSQL = "SELECT NEV, KEP, TELEFON, EMAIL, FACEBOOK FROM koleves_dolgozok WHERE rendezvenyfelelos = 1;";
    	
    	$elements = array(
    		'szervezo'	=> $this->fetchItem($szervezoSQL),
    		'rendezvenyek' => $this->getRendezvenyData()
    	);
    	$elements['szervezo']['FEJLEC_IMAGE'] = 'assets/img/kert-rendezvenyek.png';   	
    	
    	$this->view->drawRendezveny($elements);

    }
    
    
    
    public function drawRolunk(){
    	$SQL = "SELECT username AS NICK, nev AS FULLNAME, megjegyzes AS DESCRIPTION, kep AS KEP FROM koleves_dolgozok WHERE vendeglo = 1 AND allapot = 1;";
    	$elements = $this->fetchItems($SQL);
    
    	$this->view->drawRolunk($elements);
    
    }
    
    
    
    
    
    
    
    
    
    public function getEtlapData(){
    	$etlapArray = array();
    	 
    	$etelKategoriaSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." as labelText, ikon 
    			FROM koleves_etelkategoriak 
    			ORDER BY sorrend ASC;";
    
    	$etelSQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, TAGEK, AR, SORREND
    			FROM koleves_etelek
    				WHERE visible = 1 AND kategoria_id = ? AND etterem_id = 2
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
    			array_push($etlapArray[$kategoriaAdat['labelText']]['etelek'], $etelAdat);
    		}
    		 
    	}
    	 
    	return $etlapArray;
    }
    
    
    public function getEtlapPDFData(){
    	$etlapArray = array();
    
    	$etelSQL = "SELECT id, text_hu, text_en, TAGEK, AR
    			FROM koleves_etelek
    				WHERE visible = 1 AND etterem_id = 2
    			ORDER BY sorrend ASC;";
    
    	
    	$etelRES = $this->fetchItems($etelSQL);
    	foreach ($etelRES AS $etelAdat){
    		$etelAdat['AR'] = number_format($etelAdat['AR'], 0, '.', ' ');
    		array_push($etlapArray, $etelAdat);
    	}
    		 
    	
    
    	return $etlapArray;
    }
    
   

    
    public function getRendezvenyData($allapot = 0){
    	$SQL = "SELECT id, ".$_SESSION['helper']->getLangLabel('text')." AS MEGNEVEZES, ".$_SESSION['helper']->getLangLabel('leiras')." AS MEGJEGYZES, allapot FROM koleves_rendezvenyek WHERE allapot <> ? ORDER BY sorrend ASC;";
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
    
    
    
    
    public function generateEtlapPDF(){
    	$etelek = $this->getEtlapPDFData();
    	 
    
    	require_once('assets/libs/tcpdf/tcpdf.php');
    	require_once('assets/libs/tcpdf/kolevespdf.php');
    	$pdf = new kolevesKertPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    	 
    	$pdf->SetAuthor('Kőleves');
    	$pdf->SetTitle('Kőleves Kert Menü');
    	$pdf->setPrintHeader(false);
    	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    	//$pdf->setPrintFooter(true);
    	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    	$pdf->setTopMargin(15);
    	 
    	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    	$pdf->SetFont('freesans', '', 10);
    	 
    	 
    	$bMargin = $pdf->getBreakMargin();
    	$auto_page_break = $pdf->getAutoPageBreak();
    	$pdf->SetAutoPageBreak(false, 0);
    	 
    	$pdf->AddPage();
    	 
    	// Background pattern
    	$img_file = 'assets/img/pdfKertBackground.jpg';
    	$pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    	 
    	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
    	$pdf->setPageMark();
    	 
    	 
    	$html = '<br/><br/><br/><br/><br/><br/><br/><br/>
   
<div style="text-align:center;">
    			<table>';
    	 
    	    	  
    	$textCutOffIndex = 30;
    	foreach ($etelek AS $etelAdat){
    		$icons = $this->fetchAllergenIcon($etelAdat['TAGEK']);
    		$englishTextFirst = substr($etelAdat['text_en'], 0, $textCutOffIndex);
    		$englishTextRest = substr($etelAdat['text_en'], $textCutOffIndex);
    		
    		$html .= '<tr>
    				<td style="text-align:right;width:275px;">
    					'.$icons.' '. wordwrap($etelAdat['text_hu'], $textCutOffIndex, "<br/>") .' 
    				</td>
    				
    				<td style="text-align:right;width:12px;">&bull;</td>		
    				
    				<td style="width:60px;text-align:right;">
    					<strong>'.$etelAdat['AR'] .' Ft</strong>
    				</td>
    				
					<td style="text-align:right;width:12px;">&bull;</td>

    				<td style="width:40%;text-align:left;width:290px;"> 
    					'.$englishTextFirst .' '. $icons .'<br/>
    						&nbsp;&nbsp;'.wordwrap($englishTextRest, $textCutOffIndex, "<br/>&nbsp;&nbsp;").'
    				</td>
    			</tr>';
    	}
    
    	
    	 
    	$html .= '
		';
    	$html .= '</table>
    			</div>';
    
    	 
    	$pdf->writeHTML($html, true, false, true, false, '');
    	 
    	$pdf->Output('Koleves-Kert-Menu.pdf', 'D');
    }
    
}
?>
