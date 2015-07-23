<?php
class ImageView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
    
    
    public function getImages($elements){
        echo '<table class="tablaGrid kepTabla">
            <thead>
                <tr class="kategoriaRow">
                    <td>Előnézet</td>
                    <td>Kép neve</td>
                    <td>Galéria tag</td>
                    <td>Szekcióhoz</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>';
        
        foreach ($elements AS $kepData){
            $thumbPath = pathinfo($kepData['fajlnev'], PATHINFO_DIRNAME).'/th_'.basename($kepData['fajlnev']);
            
            $galeriaTagek = array(
                1   => 'Vendéglő',
                2   => 'Kert',
                3   => 'Delicates',
                4   => 'Apartman'
            );
            $szekcioNev = array(
                1   => 'Programok',
                2   => 'Rendezvények',
           		3   => 'Hírek',
           		4   => 'Szobák',
           		5   => 'Partnerek',
           		6   => 'Cikkek',
           		7   => 'Slide-k',
                8   => 'Dolgozók',
            	9	=> 'Termékek'
            );
            
            echo '<tr data-id="'.$kepData['id'].'">
                <td><img src="'.$_SESSION['helper']->getPath().$thumbPath.'" alt="'.$kepData['fajlnev'].'"/></td>
                <td>'.basename($kepData['fajlnev']).'</td>
                <td>
                    <select class="reactive" name="gallery_tag">
                        <option value=""></option>';
            foreach ($galeriaTagek AS $key => $val){
                echo '<option '.($kepData['gallery_tag'] == $key ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
            }
                        
                    echo '
                    </select>
                </td>
                <td>
                    <select class="reactive" name="szekcio">
                        <option value=""></option>';
            foreach ($szekcioNev AS $key => $val){
                echo '<option '.($kepData['szekcio'] == $key ? 'selected="selected"' : '').' value="'.$key.'">'.$val.'</option>';
            }
                echo '        
                    </select>
                </td>
                <td>
                	<form method="post" action="">
                      	<button class="deleteKep">Törlés</button>
	                </form>		
                </td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';
    }
}
?> 