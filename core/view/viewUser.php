<?php

class UserView extends BaseView{
	
	function __construct(){
		/*$valtozo < template/kajaMenu.php
		
		$valtozo */
        
	}
       
    public function drawUserList($elements){
        if (sizeof($elements) > 0){
            foreach($elements AS $userData){
                echo '<tr data-id="'.$userData['id'].'">
                <td><img src="'.$_SESSION['helper']->getPath().$userData['kep'].'" alt="'.$userData['username'].'" title="'.$userData['nev'].'" style="width:5em;"/></td>
                <td>'.$userData['nev'].'</td>
                <td>
                    <form method="post" action="'.$_SESSION['helper']->getPath().'dashboard/userRogzito">
                        <input type="hidden" name="userID" value="'.$userData['id'].'"/>
                        <button class="editEtel">Szerkesztés</button>
                
                    </form>
			     </td>
                </tr>';
            }
        }
    }
}
?>