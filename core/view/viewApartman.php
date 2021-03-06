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
    	/*
    	 * For consideration: eredetileg nem szerinti emberke picto-k lettek volna, de ez el lett vetve,
    	 * 		most kivettem a feltoltott kepeket lehetove tevo html markup-ot, es meghagytam a default
    	 * 		narancs fiusat, de azert itt hagyom a kodot for historical reasons (es nem baj, hogy a git
    	 * 		is megtartja a revision-ek keresztul, evvan, mwuuhaa)
    	 * 
    	 * <div class="review-card-img">
		 *		<img src="'.$reviewData['kep'].'" alt="'.$reviewData['kep'].'">
		 *	</div>
    	 * */
    	
    	echo '		
			<div class="review-card clearfix" >
				<div class="three columns">
					<div class="review-img">
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
    
    public function drawReviewAdmin($elements){
    	echo '
    
    	<section class="kategoriaEditor">
    			<button id="addReview">Review rögzítése</button>
    
				<table class="tablaGrid" >
				<tr>
					<td>Név</td>
					<td>
						<input type="hidden" name="id" value="0"/>
    					<input type="hidden" name="szoba_id" value="'.$elements['szobaID'].'"/>
    
						<input type="text" maxlength="128" title="Név" name="nev" value="" required/>
						<span class="tooltip">Név, max. 128 karakter</span>
					</td>
				</tr>
    			<tr>
					<td>Cím</td>
					<td>
						<input type="text" maxlength="128" title="Cím" name="cim" value="" required/>
						<span class="tooltip">Cím, max. 128 karakter</span>
					</td>
				</tr>
    			<tr>
					<td>Leírás</td>
					<td>
						<textarea maxlength="1024" title="Leírás" name="leiras" required></textarea>
						<span class="tooltip">Leírás, max. 1024 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Értékelés</td>
					<td>
    					<input type="number" title="Értékelési csillagok" name="rating" min="1" max="5" value="" required/>
						<span class="tooltip">Értékelés</span>
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
		                <span class="tooltip">Látható legyen-e a weboldalon</span>
					</td>
				</tr>
			</table>
	</section>
    
    
    
    
    		<h2>Szobához tartozó review-k</h2>
    
			<table class="tablaGrid reviewTabla">
				';
    	
    	foreach ($elements['reviewek'] AS $key => $reviewAdat){
    			
    		echo '<tr data-id="'.$reviewAdat['id'].'" data-sorrend="'.$reviewAdat['sorrend'].'" data-rating="'.$reviewAdat['rating'].'" data-allapot="'.$reviewAdat['visible'].'">
						<td>'.$reviewAdat['nev'].'</td>
						<td>'.$reviewAdat['cim'].'</td>
						<td>'.wordwrap($reviewAdat['leiras'], 60, '<br/>').'</td>
    					<td>
							<div class="star-rating" data-rating="'.$reviewAdat['rating'].'" style="width: '. ($reviewAdat['rating'] * 31) .'px;"></div>
						</td>
    					<td>'.getDecisionText($reviewAdat['visible']).'</td>
								
						<td><button class="editReview">Szerkesztés</button></td>
						<td><button class="deleteReview">Törlés</button></td>
					</tr>';
    	}
    
    
    	echo '</table>';
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
    	
    	$slideOutput = '<div><img src="'.$szobaData['kezdokep'].'" alt=""></div>';
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
    
    
    
    
    public function drawSzobaList($elements){
    	foreach ($elements AS $szobaData){
    		echo '<tr data-id="'.$szobaData['id'].'">
			 	<td>'.$szobaData['header'].'</td>
				<td>'.wordwrap($szobaData['desc'], 60, '<br/>').'</td>
				<td>'.getDecisionText($szobaData['allapot']).'</td>
				<td>
                    <form method="post" action="'.$_SESSION['helper']->getPath().'/dashboard/apartman/reviewKezelo">
                        <input type="hidden" name="szobaID" value="'.$szobaData['id'].'"/>
                        <button class="editReview">Vélemények</button>
                    </form>
                </td>
				<td>
                    <form method="post" action="'.$_SESSION['helper']->getPath().'/dashboard/apartman/szobaRogzito">
                        <input type="hidden" name="id" value="'.$szobaData['id'].'"/>
                        <button class="editSzoba">Szerkesztés</button>
                    </form>
                </td>
				<td><button class="deleteSzoba">Törlés</button></td>	
			</tr>';
            
    	}
    }
  
    
    
    
    public function drawSzobaAdmin($elements){
    	
    	echo '<table class="tablaGrid">
			<tbody>
				<tr>
					<td><input type="hidden" name="id" value="'.$elements['szoba']['id'].'"/>
						<label>Neve</label></td>
					<td><input maxlength="80" type="text" name="text" title="Apartman neve" value="'.$elements['szoba']['header'].'" required/>
					<span class="tooltip">Apartman neve, max. 80 karakter</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Leírás</label></td>
					<td><textarea maxlength="1024" type="text" name="leiras" title="Apartman leírása" required>'.str_replace(array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;"), "\r\n", $elements['szoba']['desc']).'</textarea>
					<span class="tooltip">Apartman leírása, max. 1024 karakter</span></td>
					<td></td>
				</tr>
				<tr>
					<td>
						<label>Sorrend</label></td>
						<td><input type="number" min="1" name="sorrend" title="Sorrend" value="'.$elements['szoba']['sorrend'].'" required/>
						<span class="tooltip">Sorrend</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Látható</td>
					<td>
						 <select name="allapot" required>
		                    <option value=""></option>
		                    <option '.($elements['szoba']['visible'] ? '' : 'selected="selected"').' value="0">Inaktív</option>
		                    <option '.($elements['szoba']['visible'] ? 'selected="selected"' : '').' value="1">Látható</option>
		                    
		                </select>
		                <span class="tooltip">Látható legyen-e a Barcasban</span>
					</td>
					<td></td>
				</tr>
		';
    	
    	$kepSzamlalo = 1;
    	foreach ($elements['szoba']['kepek'] AS $kepAdat){
    		echo '<tr>
				<td><label>'.$kepSzamlalo.'. kép:</label></td>
				<td>
					<input readonly="readonly" type="text"  name="kep_'.$kepSzamlalo.'" alt="'.$kepSzamlalo.'. kép" value="'.basename($kepAdat['fajlnev']).'"/>
					<input type="number" data-id="'.$kepAdat['id'].'" name="kep_'.$kepSzamlalo.'_sorrend" alt="'.$kepSzamlalo.'. kép" value="'.$kepAdat['sorrend'].'" class="kepSorrend shortInput reactive"/>
					<button data-id="'.$kepAdat['id'].'" class="deleteKep">Törlés</button>
				</td>
				<td>
					<img src="'.$_SESSION['helper']->getPath().$kepAdat['fajlnev'].'" alt="'.$kepAdat['fajlnev'].'"/>
				</td>
			</tr>';
    		$kepSzamlalo++;
    	}
    	
    	if ($elements['szoba']['id'] != 0 && !is_null(($elements['szoba']['kepek']))){
	    	echo '<tr>
					<td><label>'.$kepSzamlalo.'. kép:</label></td>
					<td>
						<select class="imageRefTemplate" data-id="'.$elements['szoba']['id'].'" name="kep_'.$kepSzamlalo.'">
							<option value=""></option>
					';
	    	foreach ($elements['elerhetoKepek'] AS $kepAdat){
	    		echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['id'].'">'.basename($kepAdat['fajlnev']).'</option>';
	    	}
	    	echo '
				
						</select>
					</td>
					<td></td>';
    	}
    	echo '
			</tr>
			</tbody>
		</table>';
    }
}
?> 