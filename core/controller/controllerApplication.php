<?php
class Application{
    private $parameters;
    
    function __construct($initParams){
        $this->drawHeader();
        $this->drawFooter();
        
        $this->parameters['directories'] = $initParams['dirs'];
		$this->parameters['database'] 	 = $initParams['dbParams'];
        $this->initDatabase();
    }
    
    function isUserLogged(){
        return true;
    }
    
    private function drawHeader(){
        echo '<!doctype html><html><head><meta charset="utf-8"/><title>Kőleves</title><link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css"/></head><body>';
    } 
    
    private function drawFooter(){
        echo '</body></html>';
    } 
    
    private function initDatabase(){
		try{
			$this->db = new PDO("mysql:host=".$this->parameters['database']['host'].';dbname='.$this->parameters['database']['name'], $this->parameters['database']['userName'], $this->parameters['database']['userPass']);
			$this->db->exec("SET CHARACTER SET utf8");
		} catch (Exception $e){
			/*echo '<html>
        <head>
            <meta charset="utf-8"/>
            <title>Kőleves :: Átmenetileg nem elérhető</title>
        </head>
        <body>
			<p class="message notification">adatbázis átmenetileg nem elérhető<br/>próbálja újra hamarosan</p>
			<style type="text/css">body{background:url(skins/default/img/bgElement.png);}.message{font-weight:bold;text-align:center;padding:0.5em 0.8em;border-radius:0.35em;font-size:1.1em;box-shadow:1px 1px 3px 1px #555;display:block;min-width:17em;max-width:25em;margin:0 auto;font-variant:small-caps;letter-spacing:1.5px;}.message.notification{background:#f3d8b2;box-shadow:1px 1px 3px 1px #7e5c2b;}</style>
            </body>
        </html>';*/
            echo '..adatbázis: off';
			//exit;
		}
	}
    
    public function generateView($viewName){
        $viewFile = $this->parameters['directories']['views'] . $viewName .'.php';
        $scriptFile = $this->parameters['directories']['skins'] . $this->parameters['skin'] . '/func/'. $viewName.'.js';
        
		if ($viewName != 'process' && !isset($_POST['formSubmitted'])){
		//if ($viewName != 'process' && $viewName != 'home' && !isset($_POST['formSubmitted'])){
			echo '<script type="text/javascript">';
			include($this->parameters['directories']['skins'] . $this->parameters['skin'] . '/func/default.js');
			if (file_exists($scriptFile)){
			   include($scriptFile);
			}
			echo '</script>';
			
			switch ($viewName){
				case 'login': case 'home': case 'raktarAllapot': case 'szallitasiDatum': case 'szallitasiAdatok': case 'pakolasiLap': case 'karantenozoLap': case 'mboLap': case 'betaroloLap': case 'kirakodoLap': case 'kirakodasElorejelzes':
					$containerName = 'content';
					break;
				default:
					$containerName = 'container';
			}
			
			
			echo '<h1>'.($this->appState == 'dev' ? 'View::'.ucfirst($viewName) : '&nbsp;').'</h1>
			<div id="'.$containerName.'">';
			
        
		}
		
		include($viewFile);
    }

		
	public function redirect($link = '.', $passParams = array()){
		$redirectQuery = '<form id="returnForm" name="returnForm" method="post" action="'.$link.'">';
		
		foreach ($passParams AS $param){
			$redirectQuery .= '<input type="hidden" name="'.$param['name'].'" value="'.$param['value'].'"/>';
		}
		$redirectQuery .= '	
			</form>
			<script type="text/javascript">
				document.returnForm.submit();
			</script>';
			
		echo $redirectQuery;
	}
}
?>