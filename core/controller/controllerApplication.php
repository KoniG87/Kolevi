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

        		<link rel="stylesheet" media="screen" type="text/css" href="'.$_SESSION['helper']->getPath('styles').'styles.min.css"/>
        		
        		<script src="'.$_SESSION['helper']->getPath('scripts').'vendor/jquery-1.11.1.min.js"></script>
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
    								'apartman'	=> 4,
    								'delicates'	=> 3
    						),
    						'labels' => array(
    								'hu'	=> 'Képek',
    								'en'	=> 'Pictures'
    						)
    				),
    				'delicates'	=> array(
    						'showOn' => array(
    							'delicates'	=> 1
    						),
    						'labels' => array(
    							'hu'	=> 'Delicates',
    							'en'	=> 'Delicates'
    						)
    				),
    				'bolt'	=> array(
    						'showOn' => array(
    							'delicates'	=> 2
    						),
    						'labels' => array(
    							'hu'	=> 'Bolt',
    							'en'	=> 'Shop'
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
    		
    	echo '<nav class="sitckyNav">';

	/* KOSAR CSAK DELICATESNÉL */    	
	if ($_SESSION['helper']->getPage() == 'delicates'){
		echo '<div class="kosar">
			<svg class="icon icon-kosar"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-kosar"></use></svg>
			<span>'.$_SESSION['helper']->getKosarEgysegek().'</span>
			<p>Kosár</p>
		</div>';
	}    	
	
	echo '
	<a href="" class="sticky-logo"><svg class="sticky-page-icon icon icon-'.$_SESSION['helper']->getPage().'-2"><use xlink:href="#icon-'.$_SESSION['helper']->getPage().'-2"></use></svg></a>
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
            <!-- <h1>Vendéglő</h1> -->';

    if ($_SESSION['helper']->getPage() == 'delicates'){
        echo '<div class="kosar">
            <svg class="icon icon-kosar"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-kosar"></use></svg>
            <span>'.$_SESSION['helper']->getKosarEgysegek().'</span>
            <p>Kosár</p>
        </div>';
    }  
            echo '<div class="nav-info right" ><a href="#footer"><span>Info</span><svg class="icon icon-info"><use xlink:href="#icon-info"></use></svg></a></div>
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
        <a href="delicates#delicates"><li>Delicatesről</li></a>
        <a href="delicates#bolt"><li>Bolt</li></a>
        <a href="delicates#kepek"><li>Képek</li></a>
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
            //$fbResp = file_get_contents($facebookLink);
        	$fbResp = '{likes:"0"}';
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
            <div class="rend-ikon"><svg class="icon icon-epitesz"><use xlink:href="#icon-epitesz"></use></svg>belső építész: <a href="mailto:langer.vera@gmail.com?Subject=Hello%20again" target="_top">Langer Vera</a></div>
		</div>
		<div class="f-nyitvatartas right">
		      <div class="diszvonal-vert left"></div>
			<svg class="icon icon-ora left"><use xlink:href="#icon-ora"></use></svg>
			<article class="right">
				<h4>nyitvatartás</h4>
    
				<p>Hétfő - Péntek:</p>
				<p>8:00 - 12:00</p>
				<p>Szombat - Vasárnap:</p>
				<p>9:00 - 12:00</p>
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
                <a href="delicates#delicates"><li>Delicatesről</li></a>
                <a href="delicates#bolt"><li>Bolt</li></a>
                <a href="delicates#kepek"><li>Képek</li></a>
			</ul>
            <div class="diszvonal-vert" style="right:0;"></div>
		</div>
		<div class="socials right clearfix">
<a href="https://www.facebook.com/Koleves?fref=ts" target="_blank">
    <div class="social-link">
        <svg class="icon icon-facebook-original left facebook-share"><use xlink:href="#icon-facebook-original"></use></svg>
        
            <p>Facebook</p>
    </div>
    </a>

<a target="_blank" href="http://www.tripadvisor.co.hu/Restaurant_Review-g274887-d797853-Reviews-Koleves-Budapest_Central_Hungary.html">
	<div class="social-link">
		<svg class="icon icon-trip-original left"><use xlink:href="#icon-trip-original"></use></svg>
		
        <p>Trip Advisor</p>
	</div>
</a>
    <a href="https://plus.google.com/118370404699522430705/posts" target="_blank">
        <div class="social-link">
            <svg class="icon icon-google-original left gplus-share"><use xlink:href="#icon-google-original"></use></svg>
            
            <p>Google Plus</p>
        </div>
    </a>
    <a href="https://foursquare.com/v/k%C5%91leves-vend%C3%A9gl%C5%91/4b75b6abf964a520101f2ee3" target="_blank">
        <div class="social-link">
            <svg class="icon icon-foursquare-original left"><use xlink:href="#icon-foursquare-original"></use></svg>
            
            <p>Four Square</p>
        </div>
    </a>
        <div class="social-link share-trigger">

            <div class="share-popup">
                <a href="http://www.facebook.com/sharer/sharer.php?u=https://www.facebook.com/Koleves?ref=ts&fref=ts" target="_blank" class="share-button share-fb"><svg class="icon icon-facebook-original"><use xlink:href="#icon-facebook-original"></use></svg></a>
                <a href="http://plus.google.com/share?url=https://plus.google.com/118370404699522430705/posts" target="_blank" class="share-button share-g"><svg class="icon icon-google-original"><use xlink:href="#icon-google-original"></use></svg></a>
            </div>
            <svg class="icon icon-share-original left"><use xlink:href="#icon-share-original"></use></svg>
            
            <p>Share</p>
        </div>
    
		</div>
	</div>
	<div class="diszvonal"></div>
	<div class="f-row">
    
    
		<div class="copyright">
			<a href="http://halluci-nation.com/" target="_blank"><img src="assets/img/halu_logo.png" alt="Created by Halluci-Nation" title="Created by Halluci-Nation"><img src="assets/img/h_logo.png" alt="Created by Halluci-Nation" title="Created by Halluci-Nation" class="h-logo"></a>
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
   /* <p>'.$socNumbers['tripadvisor'].'</p>
   <p class="gplus-count"></p>
   <p class="facebook-count"></p>*/
    
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
    		<script src="'.$_SESSION['helper']->getPath('scripts').'plugins.min.js"></script>
        	<script src="'.$_SESSION['helper']->getPath('scripts').'main.js"></script>
    	';
    
    	
    	//$subPageScriptPath = $_SESSION['helper']->getPath('scripts').$subPage.'.min.js';
    	//$subPageScriptPath = 'assets/js/'.$subPage.'.min.js';
    	$subPageScriptPath = 'assets/js/'.$subPage.'.js';
    	   
    	if (file_exists($subPageScriptPath)){
    		echo '<script src="'.$subPageScriptPath.'"></script>';
    	}

    	echo '
    		<script type="text/javascript">
    			
    			function checkoutOpen(){
    				$.post("requestHandler", {request: "checkoutForm"}, function(resp){
                		       	
    					$.each(resp, function(id, obj){
    						itemTemplate = $(".checkout-item:first").clone(true);
    						itemTemplate.find(".checkout-item-name").text(obj.labelHeader);
    						itemTemplate.find(".checkout-item-quantity").text(obj.egyseg);
    						itemTemplate.find(".checkout-item-cost").text(obj.egysegar);
    						itemTemplate.find(".checkout-item-img").html("<img src=\""+obj.kep+"\"/>");
    						
    						$(".checkout-items > div").append(itemTemplate);
    					});
    			
    					$(".checkout-item:first").hide();
                       	$(".overlay-checkout").addClass("overlay-checkout-open");
  						$("html, body").addClass("no-scroll");
    			
    					callCheckoutItem();		
    					refreshCheckoutSum();
    					
                    }, "json");
				}
    			
    			function boltItemOpen(itemID){
 						
    				$.post("requestHandler", {request: "itemForm", id: itemID}, function(resp){
                
    						itemTemplate = $(".bolt-item-view:first").clone(true);
    						sliderContainer	= $(".bolt-item-slider", itemTemplate);
    						sliderNavContainer = $(".bolt-item-slider-nav", itemTemplate);

    						sliderContainer.html("");
    						sliderNavContainer.html("");
    			
    						$.each(resp.kepek, function(key, val){
    							
    							sliderContainer.append(  $("<div/>").append( $("<img/>").attr("src", "'.$_SESSION['helper']->getPath().'"+val) ) );
    							sliderNavContainer.append(  $("<div/>").append( $("<img/>").attr("src", "'.$_SESSION['helper']->getPath().'"+val) ) );
    						});
    			
    						itemTemplate.find("h4").text(resp.labelHeader);
    						itemTemplate.find("h4").attr("data-id", resp.id);
    						itemTemplate.find(".item-fokategoria").text(resp.labelKategoria);
    						itemTemplate.find(".item-alkategoria").text(resp.labelAlkategoria);
    						itemTemplate.find("h5").text(resp.egysegar);
    						itemTemplate.find(".item-leiras").text(resp.labelDesc);
    			
    						itemTemplate.find(".checkout-item-img").html("<img src=\""+resp.kep+"\"/>");
    			
    						$(".bolt-item-view-container").append(itemTemplate);
    			
    					$(".bolt-item-view:first").remove();
    			
                       	$(".overlay-bolt").addClass("bolt-item-open");
				  		$("html, body").addClass("no-scroll"); 
    					
    					itemLoaded = true;
                    }, "json"); 	 
    			}
    			
				
    			
    			$(document).ready(function(){
					var contents = $("#nl-form").html();
					
                    $(document).on("submit","#nl-form",function(e){
                      e.preventDefault();
                      
                      
                      foglalasData = {
                        request: "asztalfoglalasUpdate",
                        nev: $("input[name=\'nev\']" , $(this)).val(),
                        datum: $("input[name=\'datum\']" , $(this)).val(),
                        ido: $("input[name=\'ido\']" , $(this)).val(),
                        id:  $("input[name=\'id\']" , $(this)).val(),
                        hanyfo: $("select[name=\'hanyfo\']" , $(this)).val(),
                        email: $("input[name=\'email\']" , $(this)).val(),
                        telefonszam: $("input[name=\'telefonszam\']" , $(this)).val(),
                        megjegyzes: $("input[name=\'megjegyzes\']" , $(this)).val(),
    					jovahagyas: 1             
                      };

                    var ujrafoglalasContent = $("<div/>").addClass("ujra-foglalas").html("<h3>Asztalfoglalás megtörtént!</h3><br/>Köszi <span class=\"foglalas-data\">"+foglalasData.nev+"</span>, hogy betértél hozzánk! Hamarosan visszaigazolunk a <span class=\"foglalas-data\">"+foglalasData.email+"</span> email címen, vagy a <span class=\"foglalas-data\">"+foglalasData.telefonszam+"</span> telefonszámon, hogy <span class=\"foglalas-data\">"+foglalasData.datum+" - "+foglalasData.ido+"</span>-kor tudjuk-e biztosítani a(z) <span class=\"foglalas-data\">"+foglalasData.hanyfo+"</span> helyet.<div class=\"nl-submit-wrap\"><button class=\"nl-reset\" type=\"submit\">Újbóli foglalás</button><button class=\"nl-reset right\" type=\"submit\">Rendben, köszi</button></div>");
                  

                      $.post("requestHandler.php", foglalasData, function(resp){
                        
                         $(".foglalas-form").velocity({rotateX: "-90deg"}, 600);
                          setTimeout(function(){
                           $(".foglalas-form").velocity({rotateX: "-270deg"}, 0);
                           $(".nl-replace").addClass("visuallyhidden");
                           $("#nl-form").prepend(ujrafoglalasContent);
                           $(".foglalas-form").velocity({rotateX: "-360deg"}, 600);
                           $(".foglalas-form").velocity({rotateX: "0deg"}, 0);
                           $(".nl-reset").Svgenerate({rangeX:0.94,rangeY:0.91,});
                        }, 599);
                         
                      }, "json");
                    
                    });
					
                     $(document).on("click", ".nl-reset", function(e){
                       e.preventDefault();
                       $(".foglalas-form").velocity({rotateX: "-90deg"}, 600);
                        setTimeout(function(){
                             $(".foglalas-form").velocity({rotateX: "-270deg"}, 0);
                             $(".ujra-foglalas").remove();
                             $(".nl-replace").removeClass("visuallyhidden");
                             $(".foglalas-form").velocity({rotateX: "-360deg"}, 600);
                             $(".foglalas-form").velocity({rotateX: "0deg"}, 0);  

                             $("#nl-form > div > div:nth-child(4) > a").text("XY");
                             $("#nl-form > div > div.nl-field.nl-dd > a").text("egy");
                             $("#nl-form > div > input.datepicker").val("ma");  
                             $("#nl-form > div > input.timepicker").val("13:30");
                             $("#nl-form > div > div:nth-child(11) > a").text("Erre az");
                             $("#nl-form > div > div:nth-child(14) > a").text("Ezen a");
                             $("#nl-form > div > div:nth-child(17) > a").text("Szeretem a maceszgombócot!");

                        }, 599);
                     });
    			
    				
    				$(".tag-label.tag-'.$_SESSION['helper']->getPage().'").trigger("click");
    		
    				

    						
 //   				$(".langselect-container div").click(function(){
 //   					data = {
 //   						request: "switchLanguage",
 //   						lang: $(this).text().substring(0, 2).toLowerCase()
 //   					};
 //   					$.post("requestHandler.php", data, function(resp){
 //   						location.reload();
 //   					});
 //   				});
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
