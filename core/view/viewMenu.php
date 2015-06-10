<?php

class MenuView extends BaseView{
	
	function __construct(){
	}
    
    public function drawNapiMenu($elements){
        echo '<section id="napiMenu">';
        
        $this->drawSectionLabel("Napi Menü", "napiMenu", 1);
                    
        echo '
                    <div class="row">
                        <div class="four columns right">
                            <img class="lazy illusztracio" data-src="assets/img/napi-img.png" alt="Napi menü" /><noscript><img src="assets/img/napi-img.png" alt="Napi menü" /></noscript>
                        </div>
                        <div class="eight columns left">
                            <h3>Kedves Vendégeink!</h3>
                            <p>Vegetáriánus és húsos menünk van hétköznaponként 1.000 Ft és 1.250 Ft-os áron, ami mellé szörpöt is adunk. Siessetek, mert ½ 12-től van ebéd és 60-70 adagot készítünk, ezért van, hogy ½ 1-re elfogy.</p>
                            
                            <ul class="napi-tablak">';
    	
        if (sizeof($elements) > 0){
        	$this->loadTemplate('kajaMenu', $elements);
        }
        
    	echo ' </ul>
                        </div>
                    </div>
    			</section>';
    }
    
    
    
    public function drawNapiAdmin($elements){
    	
    	foreach ($elements AS $napiAdat){
    		echo '<strong data-napazon="'.$napiAdat['NAPAZON'].'" data-ev="'.$napiAdat['EV'].'" data-het="'.$napiAdat['HET'].'">'.$napiAdat['NAPSZAM']. " " .$napiAdat['NAPNEV'].'</strong><br/>
    				<input maxlength="100" title="1. fogás neve" name="menuInput" class="menuInput reactive" data-id="'.$napiAdat['ELSO']['ID'].'" data-fogas="1"  type="text" value="'. $napiAdat['ELSO']['ETEL']. '"/> 
					<input maxlength="15" title="1. fogás összetevők" name="menuTag" class="menuTag reactive" data-id="'.$napiAdat['ELSO']['ID'].'" data-fogas="1"  type="text" value="'. $napiAdat['ELSO']['TAG']. '"/> 
					<span class="tooltip">Leves, max. 100 karakter</span> <br/>
    				
					<input maxlength="100" title="2. fogás neve" name="menuInput" class="menuInput reactive" data-id="'.$napiAdat['MASODIK']['ID'].'" data-fogas="2" type="text" value="'. $napiAdat['MASODIK']['ETEL']. '"/> 
					<input maxlength="15" title="2. fogás összetevők" name="menuTag" class="menuTag reactive" data-id="'.$napiAdat['MASODIK']['ID'].'" data-fogas="2"  type="text" value="'. $napiAdat['MASODIK']['TAG']. '"/>
					<span class="tooltip">Főétel, max. 100 karakter</span> <br/>
    				
					
					<input maxlength="100" title="3. fogás neve" name="menuInput" class="menuInput reactive" data-id="'.$napiAdat['HARMADIK']['ID'].'" data-fogas="3" type="text" value="'. $napiAdat['HARMADIK']['ETEL']. '"/> 
					<input maxlength="15" title="3. fogás összetevők" name="menuTag" class="menuTag reactive" data-id="'.$napiAdat['HARMADIK']['ID'].'" data-fogas="3"  type="text" value="'. $napiAdat['HARMADIK']['TAG']. '"/>
					<span class="tooltip">Desszeret, max. 100 karakter</span> <br/>
    				';
    		
    	}
    	
    	echo '<br/><br/>
    	<script type="text/javascript">
    		$(document).ready(function(){
    			$("input.menuTag").change(function(){
					$(this).prev("input.menuInput").trigger("change");
				});
				
				$("input.menuInput").focus(function(){
					originalValue = $(this).val();
    			}).change(function(){
    			triggeredInput = $(this);
    			dayElement = triggeredInput.prevAll("strong").first(); 		
    			data = {
    				id: triggeredInput.attr("data-id"),
    				menuInput: triggeredInput.val(),
					menuTag: triggeredInput.next("input.menuTag").val(),
    				ev: dayElement.attr("data-ev"),
    				het: dayElement.attr("data-het"),
    				fogasazon: triggeredInput.attr("data-fogas"),
    				napazon: dayElement.attr("data-napazon"),
    				request: "napiUpdate"
				};
    			
				$.post("'.$_SESSION['helper']->getPath().'requestHandler", data, function(resp){
					if (resp["status"]){
						triggeredInput.addClass("success");
    					triggeredInput.next("input.menuTag").addClass("success");
    					triggeredInput.attr("data-id", resp["inputID"]);
    					triggeredInput.next("input.menuTag").attr("data-id", resp["inputID"]);
					}else{
						triggeredInput.addClass("error");
    					triggeredInput.next("input.menuTag").addClass("error");
						triggeredInput.val(originalValue);
					}
    			
    			setTimeout(function(){
    				triggeredInput.removeClass("success error");
    				triggeredInput.next("input.menuTag").removeClass("success error");
    			}, 750);
    			}, "json");		
    		});	
    	});
    	</script>';
    	
    }
    
    
    public function drawEtlapAdmin($elements){
    	$kategoriaNevek = array_keys($elements['kategoriak']);
    	
    	switch ($elements['helyiseg']){
    		case 'vendeglo': $etterem = 1; break;
    		case 'kert': $etterem = 2; break;
    		default: $etterem = 1;
    	}
    	
    	
    	echo '
		
    	<section class="kategoriaEditor">
    			<button id="addEtel">Étel rögzítése</button>
    			
				<table class="tablaGrid" >
				<tr>
					<td>Étlap szekció</td>
					<td>
    					<input type="hidden" name="etterem" value="'.$etterem.'"/>
    					<input type="hidden" name="id" value="0"/>
						<select name="kategoria" title="Ételszekció" value="" required>
							<option value=""></option>';
		foreach ($kategoriaNevek AS $kategoria){
			echo '<option value="'.$kategoria.'">'.$kategoria.'</option>';
		}
		echo '
						</select>
						<span class="tooltip">Ételszekció</span>
					</td>
				</tr>
				<tr>
					<td>Megnevezés</td>
					<td>
						<input type="text" maxlength="255" title="Étel neve" name="text" value="" required/>
						<span class="tooltip">Étel neve, max. 255 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Ételjelölők</td>
					<td>
						
				';
		
		
		
		$allergenTipusok = array(
			1 => 'Csillagfürt',
			2 => 'Diófélék',	
			3 => 'Földimogyi',
			4 => 'Glutén',
			5 => 'Hal',
			6 => 'Mustár',
			7 => 'Puhatestűek',
			8 => 'Rákfélék',
			9 => 'Szezámmag',
			10 => 'Szójabab',
			11 => 'Szulfitok',
			12 => 'Tej',
			13 => 'Tojás',
			14 => 'Zeller'				
		);
		
		for ($allergenCounter = 1; $allergenCounter <= 14; $allergenCounter++){
			echo '<span data-val="'.$allergenCounter.'" title="'.$allergenTipusok[$allergenCounter].'" class="allergen allergenSelector alg-'.$allergenCounter.'"></span>';
		}
		
		echo '
					</td>
				</tr>
				<tr>
					<td>Ár</td>
					<td>
						<input type="text" title="Étel ára" name="ar" value="" required/>
						<span class="tooltip">Étel ára</span>
					</td>
				</tr>
				<tr>
					<td>Sorrend</td>
					<td>
						<input type="number" title="Sorrend" min="1" name="sorrend" value="" required/>
						<span class="tooltip">Sorrend</span>
					</td>
				</tr>
			</table>
	 
</section>
    			
    	<h2>Cetli</h2>
    	<section>';
    	
    	$cetliSzamlalo = 1;
    	$sorSzamlalo = 1;
    	foreach ($elements['cetli'] AS $cetliAdat){
    		if ($cetliAdat['cetliSzam'] != $cetliSzamlalo){
    			$cetliSzamlalo = $cetliAdat['cetliSzam'];
    			$sorSzamlalo = 1;
    			echo '<br/>';
    		}
    		
			echo '
    		<input class="reactive" type="text" maxlength="30" title="'.$cetliSzamlalo.'. cetli '.$sorSzamlalo.'. sora" data-id="'.$cetliAdat['id'].'" name="cetli'.$cetliSzamlalo.'" value="'.$cetliAdat['labelText'].'"/> 
    				<span class="tooltip">Cetli '.$cetliSzamlalo.'. sora, max. 30 karakter</span> <br/>';
		}
    	
    	
		
		echo '
		</section>
		
	
				
    		<h2>Étlap</h2>
			
			<table class="tablaGrid etlapTabla">
				';
		
		foreach ($elements['kategoriak'] AS $kategoria => $kategoriaAdat){
			echo '<tr class="kategoriaRow">
					<td colspan="6">'.$kategoria.'</td>
					</tr>
					';
			
			foreach ($kategoriaAdat['etelek'] AS $etelAdat){
				echo '<tr data-id="'.$etelAdat['id'].'">
						<td>'.$etelAdat['MEGNEVEZES'].'</td>
						<td data-val="'.$etelAdat['TAGEK'].'">';

				$megadottAllergenek = array();
				if (!empty($etelAdat['TAGEK'])){
					$megadottAllergenek = explode(',', $etelAdat['TAGEK']);
				}
				
				if (count($megadottAllergenek)){
					foreach ($megadottAllergenek AS $allergenSzam){
						echo '<span data-val="'.$allergenSzam.'" title="'.$allergenTipusok[$allergenSzam].'" class="allergen alg-'.$allergenSzam.'"></span>';
					}
				}
								
				echo '</td>
						<td>'.$etelAdat['AR'].'</td>
						<td>'.$etelAdat['SORREND'].'</td>
						<td><button class="editEtel">Szerkesztés</button></td>
						<td><button class="deleteEtel">Törlés</button></td>
					</tr>';
			}
		}
		
		echo '</table>';
    }
    
    
    
