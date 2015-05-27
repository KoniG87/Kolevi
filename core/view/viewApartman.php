<?php

class ApartmanView extends BaseView{
	
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
    
    
    
    public function drawTerkep(){
    	echo '<section id="terkep">';
    	
    	$this->drawSectionLabel("Térkép", "terkep", 1);
    	
    	echo '
	<div class="terkep-container">';
	    
	    include('core/template/terkep_svg.php');
	    
	    echo '
		<!-- <img src="assets/img/aprt_terkep.png" alt="Térkép" title="térkép"> -->
		<a href="#hely" class="marker-pos">
			<div class="marker-logo">
				<h2>Kőleves Vendéglő</h2>
				<svg class="icon icon-marker-logo"><use xlink:href="#icon-marker-logo"></use></svg>
				<div class="marker-shadow"></div>
			</div>
		</a>
	</div>
	<div class="row">
		<div class="twelve columns centered">
			<h3>A mi Budapestünk</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus sit cumque quisquam ad! Obcaecati aperiam itaque porro, possimus nemo dolores, reiciendis praesentium ipsa maxime! Distinctio velit dolorum qui, repudiandae dolorem corporis magnam dignissimos sunt odio cum. Mollitia, voluptates. Esse, animi totam facilis dolore voluptatem iure perspiciatis ullam nulla voluptatibus aliquam incidunt sint dolor itaque, repellendus! Laborum incidunt ipsam sequi placeat!</p>
		</div>
	</div>
</section>';
    }
    
    
    public function drawHely(){
    	echo '<section id="hely">';
    	
    	$this->drawSectionLabel("Hely", "hely", 2);
	echo '

	<div class="hely-container">';
	      
	    include('core/template/hely_svg.php');
	    echo '
		</div>
	<div class="row">
		<div class="twelve columns centered">
			<h3>A Hely</h3>
			<p>lorem ipsum dolor sit amet, consectetur adipisicing elit. accusamus sit cumque quisquam ad! obcaecati aperiam itaque porro, possimus nemo dolores, reiciendis praesentium ipsa maxime! distinctio velit dolorum qui, repudiandae dolorem corporis magnam dignissimos sunt odio cum. mollitia, voluptates. esse, animi totam facilis dolore voluptatem iure perspiciatis ullam nulla voluptatibus aliquam incidunt sint dolor itaque, repellendus! laborum incidunt ipsam sequi placeat!</p>
		</div>
	</div>
</section>';
    }
    
    
    public function drawReview($reviewData){
    	echo '		
			<div class="review-card clearfix" >
				<div class="three columns">
					<div class="review-card-img">
						<img src="'.$reviewData['kep'].'" alt="'.$reviewData['kep'].'">
					</div>
					<h2>'.$reviewData['nev'].'</h2>
				</div>
				<div class="nine columns">
					<h2>"'.$reviewData['cim'].'"</h2>
					<div class="star-rating" data-rating="'.$reviewData['rating'].'"></div>
					<p>'.$reviewData['leiras'].'</p>
				</div>
			</div>';
    }
    
    
    public function drawSzoba($szobaData){
    	$counterSzoba = 0;
        $counterSzoba++;
    	echo '<div class="szoba clearfix" id="szoba_'.$counterSzoba.'">
    	
		<div class="szoba-description four columns">
    		<h3>'.$szobaData['header'].'</h3>
    		<p>'.$szobaData['desc'].'</p>
    	</div>    			

    	<div class=" seven columns">
    		<div class="szoba-carousel">';
    	
    	$slideOutput = '';
    	foreach ($szobaData['kepek'] AS $kepData){
    		$slideOutput .= '<div><img src="'.$kepData['fajlnev'].'" alt=""></div>'; 
    	}
    	echo $slideOutput;
    	
    	echo '
		    </div>
	    	<div class="szoba-carousel-nav">';
    	
    	echo $slideOutput;
			    
    	echo '
	    	</div>
    	</div>
    	
    	
    	<div class="review-container ten columns centered">
    	';
    	
    	foreach ($szobaData['reviewek'] AS $reviewData){
    		$this->drawReview($reviewData);
    	}
    	
    	echo '
    	<div class="add-review">
    	<form action="">
    	<div class="three columns">
    	<div class="review-img">

    	</div>
    	<input type="text" placeholder="Név">
    	</div>
    	<div class="nine columns">
    	
    	<input type="text" placeholder="Cím">
    	
    	<div class="stars">
    	<input type="radio" name="star" class="star-1" id="star-1" />
    	<label class="star-1" for="star-1">1</label>
    	<input type="radio" name="star" class="star-2" id="star-2" />
    	<label class="star-2" for="star-2">2</label>
    	<input type="radio" name="star" class="star-3" id="star-3" />
    	<label class="star-3" for="star-3">3</label>
    	<input type="radio" name="star" class="star-4" id="star-4" />
    	<label class="star-4" for="star-4">4</label>
    	<input type="radio" name="star" class="star-5" id="star-5" />
    	<label class="star-5" for="star-5">5</label>
    	<span></span>
    	</div>
    	
    	<textarea placeholder="Szeretem a tollpárnákat" ></textarea>
    	
    	</div>
    	<input type="submit" value="Küldés">
    	</form>
    	</div>
    	</div>
    	</div>';
    }
    
    
    public function drawSzobak($elements){
    	echo '<section id="szobak">';
    	
    	$this->drawSectionLabel("Szobák", "szobak", 3);
    	echo '
    	
    	<div class="row clearfix szobak-container">';
    	
    	foreach ($elements['szobak'] AS $sorrend => $szobaData){
    		$this->drawSzoba($szobaData);
    	}
    	
    	echo '
    	</div>
    	</section>';
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
					<p>A Kőleves Kert 8. szezonját éli. Amikor még a sarkon volt a vendéglőnk és egy elég brutális mellék-helység 
volt a kertben, akkor a szimpla kerten kívül senki más nem volt a környéken, nagyon vártuk, hogy végre 
ennyire nyüzsgő belváros legyünk.</p>
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