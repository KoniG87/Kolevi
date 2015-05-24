<?php
class Application{
    private $parameters;
    private $db;
    
    function __construct($initParams){
        
        $this->parameters['directories'] = $initParams['dirs'];
		$this->parameters['database'] 	 = $initParams['dbParams'];
        $this->initDatabase();
    }
    
    public function getDbHandler(){
    	return $this->db;
    }
    
    public function isUserLogged(){
        return true;
    }
    
    public function drawHeader($loadWrapper = false){
        echo '<!doctype html>
        		<html>
        			<head>
        				 <meta charset="utf-8"/>
        				 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        				 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        				 <title>Kőleves::Vendéglő</title>
        				 <meta name="description" content=""/>

                        <!-- Favicon -->
                        <link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
                        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

                        <!-- Windows 8 Pinned Site 
                        <meta name="msapplication-TileImage" content="/pinsite.png">
                        <meta name="msapplication-TileColor" content="#ffffff">
                        <meta name="application-name" content="Kőleves">-->

        		<link rel="stylesheet" media="screen" type="text/css" href="assets/css/styles.min.css"/>
        		
        		<script src="assets/js/vendor/jquery-1.11.1.min.js"></script>
                <script src="https://www.google.com/recaptcha/api.js"></script>
        	</head>
        	<body>
        		<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        		';
        include('core/template/SVGsprite.php');
        
        if ($loadWrapper){
        	echo '<div id="wrapper">';
        }
    } 
    
    
        
    public function drawNav($loadWrapper = true, $subPage){
    	if ($loadWrapper){
    		echo '<div id="wrapper">';
    	}
    	else{
    		
    		$menuContents = array(
    				'hely'	=> array(
    						'showOn' => array(
    								'apartman'	=> 2
    						),
    						'labels' => array(
    								'hu'	=> 'A hely',
    								'en'	=> 'The place'
    						)
    				),
    				'szobak'	=> array(
    						'showOn' => array(
    								'apartman'	=> 3
    						),
    						'labels' => array(
    								'hu'	=> 'Szobák',
    								'en'	=> 'Rooms'
    						)
    				),
    				'terkep'	=> array(
    						'showOn' => array(
    								'apartman'	=> 1
    						),
    						'labels' => array(
    								'hu'	=> 'Térkép',
    								'en'	=> 'Map'
    						)
    				),
    				
    				'napiMenu'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 1
    						),
    						'labels' => array(
    								'hu'	=> 'Napi Menü',
    								'en'	=> 'Daily Menu'
    						)
    				),
    				'etlap'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 2,
    								'kert'		=> 2
    						),
    						'labels' => array(
    								'hu'	=> 'Étlap',
    								'en'	=> 'Foodz'
    						)
    				),
    				'asztalfoglalas'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 3
    						),
    						'labels' => array(
    								'hu'	=> 'Asztalfoglalás',
    								'en'	=> 'Reservation'
    						)
    				),
    				'rendezvenyek'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 4,
    								'kert'		=> 3
    						),
    						'labels' => array(
    								'hu'	=> 'Rendezvények',
    								'en'	=> 'Events'
    						)
    				),
    				'programok'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 5
    						),
    						'labels' => array(
    								'hu'	=> 'Programok',
    								'en'	=> 'Programok'
    						)
    				),
    				'rolunk'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 6,
    								'kert'		=> 1
    						),
    						'labels' => array(
    								'hu'	=> 'Rólunk',
    								'en'	=> 'About Us'
    						)
    				),
    				'kepek'	=> array(
    						'showOn' => array(
    								'vendeglo'	=> 7,
    								'kert'		=> 4,
    								'apartman'	=> 4
    						),
    						'labels' => array(
    								'hu'	=> 'Képek',
    								'en'	=> 'Pictures'
    						)
    				)
    				
    		);
    		$menuToShow = array();
    		
    		if ($_SESSION['helper']->getLang() == 'en'){
    			unset($menuContents['napiMenu']['showOn']['vendeglo']);
    		}
    		
    		
    		foreach ($menuContents AS $menuKey => $menuData){
    			if (in_array($subPage, array_keys($menuData['showOn']))){
    				$menuToShow[$menuData['showOn'][$subPage]][$menuKey] = $menuData['labels']['hu'];
    			}
    		}
    		
    	echo '<nav class="sitckyNav">
