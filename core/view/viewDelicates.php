<?php
class DelicatesView extends BaseView{
	
	function __construct(){
		
        
	}
    
	
	
	public function drawSliderAdmin($elements){
		echo '
	   	<section class="kategoriaEditor">
    		<button id="addSlide">Akció rögzítése</button>
		
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
					<td>Leírás</td>
					<td>
	
						<input type="text" maxlength="1024" title="Leírás" name="leiras" value="" required/>
						<span class="tooltip">Leírás, max. 1024 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Tag-ek</td>
					<td>
	
						<input type="text" maxlength="255" title="Tag-ek" name="tag" value="" required/>
						<span class="tooltip">Tag-ek, max. 255 karakter</span>
					</td>
				</tr>
	
				
				<tr>
					<td>Slide képe:</label></td>
				<td>
					<select class="imageRefTemplate" name="kep" title="Slide képe" required>
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
					<td>Ár:</label></td>
				<td>
					<input type="text" title="Ár" name="ar" value="" required/>
					<span class="tooltip">Ár</span>
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
	
	
	
	
    		<h2>Akciók</h2>
	
			<table class="tablaGrid striped slideTabla">
				<thead>
					<tr>
						<th>Kép</th>
						<th>Cím</th>
						<th class="wideHeader">Leírás</th>
						<th>Tagek</th>
						<th>Sorrend</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>';
	
		foreach ($elements['akciok'] AS $key => $slideAdat){
			
				echo '<tr data-id="'.$slideAdat['id'].'" data-ar="'.$slideAdat['ar'].'">
						<td><img data-original="'.$slideAdat['kep'].'" src="'.$this->getThumbnailPath($_SESSION['helper']->getPath().$slideAdat['kep']).'" alt=""/></td>
						<td>'.$slideAdat['labelHeader'].'</td>
						<td>'.$slideAdat['labelDesc'].'</td>
						<td>'.$slideAdat['labelTag'].'</td>
						<td>'.$slideAdat['sorrend'].'</td>
						<td><button class="editSlide">Szerkesztés</button></td>
						<td><button class="deleteSlide">Törlés</button></td>
					</tr>';
			}
		
	
		echo '</tbody>
				</table>';
		
	}
	
	
	
	
	
	public function drawKategoriaAdmin($elements){
		$kategoriaNevek = array();
		foreach ($elements['kategoriak'] AS $key => $kategoriaAdat){
			array_push($kategoriaNevek, array('id' => $kategoriaAdat['id'], 'text' => $kategoriaAdat['labelHeader']));
		}
		
		echo '
	   	<section class="kategoriaEditor">
    		<button id="addKategoria">Kategória rögzítése</button>
	
			<table class="tablaGrid" >
				<tr>
					<td>Főkategória</td>
					<td>
    					<input type="hidden" name="id" value="0"/>
						<select name="kategoria" title="Főkategória" value="" required>
							<option value=""></option>';
				foreach ($kategoriaNevek AS $kategoriaAdat){
					echo '<option value="'.$kategoriaAdat['id'].'">'.$kategoriaAdat['text'].'</option>';
				}
				echo '
						</select>
						<span class="tooltip">Főkategória</span>
					</td>
				</tr>
				<tr>
					<td>Cím</td>
					<td>
						
						<input type="text" maxlength="128" title="Cím" name="text" value="" required/>
						<span class="tooltip">Cím, max. 128 karakter</span>
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
	
	
	
	
    		<h2>Akciók</h2>
	
			<table class="tablaGrid kategoriaTabla">
				
				<tbody>';
	
		foreach ($elements['kategoriak'] AS $kategoriaAdat){
			echo '<tr class="kategoriaRow">
					<td colspan="4">'.$kategoriaAdat['labelHeader'].'</td>
					</tr>
					';
			foreach ($kategoriaAdat['alkategoriak'] AS $alkategoriaAdat){
				
				echo '<tr data-id="'.$alkategoriaAdat['id'].'" data-kategoria="'.$alkategoriaAdat['fokategoria_id'].'">
						<td >'.$alkategoriaAdat['labelHeader'].'</td>
						<td >'.$alkategoriaAdat['sorrend'].'</td>
						<td><button class="editKategoria">Szerkesztés</button></td>
						<td><button class="deleteKategoria">Törlés</button></td>
						</tr>';
			}
			
		}
	
	
		echo '</tbody>
				</table>';
	
	}
	
	
	private function drawKategoriaAccordion($elements){
		
		foreach ($elements AS $kategoriaData){
			echo '
			<div class="'.$kategoriaData['icon'].' bolt-acco-container">
				<div class="bolt-acco-illustration">
					<svg class="icon icon-'.$kategoriaData['icon'].'"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-'.$kategoriaData['icon'].'"></use></svg>
				</div>
				<ul class="bolt-acco">
					<div class="bolt-acco-head">'.$kategoriaData['labelHeader'].'</div>';
			
			foreach ($kategoriaData['alkategoriak'] AS $alkategoriaData){
				echo '<li data-kategoria="'. $kategoriaData['icon'] .'" data-id="'. $alkategoriaData['id'] .'">'.$alkategoriaData['labelHeader'].'</li>';
			} 
			
			echo '
				</ul>
			</div>';	
		}
		
	}
	
	
	