    public function drawItallapAdmin($elements){
    	$kategoriaNevek = array_keys($elements['kategoriak']);
    	 
    	switch ($elements['helyiseg']){
    		case 'vendeglo': $etterem = 1; break;
    		case 'kert': $etterem = 2; break;
    		default: $etterem = 1;
    	}
    	
    	echo '
    
    	<section class="kategoriaEditor">
    			<button id="addItal">Ital rögzítése</button>
    
				<table class="tablaGrid" >
				<tr>
					<td>Itallap szekció</td>
					<td>
    					<input type="hidden" name="id" value="0"/>
    					<input type="hidden" name="etterem" value="'.$etterem.'"/>
						<select name="kategoria" value="" required>
							<option value=""></option>';
    	foreach ($kategoriaNevek AS $kategoria){
    		echo '<option value="'.$kategoria.'">'.$kategoria.'</option>';
    	}
    	echo '
						</select>
						<span class="tooltip">Italszekció</span>
					</td>
				</tr>
				<tr>
					<td>Megnevezés</td>
					<td>
						<input type="text" maxlength="255" title="Ital neve" name="text" value="" required/>
						<span class="tooltip">Ital neve, max. 255 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Ár</td>
					<td>
						<input type="text" title="Ital ára" name="ar" value="" required/>
						<span class="tooltip">Ital ára</span>
					</td>
				</tr>
    			<tr>
					<td>Sorrend</td>
					<td>
						<input type="number" title="Sorrend" min="1" name="sorrend" value="" required/>
						<span class="tooltip">Sorrend</span>
					</td>
				</tr>
			</table>
    
</section>
    
    		<h2>Itallap</h2>
		
			<table class="tablaGrid etlapTabla">
    
    
				';
    
    	foreach ($elements['kategoriak'] AS $kategoria => $kategoriaAdat){
    		
    		echo '<tr class="kategoriaRow">
					<td colspan="5">'.$kategoria.'</td>
					</tr>
					';
    			
    		foreach ($kategoriaAdat['italok'] AS $italAdat){
    			echo '<tr data-id="'.$italAdat['id'].'">
						<td>'.$italAdat['MEGNEVEZES'].'</td>
						<td>'.$italAdat['AR'].'</td>
						<td>'.$italAdat['SORREND'].'</td>
						<td><button class="editItal">Szerkesztés</button></td>
						<td><button class="deleteItal">Törlés</button></td>
					</tr>';
    		}
    	}
    
    	echo '</table>';
    }
    
    
    
    
    
