<?php

class User extends BaseObject{
	
	function __construct($dbHandler){
        $this->objectType = 'User';
        
		parent::__construct($dbHandler);
	}
	
	private function getSalt(){
		return "jlm.2@#.#29OifqAmbE";
	}
	
	private function encodePass($pass){
		$salt = $this->getSalt();
		return hash('sha256', $salt.$pass);
	}
	
	
	public function authUser(){
		$res = array('status' => "nope");
		
		$checkUserSQL = "SELECT count(id) AS valid, id, jogosultsag_id, username, nev FROM koleves_dolgozok WHERE jelszav LIKE ? and email LIKE ? AND jogosultsag_id = 9;";
		$checkParams = array(
			$this->encodePass($_POST['p']),
			$_POST['u']
		); 
		$userRES = $this->fetchItem($checkUserSQL, $checkParams);
		
		if ($userRES['valid'] > 0){
			$res['status'] = "ok";
            $_SESSION['user']['id'] = $userRES['id'];
            $_SESSION['user']['jogosultsag_id'] = $userRES['jogosultsag_id'];
            $_SESSION['user']['username'] = $userRES['username'];
            $_SESSION['user']['nev'] = $userRES['nev'];
            $_SESSION['pref']['lang'] = 'hu';
		}
		
		echo json_encode($res);		
	}
	
	public function updateUser(){
    	$res = array();
    	
    	try{
    		$this->beginTransaction();
    		
    		$alreadyTakenSQL = "SELECT id FROM koleves_dolgozok WHERE email LIKE ?;";
    		
    		$takenParams = array(
    			$_POST['email']
    		);
    		$dolgozoAdat = $this->fetchItem($alreadyTakenSQL, $takenParams);
    		
    		/*
    		 * Új sor beszúrása
    		 */
    		if ($_POST['id'] == "0" && empty($dolgozoAdat)){
    			
    			$SQL = "INSERT INTO koleves_dolgozok SET username = ?, nev = ?, megjegyzes = ?, telefon = ?, email = ?, kep = ?, jelszav = ?, facebook = ?, allapot = ?, jogosultsag_id = ?, rendezvenyfelelos = ?;";
    			
    			$queryParams = array(
    				$_POST['username'],
    				$_POST['nev'],
    				$_POST['megjegyzes'],
    				$_POST['telefon'],
    				$_POST['email'],
                    empty($_POST['kep']) ? NULL : $_POST['kep'],
    				$this->encodePass($_POST['pass']),
    				empty($_POST['facebook']) ? NULL : $_POST['facebook'],
                    $_POST['allapot'],
                    $_POST['jogosultsag_id'],
                    $_POST['rendezvenyfelelos']
    			);
    			
    			$res['inputID'] = $this->insertItem($SQL, $queryParams);
    		}
    		/*
    		 * Meglévő sor updatelése
    		 */
    		else{
    			$SQL = "UPDATE koleves_dolgozok SET megjegyzes = ?, telefon = ?, email = ?, facebook = ?, nev = ?, kep = ?, allapot = ?, jogosultsag_id = ?, rendezvenyfelelos = ? WHERE id = ?;";
    			 
    			$queryParams = array(
    					$_POST['megjegyzes'],
    					$_POST['telefon'],
    					$_POST['email'],
    					$_POST['facebook'],
    					$_POST['nev'],
                        $_POST['kep'],
                        $_POST['allapot'],
                        $_POST['jogosultsag_id'],
                        $_POST['rendezvenyfelelos'],
    					$_POST['id']
    			);
    			 
    			$this->updateItem($SQL, $queryParams);
    			
    		}
    		
    		$res['status'] = "ok";
    		$this->commit();
    	}catch(Exception $e){
    		$res['status'] = "nope";
    		$this->rollback();
    	}
    		 
    	echo json_encode($res);
    } 
    
    
    public function updateJelszo(){
    	return false;
    }
    
    
    public function getUsersData($id = null){
        
        $SQL = "SELECT id, nev, username, kep, megjegyzes, facebook, email, telefon, allapot, jogosultsag_id, rendezvenyfelelos FROM koleves_dolgozok ".(!is_null($id) ? 'WHERE id = ?' : '');
        
        if (is_null($id)){
            return $this->fetchItems($SQL);
        }
        
        return $this->fetchItem($SQL, array($id));
    }
    
    
    public function loadUserData($id = null){
        $tmpArray = array(
            'id'    => '0',
            'username'  => '',
            'nev'   => '',
            'megjegyzes' => '',
            'telefon'   => '',
            'email' => '',
            'kep'   => '',
            'facebook'    => '',
            'rendezvenyfelelos' => '0',
            'jogosultsag_id'    => '1',
            'allapot'   => '1'
        );
        
        if (!is_null($id)){
            $tmpArray = $this->getUsersData($id);
        }
        
        return $tmpArray;
    }
    
    public function drawUserList(){
        $elements = $this->getUsersData();
        
        $this->view->drawUserList($elements);
    }
    
    
    public function loadKepek(){
        $SQL = "SELECT id, fajlnev FROM koleves_kepek WHERE szekcio = 3;";
        
        return $this->fetchItems($SQL);
    }
}
?>