<a href="/kolevi/"><svg class="sticky-page-icon icon icon-'.$_SESSION['helper']->getPage().'-2"><use xlink:href="#icon-'.$_SESSION['helper']->getPage().'-2"></use></svg></a>
<svg class="icon icon-backtotop backToTop"><use xlink:href="#icon-backtotop"></use></svg>
    <div class="row">';
    	
    	    	
    	ksort($menuToShow);
    	    	    	
    	foreach ($menuToShow AS $sorrend => $linkInfo){
    		foreach ($linkInfo AS $key => $label){
    			echo '<a href="#'.$key.'"><span>'.$label.'</span>
	            <div class="diszvonal"></div>
	        <div class="sticky-fold">'.$label.'</div>
	        </a>';
    		}
    	}
    	
    	echo '
               
    </div>
    <div class="nav-info right" >
    	<a href="#footer">
    		<span>Info</span>
    		<svg class="icon icon-info"><use xlink:href="#icon-info"></use></svg></a>
    </div>
    <div class="langselect-container clearfix">
        <svg class="icon icon-lang-select langselect right"><use xlink:href="#icon-lang-select"></use></svg>
        <div class="left eng '.($_SESSION['helper']->getLang() == "en" ? 'lang-selected' : '') .'">Eng<span> / </span></div>
        <div class="right hun '.($_SESSION['helper']->getLang() == "hu" ? 'lang-selected' : '') .'">Hun</div>
    </div>
</nav>



