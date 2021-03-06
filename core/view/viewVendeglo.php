<?php
class VendegloView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
    
	
	
	public function drawCikkAdmin($elements){
		
			
		echo '
	
    	<section class="kategoriaEditor">
    			<button id="addCikk">Cikk rögzítése</button>
	
				<table class="tablaGrid" >
				<tr>
					<td>Cím</td>
					<td>
						<input type="hidden" name="id" value="0"/>
						
				
						<input type="text" maxlength="128" title="Cím" name="text" value="" required/>
						<span class="tooltip">Cím, max. 128 karakter</span>
					</td>
				</tr>
				<tr>
					<td>URL</td>
					<td>
	
						<input type="text" maxlength="255" title="Hivatkozás címe" name="url" value="" required/>
						<span class="tooltip">Hivatkozás címe, max. 255 karakter</span>
					</td>
				</tr>
	
				
				<tr>
					<td>Cikk előnézeti képe:</label></td>
				<td>
					<select class="imageRefTemplate" name="kiskep" title="Előnézeti kép" required>
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['fajlnev'].'">'.basename($kepAdat['fajlnev']).'</option>';
		}
		echo '
			
					</select>
					<span class="tooltip">Kiskép</span>
				</td>
				
			</tr>
				
				<tr>
					<td>Cikk képe:</label></td>
				<td>
					<select class="imageRefTemplate" name="nagykep" title="Cikk képe" required>
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['fajlnev'].'">'.basename($kepAdat['fajlnev']).'</option>';
		}
		echo '
			
					</select>
					<span class="tooltip">Nagykép</span>
				</td>
				
			</tr>
				
				<tr>
					<td>Sorrend</td>
					<td>
						<input type="number" title="Sorrend" min="1" name="sorrend" value="" required/>
						<span class="tooltip">Sorrend</span>
					</td>
				</tr>
				
				<tr>
					<td>Látható</td>
					<td>
						 <select name="allapot" required>
		                    <option value=""></option>
		                    <option value="0">Inaktív</option>
		                    <option value="1">Látható</option>
		                    
		                </select>
		                <span class="tooltip">Látható legyen-e a Barcasban</span>
					</td>
				</tr>
			</table>
	</section>
	
	
	
	
    		<h2>Cikkek</h2>
	
			<table class="tablaGrid cikkTabla">
				';
	
		foreach ($elements['cikkek'] AS $key => $cikkAdat){
			
				echo '<tr data-nagykep="'.basename($cikkAdat['nagykep']).'" data-kiskep="'.basename($cikkAdat['kiskep']).'" data-url="'.$cikkAdat['url'].'" data-id="'.$cikkAdat['id'].'" data-sorrend="'.$cikkAdat['sorrend'].'" data-allapot="'.$cikkAdat['visible'].'">
						<td><img src="'.$_SESSION['helper']->getPath().$cikkAdat['kiskep'].'" alt=""/></td>
						<td>'.$cikkAdat['labelHeader'].'</td>
						
						<td><button class="editCikk">Szerkesztés</button></td>
						<td><button class="deleteCikk">Törlés</button></td>
					</tr>';
			}
		
	
		echo '</table>';
	}
	
	
	
	
	
    public function drawFoglalasForm($elements){
    	echo '<section id="asztalfoglalas">';
    	
    	$this->drawSectionLabel("Asztalfoglalás", "asztalfoglalas", 3);
		
    	$this->loadTemplate('foglalasForm', $elements);
		
    	echo '</section>';
    }
    
    
    
    public function drawProgram($elements){
    	$monthNames = array(
    			1	=> 'január',
    			2	=> 'február',
    			3	=> 'március',
    			4	=> 'április',
    			5	=> 'május',
    			6	=> 'június',
    			7	=> 'július',
    			8	=> 'augusztus',
    			9	=> 'szeptember',
    			10	=> 'október',
    			11	=> 'november',
    			12	=> 'december'
    	);
    	$dayNames = array(
    			1	=> 'hétfő',
    			2	=> 'kedd',
    			3	=> 'szerda',
    			4	=> 'csütörtök',
    			5	=> 'péntek',
    			6	=> 'szombat',
    			7	=> 'vasárnap'
    	);
        
        $dateValues = array();
    	foreach ($elements AS $programData){
             array_push($dateValues, $programData['datum']);
        }
        echo '<script>var events = [';
        $output = '';
            
        foreach ($dateValues AS $val){
            $output .= "{ date: '".$val."' },";
        }    
        echo substr($output, 0, -1);
        
        echo '];</script>';
        
        
        
    	echo '<section id="programok">';
    	$this->drawSectionLabel("Programok", "programok", 5);
    	
    	echo '<div class="row clearfix">
              	<div class="four columns">
                	<img data-src="assets/img/programok-img.png" alt="Asztalfoglalás" class="lazy illusztracio"><noscript><img src="assets/img/programok-img.png" alt="Asztalfoglalás"></noscript>
                </div>
                <div class="eight columns" style="position:relative;">
                            
                <div id="mini-clndr"></div>
                	<svg class="icon icon-naptar naptar-trigger"><use xlink:href="#icon-naptar"></use></svg>
                </div>
              </div>
              <div class="row clearfix programok-container">
    	';
    	
                
    	foreach ($elements AS $programData){
    		$date = new DateTime($programData['datum']);
    		echo '	<div data-datum="'.$programData['datum'].'" class="program">
                            <div class="program-left eight columns">
                                <div class="program-kep" style="background-image:url('.$programData['kep'].');"></div>
                                <div class="program-date">
                                    <p>'.$monthNames[$date->format('n')].'</p>
                                    <h2>'.$date->format('d').'</h2>
                                    <p>'.$dayNames[$date->format('N')].'</p>
                                </div>
                            </div>
                            <div class="program-right four columns">
<div class="dot-inner-content">
<h3>'.$programData['labelHeader'].'</h3>
	<p>'.$programData['labelDesc'].'</p>
	'.(!empty($programData['fblink']) ? '<a target="_blank" href="'.$programData['fblink'].'">facebook esemény</a>' : '').'
	</div>
                                <svg class="icon icon-rolunk-le program-nyil program-nyil-le"><use xlink:href="#icon-rolunk-le"></use></svg>	
                                <svg class="icon icon-rolunk-le program-nyil program-nyil-fel"><use xlink:href="#icon-rolunk-le"></use></svg>
                            </div>

                        </div>';
            
           
    	}		
    		
    		echo '	
                </section>';
    	
        
    	
    }
    
    
    
    
    public function drawRendezveny($elements){
    	echo '<section id="rendezvenyek">';
                
    	$this->drawSectionLabel("Rendezvények", "rendezvenyek", 4);
    	
    	
    	echo '<p>A földszinti vendégtérből nyílik az általunk "VIP" teremnek nevezett kisterem, ahol maximum 13 fő fér el. Zártkörű ebédekhez, vacsorákhoz vagy megbeszélésekhez ajánljuk.</p>
    			<p>Az épület hátsó részében található az "Elefántos" terem, ahol maximum 25 fő fér el ültetve, ha nem feltétlenül szeretne mindenki leülni, akkor 40 ember is befér. Ezt a termet zártkörű ebédekhez, vacsorákhoz, megbeszélésekhez, osztálytalálkozókhoz, tréningekhez, workshopokhoz, stb. ajánljuk. Ennek a teremnek van egy külön pultja is, projektora és néhány kényelmes fotelje is.</p>
    			<p>Az emeleti különterem a legnagyobb külön helyiségünk. Ültetve 70-75 ember fér el benne, állva 120-150-en is akár. Ehhez a teremhez tartozik egy külön bárpult és egy dohányzó terasz is. Amit biztosítani tudunk: erősítő, keverőpult, hangfalak, mikrofonok, projektor, vetítővászon, flipchart tábla. Mindenféle zártkörű rendezvényekhez ajánljuk, például ebédekhez, vacsorákhoz, esküvőkhöz, születésnapokhoz, előadások, tréningek, stb.</p>
    			<p>Ezen kívül a kertbe is felveszünk nagyobb foglalásokat és arra is van lehetőség, hogy az egész vendéglőt kivedd.</p>
                <p>Minden ilyen rendezvénnyel kapcsolatban keresd Elek Imolát....</p>';
    	
    	$this->loadTemplate('rendezvenyFejlec', array($elements['szervezo']));
    	
    	foreach ($elements['rendezvenyek'] AS $rendezvenyData){
    		echo '<div class="row">
                        <div class="twelve columns">
                            <h3>'.$rendezvenyData['MEGNEVEZES'].'</h3>
                            <p>'.$rendezvenyData['MEGJEGYZES'].'</p>
                        </div>
                        <div class="eight columns centered rend-slider">';
    	
    		$this->loadTemplate('rendezvenyLista', $rendezvenyData['kepek']);
    		
    		echo '</div>
            <svg class="icon icon-swipe"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-swipe"></use></svg>
                    </div>';
    	}
    	
                            
                       
    	
    	echo '</section>';
    }
    
    
    
    public function drawRendezvenyList($elements){
    	foreach ($elements AS $rendezvenyData){
    		echo '<tr data-id="'.$rendezvenyData['id'].'">
			 	<td>'.$rendezvenyData['MEGNEVEZES'].'</td>
				<td>'.$rendezvenyData['MEGJEGYZES'].'</td>
				<td>'.getDecisionText($rendezvenyData['allapot']).'</td>
				<td>
                    <form method="post" action="'.$_SESSION['helper']->getPath().'dashboard/rendezvenyRogzito">
                        <input type="hidden" name="id" value="'.$rendezvenyData['id'].'"/>
                        <button class="editEtel">Szerkesztés</button>
                    </form>
                </td>
				<td>
                	<button class="deleteRendezveny">Törlés</button>
                </td>
			</tr>';
        }
    }
    
    public function drawProgramList($elements){
    	foreach ($elements AS $programData){
    		echo '<tr data-id="'.$programData['id'].'">
			 	<td>'.$programData['labelHeader'].'</td>
				<td>'.$programData['labelDesc'].'</td>
				<td>'.$programData['datum'].'</td>
				<td>'.getDecisionText($programData['allapot']).'</td>
				<td>
                    <form method="post" action="'.$_SESSION['helper']->getPath().'dashboard/programRogzito">
                        <input type="hidden" name="id" value="'.$programData['id'].'"/>
                        <button class="editProgram">Szerkesztés</button>
                    </form>    
                </td>
				<td>
                	<button class="deleteProgram">Törlés</button>
                </td>
			</tr>';
    	}
        //<td><button class="deleteEtel">Törlés</button></td>
    }
    
  
  
	public function drawRendezvenyAdmin($elements){
		
		echo '<table class="tablaGrid">
			<tbody>
				<tr>
					<td><input type="hidden" name="id" value="'.$elements['rendezveny']['id'].'"/>
						<label>Neve</label></td>
					<td><input maxlength="75" title="Cím" type="text" name="text" value="'.$elements['rendezveny']['MEGNEVEZES'].'" required/>
					<span class="tooltip">Cím, max. 75 karakter</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Leírás</label></td>
					<td><textarea maxlength="1024" title="Leírás" type="text" name="leiras" required>'.$elements['rendezveny']['MEGJEGYZES'].'</textarea>
					<span class="tooltip">Leírás, max. 1024 karakter</span></td>
					<td></td>
				</tr>
				<tr>
					<td>Sorrend</td>
					<td>
						<input type="number" title="Sorrend" min="1" name="sorrend" value="'.$elements['rendezveny']['sorrend'].'" required/>
						<span class="tooltip">Sorrend</span>
					</td>
					<td></td>
				</tr>
    						
				<tr>
					<td>Látható</td>
					<td>
						 <select name="allapot" required>
		                    <option value=""></option>
		                    <option '.($elements['rendezveny']['allapot'] ? '' : 'selected="selected"').' value="0">Inaktív</option>
		                    <option '.($elements['rendezveny']['allapot'] ? 'selected="selected"' : '').' value="1">Látható</option>
    
		                </select>
		                <span class="tooltip">Látható legyen-e a weboldalon</span>
					</td>
		            <td></td>
				</tr>			
		';

		$kepSzamlalo = 1;
		
		if ($elements['rendezveny']['id'] != 0 && !is_null(($elements['rendezveny']['kepek']))){
			foreach ($elements['rendezveny']['kepek'] AS $kepAdat){
				echo '<tr>
					<td><label>'.$kepSzamlalo.'. kép:</label></td>
					<td>
						<input readonly="readonly" type="text"  name="kep_'.$kepSzamlalo.'" alt="'.$kepSzamlalo.'. kép" value="'.basename($kepAdat['fajlnev']).'"/>
						<button data-id="'.$kepAdat['id'].'" class="deleteKep">Törlés</button>
					</td>
					<td>
						<img src="'.$_SESSION['helper']->getPath().$kepAdat['fajlnev'].'" alt="'.$kepAdat['fajlnev'].'"/>
					</td>
				</tr>';
				$kepSzamlalo++;
			}
		
		
		echo '<tr>
				<td><label>'.$kepSzamlalo.'. kép:</label></td>
				<td>
					<select class="imageRefTemplate" data-id="'.$elements['rendezveny']['id'].'" name="kep_'.$kepSzamlalo.'">
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['id'].'">'.basename($kepAdat['fajlnev']).'</option>';
		}
		echo '				
					
					</select>
				</td>
				<td></td>
			</tr>';
		}
		echo '
			</tbody>
		</table>';
	}
  
	
	
	
	
	
	public function drawPartnerAdmin($elements){
					
		echo '
	
    	<section class="kategoriaEditor">
    			<button id="addPartner">Partner rögzítése</button>
    
				<table class="tablaGrid" >
				<tr>
					<td>Megnevezés</td>
					<td>
						<input type="hidden" name="id" value="0"/>
						
						<input type="text" maxlength="128" title="Partner neve" name="text" value="" required/>
						<span class="tooltip">Partner neve, max. 128 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Leírás</td>
					<td>
						
						<input type="text" maxlength="1024" title="Leírás partnerről" name="leiras" value="" required/>
						<span class="tooltip">Leírás, max. 1024 karakter</span>
					</td>
				</tr>
				<tr>
					<td>URL</td>
					<td>
						
						<input type="text" maxlength="255" title="URL" name="url" value="" required/>
						<span class="tooltip">URL, max. 255 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Sorrend</td>
					<td>
						<input type="number" title="Sorrend" min="1" name="sorrend" value="" required/>
						<span class="tooltip">Sorrend</span>
					</td>
				</tr>
				
				<tr>
					<td>Látható</td>
					<td>
						 <select name="allapot" required>
		                    <option value=""></option>
		                    <option value="0">Inaktív</option>
		                    <option value="1">Látható</option>
		                    
		                </select>
		                <span class="tooltip">Látható legyen-e a Barcasban</span>
					</td>
				</tr>
				
				<tr>
					<td>Partner képe:</label></td>
				<td>
					<select class="imageRefTemplate" title="Partner képe" name="kep" required>
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['fajlnev'].'">'.basename($kepAdat['fajlnev']).'</option>';
		}
		echo '				
					
					</select>
					<span class="tooltip">Partner neve</span>
				</td>
				
			</tr>
			</table>
	</section>
	
	
	
	
    		<h2>Partnerek</h2>
	
			<table class="tablaGrid partnerTabla">
				';
	
		foreach ($elements['partnerek'] AS $key => $partnerAdat){
			echo '<tr data-id="'.$partnerAdat['id'].'" data-sorrend="'.$partnerAdat['sorrend'].'" data-allapot="'.$partnerAdat['visible'].'">
					<td><img src="'.$_SESSION['helper']->getPath().$partnerAdat['kep'].'" alt="'.$partnerAdat['labelHeader'].'"/></td>
					<td>'.$partnerAdat['labelHeader'].'</td>
					<td>'.$partnerAdat['labelDesc'].'</td>
					<td>'.$partnerAdat['url'].'</td>
					<td><button class="editPartner">Szerkesztés</button></td>
					<td><button class="deletePartner">Törlés</button></td>
				</tr>';
		}
	
		echo '</table>';
	}
	
	
	
	
	
	
    
    public function drawRolunk($elements){
    	echo '<section id="rolunk">';
    	$this->drawSectionLabel("Rólunk", "rolunk", 6);
    	echo '
			<div class="row clearfix">
				<div class="eight columns">
					<h3>A Vendéglő</h3>
					<p>A Kőleves 10 éves vendéglő. Imola és Kápszi ültünk egy rémséges vasút-állomáson 1995 körül és elhatároztuk, hogy nyitunk egy vendéglőt. 
		Azt hiszem ez kb. 10 évvel később, de megvalósult 2005-ben. Ez a tíz év beszélgetés a vendéglőről elég volt ahhoz, hogy pontosan tudjuk mit akarunk és lássuk, 
		hogy ugyanazt, ez azóta is töretlenül működik köztünk. Persze nem magától ment minden, hanem sok kölcsön pénzből, amivel az elején nehéz volt küzdenünk. Először 
		a Dob-Kazinczy sarkán nyitottuk meg a Kőlevest, ahol 8 évig üzemeltünk egyre sikeresebben. Itt sikerült egysmást tanulnunk erről a szakmáról, hiszen egyikünk sem 
		volt vendéglátós azelőtt, mégpedig főleg azt, hogy ha magunkat adjuk és beletesszük az energiáinkat, őszinték vagyunk, és figyelünk, akkor ezt a közönségünk is 
		megérzi, és elérjük a sikert. A Kazinczy 41-be három éve költöztünk, ami már egy ötször akkora hely és itt megvalósulhatott minden álmunk, amit egy konyháról 
		képzeltünk. Kidobhattuk a micro sütőt és mindent magunk tudunk elkészíteni, ami lekvár, szósz, pesto, öntet, vagy bármi hozzávaló és eredeti ízt kíván. Útközben 
		még megnyitottuk a Kőleves kertet 7 évvel ezelőtt, hogy nyáron is lehessen könnyű grill konyhával a szabadban enni-inni. Azután 4 éve elkészült a <a href="http://www.mikativadarmulato.hu/">Mika Tivadar Mulató</a>, 
		majd egy évvel később, a hozzá tartozó kert is.</p>
				</div>
				<div class="three columns right">
					<img data-src="assets/img/vendegkonyv.png" alt="Rólunk" class="lazy illusztracio"><noscript><img src="assets/img/vendegkonyv.png" alt="Rólunk"></noscript>
				</div>
			</div>
            <div class="row clearfix">
                <div class="twelve columns cikkek-container">
                    <h3>Rólunk írták</h3>
                    <div class="cikkek-slider">';
    	
    	
    	$this->loadTemplate('cikkElem', $elements['cikkek']);
    	
    	echo '
                    </div>
                </div>
            </div>
			<div class="row clearfix">
				<div class="twelve columns">
			
					<div class="rolunk-container clearfix">
					<h3>Csapatunk tagjai</h3>
						';
		
    		$this->loadTemplate('rolunkEmber', $elements['emberek']);

            echo '  	 
              </div>
			  	<div class="row clearfix">
					<div class="twelve columns partnerek-container">
                    <h3>Akiket szeretünk</h3>';

            $this->loadTemplate('partnerElem', $elements['partnerek']);
                                  
             echo '
					</div>
               </div>
             </section>';
    	
    }
 
    
     public function drawFoglalasLista($elements){
        
        
        foreach ($elements AS $foglalasData){
            echo '<tr data-id="'.$foglalasData['id'].'">
			<td>'.$foglalasData['nev'].'</td>
			<td>'.$foglalasData['email'].'</td>
			<td>'.$foglalasData['telefonszam'].'</td>
			<td>'.substr($foglalasData['idopont'],0, 10).'<br/> '.substr($foglalasData['idopont'],11, 5).'</td>
			<td>'.$foglalasData['hanyfo'].'</td>
			<td class="wideHeader">'.wordwrap($foglalasData['megjegyzes'], 28, '<br/>').'</td>
			<td>'.($foglalasData['jovahagyva'] == 0 && $foglalasData['visible'] == 1 ? '
				<button class="editFoglalas" title="Ezzel szerkeszted a foglalás adatait!">Szerkesztés</button>' : '').'					
			</td>
			<td>'.($foglalasData['jovahagyva'] == 0 && $foglalasData['visible'] == 1 ? '
				<button class="deleteFoglalas" title="Ezzel törlöd a foglalást!">Törlés</button>
				<button class="cancelFoglalas" style="display:none;" title="Ezzel elveted az adatok módosításait!">Mégse</button>' : 
					($foglalasData['jovahagyva'] == 0 && $foglalasData['visible'] == 0 ? 'Törölve' : '') ).'					
			</td>
			<td>'.($foglalasData['jovahagyva'] == 0 && $foglalasData['visible'] == 1 ? '
                <button class="approveFoglalas" title="Ezzel jóváhagyod a foglalás adatait, egyben értesítő emailt küld a rendszer a vendégnek!">Jóváhagyás</button>
				<button class="saveFoglalas" style="display:none;" title="Ezzel elmented az adatokat!">Mentés</button>' : 
					($foglalasData['jovahagyva'] == 1 && $foglalasData['visible'] == 0 ? 'Jóváhaagyva' : '') ).'
            </td>
            
		</tr>';
            //<button class="editFoglalas">Szerkesztés</button> <br/> 
        }
    }
    
    
    public function drawHirList($elements){
        foreach ($elements AS $hirData){
            echo '<tr data-sorrend="'.$hirData['sorrend'].'" data-id="'.$hirData['id'].'" data-url="'.$hirData['url'].'" data-tipus="'.$hirData['tipus_id'].'" data-allapot="'.$hirData['allapot'].'" data-bejegyzes="'.$hirData['fk_id'].'">
                
                <td>'.$hirData['felirat'].'</td>
                <td>'.getDecisionText($hirData['allapot']).'</td>
                <td><button class="editHir">Szerkesztés</button></td>
                <td><button class="deleteHir">Törlés</button></td>
            </tr>';
        }
    }
}
?> 