    public function drawEtlap($elements){
    	
    	echo '<section id="etlap">
               ';

    	$this->drawSectionLabel("Étlap", "etlap", 2);
    	
        echo '<div class="row clearfix">
                        <div class="three columns">
                            <img class="lazy illusztracio" data-src="assets/img/etlap-img.png" alt=""><noscript><img src="assets/img/etlap-img.png" alt=""></noscript>
                            <div class="allergen-magyarazo">
                                  <h3>Allergének</h3>

                                  <p> <span>Csillagfürt</span> <span class="allergen alg-1 right"></span></p>
                                  <p> <span>Diófélék</span> <span class="allergen alg-2 right"></span></p>
                                  <p> <span>Földimogyoró</span> <span class="allergen alg-3 right"></span></p>
                                  <p> <span>Glutén</span> <span class="allergen alg-4 right"></span></p>
                                  <p> <span>Hal</span> <span class="allergen alg-5 right"></span></p>
                                  <p> <span>Mustár</span> <span class="allergen alg-6 right"></span></p>
                                  <p> <span>Puhatestűek</span> <span class="allergen alg-7 right"></span></p>
                                  <p> <span>Rákfélék</span> <span class="allergen alg-8 right"></span></p>
                                  <p> <span>Szezámmag</span> <span class="allergen alg-9 right"></span></p>
                                  <p> <span>Szójabab</span> <span class="allergen alg-10 right"></span></p>
                                  <p> <span>Szulfitok</span> <span class="allergen alg-11 right"></span></p>
                                  <p> <span>Tej</span> <span class="allergen alg-12 right"></span></p>
                                  <p> <span>Tojás</span> <span class="allergen alg-13 right"></span></p>
                                  <p> <span>Zeller</span> <span class="allergen alg-14 right"></span></p>
                            </div>
                        </div>
    			<div class="nine columns etlap">';
    	
    	$this->drawCetli($elements['cetli']);
    	
    	echo '<div class="etlap-head clearfix">
                                <img class="left etlap-level lazy" data-src="assets/img/etlap_bf@2x.jpg" alt=""><noscript><img src="assets/img/etlap_bf@2x.jpg" alt=""></noscript>
                                <svg class="icon icon-logo_barna"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-logo_barna"></use></svg>
                                <img class="right etlap-level lazy" data-src="assets/img/etlap_jf@2x.jpg" alt=""><noscript><img src="assets/img/etlap_jf@2x.jpg" alt=""></noscript>
                            </div>';
    	echo '<table>';
    	foreach ($elements['kategoriak'] AS $kategoria => $kategoriaAdat){
    		
    		echo '<tr class="etlap-kategoria"><td colspan="2"> • '.$kategoria.' • </td></tr>';
			
    		$this->loadTemplate('etlapForma', $kategoriaAdat['etelek']);

    		
    	}
    	
    	echo '</table></div>
                        
                    </div>
                    <div class="row clearfix">
                    <div class="four columns" style="margin-bottom:3rem;">
                            <div class="mobile-cetli">
                                <h3>Külön ajánlat</h3>';
                                  foreach ($elements['cetli'] AS $key => $cetliAdat){
                                        echo '<p>'.$cetliAdat['labelText'].'</p>';
                                   }  
                            echo '</div>
                            <a class="dl-pdf" target="_blank" href="'.$_SESSION['helper']->getPath().'requestHandler"><svg class="icon icon-letoltes"><use xlink:href="#icon-letoltes"></use></svg>Letöltés</a>
                    </div>
                    </div>

                    ';
    }
    

    
    
    
public function drawKertEtlap($elements){
     /*print_r($elements);
     exit;*/
		echo '<section id="etlap">';
		
		$this->drawSectionLabel("Étlap", "etlap", 2);
		
		echo '
     		<div class="row clearfix">
        <div class="three columns left illusztracio">
        <p class="ehes-szomjas">Éhes vagy?</p>
    <img data-src="assets/img/asztalos_bacsi.png" alt="kert étlap" class="lazy illusztracio" >
    <noscript>
      <img src="assets/img/asztalos_bacsi.png" alt="kert étlap">
    </noscript>

        </div>
             <div class="eight columns right  itallap etel-fold">';
     
     foreach ($elements['kategoriak'] AS $kategoria => $kategoriaAdat){
        
      echo '<ul class="fold-list">
                    <div class="etel-head">
        <svg class="icon icon-'.$kategoriaAdat['ikon'].'"><use xlink:href="#icon-'.$kategoriaAdat['ikon'].'"></use></svg>
        '.$kategoria.'</div>';
      
      $italSzamlalo = 0;
      $osszesItal = sizeof($kategoriaAdat['etelek']);
      
      $containerSzamlalo = 1;
      $maxElemSzam = 3;
            
      $italContainer = array();
      foreach ($kategoriaAdat['etelek'] AS $ital){
       array_push($italContainer, $ital);
       $italSzamlalo += 1;
       
       if (sizeof($italContainer) % $maxElemSzam == 0 || $italSzamlalo == $osszesItal){
        echo '<li>';
        $this->loadTemplate('itallapElem', $italContainer);
        echo '</li>';
        $containerSzamlalo++;
        
        if ($containerSzamlalo == 1 || $containerSzamlalo == $osszesItal){
         $maxElemSzam = 3;
        }else{
         $maxElemSzam = 4;
        }
        
        
        $italContainer = array();
       }
      }
      
      if ($containerSzamlalo % 2 == 1){
       echo '<li>
         <p></p><b></b>
         <p></p><b></b>
         <p></p><b></b>
        </li>';
      }
      
      echo '</ul>';
     }
     
     echo '
       </div> 
           </div>
                ';
     
    }
    
    
    public function drawItallap($elements, $helyiseg){
     echo '<div class="row clearfix">';
     
     if ($helyiseg == 'kert'){
     	echo '
     
             <div class="three columns right illusztracio">
             <p class="ehes-szomjas">Szomjas vagy?</p>
    		 <img data-src="assets/img/asztalos_neni.png" alt="Kert itallap" class="lazy illusztracio">
    		<noscript>
      			<img src="assets/img/asztalos_neni.png" alt="Kert itallap">
    			</noscript>
  			</div>';
     }
     if ($helyiseg == 'vendeglo'){
      echo '<div class="twelve columns centered itallap ital-fold vendeglo-itallap">';
     }
     else{
      echo '<div class="twelve columns centered itallap ital-fold">';
     }
    foreach ( $elements as $kategoria => $kategoriaAdatok ) {
		echo '<ul class="fold-list">
			<div class="itallap-head">
	        <svg class="icon icon-' . $kategoriaAdatok ['ikon'] . '"><use xlink:href="#icon-' . $kategoriaAdatok ['ikon'] . '"></use></svg>
	        ' . $kategoria . '</div>';
				
		$italSzamlalo = 0;
		$osszesItal = sizeof ( $kategoriaAdatok ['italok'] );
				
		$containerSzamlalo = 0;
		$maxElemSzam = 3;
				
		$italContainer = array ();
		foreach ( $kategoriaAdatok ['italok'] as $ital ) {
		array_push ( $italContainer, $ital );
		$italSzamlalo += 1;
			
		if (sizeof ( $italContainer ) % $maxElemSzam == 0 || $italSzamlalo == $osszesItal) {
			echo '<li>';
			$this->loadTemplate ( 'itallapElem', $italContainer );
			echo '</li>';
			$containerSzamlalo ++;
			
			if ($containerSzamlalo > 1 || $italSzamlalo == $osszesItal) {
				$maxElemSzam = 3;
			} else {
				$maxElemSzam = 4;
			}
			
			$italContainer = array ();
		}
	}
      
      if ($containerSzamlalo % 3 != 0){
      	for ($i = (3- $containerSzamlalo % 3 ); $i > 0; $i--){
       		echo '<li>
        	 <p></p><b></b>
         	<p></p><b></b>
         	<p></p><b></b>
        	</li>';
       	}
      	
      }
      
      echo '</ul>';
     }
     

     if ($helyiseg == 'kert'){
	     echo '
	     <a class="dl-pdf dl-pdf-itallap" target="_blank" href="'.$_SESSION['helper']->getPath().'requestHandler"><svg class="icon icon-letoltes"><use xlink:href="#icon-letoltes"></use></svg>Letöltés</a>
	     <form id="requestEtlapForm" method="post" action="'.$_SESSION['helper']->getPath().'requestHandler" target="_blank">
			<input type="hidden" name="request" value="generateKertEtlapPDF"/>
	     </form>
	     <script type="text/javascript">
			$(document).ready(function(){
	    		$(".dl-pdf-itallap").click(function(e){
	    			e.preventDefault();
	     			$("#requestEtlapForm").submit();    
	    			
	    		});
	    	});
	     </script>';
     }
     if ($helyiseg == "vendeglo"){
     	echo '
	     <a class="dl-pdf dl-pdf-itallap" target="_blank" href="'.$_SESSION['helper']->getPath().'requestHandler"><svg class="icon icon-letoltes"><use xlink:href="#icon-letoltes"></use></svg>Letöltés</a>
	     <form id="requestEtlapForm" method="post" action="'.$_SESSION['helper']->getPath().'requestHandler" target="_blank">
			<input type="hidden" name="request" value="generateVendegloItallapPDF"/>
	     </form>
	     <script type="text/javascript">
			$(document).ready(function(){
	    		$(".dl-pdf-itallap").click(function(e){
	    			e.preventDefault();
	     			$("#requestEtlapForm").submit();
	    
	    		});
	    	});
	     </script>';
     }
     
     echo '
       </div> 

                    </div>
                </section>';
     
    }
    
    
    
    
    
    public function drawCetli($elements){
    	
    	$sorSzamlalo = 1;
    	$cetliSzamlalo = 0;
    	$isClosing = false;
    	foreach ($elements AS $key => $cetliAdat){
    		if ($cetliAdat['cetliSzam'] != $cetliSzamlalo){
    			$cetliSzamlalo = $cetliAdat['cetliSzam'];
    			
    			if (!is_null($cetliAdat['labelText'])){
    				if ($cetliSzamlalo > 1){
    					echo '</div>
            			</div>'; 
    				}
    				
    			
	    			$sorSzamlalo = 1; 
	    		
	    			echo '<div class="spec-ajanlat cetli-'.$cetliSzamlalo.'">
	                  <svg class="csipesz icon icon-csipesz"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-csipesz"></use></svg>
	   					<div class="cetli">
	                      <h3>Külön ajánlat</h3>
	    			';
    			}
    		}

    		echo '<p>'.$cetliAdat['labelText'].'</p>';
    		$sorSzamlalo++;
    	}
    	echo '</div>
          	</div>';
    	
    	
    }
    
}
?>