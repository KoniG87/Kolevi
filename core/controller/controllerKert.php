<?php

class Kert extends BaseObject{
    
    function __construct($dbHandler){
        $this->objectType = 'Kert';
        
        parent::__construct($dbHandler);
    }
    
    public function drawFoglalasForm(){
        $this->view->drawFoglalasForm();
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
    
    public function drawRolunk(){
        $SQL = "SELECT username AS NICK, nev AS FULLNAME, megjegyzes AS DESCRIPTION, kep AS KEP FROM koleves_dolgozok WHERE vendeglo = 1 AND allapot = 1;";
        $elements = $this->fetchItems($SQL);
        
        $this->view->drawRolunk($elements);
        
    }
    
}
?>
