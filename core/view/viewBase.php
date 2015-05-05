<?php

class BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
	}
    
    public function loadTemplate($template, $elements = null){
        $path = 'core/template/'.$template.'.php';
        $output = '';
        if (file_exists($path)){
            $tpl = file_get_contents($path);
            
            if (!empty($elements)){
            	
                foreach ($elements AS $key => $val){
                    $stateTpl = $tpl;
                    //print_r($val);
                    if (is_array($val)){
                        foreach ($val AS $subKey => $subVal){
                            $stateTpl = str_replace('[['.$subKey.']]', $subVal, $stateTpl);
                        }
                    }else{
                        $stateTpl = str_replace('[['.$key.']]', $val, $stateTpl);
                    }
                    $output .= $stateTpl;
                }
            }else{
            	$output = $tpl;
            }
            
        }
		$output = preg_replace('/(\[\[\w*\]\])/', '', $output);
        
        echo $output;
    }
    
    public function drawSectionLabel($labelText, $forElement, $labelPos){
    	$elements = array(
    	    array(
    			'LABELTEXT'	=> $labelText,
    			'FORELEMENT' => $forElement,
    			'POS'	=>	$labelPos
    	    )		
    	);
    	
    	$templatePath = 'sectionHeader';
    	
    	$this->loadTemplate($templatePath, $elements);
    }
}
?>