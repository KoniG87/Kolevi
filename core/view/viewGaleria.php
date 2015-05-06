<?php

class GaleriaView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
    
    public function drawGaleria($elements){
        echo '<section id="kepek">';
                    
        $this->drawSectionLabel("Képek", "kepek", 7);
        
        echo '
			<div class="row">
			   <div class="twelve columns centered gallery-filters clearfix">
					<div class="left filter filter-on" data-filter="0">
						<div class="tag-before"></div><div class="tag-label">Összes</div><div class="tag-after"></div>
					</div>
					<div class="left filter" data-filter="1">
						<div class="tag-before"></div><div class="tag-label">Vendéglő</div><div class="tag-after"></div>
					</div>
					<div class="left filter" data-filter="2">
						<div class="tag-before"></div><div class="tag-label">Kert</div><div class="tag-after"></div>
					</div>
					<div class="left filter" data-filter="3">
						<div class="tag-before"></div><div class="tag-label">Delicates</div><div class="tag-after"></div>
					</div>
					<div class="left filter" data-filter="4">
						<div class="tag-before"></div><div class="tag-label">Apartman</div><div class="tag-after"></div>
					</div>


				</div>
				<div class="twelve columns centered gallery-container">';
    	
    	$this->loadTemplate('galeriaKep', $elements);

    	echo ' </div>

				<div class="overlay">
					<div class="row gallery-slider">
				';
		foreach ($elements AS $kepAdat){
			echo '<div class="gallery-slider-element"><img src="'.$kepAdat['PATH'].'" alt="" ></div>
			';
		}
				
			
		  echo '
					</div>
						


				</div>
			</div>
		</section>';
    }
    
}
?>