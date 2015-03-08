<?php

class MenuView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
    
    public function drawNapiMenu($elements){
        $this->loadTemplate('kajaMenu', $elements);   
    }
    
}
?>