	public function drawMegrendelesAdmin($elements){
		echo '
	   	<section class="megrendelesEditor">
    		<button id="addTermek">Megrendelés rögzítése</button>
	
			<table class="tablaGrid" >
				<tr>
					<td>Név</td>
					<td style="width:200px;">
						<input type="hidden" name="id" value="0"/>
						<input type="text" maxlength="80" title="Név" name="nev" value="" required/>
						<span class="tooltip">név, max. 80 karakter</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
	
						<input type="text" maxlength="80" title="Email" name="email" value="" required/>
						<span class="tooltip">Email, max. 80 karakter</span>
					</td>
					<td></td>	
				</tr>
				<tr class="headerEnd">
					<td>Megjegyzés</td>
					<td>
						<textarea maxlength="2048" title="Megjegyzés" name="megjegyzes"  required></textarea>
						
						<span class="tooltip">Megjegyzés, max. 2048 karakter</span>
					</td>
					<td></td>
				</tr>
	
	
		</table>
		</section>
		
    	<h2>'.$elements['allapot'].' megrendelések</h2>
	
		<table class="tablaGrid striped megrendelesTabla">
			<thead>
				<tr>
					<th>Név</th>
					<th>Email</th>
					<th class="wideHeader">Megjegyzés</th>
					<th>Összérték</th>
					<th></th>
					<th></th>
				</tr>
			</thead>			
			<tbody>';
	
		foreach ($elements['megrendelesek'] AS $megrendelesAdat){
			echo '<tr data-id="'.$megrendelesAdat['id'].'" data-termekek="'.str_replace('"', '\'', json_encode($megrendelesAdat['termekek'])).'">
				 <td>'.$megrendelesAdat['nev'].'</td>
				 <td>'.$megrendelesAdat['email'].'</td>
				 <td>'.$megrendelesAdat['megjegyzes'].'</td>
				 <td>'.number_format($megrendelesAdat['osszertek'], 0, '.', ' ').'</td>
				 <td><button class="editMegrendeles">Szerkesztés</button></td>
				 <td><button class="deleteMegrendeles">Törlés</button></td>
				 </tr>';
			
	
		}
	
	
		echo '</tbody>
				</table>';
	
	}
	
	public function drawTermekAdmin($elements){
		echo '
	   	<section class="kategoriaEditor">
    		<button id="addTermek">Termék rögzítése</button>
	
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
					<td>Leírás</td>
					<td>
	
						<textarea maxlength="1024" title="Leírás" name="leiras" value="" required>
				
						</textarea>
						<span class="tooltip">Leírás, max. 1024 karakter</span>
					</td>
				</tr>
				<tr>
					<td>Tag-ek</td>
					<td>
	
						<input type="text" maxlength="255" title="Tag-ek" name="tag" value="" required/>
						<span class="tooltip">Tag-ek, max. 255 karakter</span>
					</td>
				</tr>
	
	
				<tr>
					<td>Kezdőkép:</label></td>
				<td>
					<select class="imageRefTemplate" name="kep" title="Kezdőkép" required>
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['fajlnev'].'">'.$kepAdat['fajlnev'].'</option>';
		}
		echo '
					</select>
					<span class="tooltip">Kezdőkép</span>
				</td>
			</tr>
	
