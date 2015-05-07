<?php

class KertView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
    
    public function drawFoglalasForm(){
    	echo '<section id="asztalfoglalas">';
    	$this->drawSectionLabel("Asztalfoglalás", "asztalfoglalas", 3);
		$this->loadTemplate('foglalasForm');
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
                                <h3>'.$programData['labelHeader'].'</h3>
                                '.$programData['labelDesc'].'
                                '.(!is_null($programData['fblink']) ? '<a href="'.$programData['fblink'].'">facebook esemény</a>' : '').'
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
                
    	$this->drawSectionLabel("Rendezvények", "rendezvenyek", 3);
    	
    	
    	echo '<p>A földszinti vendégtérből nyílik az általunk "VIP" teremnek nevezett kisterem, ahol maximum 13 fő fér el. Zártkörű ebédekhez, vacsorákhoz vagy megbeszélésekhez ajánljuk.</p>
    			<p>Az épület hátsó részében található az "Elefántos" terem, ahol maximum 25 fő fér el ültetve, ha nem feltétlenül szeretne mindenki leülni, akkor 40 ember is befér. Ezt a termet zártkörű ebédekhez, vacsorákhoz, megbeszélésekhez, osztálytalálkozókhoz, tréningekhez, workshopokhoz, stb. ajánljuk. Ennek a teremnek van egy külön pultja is, projektora és néhány kényelmes fotelje is.</p>
    			<p>Az emeleti különterem a legnagyobb külön helyiségünk. Ültetve 70-75 ember fér el benne, állva 120-150-en is akár. Ehhez a teremhez tartozik egy külön bárpult és egy dohányzó terasz is. Amit biztosítani tudunk: erősítő, keverőpult, hangfalak, mikrofonok, projektor, vetítővászon, flipchart tábla. Mindenféle zártkörű rendezvényekhez ajánljuk, például ebédekhez, vacsorákhoz, esküvőkhöz, születésnapokhoz, előadások, tréningek, stb.</p>
    			<p>Ezen kívül a kertbe is felveszünk nagyobb foglalásokat és arra is van lehetőség, hogy az egész vendéglőt kivedd.</p>';
    	
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
                    <form method="post" action="index.php?page=dashboard&sub=rendezvenyRogzito">
                        <input type="hidden" name="id" value="'.$rendezvenyData['id'].'"/>
                        <button class="editEtel">Szerkesztés</button>
                    </form>
                </td>
				
			</tr>';
            //<td><button class="deleteEtel">Törlés</button></td>
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
                    <form method="post" action="index.php?page=dashboard&sub=programRogzito">
                        <input type="hidden" name="id" value="'.$programData['id'].'"/>
                        <button class="editProgram">Szerkesztés</button>
                    </form>    
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
					<td><input maxlength="75" type="text" name="text_hu" value="'.$elements['rendezveny']['MEGNEVEZES'].'" required/>
					<span class="tooltip">Cím, max. 75 karakter</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Leírás</label></td>
					<td><textarea maxlength="1024" type="text" name="leiras_hu" required>'.$elements['rendezveny']['MEGJEGYZES'].'</textarea>
					<span class="tooltip">Leírás, max. 1024 karakter</span></td>
					<td></td>
				</tr>
		';

		$kepSzamlalo = 1;
		foreach ($elements['rendezveny']['kepek'] AS $kepAdat){
			echo '<tr>
				<td><label>'.$kepSzamlalo.'. kép:</label></td>
				<td>
					<input readonly="readonly" type="text"  name="kep_'.$kepSzamlalo.'" alt="'.$kepSzamlalo.'. kép" value="'.basename($kepAdat['fajlnev']).'"/>
					<button data-id="'.$kepAdat['id'].'" class="deleteKep">Törlés</button>
				</td>
				<td>
					<img src="'.$kepAdat['fajlnev'].'" alt="'.$kepAdat['fajlnev'].'"/>
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
			</tr>
			</tbody>
		</table>';
	}
  
    
    public function drawRolunk($elements){
    	echo '<section id="rolunk">';
    	$this->drawSectionLabel("Rólunk", "rolunk", 1);
    	echo '
			<div class="row clearfix">
				<div class="twelve columns">
					<h3>A Kert</h3>
					<p>Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child 
with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that\'s what you see 
at a toy store. And you must think you\'re in a toy store, because you\'re here shopping for an infant named Jeb.
Look, just because I don\'t be givin\' no man a foot massage don\'t make it right for Marsellus to throw Antwone into a glass motherfuckin\' house, 
fuckin\' up the way the nigger talks. Motherfucker do that shit to me, he better paralyze my ass, \'cause I\'ll kill the motherfucker, know what I\'m sayin\'?</p>
				</div>
				<div class=" ten columns centered rolunk-kert-kep">
					<img src="assets/img/kert-kep.jpg" alt="Ez itt a kert!">
				</div>
			</div>
			<div class="row clearfix">
				<div class="twelve columns">
					<h3>Mi</h3>
					<p>Igazán fiatalos, modern arcok vagyunk - és mindemellett még finomkat is főzünk! Gyere be hozz, akár csak egy kávéra is, ha nem szeretnéd otthon egyedül meginni, hanem kedves társasággal szeretnéd megosztani a reggeli lendületet!</p>
					 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
			
			
			<form action="?" method="POST">
			  <!--<div class="g-recaptcha" data-sitekey="6LctzgUTAAAAAEDRtdJAynba8NWcjWKgSsTtUnP7"></div>-->
			  <br/>
			</form>
					<div class="rolunk-container clearfix">
					
						';
		/*
		*	Recaptcha form
		*/
	/*	echo '<form method="post" action="verify.php">
		<div class="rolunk-ikon">
		<svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg>
	</div>
	<input type="hidden">';
 
	require_once('assets/libs/recaptcha/recaptchalib.php');
    $publickey = "6LctzgUTAAAAAEDRtdJAynba8NWcjWKgSsTtUnP7"; 
	$privatekey = "6LctzgUTAAAAACqo4ZyDvJxKT9BAK3pFumWKXXmA";
    
	echo recaptcha_get_html($publickey);
	echo '<input type="submit" value="SUBMIT">';

	$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
	
	if (!$resp->is_valid) {
		die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
        "(reCAPTCHA said: " . $resp->error . ")");
	} else {
		// jelenitsük meg azt a szaros telefonszámot.
	}

	echo '<div class="g-recaptcha" data-sitekey="'.$publickey.'"></div>
	</form>';
	*/
    	$this->loadTemplate('rolunkEmber', $elements);
                    echo '  	 
                    </div>
                </section>';
    	
    }
 
    
     public function drawFoglalasLista($elements){
        
        
        foreach ($elements AS $foglalasData){
            echo '<tr data-id="'.$foglalasData['id'].'">
			<td>'.$foglalasData['nev'].'</td>
			<td>'.$foglalasData['email'].'</td>
			<td>'.substr($foglalasData['idopont'],0, 10).'<br/>'.substr($foglalasData['idopont'],11, 5).'</td>
			<td>'.$foglalasData['hanyfo'].'</td>
			<td class="wideHeader">'.$foglalasData['megjegyzes'].'</td>
			<td>'.($foglalasData['jovahagyva'] == 0 ? '
                
                <button class="approveFoglalas" title="Ezzel jóváhagyod a foglalás adatait, egyben értesítő emailt küld a rendszer a vendégnek!">Jóváhagyás</button>' : '').'</td>
            
		</tr>';
            //<button class="editFoglalas">Szerkesztés</button> <br/> 
        }
    }
    
    
    public function drawHirList($elements){
        foreach ($elements AS $hirData){
            echo '<tr data-id="'.$hirData['id'].'" data-tipus="'.$hirData['tipus_id'].'" data-allapot="'.$hirData['allapot'].'" data-bejegyzes="'.$hirData['fk_id'].'">
                
                <td>'.$hirData['felirat'].'</td>
                <td>'.getDecisionText($hirData['allapot']).'</td>
                <td><button class="editHir">Szerkesztés</button></td>
                
            </tr>';
        }
    }
}
?>