<!-- MOBIL -->

    <a id="trigger" class="menu-trigger navicon-button x" title="menu"><div class="navicon"></div></a>
    
    <nav class="side-nav">
      <div class="side-nav-inner">
        <header>
            <svg class="icon icon-logo"><use xlink:href="#icon-logo"></use></svg>
            <!-- <h1>Vendéglő</h1> -->
            <div class="nav-info right" ><a href="#footer"><span>Info</span><svg class="icon icon-info"><use xlink:href="#icon-info"></use></svg></a></div>
            <div class="langselect-container clearfix">
                <svg class="icon icon-lang-select langselect right"><use xlink:href="#icon-lang-select"></use></svg>
                <div class="left eng '.($_SESSION['helper']->getLang() == "en" ? 'lang-selected' : '') .'">Eng<span> / </span></div>
                <div class="right hun '.($_SESSION['helper']->getLang() == "hu" ? 'lang-selected' : '') .'">Hun</div>
            </div>
        </header>
      <ul>
        <svg class="icon icon-vendeglo"><use xlink:href="#icon-vendeglo"></use></svg>
        '.($_SESSION['helper']->getLang() == 'hu' ? '<a href="vendeglo#napiMenu"><li>Napi menü</li></a>' : '').'
        <a href="vendeglo#etlap"><li>Étlap</li></a>
        <a href="vendeglo#asztalfoglalas"><li>Asztalfoglalás</li></a>
        <a href="vendeglo#rendezvenyek"><li>Rendezvények</li></a>
        <a href="vendeglo#programok"><li>Programok</li></a>
        <a href="vendeglo#rolunk"><li>Rólunk</li></a>
        <a href="vendeglo#kepek"><li>Képek</li></a>
      </ul>
      <ul>
        <svg class="icon icon-kert"><use xlink:href="#icon-kert"></use></svg>
        <a href="kert#rolunk"><li>Rólunk</li></a>
        <a href="kert#etlap"><li>Étlap</li></a>
        <a href="kert#rendezvenyek"><li>Rendezvények</li></a>
        <a href="kert#kepek"><li>Képek</li></a>
      </ul>
      <ul>
        <svg class="icon icon-apartman"><use xlink:href="#icon-apartman"></use></svg>
       <a href="apartman#terkep"><li>Térkép</li></a>
    		<a href="apartman#hely"><li>A hely</li></a>
        <a href="apartman#szobak"><li>Szobák</li></a>
        <a href="apartman#kepek"><li>Képek</li></a>

      </ul>
      <ul>
        <svg class="icon icon-delicates"><use xlink:href="#icon-delicates"></use></svg>
        '.(false ? '<a href=""><li>valami</li></a>
        <a href=""><li>valami</li></a>
        <a href=""><li>valami</li></a>
        <a href=""><li>valami</li></a>
        <a href=""><li>valami</li></a>' : '<li>Hamarosan</li>').'
      </ul>
      </div>
    </nav>';
    	}

    }
    
    
    
    public function drawFooter(){
        $facebookLink = 'http://graph.facebook.com/Koleves/';
        $socNumbers = array(
            'facebook'  => 'n/a',
            'tripadvisor'   => '4+<br/>(544 reviews)',
            'googleplus'    => '4.5*<br/>(69 reviews)'
        );
        try{
            $fbResp = file_get_contents($facebookLink);
            $fbInfo = json_decode($fbResp, true);
            
            $socNumbers['facebook'] = number_format($fbInfo['likes'], 0, ',', '.');
        }catch(Exception $e){
        
        }
        
    	echo '</div>
        	<footer id="footer">
               <div class="f-row clearfix">
		<div class="f-contact left">
			<div class="rend-ikon"><svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg>+36 20 2135 999, &nbsp;  + 36 1 322 1011</div>
			<div class="rend-ikon" style="text-transform:lowercase;"><svg class="icon icon-mail"><use xlink:href="#icon-mail"></use></svg>asztalfoglalas@koleves.com, &nbsp; reservation@koleves.com,  &nbsp;info@koleves.com</div>
			<div class="rend-ikon"><svg class="icon icon-map"><use xlink:href="#icon-map"></use></svg>kazinczy utca 41., budapest, hungary, 1075</div>
		</div>
		<div class="f-nyitvatartas right">
		      <div class="diszvonal-vert left"></div>
			<svg class="icon icon-ora left"><use xlink:href="#icon-ora"></use></svg>
			<article class="right">
				<h4>nyitvatartás</h4>
    
				<p>Mon - Fri:</p>
				<p>8:00 am - 12:00 am</p>
				<p>Sat - Sun:</p>
				<p>9:00 am - 12:00 am</p>
			</article>
		</div>
	</div>
	<div class="diszvonal"></div>
	<div class="f-row clearfix">
		<div class="f-sitemap left clearfix">
			<ul>
				<h4>étterem</h4>
				<a href="vendeglo#napiMenu"><li>Napi menü</li></a>
				<a href="vendeglo#etlap"><li>Étlap</li></a>
				<a href="vendeglo#asztalfoglalas"><li>Asztalfoglalás</li></a>
				<a href="vendeglo#rendezvenyek"><li>Rendezvények</li></a>
				<a href="vendeglo#programok"><li>Programok</li></a>
				<a href="vendeglo#rolunk"><li>Rólunk</li></a>
				<a href="vendeglo#kepek"><li>Képek</li></a>
			</ul>
			<ul>
				<h4>kert</h4>
                <a href="kert#rolunk"><li>Rólunk</li></a>
				<a href="kert#etlap"><li>Étlap</li></a>
                <a href="kert#rendezvenyek"><li>Rendezvények</li></a>
                <a href="kert#kepek"><li>Képek</li></a>
			</ul>
			<ul>
				<h4>apartman</h4>
				<a href="apartman#terkep"><li>Térkép</li></a>
    			<a href="apartman#hely"><li>A hely</li></a>
				<a href="apartman#szobak"><li>Szobák</li></a>
				<a href="apartman#kepek"><li>Képek</li></a>    
			</ul>
			<ul>
				<h4>delicates</h4>
				'.(false ? '<a href=""><li>valami</li></a>
				<a href=""><li>valami</li></a>
				<a href=""><li>valami</li></a>
				<a href=""><li>valami</li></a>
				<a href=""><li>valami</li></a>' : '<li>Hamarosan</li>').'
			</ul>
            <div class="diszvonal-vert" style="right:0;"></div>
		</div>
		<div class="socials right clearfix">
	<div class="social-link">
		<svg class="icon icon-facebook-original left facebook-share"><use xlink:href="#icon-facebook-original"></use></svg>
		<p class="facebook-count"></p>
        <p>Facebook</p>
	</div>

<a target="_blank" href="http://www.tripadvisor.co.hu/Restaurant_Review-g274887-d797853-Reviews-Koleves-Budapest_Central_Hungary.html">
	<div class="social-link">
		<svg class="icon icon-trip-original left"><use xlink:href="#icon-trip-original"></use></svg>
		<p>'.$socNumbers['tripadvisor'].'</p>
        <p>TripAdvisor</p>
	</div>
</a>

	<div class="social-link">
		<svg class="icon icon-google-original left gplus-share"><use xlink:href="#icon-google-original"></use></svg>
		<p class="gplus-count"></p>
        <p>GooglePlus</p>
	</div>

		</div>
	</div>
	<div class="diszvonal"></div>
	<div class="f-row">
    
    
		<div class="copyright">
			<a href="http://halluci-nation.com/"><img src="assets/img/halu_logo.png" alt="Created by Halluci-Nation" title="Created by Halluci-Nation"><img src="assets/img/h_logo.png" alt="Created by Halluci-Nation" title="Created by Halluci-Nation" class="h-logo"></a>
		</div>
	</div>
            </footer>
    
    			<!-- &lsaquo; &rsaquo;-->
        <script id="calendar-template" type="text/template">
          <div class="controls ">
            <div class="month-controls right ">
            <div class=""><svg class="icon icon-nyil-balra clndr-previous-button"><use xlink:href="#icon-nyil-balra"></use></svg></div><div class="year left"><%= year %></div><div class="month left"><%= month %></div><div class=""><svg class="icon icon-nyil-jobbra clndr-next-button"><use xlink:href="#icon-nyil-jobbra"></use></svg></div>
              </div>
              <div class="headers ">
                <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
              </div>
          </div>
    
          <div class="days-container clearfix">
            <div class="days ">
              <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
            </div>
          </div>
        </script>';
    }
    
    
    public function drawPageClosure($subPage){
    	echo '
			<script type="text/javascript">
    			$(document).ready(function(){
    				navCounter = 1;
    				$(".sitckyNav div.row a").each(function(){
    					navLabel = $(this).attr("href").substring(1);
    					$(".section-label label[for=\""+navLabel+"\"]").parent().attr("data-labelpos", navCounter);
    					navCounter += 1; 
    				}).promise().done(function(){
    					
    				});	
    		});
    			</script>
    		<script src="assets/js/plugins.min.js"></script>
        	<script src="assets/js/main.min.js"></script>
    	';
    
    	$subPageScriptPath = 'assets/js/'.$subPage.'.min.js';
    	if (file_exists($subPageScriptPath)){
    		echo '<script src="'.$subPageScriptPath.'"></script>';
    	}
    	
    	echo '
    		<script type="text/javascript">
    			$(document).ready(function(){
					var contents = $("#nl-form").html();
					
                    $(document).on("submit","#nl-form",function(e){
                      e.preventDefault();
                      
                      
                      foglalasData = {
                        request: "asztalfoglalasUpdate",
                        nev: $("input[name=\"nev\"]" , $(this)).val(),
                        datum: $("input[name=\"datum\"]" , $(this)).val(),
                        ido: $("input[name=\"ido\"]" , $(this)).val(),
                        id:  $("input[name=\"id\"]" , $(this)).val(),
                        hanyfo: $("select[name=\"hanyfo\"]" , $(this)).val(),
                        email: $("input[name=\"email\"]" , $(this)).val(),
                        megjegyzes: $("input[name=\"megjegyzes\"]" , $(this)).val()               
                      };
                          

                      $.post("requestHandler.php", foglalasData, function(resp){
                        
                           $("#nl-form").fadeToggle();
                           setTimeout(function(){
                      	      $("#nl-form").html("<h3>Asztalfoglalás megörtént!</h3><br/>Köszi, hogy betértél hozzánk! Hamarosan visszaigazolunk a megadott email címen, hogy a megadott időpontban tudjuk-e biztosítani a kért helyeket.<div class=\"nl-submit-wrap\"><button class=\"nl-reset\" type=\"submit\">Újbóli foglalás</button></div>");
                        	    $("#nl-form").fadeToggle();
                            	$(".nl-reset").Svgenerate({rangeX:0.94,rangeY:0.91,});
                           }, 350);
                         
                      }, "json");
                    
                    });
					
					$(document).on("click", ".nl-reset", function(e){
						e.preventDefault();
						$("#nl-form").fadeToggle();
					   setTimeout(function(){
                            $("#nl-form").html(contents);
                            $("#nl-form").fadeToggle();
                            
					   }, 350);
					});
    			
    				
    				$(".tag-label.tag-'.$_SESSION['helper']->getPage().'").trigger("click");
    		
    				$(".langselect-container div").click(function(){
    					data = {
    						request: "switchLanguage",
    						lang: $(this).text().substring(0, 2).toLowerCase()
    					};
    					$.post("requestHandler.php", data, function(resp){
    						location.reload();
    					});
    				});
    			});	
    		</script>
        		</body>
        		</html>';
    }
    
    
    
    private function initDatabase(){
		try{
			$this->db = new PDO("mysql:host=".$this->parameters['database']['host'].';dbname='.$this->parameters['database']['name'], $this->parameters['database']['userName'], $this->parameters['database']['userPass']);
			$this->db->exec("SET CHARACTER SET utf8");
		} catch (Exception $e){
			echo '<html>
        	<head>
	            <meta charset="utf-8"/>
            	<title>Kőleves :: Átmenetileg nem elérhető</title>
        	</head>
        	<body>
				<p class="message notification">adatbázis átmenetileg nem elérhető<br/>próbálja újra hamarosan</p>
				<style type="text/css">.message{font-weight:bold;text-align:center;padding:0.5em 0.8em;border-radius:0.35em;font-size:1.1em;box-shadow:1px 1px 3px 1px #555;display:block;min-width:17em;max-width:25em;margin:0 auto;font-variant:small-caps;letter-spacing:1.5px;}.message.notification{background:#f3d8b2;box-shadow:1px 1px 3px 1px #7e5c2b;}</style>
            	</body>
        	</html>';
            
			exit;
		}
	}
    
    public function generateView($viewName){
        $viewFile = $this->parameters['directories']['views'] . $viewName .'.php';
        $scriptFile = $this->parameters['directories']['skins'] . $this->parameters['skin'] . '/func/'. $viewName.'.js';
        
		if ($viewName != 'process' && !isset($_POST['formSubmitted'])){
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
    

	public function initHelper($params){
		$_SESSION['helper'] = new Helper($params);
	}
    
}
?>