			<tr>
					<td>Ár:</label></td>
				<td>
					<input type="text" title="Ár" name="ar" value="" required/>
					<span class="tooltip">Ár</span>
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
	
	
    	<h2>Termékek</h2>
	
		<table class="tablaGrid kategoriaTabla">
			<tbody>';
	
		foreach ($elements['kategoriak'] AS $kategoriaAdat){
			echo '<tr class="kategoriaRow">
					<td colspan="8">'.$kategoriaAdat['labelHeader'].'</td>
					</tr>
					';
			foreach ($kategoriaAdat['alkategoriak'] AS $alkategoriaAdat){
				
				echo '<tr class="alKategoriaRow">
						<td colspan="8">Alkategória: <strong>'.$alkategoriaAdat['labelHeader'].'</strong></td>
						
						</tr>';
				
				foreach ($alkategoriaAdat['termekek'] AS $termekAdat){
					echo '<tr data-id="'.$termekAdat['id'].'">
						<td><img src="'.$_SESSION['helper']->getPath().$termekAdat['kiskep'].'" alt="'.$termekAdat['nagykep'].'"/></td>
						<td>'.$termekAdat['labelHeader'].'</td>
						<td>'.$termekAdat['labelDesc'].'</td>
						<td>'.$termekAdat['ar'].'</td>
						<td>'.$termekAdat['labelTag'].'</td>
						<td>'.$termekAdat['sorrend'].'</td>
						<td><button class="editTermek">Szerkesztés</button></td>
						<td><button class="deleteTermek">Törlés</button></td>
						</tr>';
				}
			}
				
		}
	
	
		echo '</tbody>
				</table>';
	
	}
	
	
	
	public function drawSlider($elements){
		echo '<section id="delicates">';
		$this->drawSectionLabel("Delicates", "delicates", 1);
			
		echo '
			<div class="row clearfix">
				<div class="twelve columns centered delicates-slider">
		';
		
		foreach ($elements['slidek'] AS $slideData){
			echo '<div class="delicates-slide">
				<div class="delicates-slide-img">
					<img src="'.$slideData['kep'].'" alt="" title="">
				</div>
				<aside>
					<h4>'.$slideData['labelHeader'].'</h4>
					<p>'.$slideData['labelDesc'].'</p>
					'.(!is_null($slideData['labelTag']) ? '<p>'.$slideData['labelTag'].'</p>' : '').'		
					<h5>'.number_format($slideData['ar'], 0, '.', ' ').' Ft</h5>
				</aside>
			</div>';
		
		}
		echo '
				</div>
			</div>
		
		
			<div class="row delicatesrol-bemutatkozas">
				<div class="twelve columns centered">
					<h3>Kedves vásárló</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, qui, ex? Temporibus natus at ad ducimus fuga sunt, odit quo fugiat recusandae cum cumque provident, deleniti, perspiciatis et incidunt vero placeat quia qui! Voluptatibus, nostrum nam repudiandae dicta, harum voluptatum.</p>
				</div>
			</div>
		
			<div class="row delicatesrol-acco">
				<div class="ten columns centered">
			';
		$this->drawKategoriaAccordion($elements['kategoriak']);			
				
		echo '
				</div>
			</div>
		</section>';
	}
	
	
	
	public function drawBolt($elements){
		echo '<!-- BOLT -->
<section id="bolt">';

		$this->drawSectionLabel("Bolt", "bolt", 2);
	
	echo '

	<div class="row">
		<div class="three columns clearfix">';
			
		$this->drawKategoriaAccordion($elements['kategoriak']);
		
		echo '
		</div>
		<div class="nine columns clearfix">
			<div class="bolt-search">
			<svg class="icon icon-kereso"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-kereso"></use></svg>
				<form id="searchForm" action="">
				
					<svg class="icon icon-nagyito"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-nagyito"></use></svg>
					<input type="search" class="productSearchField" placeholder="keresés">
				</form>
			</div>

			<div class="bolt-grid">

<!-- IDE TOLD BE AZ ÖSSZES TERMÉKET (BOLT-GRID-ELEMENT) ! SEMMI <H3>, SEMMI SZŰKITÉS-->

			</div>
		</div>
	</div>
</section>';
	}
	
	
	public function drawCheckout($elements){
		echo json_encode($elements['termekek']);
	
	}
	
	
	public function drawProductPage($elements){
		echo json_encode($elements['termek']);
		
	}
	
	
	public function drawBoltKategoriaTermekek($elements){
		foreach ($elements['termekek'] AS $termekAdat){
			echo '
			<div class="bolt-grid-element" data-id="'.$termekAdat['id'].'">
				<a href="">
					<div class="bolt-grid-element-img" style="height: 162px;">
						<img src="'.$termekAdat['kiskep'].'" alt="">
						<svg class="svg-dropShadow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 162 162" preserveAspectRatio="none" style="position:absolute;z-index:-1;left:40px;top:40px;filter: blur(3px);-webkit-filter: blur(3px);"><defs></defs><polygon fill="rgba(0,0,0,0.2)" points="151.7723587386869,156.51972304003314 108.6086400487081,153.11276621779427 5.2634543188847545,154.14037702976725 5.047810207167629,59.869914068824464 6.219244894660079,2.9791638510441203 69.30165562701654,4.103926579481936 161.6820746989455,5.529374749632552 158.16217355797068,55.51234508029607 "></polygon></svg><svg class="svg-maskedImg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 162 162" preserveAspectRatio="none"><defs><clipPath id="img-mask-432"><polygon fill="#000" stroke="rgba(0,0,0,0)" stroke-width="0" points="151.7723587386869,156.51972304003314 108.6086400487081,153.11276621779427 5.2634543188847545,154.14037702976725 5.047810207167629,59.869914068824464 6.219244894660079,2.9791638510441203 69.30165562701654,4.103926579481936 161.6820746989455,5.529374749632552 158.16217355797068,55.51234508029607 "></polygon></clipPath></defs><image height="100%" width="100%" clip-path="url(#img-mask-432)" xlink:href="assets/uploads/th_gallery04.jpg"></image></svg>
					</div>
					<h4>'.$termekAdat['labelHeader'].'</h4>
					<h5>'.number_format($termekAdat['ar'], 0, ' ', '.').' Ft</h5>
				</a>
			</div>';	
		}
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
                                <h3>'.$programData['labelHeader'].'</h3>
                                <p>'.$programData['labelDesc'].'</p>
                                '.(!empty($programData['fblink']) ? '<a target="_blank" href="'.$programData['fblink'].'">facebook esemény</a>' : '').'
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
					<td><input maxlength="75" title="Cím" type="text" name="text_hu" value="'.$elements['rendezveny']['MEGNEVEZES'].'" required/>
					<span class="tooltip">Cím, max. 75 karakter</span>
					</td>
					<td></td>
				</tr>
				<tr>
					<td><label>Leírás</label></td>
					<td><textarea maxlength="1024" title="Leírás" type="text" name="leiras_hu" required>'.$elements['rendezveny']['MEGJEGYZES'].'</textarea>
					<span class="tooltip">Leírás, max. 1024 karakter</span></td>
					<td></td>
				</tr>
		';

		$kepSzamlalo = 1;
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
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
			</tr>
			</tbody>
		</table>';
	}
  
	
	
	
	
	
	public function drawPartnerAdmin($elements){
					
		echo '
	
    	<section class="kategoriaEditor">
    			<button id="addEtel">Partner rögzítése</button>
    
				<table class="tablaGrid" >
				<tr>
					<td>Megnevezés</td>
					<td>
						
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
					<td>Partner képe:</label></td>
				<td>
					<select class="imageRefTemplate" title="Partner képe" name="kep" required>
						<option value=""></option>
				';
		foreach ($elements['elerhetoKepek'] AS $kepAdat){
			echo '<option data-fullpath="'.$kepAdat['fajlnev'].'" value="'.$kepAdat['id'].'">'.basename($kepAdat['fajlnev']).'</option>';
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
			echo '<tr data-id="'.$partnerAdat['id'].'">
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
            echo '<tr data-id="'.$hirData['id'].'" data-url="'.$hirData['url'].'" data-tipus="'.$hirData['tipus_id'].'" data-allapot="'.$hirData['allapot'].'" data-bejegyzes="'.$hirData['fk_id'].'">
                
                <td>'.$hirData['felirat'].'</td>
                <td>'.getDecisionText($hirData['allapot']).'</td>
                <td><button class="editHir">Szerkesztés</button></td>
                <td><button class="deleteHir">Törlés</button></td>
            </tr>';
        }
    }
}
?> 