<?php

class Menu extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'Menu';
        
		parent::__construct($dbHandler);
	}
    
    public function drawNapiMenu(){
        $elements = array(
            array(
                'NEV'   => 'Palacsinta',
                'LEIRAS'=> 'Kakaós, túrós, lekváros',
                'SULY'  => '390'
            ),
            array(
                'NEV'   => 'Leves',
                'LEIRAS'=> '',
                'SULY'  => '590'
            ),
            array(
                'NEV'   => 'Főétel',
                'LEIRAS'=> 'Rántotthús körettel',
                'SULY'  => '790'
            ),
        );
        
        $this->view->drawNapiMenu($elements);
    }
}
?>